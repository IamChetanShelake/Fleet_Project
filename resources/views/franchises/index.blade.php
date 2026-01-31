<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Region - Fleet Management System</title>
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
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container-wrapper {
            max-width: 1200px;
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

        .add-button-center {
            text-align: center;
            margin: 100px 0;
        }

        .add-button-corner {
            text-align: right;
            margin-bottom: 30px;
        }

        .btn-add-franchise {
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add-franchise:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            color: white;
        }

        .btn-add-franchise i {
            margin-right: 10px;
        }

        .franchise-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .franchise-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
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
            background: linear-gradient(90deg, #f9fafb 0%, #f9f8fa 100%);
        }

        .franchise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.25);
        }

        .franchise-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: white;
        }

        .franchise-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .franchise-details {
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #666;
            font-size: 0.95rem;
        }

        .detail-item i {
            width: 25px;
            color: var(--accent-color);
        }

        .btn-login {
            margin: 20px;
            width: 100%;
            background: linear-gradient(135deg, #0f0f0f 0%, #030303 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 20px rgba(253, 253, 253, 0.4);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }

        .empty-state i {
            font-size: 5rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 30px;
        }

        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.1);
        }

        .btn-outline-primary {
            --bs-btn-color: #000000;
            --bs-btn-border-color: #000000;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #000000;
            --bs-btn-hover-border-color: #0d6efd;
            --bs-btn-focus-shadow-rgb: 13, 110, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #0d6efd;
            --bs-btn-active-border-color: #0d6efd;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #0d6efd;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #0d6efd;
            --bs-gradient: none;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .franchise-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="header-section">
            <h1><i class="fas fa-globe"></i> Fleet Management System</h1>
            <p>Select your region to continue</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($franchises->count() > 0)
            <div class="add-button-corner">
                <a href="{{ route('franchises.create') }}" class="btn-add-franchise">
                    <i class="fas fa-plus-circle"></i> Add New Region
                </a>
            </div>

            <div class="franchise-grid">
                @foreach($franchises as $franchise)
                    <div class="franchise-card">
                        <div class="franchise-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="franchise-name">{{ $franchise->country_name }}</div>
                        <div class="franchise-details">
                            <div class="detail-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Currency: <strong>{{ $franchise->currency }}</strong></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-percentage"></i>
                                <span>Tax: <strong>{{ $franchise->has_tax ? $franchise->tax_percentage . '%' : 'No Tax' }}</strong></span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <a href="{{ route('franchises.show', $franchise->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('franchises.edit', $franchise->id) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('franchises.destroy', $franchise->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this franchise?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            <a href="{{ route('franchises.login', $franchise->id) }}" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i> Go to Login
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-globe-americas"></i>
                <h3>No Regions Available</h3>
                <p>Get started by adding your first region</p>
                <a href="{{ route('franchises.create') }}" class="btn-add-franchise">
                    <i class="fas fa-plus-circle"></i> Add New Region
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>