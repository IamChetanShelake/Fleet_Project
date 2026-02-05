@extends('admin.layout.master')

@php
    $title = 'Invoice Details';
    $titles = 'Invoice Details';
    $route = 'invoice';
@endphp

@section('content')
<style>
    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
        transition: margin-left 0.3s ease;
    }

    .invoice-container-wrapper {
        width: 100%;
    }

    .invoice-container {
        padding: 30px 40px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }
        
        .invoice-container {
            padding: 20px;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="invoice-container-wrapper">
        <div class="invoice-container">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0 font-size-18">Invoice Details</h4>
                            <p class="text-muted mb-0">View and manage invoice details for consignment</p>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">
                                <i class="fi fi-rr-arrow-left"></i> Back to List
                            </a>
                            <a href="{{ route('admin.invoice.download', $transport->id) }}" class="btn btn-primary">
                                <i class="fi fi-rr-download"></i> Download Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Details Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Header -->
                            <div style="text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
                                <h1 style="font-size: 24px; font-weight: bold; color: #003B67;">LOGISTICS FLEET MANAGEMENT INVOICE</h1>
                            </div>

                            <!-- Basic Info -->
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
                                <tr>
                                    <td style="width: 50%; padding: 8px; border: 1px solid #ddd;"><strong>Invoice ID:</strong> {{ 'INV/UAE/' . str_pad($transport->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td style="width: 50%; padding: 8px; border: 1px solid #ddd;"><strong>Status:</strong> {{ ucfirst($transport->status ?? 'draft') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>Created At:</strong> {{ $transport->created_at ? $transport->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>Updated At:</strong> {{ $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                </tr>
                            </table>

                            <!-- Consigner & Receiver -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 5px; margin-bottom: 15px;">Consigner & Receiver Details</div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px;">
                                        <h4 style="font-size: 16px; margin-bottom: 10px; color: #003B67;">CONSIGNER (Source)</h4>
                                        <p><strong>{{ $transport->consigner ?? 'N/A' }}</strong></p>
                                        <p>{{ $transport->pickup_location ?? 'N/A' }}</p>
                                        <p>{{ $transport->source_city ?? 'N/A' }}, {{ $transport->source_state ?? 'N/A' }} - {{ $transport->source_pincode ?? 'N/A' }}</p>
                                        <p>{{ $transport->source_country ?? 'N/A' }}</p>
                                    </div>
                                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px;">
                                        <h4 style="font-size: 16px; margin-bottom: 10px; color: #003B67;">RECEIVER (Destination)</h4>
                                        <p><strong>{{ $transport->receiver_name ?? 'N/A' }}</strong></p>
                                        <p>{{ $transport->building_no ?? 'N/A' }}, {{ $transport->address_line ?? 'N/A' }}</p>
                                        <p>{{ $transport->delivery_location ?? 'N/A' }}</p>
                                        <p>{{ $transport->dest_city ?? 'N/A' }}, {{ $transport->dest_state ?? 'N/A' }} - {{ $transport->dest_pincode ?? 'N/A' }}</p>
                                        <p>{{ $transport->dest_country ?? 'N/A' }}</p>
                                        <p>Mobile: {{ $transport->receiver_mobile ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip & Vehicle Details -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 5px; margin-bottom: 15px;">Trip & Vehicle Details</div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Trip Type</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->trip_type ?? 'N/A' }}</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Vehicle Type</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->vehicle_type ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Vehicle No</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Driver Name</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->assigned_driver ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Driver ID</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->assigned_driver_id ?? 'N/A' }}</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Pickup Date/Time</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->pickup_datetime ? \Carbon\Carbon::parse($transport->pickup_datetime)->format('Y-m-d H:i') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Delivery Date</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->delivery_date ? \Carbon\Carbon::parse($transport->delivery_date)->format('Y-m-d') : 'N/A' }}</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">LR No</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->party_lr_no ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Consignment Details -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 5px; margin-bottom: 15px;">Consignment Details</div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="width: 20%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Invoice No</th>
                                        <td style="width: 20%; padding: 8px; border: 1px solid #ddd;">{{ $transport->invoice_no ?? 'N/A' }}</td>
                                        <th style="width: 20%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Invoice Value</th>
                                        <td style="width: 20%; padding: 8px; border: 1px solid #ddd;">{{ $transport->invoice_value ?? 'N/A' }}</td>
                                        <th style="width: 20%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Packages</th>
                                        <td style="width: 20%; padding: 8px; border: 1px solid #ddd;">{{ $transport->packages ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Weight</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->weight ?? 'N/A' }} Tons</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Status</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ ucfirst($transport->status ?? 'draft') }}</td>
                                        <th style="padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Created</th>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->created_at ? $transport->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Financial Summary -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 5px; margin-bottom: 15px;">Financial Summary</div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="width: 25%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Freight Weight</th>
                                        <th style="width: 25%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Rate/Unit</th>
                                        <th style="width: 25%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Fixed Cost</th>
                                        <th style="width: 25%; padding: 8px; border: 1px solid #ddd; background: #f5f5f5; font-weight: bold;">Total Cost</th>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->freight_weight ?? 'Not Set' }} {{ $transport->weight_unit ?? 'KG' }}</td>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->rate_per_unit ?? 'Not Set' }}</td>
                                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $transport->fixed_cost ?? 'Not Set' }}</td>
                                        <td rowspan="2" style="padding: 8px; border: 1px solid #ddd; background: #f0f0f0; font-weight: bold;">{{ $transport->total_cost ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">
                                            @php
                                                $expenseTypes = is_array($transport->expense_types) ? implode(', ', $transport->expense_types) : ($transport->expense_types ?? 'None');
                                            @endphp
                                            Expenses: {{ $expenseTypes }}
                                        </td>
                                        <td style="padding: 8px; border: 1px solid #ddd;">
                                            @php
                                                $expenseAmounts = is_array($transport->expense_amounts) ? implode(', ', $transport->expense_amounts) : ($transport->expense_amounts ?? '0.00');
                                            @endphp
                                            {{ $expenseAmounts }}
                                        </td>
                                    </tr>
                                </table>
                                @if(!$transport->freight_weight && !$transport->fixed_cost)
                                <p style="color: #ED5A68; font-size: 12px; margin-top: 10px;"><strong>Note:</strong> Financial summary is pending. Please complete the Charges & Advance step.</p>
                                @endif
                            </div>

                            <!-- Additional Info -->
                            @if($transport->handling_instructions || (is_array($transport->expense_remarks) ? implode(', ', $transport->expense_remarks) : $transport->expense_remarks) || $transport->final_notes)
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 5px; margin-bottom: 15px;">Additional Information</div>
                                @if($transport->handling_instructions)
                                <p style="margin-bottom: 8px;"><strong>Handling Instructions:</strong> {{ $transport->handling_instructions }}</p>
                                @endif
                                @if($transport->expense_remarks)
                                @php
                                    $expenseRemarks = is_array($transport->expense_remarks) ? implode(', ', $transport->expense_remarks) : $transport->expense_remarks;
                                @endphp
                                <p style="margin-bottom: 8px;"><strong>Expense Remarks:</strong> {{ $expenseRemarks }}</p>
                                @endif
                                @if($transport->final_notes)
                                <p><strong>Final Notes:</strong> {{ $transport->final_notes }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
