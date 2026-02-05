<?php

namespace App\Http\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\PettyCash;
use App\Models\Project;
use App\Models\PettyCashAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\WhatsApp\AiSensyService;

class PettyCashController extends Controller
{
    public function index()
    {
        // Get the selected project from session
        $selectedProjectId = session('selected_project_id');

        // Filter petty cash entries by supervisor and selected project
        $pettyCashEntries = PettyCash::with(['project', 'supervisor'])
            ->where('supervisor_id', Auth::id())
            ->when($selectedProjectId, function ($query) use ($selectedProjectId) {
                return $query->where('project_id', $selectedProjectId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate totals for the selected project only
        $totalAmountQuery = PettyCash::where('supervisor_id', Auth::id());
        $totalTransactionsQuery = PettyCash::where('supervisor_id', Auth::id());
        $thisMonthTransactionsQuery = PettyCash::where('supervisor_id', Auth::id());

        if ($selectedProjectId) {
            $totalAmountQuery->where('project_id', $selectedProjectId);
            $totalTransactionsQuery->where('project_id', $selectedProjectId);
            $thisMonthTransactionsQuery->where('project_id', $selectedProjectId);
        }

        $totalAmount = $totalAmountQuery->sum('amount');
        $totalTransactions = $totalTransactionsQuery->count();
        $thisMonthTransactionsCount = $thisMonthTransactionsQuery
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Get projects assigned to the supervisor
        $projects = Project::whereHas('supervisors', function($query) {
            $query->where('supervisor_id', Auth::id());
        })->with(['pettyCashAllocations'])->get();

        // Calculate allocation information for each project
        foreach ($projects as $project) {
            $allocation = $project->pettyCashAllocations->first();
            $project->allocatedAmount = $allocation ? $allocation->allocated_amount : 0;
            $project->totalExpenses = $project->pettyCashEntries()
                ->where('supervisor_id', Auth::id())
                ->sum('amount');
            $project->remainingBalance = $project->allocatedAmount - $project->totalExpenses;
        }

        return view('supervisor.pettyCash.index', compact(
            'pettyCashEntries',
            'totalAmount',
            'totalTransactions',
            'thisMonthTransactionsCount',
            'projects',
            'selectedProjectId'
        ));
    }

    public function create()
    {
        $selectedProjectId = session('selected_project_id');

        $projects = Project::whereHas('supervisors', function($query) {
            $query->where('supervisor_id', Auth::id());
        })->get();

        return view('supervisor.pettyCash.create', compact('projects', 'selectedProjectId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'amount_type' => 'required|in:cash,online',
            'category' => 'required|string|max:255',
            'expense_date' => 'required|date',
            'project_id' => 'nullable|exists:projects,id',
            'receipt_number' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'photos.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:20480', // 20MB
            'videos.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:102400', // 100MB
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240', // 10MB
        ]);

        $pettyCash = new PettyCash();
        $pettyCash->supervisor_id = Auth::id();

        // Use selected project if no project is specified in the request
        $selectedProjectId = session('selected_project_id');
        $pettyCash->project_id = $request->project_id ?? $selectedProjectId;

        $pettyCash->expense_name = $request->expense_name;
        $pettyCash->description = $request->description;
        $pettyCash->amount = $request->amount;
        $pettyCash->amount_type = $request->amount_type;
        $pettyCash->category = $request->category;
        $pettyCash->expense_date = $request->expense_date;
        $pettyCash->receipt_number = $request->receipt_number;
        $pettyCash->remarks = $request->remarks;

        // Handle file uploads
        $pettyCash->photos = $this->handleFileUploads($request, 'photos', 'petty-cash/photos');
        $pettyCash->videos = $this->handleFileUploads($request, 'videos', 'petty-cash/videos');
        $pettyCash->documents = $this->handleFileUploads($request, 'documents', 'petty-cash/documents');

        $pettyCash->save();

        // Notify contractor via AiSensy (non-blocking)
        try {
            $supervisorName = Auth::user()->name ?? 'Supervisor';
            $project = $pettyCash->project_id ? Project::find($pettyCash->project_id) : null;
            $projectName = $project?->name ?? 'Project';
            $expenseDate = $pettyCash->expense_date ? (\Carbon\Carbon::parse($pettyCash->expense_date)->format('d/m/Y')) : '-';

            $templateParams = [
                $supervisorName,               // {{1}} Supervisor Name
                $projectName,                  // {{2}} Project Name
                $pettyCash->expense_name ?? '-', // {{3}} Expense Name
                $expenseDate,                  // {{4}} Expense Date d/m/Y
                (string) $pettyCash->amount,   // {{5}} Amount
                $pettyCash->amount_type ?? '-',// {{6}} Payment Type
                $pettyCash->category ?? '-',   // {{7}} Expense Category
            ];

            // Contractor destination from .env
            $adminDest = config('aisensy.admin_destination');
            $destination = $adminDest ? (preg_match('/^\+?\d+$/', $adminDest) ? ltrim($adminDest, '+') : preg_replace('/\D/', '', $adminDest)) : null;

            Log::info('Preparing AiSensy payload for petty cash expense (contractor)', [
                'destination' => $destination,
                'templateParams' => $templateParams,
            ]);

            if ($destination) {
                $service = new AiSensyService();
                $sendResult = $service->sendPettyCashExpenseForContractor([
                    'destination' => $destination,
                    'userName' => config('aisensy.username'),
                    'templateParams' => $templateParams,
                    'paramsFallbackValue' => ['FirstName' => 'user'],
                ]);

                Log::info('AiSensy send result (petty cash expense -> contractor)', [
                    'petty_cash_id' => $pettyCash->id,
                    'result' => $sendResult,
                ]);
            } else {
                Log::warning('AiSensy skipped: contractor destination missing/invalid for petty cash expense');
            }
        } catch (\Throwable $notifyEx) {
            Log::error('AiSensy error while sending petty cash expense to contractor', [
                'petty_cash_id' => $pettyCash->id ?? null,
                'error' => $notifyEx->getMessage(),
                'trace' => $notifyEx->getTraceAsString(),
            ]);
        }

        return redirect()->route('supervisor.pettyCash')->with('success', 'Petty cash entry added successfully!');
    }

    public function show(PettyCash $pettyCash)
    {
        // Ensure supervisor can only view their own entries
        if ($pettyCash->supervisor_id !== Auth::id()) {
            abort(403);
        }

        return view('supervisor.pettyCash.show', compact('pettyCash'));
    }

    public function edit(PettyCash $pettyCash)
    {
        // Ensure supervisor can only edit their own entries and only if pending
        if ($pettyCash->supervisor_id !== Auth::id() || $pettyCash->status !== 'pending') {
            abort(403);
        }

        $selectedProjectId = session('selected_project_id');

        $projects = Project::whereHas('supervisors', function($query) {
            $query->where('supervisor_id', Auth::id());
        })->get();

        return view('supervisor.pettyCash.edit', compact('pettyCash', 'projects', 'selectedProjectId'));
    }

    public function update(Request $request, PettyCash $pettyCash)
    {
        // Ensure supervisor can only update their own entries and only if pending
        if ($pettyCash->supervisor_id !== Auth::id() || $pettyCash->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'expense_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'amount_type' => 'required|in:cash,online',
            'category' => 'required|string|max:255',
            'expense_date' => 'required|date',
            'project_id' => 'nullable|exists:projects,id',
            'receipt_number' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'photos.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:20480',
            'videos.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:102400',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        // Use selected project if no project is specified in the request
        $selectedProjectId = session('selected_project_id');
        $pettyCash->project_id = $request->project_id ?? $selectedProjectId;

        $pettyCash->expense_name = $request->expense_name;
        $pettyCash->description = $request->description;
        $pettyCash->amount = $request->amount;
        $pettyCash->amount_type = $request->amount_type;
        $pettyCash->category = $request->category;
        $pettyCash->expense_date = $request->expense_date;
        $pettyCash->receipt_number = $request->receipt_number;
        $pettyCash->remarks = $request->remarks;

        // Handle new file uploads
        if ($request->hasFile('photos')) {
            $pettyCash->photos = $this->handleFileUploads($request, 'photos', 'petty-cash/photos');
        }
        if ($request->hasFile('videos')) {
            $pettyCash->videos = $this->handleFileUploads($request, 'videos', 'petty-cash/videos');
        }
        if ($request->hasFile('documents')) {
            $pettyCash->documents = $this->handleFileUploads($request, 'documents', 'petty-cash/documents');
        }

        $pettyCash->save();

        return redirect()->route('supervisor.pettyCash')->with('success', 'Petty cash entry updated successfully!');
    }

    public function destroy(PettyCash $pettyCash)
    {
        // Ensure supervisor can only delete their own entries and only if pending
        if ($pettyCash->supervisor_id !== Auth::id() || $pettyCash->status !== 'pending') {
            abort(403);
        }

        // Delete associated files
        $this->deleteFiles($pettyCash->photos);
        $this->deleteFiles($pettyCash->videos);
        $this->deleteFiles($pettyCash->documents);

        $pettyCash->delete();

        return redirect()->route('supervisor.pettyCash')->with('success', 'Petty cash entry deleted successfully!');
    }

    private function handleFileUploads(Request $request, string $fieldName, string $directory): ?array
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $files = [];
        foreach ($request->file($fieldName) as $file) {
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Ensure the directory exists at project root level (outside public folder)
            $rootDirectory = base_path('petty_cash_' . str_replace('-', '_', str_replace('/', '_', $directory)));
            if (!file_exists($rootDirectory)) {
                mkdir($rootDirectory, 0755, true);
            }

            $file->move($rootDirectory, $filename);
            $path = $rootDirectory . '/' . $filename;
            $files[] = $path;
        }

        return $files;
    }

    private function deleteFiles(?array $files): void
    {
        if (!$files) return;

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
