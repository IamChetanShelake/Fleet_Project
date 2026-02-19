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
                            <!-- Header with Logo -->
                            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #003B67; padding-bottom: 20px; margin-bottom: 25px;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <!-- Logo -->
                                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #003B67 0%, #0056b3 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-truck" style="font-size: 40px; color: white;"></i>
                                    </div>
                                    <div>
                                        <h1 style="font-size: 22px; font-weight: bold; color: #003B67; margin: 0;">LOGISTICS FLEET</h1>
                                        <p style="font-size: 14px; color: #666; margin: 0;">MANAGEMENT SYSTEM</p>
                                        <p style="font-size: 12px; color: #999; margin: 0;">Professional Logistics Solutions</p>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <h2 style="font-size: 28px; font-weight: bold; color: #003B67; margin: 0;">INVOICE</h2>
                                    @php
                                        $franchiseCode = 'UAE';
                                        $franchiseName = session('selected_franchise_name') ?? 'United Arab Emirates';
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
                                        $invoiceNo = 'INV/' . $franchiseCode . '/' . str_pad($transport->id, 5, '0', STR_PAD_LEFT);
                                    @endphp
                                    <p style="font-size: 16px; color: #333; margin: 5px 0 0 0;"><strong>{{ $invoiceNo }}</strong></p>
                                </div>
                            </div>

                            <!-- Invoice Info -->
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
                                <tr>
                                    <td style="width: 50%; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Invoice Date:</strong> {{ $transport->created_at ? $transport->created_at->format('d M Y') : 'N/A' }}</td>
                                    <td style="width: 50%; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Status:</strong> 
                                        <span style="padding: 3px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; background: {{ $transport->status === 'delivered' ? '#28a745' : ($transport->status === 'cancelled' ? '#dc3545' : '#ffc107') }}; color: white;">
                                            {{ ucfirst($transport->status ?? 'draft') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>Created At:</strong> {{ $transport->created_at ? $transport->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>Updated At:</strong> {{ $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                </tr>
                            </table>

                            <!-- Consigner & Receiver -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 8px; margin-bottom: 15px; color: #003B67;">
                                    <i class="fas fa-exchange-alt me-2"></i>Consigner & Receiver Details
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f9f9f9;">
                                        <h4 style="font-size: 14px; margin-bottom: 10px; color: #003B67; text-transform: uppercase; letter-spacing: 1px;">
                                            <i class="fas fa-arrow-up me-2"></i>Consigner (Source)
                                        </h4>
                                        <p style="margin: 5px 0;"><strong>{{ $transport->consigner ?? 'N/A' }}</strong></p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->pickup_location ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->source_city ?? 'N/A' }}, {{ $transport->source_state ?? 'N/A' }} - {{ $transport->source_pincode ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->source_country ?? 'N/A' }}</p>
                                    </div>
                                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f9f9f9;">
                                        <h4 style="font-size: 14px; margin-bottom: 10px; color: #003B67; text-transform: uppercase; letter-spacing: 1px;">
                                            <i class="fas fa-arrow-down me-2"></i>Receiver (Destination)
                                        </h4>
                                        <p style="margin: 5px 0;"><strong>{{ $transport->receiver_name ?? 'N/A' }}</strong></p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->building_no ?? 'N/A' }}, {{ $transport->address_line ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->delivery_location ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->dest_city ?? 'N/A' }}, {{ $transport->dest_state ?? 'N/A' }} - {{ $transport->dest_pincode ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;">{{ $transport->dest_country ?? 'N/A' }}</p>
                                        <p style="margin: 5px 0; color: #666;"><i class="fas fa-phone me-1"></i>{{ $transport->receiver_mobile ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip & Vehicle Details -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 8px; margin-bottom: 15px; color: #003B67;">
                                    <i class="fas fa-truck me-2"></i>Trip & Vehicle Details
                                </div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Trip Type</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->trip_type ?? 'N/A' }}</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Vehicle Type</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->vehicle_type ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Vehicle No</th>
                                        <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; color: #003B67;">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Driver Name</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->assigned_driver ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Driver ID</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->assigned_driver_id ?? 'N/A' }}</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Pickup Date/Time</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->pickup_datetime ? \Carbon\Carbon::parse($transport->pickup_datetime)->format('d M Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Delivery Date</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->delivery_date ? \Carbon\Carbon::parse($transport->delivery_date)->format('d M Y') : 'N/A' }}</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">LR No</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->party_lr_no ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Consignment Details -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 8px; margin-bottom: 15px; color: #003B67;">
                                    <i class="fas fa-box me-2"></i>Consignment Details
                                </div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="width: 20%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Invoice No</th>
                                        <td style="width: 20%; padding: 10px; border: 1px solid #ddd;">{{ $transport->invoice_no ?? 'N/A' }}</td>
                                        <th style="width: 20%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Invoice Value</th>
                                        <td style="width: 20%; padding: 10px; border: 1px solid #ddd;">{{ $transport->invoice_value ?? 'N/A' }}</td>
                                        <th style="width: 20%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Packages</th>
                                        <td style="width: 20%; padding: 10px; border: 1px solid #ddd;">{{ $transport->packages ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Weight</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->weight ?? 'N/A' }} Tons</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Status</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ ucfirst($transport->status ?? 'draft') }}</td>
                                        <th style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Created</th>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->created_at ? $transport->created_at->format('d M Y H:i') : 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Financial Summary -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 8px; margin-bottom: 15px; color: #003B67;">
                                    <i class="fas fa-calculator me-2"></i>Financial Summary
                                </div>
                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                                    <tr>
                                        <th style="width: 25%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Freight Weight</th>
                                        <th style="width: 25%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Rate/Unit</th>
                                        <th style="width: 25%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Fixed Cost</th>
                                        <th style="width: 25%; padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold;">Total Cost</th>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->freight_weight ?? 'Not Set' }} {{ $transport->weight_unit ?? 'KG' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->rate_per_unit ?? 'Not Set' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transport->fixed_cost ?? 'Not Set' }}</td>
                                        <td rowspan="2" style="padding: 10px; border: 1px solid #ddd; background: #003B67; color: white; font-weight: bold; font-size: 18px;">{{ $transport->total_cost ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px; border: 1px solid #ddd;">
                                            @php
                                                $expenseTypes = is_array($transport->expense_types) ? implode(', ', $transport->expense_types) : ($transport->expense_types ?? 'None');
                                            @endphp
                                            <strong>Expenses:</strong> {{ $expenseTypes }}
                                        </td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
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
                                <div style="font-size: 16px; font-weight: bold; border-bottom: 2px solid #003B67; padding-bottom: 8px; margin-bottom: 15px; color: #003B67;">
                                    <i class="fas fa-info-circle me-2"></i>Additional Information
                                </div>
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

                            <!-- Footer -->
                            <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #003B67; text-align: center; color: #666; font-size: 12px;">
                                <p style="margin: 0;"><strong>LOGISTICS FLEET MANAGEMENT SYSTEM</strong></p>
                                <p style="margin: 5px 0;">Professional Logistics Solutions | Delivering Excellence</p>
                                <p style="margin: 5px 0;">Thank you for your business!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
