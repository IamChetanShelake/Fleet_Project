<?php

namespace App\Http\Controllers;

use App\Models\Pod;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodController extends Controller
{
    /**
     * Display POD upload page for a specific transport
     */
    public function index($transportId)
    {
        $transport = Transport::findOrFail($transportId);
        $pods = Pod::where('transport_id', $transportId)->orderBy('created_at', 'desc')->get();

        return view('admin.pod.index', compact('transport', 'pods'));
    }

    /**
     * Store uploaded POD files
     */
    public function store(Request $request, $transportId)
    {
        $transport = Transport::findOrFail($transportId);
        
        $uploadedFiles = [];
        $errorFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                try {
                    // Generate unique filename
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = pathinfo($originalName, PATHINFO_FILENAME);
                    $safeFileName = Str::slug($fileName);
                    $uniqueFileName = $safeFileName . '_' . time() . '_' . Str::random(8) . '.' . $extension;
                    
                    // Create directory if it doesn't exist
                    $uploadPath = public_path('pod/' . $transportId);
                    if (!File::exists($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true);
                    }
                    
                    // Move file to storage
                    $file->move($uploadPath, $uniqueFileName);
                    
                    // Create POD record
                    $pod = new Pod();
                    $pod->transport_id = $transportId;
                    $pod->file_name = $uniqueFileName;
                    $pod->original_name = $originalName;
                    $pod->file_path = 'pod/' . $transportId . '/' . $uniqueFileName;
                    $pod->save();
                    
                    $uploadedFiles[] = $originalName;
                    
                } catch (\Exception $e) {
                    $errorFiles[] = $originalName . ' (' . $e->getMessage() . ')';
                }
            }
        } else {
            return redirect()->route('admin.pod.index', $transportId)
                ->with('error', 'No files were uploaded. Please select files to upload.');
        }

        $message = '';
        if (count($uploadedFiles) > 0) {
            $message .= 'Successfully uploaded ' . count($uploadedFiles) . ' file(s): ' . implode(', ', $uploadedFiles) . '.';
        }
        if (count($errorFiles) > 0) {
            $message .= ' Failed to upload: ' . implode(', ', $errorFiles);
        }

        return redirect()->route('admin.pod.index', $transportId)
            ->with('success', $message ?: 'No files were uploaded.');
    }

    /**
     * View a specific POD file
     */
    public function view($id)
    {
        $pod = Pod::findOrFail($id);
        
        $filePath = public_path($pod->file_path);
        
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->file($filePath);
    }

    /**
     * Download a specific POD file
     */
    public function download($id)
    {
        $pod = Pod::findOrFail($id);
        
        $filePath = public_path($pod->file_path);
        
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->download($filePath, $pod->original_name);
    }

    /**
     * Delete a specific POD file
     */
    public function destroy($id)
    {
        $pod = Pod::findOrFail($id);
        
        // Delete file from storage
        $filePath = public_path($pod->file_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        
        // Delete record from database
        $transportId = $pod->transport_id;
        $pod->delete();
        
        return redirect()->route('admin.pod.index', $transportId)
            ->with('success', 'File deleted successfully.');
    }
}
