<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'QWIKHOM CMS') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004271;
            --secondary-color: #353535;
            --dark-color: #000000;
            --light-bg: #e4f9ff;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.1);
            --border-radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(0, 66, 113, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(53, 53, 53, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1200px;
            display: flex;
            min-height: 600px;
            box-shadow: var(--card-shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
            background: white;
            position: relative;
            z-index: 1;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0066A1 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            color: white;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="90" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .brand-section {
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .brand-logo {
            width: 180px;
            height: 120px;
            background: white;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.25);
        }

        .brand-logo img {
            width: 195px;
            height: 90px;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .brand-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 400;
            margin-bottom: 2rem;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features-list li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .features-list li i {
            margin-right: 0.75rem;
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
        }

        .login-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 66, 113, 0.1);
        }

        .form-input::placeholder {
            color: #adb5bd;
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.1rem;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 0.5rem;
            accent-color: var(--primary-color);
        }

        .checkbox-group label {
            color: #6c757d;
            font-weight: 500;
            cursor: pointer;
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #002d52;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0066A1 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 66, 113, 0.3);
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 66, 113, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .loading-state {
            display: none;
            text-align: center;
            color: var(--primary-color);
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 10px;
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 66, 113, 0.1);
        }

        .social-icon {
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
            display: none;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        .footer-text {
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: auto;
            padding-top: 2rem;
        }

        .footer-text i {
            color: var(--primary-color);
            margin-right: 0.25rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .login-left {
                padding: 2rem 1.5rem;
                min-height: 300px;
            }

            .login-right {
                padding: 2rem 1.5rem;
            }

            .brand-title {
                font-size: 2rem;
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .login-left,
            .login-right {
                padding: 1.5rem 1rem;
            }

            .brand-title {
                font-size: 1.8rem;
            }

            .login-title {
                font-size: 1.6rem;
            }
        }

        /* Animations */
        .login-wrapper {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-input:focus {
            animation: inputFocus 0.3s ease-out;
        }

        @keyframes inputFocus {
            0% { transform: scale(1); }
            50% { transform: scale(1.01); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Side - Brand Section -->
        <div class="login-left">
            <div class="brand-section">
                <div class="brand-logo">
                    <img src="{{ asset('images/image 2 1.png') }}" alt="QWIKHOM Logo">
                </div>
                <h1 class="brand-title">QWIKHOM</h1>
                <p class="brand-subtitle">Website Content Management System</p>

                <ul class="features-list">
                    <li><i class="fas fa-tachometer-alt"></i> Comprehensive Dashboard</li>
                    <li><i class="fas fa-edit"></i> Content Management</li>
                    <li><i class="fas fa-users"></i> User Administration</li>
                    <li><i class="fas fa-chart-line"></i> Analytics & Reporting</li>
                    <li><i class="fas fa-shield-alt"></i> Secure & Reliable</li>
                </ul>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2 class="login-title">Welcome Back</h2>
                <p class="login-subtitle">Sign in to access your CMS dashboard</p>
            </div>

            <!-- Alert for messages -->
            <div id="alertMessage" class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <span id="alertText"></span>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required autocomplete="email" autofocus>
                    <i class="fas fa-user input-icon"></i>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required autocomplete="current-password">
                    <i class="fas fa-lock input-icon"></i>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="checkbox-group">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In to Dashboard
                </button>

                <div class="loading-state" id="loadingState">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span>Authenticating...</span>
                </div>
            </form>

            <div class="divider">
                <span>or continue with</span>
            </div>

            <div class="social-buttons">
                <a href="#" class="btn-social google-btn" onclick="loginWithGoogle()">
                    <svg class="social-icon" viewBox="0 0 24 24" width="18" height="18">
                        <path fill="#EA4335" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#FBBC05" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#34A853" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#4285F4" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </a>
                <a href="#" class="btn-social microsoft-btn" onclick="loginWithMicrosoft()">
                    <svg class="social-icon" viewBox="0 0 24 24" width="18" height="18">
                        <path fill="#F25022" d="M1 1h10v10H1z"/>
                        <path fill="#00A4EF" d="M12 1h10v10H12z"/>
                        <path fill="#7FBA00" d="M1 12h10v10H1z"/>
                        <path fill="#FFB900" d="M12 12h10v10H12z"/>
                    </svg>
                    Microsoft
                </a>
            </div>

            <div class="footer-text">
                <i class="fas fa-shield-alt"></i>
                Secure login powered by QWIKHOM CMS
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const loadingState = document.getElementById('loadingState');

            // Show loading state
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
            loadingState.style.display = 'block';
        });

        function loginWithGoogle() {
            console.log('Google login initiated');
            showAlert('Google login integration coming soon!', 'info');
        }

        function loginWithMicrosoft() {
            console.log('Microsoft login initiated');
            showAlert('Microsoft login integration coming soon!', 'info');
        }

        function showAlert(message, type = 'danger') {
            const alertMessage = document.getElementById('alertMessage');
            const alertText = document.getElementById('alertText');

            alertText.textContent = message;
            alertMessage.className = `alert alert-${type}`;
            alertMessage.style.display = 'block';

            // Auto-hide success messages
            if (type === 'success') {
                setTimeout(() => {
                    alertMessage.style.display = 'none';
                }, 3000);
            }
        }

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
