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
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #003B67;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #003B67 0%, #0056b3 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo i {
            font-size: 40px;
            color: white;
        }
        .company-info h1 {
            font-size: 22px;
            font-weight: bold;
            color: #003B67;
            margin: 0;
        }
        .company-info p {
            font-size: 14px;
            color: #666;
            margin: 2px 0;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h2 {
            font-size: 28px;
            font-weight: bold;
            color: #003B67;
            margin: 0;
        }
        .invoice-title p {
            font-size: 16px;
            color: #333;
            margin: 5px 0 0 0;
        }
        h4 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #003B67;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #003B67;
            padding-bottom: 8px;
            margin-bottom: 15px;
            color: #003B67;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 12px;
        }
        th {
            background: #003B67;
            color: white;
            font-weight: bold;
        }
        .info-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            background: #f9f9f9;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .total-row {
            background: #003B67;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .status-badge {
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #003B67;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        @media print {
            body {
                padding: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-truck"></i>
            </div>
            <div class="company-info">
                <h1>LOGISTICS FLEET</h1>
                <p>MANAGEMENT SYSTEM</p>
                <p style="font-size: 12px; color: #999;">Professional Logistics Solutions</p>
            </div>
        </div>
        <div class="invoice-title">
            <h2>INVOICE</h2>
            <p><strong>{{ $data['id'] }}</strong></p>
        </div>
    </div>

    <!-- Invoice Info -->
    <table>
        <tr>
            <td style="width: 50%; background: #f9f9f9;"><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}</td>
            <td style="width: 50%; background: #f9f9f9;"><strong>Status:</strong> 
                <span class="status-badge" style="background: {{ $data['status'] === 'delivered' ? '#28a745' : ($data['status'] === 'cancelled' ? '#dc3545' : '#ffc107') }};">
                    {{ ucfirst($data['status']) }}
                </span>
            </td>
        </tr>
        <tr>
            <td><strong>Created At:</strong> {{ $data['created_at'] }}</td>
            <td><strong>Updated At:</strong> {{ $data['updated_at'] }}</td>
        </tr>
    </table>

    <!-- Consigner & Receiver -->
    <div class="section">
        <div class="section-title"><i class="fas fa-exchange-alt"></i> Consigner & Receiver Details</div>
        <div class="info-grid">
            <div class="info-box">
                <h4><i class="fas fa-arrow-up"></i> Consigner (Source)</h4>
                <p><strong>{{ $data['consigner'] }}</strong></p>
                <p>{{ $data['pickup_location'] }}</p>
                <p>{{ $data['source_city'] }}, {{ $data['source_state'] }} - {{ $data['source_pincode'] }}</p>
                <p>{{ $data['source_country'] }}</p>
            </div>
            <div class="info-box">
                <h4><i class="fas fa-arrow-down"></i> Receiver (Destination)</h4>
                <p><strong>{{ $data['receiver_name'] }}</strong></p>
                <p>{{ $data['building_no'] }}, {{ $data['address_line'] }}</p>
                <p>{{ $data['delivery_location'] }}</p>
                <p>{{ $data['dest_city'] }}, {{ $data['dest_state'] }} - {{ $data['dest_pincode'] }}</p>
                <p>{{ $data['dest_country'] }}</p>
                <p><i class="fas fa-phone"></i> {{ $data['receiver_mobile'] }}</p>
            </div>
        </div>
    </div>

    <!-- Trip & Vehicle Details -->
    <div class="section">
        <div class="section-title"><i class="fas fa-truck"></i> Trip & Vehicle Details</div>
        <table>
            <tr>
                <th>Trip Type</th>
                <td>{{ $data['trip_type'] }}</td>
                <th>Vehicle Type</th>
                <td>{{ $data['vehicle_type'] }}</td>
            </tr>
            <tr>
                <th>Vehicle No</th>
                <td style="font-weight: bold; color: #003B67;">{{ $data['assigned_vehicle_no'] }}</td>
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
        <div class="section-title"><i class="fas fa-box"></i> Consignment Details</div>
        <table>
            <tr>
                <th style="width: 20%;">Invoice No</th>
                <td style="width: 20%;">{{ $data['id'] }}</td>
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
        <div class="section-title"><i class="fas fa-calculator"></i> Financial Summary</div>
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
                <td colspan="2"><strong>Expenses:</strong> {{ $data['expense_types'] ?: 'None' }}</td>
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
        <div class="section-title"><i class="fas fa-info-circle"></i> Additional Information</div>
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

    <!-- Footer -->
    <div class="footer">
        <p><strong>LOGISTICS FLEET MANAGEMENT SYSTEM</strong></p>
        <p>Professional Logistics Solutions | Delivering Excellence</p>
        <p>Thank you for your business!</p>
    </div>
</body>
</html>
