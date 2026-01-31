<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $franchise->country_name }} - Fleet Management System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004271;
            --secondary-color: #353535;
            --accent-color: #00a8e8;
            --light-bg: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, #070707 0%, #000000 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container-wrapper {
            max-width: 800px;
            width: 100%;
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .back-link:hover {
            color: var(--accent-color);
            transform: translateX(-5px);
        }

        .back-link i {
            margin-right: 8px;
        }

        .franchise-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }

        .franchise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #000000 0%, #000000 100%);
        }

        .franchise-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            font-size: 2.5rem;
            color: white;
        }

        .franchise-name {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .detail-section {
            margin-bottom: 30px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #fcfcfc;
            border-radius: 10px;
            border-left: 4px solid #070809;
        }

        .detail-item i {
            width: 30px;
            font-size: 1.2rem;
            color: var(--accent-color);
            margin-right: 15px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-right: 10px;
            min-width: 120px;
        }

        .detail-value {
            color: #000000;
            font-size: 1.1rem;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            color: white;
            border: none;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .btn-login {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="header-section">
            <h1><i class="fas fa-globe"></i> Franchise Details</h1>
            <p>View and manage franchise information</p>
        </div>

        <a href="{{ route('franchises.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Regions
        </a>

        <div class="franchise-card">
            <div class="text-center">
                <div class="franchise-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="franchise-name">{{ $franchise->country_name }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <div>
                        <span class="detail-label">Currency:</span>
                        <span class="detail-value">{{ $franchise->currency }}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-percentage"></i>
                    <div>
                        <span class="detail-label">Tax Status:</span>
                        <span class="detail-value">
                            @if($franchise->has_tax)
                                Tax Applied ({{ $franchise->tax_percentage }}%)
                            @else
                                No Tax
                            @endif
                        </span>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-calendar-alt"></i>
                    <div>
                        <span class="detail-label">Created:</span>
                        <span class="detail-value">{{ $franchise->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span class="detail-label">Last Updated:</span>
                        <span class="detail-value">{{ $franchise->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <span class="detail-label">Status:</span>
                        <span class="status-badge {{ $franchise->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $franchise->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('franchises.edit', $franchise->id) }}" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i> Edit Region
                </a>
                <form action="{{ route('franchises.destroy', $franchise->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this franchise?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        <i class="fas fa-trash"></i> Delete Region
                    </button>
                </form>
                <a href="{{ route('franchises.login', $franchise->id) }}" class="btn-action btn-login">
                    <i class="fas fa-sign-in-alt"></i> Go to Login
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>