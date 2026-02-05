<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $data['id'] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h4 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #003B67;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #003B67;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 12px;
        }
        th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .info-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .total-row {
            background: #f0f0f0;
            font-weight: bold;
        }
        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <h1>LOGISTICS FLEET MANAGEMENT INVOICE</h1>

    <!-- Basic Info -->
    <table>
        <tr>
            <td style="width: 50%;"><strong>Invoice ID:</strong> {{ $data['id'] }}</td>
            <td style="width: 50%;"><strong>Status:</strong> {{ $data['status'] }}</td>
        </tr>
        <tr>
            <td><strong>Created At:</strong> {{ $data['created_at'] }}</td>
            <td><strong>Updated At:</strong> {{ $data['updated_at'] }}</td>
        </tr>
    </table>

    <!-- Consigner & Receiver -->
    <div class="section">
        <div class="section-title">Consigner & Receiver Details</div>
        <div class="info-grid">
            <div class="info-box">
                <h4>CONSIGNER (Source)</h4>
                <p><strong>{{ $data['consigner'] }}</strong></p>
                <p>{{ $data['pickup_location'] }}</p>
                <p>{{ $data['source_city'] }}, {{ $data['source_state'] }} - {{ $data['source_pincode'] }}</p>
                <p>{{ $data['source_country'] }}</p>
            </div>
            <div class="info-box">
                <h4>RECEIVER (Destination)</h4>
                <p><strong>{{ $data['receiver_name'] }}</strong></p>
                <p>{{ $data['building_no'] }}, {{ $data['address_line'] }}</p>
                <p>{{ $data['delivery_location'] }}</p>
                <p>{{ $data['dest_city'] }}, {{ $data['dest_state'] }} - {{ $data['dest_pincode'] }}</p>
                <p>{{ $data['dest_country'] }}</p>
                <p>Mobile: {{ $data['receiver_mobile'] }}</p>
            </div>
        </div>
    </div>

    <!-- Trip & Vehicle Details -->
    <div class="section">
        <div class="section-title">Trip & Vehicle Details</div>
        <table>
            <tr>
                <th>Trip Type</th>
                <td>{{ $data['trip_type'] }}</td>
                <th>Vehicle Type</th>
                <td>{{ $data['vehicle_type'] }}</td>
            </tr>
            <tr>
                <th>Vehicle No</th>
                <td>{{ $data['assigned_vehicle_no'] }}</td>
                <th>Driver Name</th>
                <td>{{ $data['assigned_driver'] }}</td>
            </tr>
            <tr>
                <th>Driver ID</th>
                <td>{{ $data['assigned_driver_id'] }}</td>
                <th>Pickup Date/Time</th>
                <td>{{ $data['pickup_datetime'] }}</td>
            </tr>
            <tr>
                <th>Delivery Date</th>
                <td>{{ $data['delivery_date'] }}</td>
                <th>LR No</th>
                <td>{{ $data['party_lr_no'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Consignment Details -->
    <div class="section">
        <div class="section-title">Consignment Details</div>
        <table>
            <tr>
                <th style="width: 20%;">Invoice No</th>
                <td style="width: 20%;">{{ $data['invoice_no'] }}</td>
                <th style="width: 20%;">Invoice Value</th>
                <td style="width: 20%;">{{ $data['invoice_value'] }}</td>
                <th style="width: 20%;">Packages</th>
                <td style="width: 20%;">{{ $data['packages'] }}</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>{{ $data['weight'] }} Tons</td>
                <th>Status</th>
                <td>{{ $data['status'] }}</td>
                <th>Created</th>
                <td>{{ $data['created_at'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Financial Summary -->
    <div class="section">
        <div class="section-title">Financial Summary</div>
        <table>
            <tr>
                <th style="width: 25%;">Freight Weight</th>
                <th style="width: 25%;">Rate/Unit</th>
                <th style="width: 25%;">Fixed Cost</th>
                <th style="width: 25%;">Total Cost</th>
            </tr>
            <tr>
                <td>{{ $data['freight_weight'] ? $data['freight_weight'] . ' ' . $data['weight_unit'] : 'Not Set' }}</td>
                <td>{{ $data['rate_per_unit'] ?: 'Not Set' }}</td>
                <td>{{ $data['fixed_cost'] ?: 'Not Set' }}</td>
                <td rowspan="2" class="total-row">{{ $data['total_cost'] ?: '0.00' }}</td>
            </tr>
            <tr>
                <td colspan="2">Expenses: {{ $data['expense_types'] ?: 'None' }}</td>
                <td>{{ $data['expense_amounts'] ?: '0.00' }}</td>
            </tr>
        </table>
        @if(!$data['freight_weight'] && !$data['fixed_cost'])
        <p style="color: #ED5A68; font-size: 12px; margin-top: 10px;"><strong>Note:</strong> Financial summary is pending. Please complete the Charges & Advance step.</p>
        @endif
    </div>

    <!-- Additional Info -->
    @if($data['handling_instructions'] || $data['expense_remarks'] || $data['final_notes'])
    <div class="section">
        <div class="section-title">Additional Information</div>
        @if($data['handling_instructions'])
        <p><strong>Handling Instructions:</strong> {{ $data['handling_instructions'] }}</p>
        @endif
        @if($data['expense_remarks'])
        <p><strong>Expense Remarks:</strong> {{ $data['expense_remarks'] }}</p>
        @endif
        @if($data['final_notes'])
        <p><strong>Final Notes:</strong> {{ $data['final_notes'] }}</p>
        @endif
    </div>
    @endif
</body>
</html>
