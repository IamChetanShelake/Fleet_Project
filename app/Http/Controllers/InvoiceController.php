<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of all invoices (based on consignments).
     * Filtered by franchise_id from session
     */
    public function index()
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::orderBy('created_at', 'desc');
        
        // Filter by franchise if franchise_id is in session
        // Also include records where franchise_id is NULL (legacy data)
        if ($franchiseId) {
            $query->where(function($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }
        
        // Only show consignments that have been assigned (have a vehicle assigned)
        $query->whereNotNull('assigned_vehicle_no')
              ->where('assigned_vehicle_no', '!=', '');
        
        $transports = $query->paginate(10);
        
        return view('admin.invoice.index', compact('transports'));
    }

    /**
     * View Invoice details for a specific consignment.
     * Filtered by franchise_id from session
     */
    public function view($id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('id', $id);
        
        // Filter by franchise if franchise_id is in session
        // Also include records where franchise_id is NULL (legacy data)
        if ($franchiseId) {
            $query->where(function($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }
        
        $transport = $query->firstOrFail();
        
        return view('admin.invoice.view', compact('transport'));
    }

    /**
     * Download Invoice PDF for a consignment.
     */
    public function download($id)
    {
        $franchiseId = session('franchise_id');
        $franchiseName = session('selected_franchise_name') ?? 'UAE';
        
        $query = Transport::where('id', $id);
        
        // Filter by franchise if franchise_id is in session
        // Also include records where franchise_id is NULL (legacy data)
        if ($franchiseId) {
            $query->where(function($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }
        
        $transport = $query->firstOrFail();

        // Generate invoice number with franchise-specific prefix
        $franchiseCode = 'UAE'; // Default
        switch ($franchiseName) {
            case 'Qatar':
                $franchiseCode = 'QTR';
                break;
            case 'Saudi Arabia':
                $franchiseCode = 'SAU';
                break;
            case 'United Arab Emirates':
                $franchiseCode = 'UAE';
                break;
            default:
                $franchiseCode = substr(strtoupper($franchiseName), 0, 3);
        }
        $invoiceNo = 'INV/' . $franchiseCode . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        
        $expenseTypes = is_array($transport->expense_types) ? implode(', ', $transport->expense_types) : ($transport->expense_types ?? '');
        $expenseAmounts = is_array($transport->expense_amounts) ? implode(', ', $transport->expense_amounts) : ($transport->expense_amounts ?? '');
        $expenseRemarks = is_array($transport->expense_remarks) ? implode(', ', $transport->expense_remarks) : ($transport->expense_remarks ?? '');

        $data = [
            'id' => $invoiceNo,
            'created_at' => $transport->created_at ? $transport->created_at->format('Y-m-d H:i:s') : '',
            'updated_at' => $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : '',
            'consigner' => $transport->consigner ?? '',
            'pickup_location' => $transport->pickup_location ?? '',
            'source_pincode' => $transport->source_pincode ?? '',
            'source_city' => $transport->source_city ?? '',
            'source_state' => $transport->source_state ?? '',
            'source_country' => $transport->source_country ?? '',
            'delivery_location' => $transport->delivery_location ?? '',
            'address_line' => $transport->address_line ?? '',
            'building_no' => $transport->building_no ?? '',
            'dest_pincode' => $transport->dest_pincode ?? '',
            'dest_state' => $transport->dest_state ?? '',
            'dest_country' => $transport->dest_country ?? '',
            'dest_city' => $transport->dest_city ?? '',
            'pickup_datetime' => $transport->pickup_datetime ? \Carbon\Carbon::parse($transport->pickup_datetime)->format('Y-m-d H:i') : '',
            'delivery_date' => $transport->delivery_date ? \Carbon\Carbon::parse($transport->delivery_date)->format('Y-m-d') : '',
            'receiver_name' => $transport->receiver_name ?? '',
            'receiver_mobile' => $transport->receiver_mobile ?? '',
            'party_lr_no' => $transport->party_lr_no ?? '',
            'packages' => $transport->packages ?? '',
            'weight' => $transport->weight ?? '',
            'invoice_no' => $transport->invoice_no ?? '',
            'invoice_value' => $transport->invoice_value ?? '',
            'trip_type' => $transport->trip_type ?? '',
            'vehicle_type' => $transport->vehicle_type ?? '',
            'assigned_vehicle_no' => $transport->assigned_vehicle_no ?? '',
            'assigned_driver' => $transport->assigned_driver ?? '',
            'assigned_driver_id' => $transport->assigned_driver_id ?? '',
            'handling_instructions' => $transport->handling_instructions ?? '',
            'freight_weight' => $transport->freight_weight ?? '',
            'weight_unit' => $transport->weight_unit ?? 'KG',
            'rate_per_unit' => $transport->rate_per_unit ?? '',
            'total_packages' => $transport->total_packages ?? '',
            'rate_per_package' => $transport->rate_per_package ?? '',
            'fixed_cost' => $transport->fixed_cost ?? '',
            'expense_types' => $expenseTypes,
            'expense_amounts' => $expenseAmounts,
            'expense_remarks' => $expenseRemarks,
            'final_notes' => $transport->final_notes ?? '',
            'status' => ucfirst($transport->status ?? 'draft'),
            'total_cost' => $transport->total_cost ?? '',
        ];

        // Generate PDF using DomPDF
        $pdf = Pdf::loadView('admin.consignment.invoice-pdf', compact('data'));
        
        // Download the PDF file
        return $pdf->download('invoice-' . str_replace('/', '-', $invoiceNo) . '.pdf');
    }
}