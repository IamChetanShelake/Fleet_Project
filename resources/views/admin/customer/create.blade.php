@extends('admin.layout.master')

@section('title', 'Add Customer - Peak Logistics')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: #E5EAF2;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
    }

    .form-wrapper {
        width: 100%;
    }

    /* Top Navbar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-container {
        position: relative;
        flex: 0 0 353px;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666262;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 30px;
        padding: 10px 20px 10px 55px;
        font-size: 18px;
        font-weight: 700;
        color: #666262;
        background: #fff;
    }

    .search-input::placeholder {
        color: #666262;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .btn-main-account {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 46px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .icon-btn {
        width: 50px;
        height: 48px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn i {
        font-size: 22px;
        color: #000;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .user-avatar i {
        font-size: 30px;
        color: #666;
    }

    /* Form Container */
    .form-container {
        padding: 50px 40px;
        width: 100%;
    }

    /* Header Section */
    .form-header {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 12px 37px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .form-header h1 {
        font-size: 22px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    /* Form Card */
    .form-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 40px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Photo Upload */
    .photo-upload-container {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
    }

    .photo-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #E5EAF2;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 3px solid #003B67;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview i {
        font-size: 40px;
        color: #999;
    }

    .photo-upload-btn {
        background: #003B67;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 14px;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .photo-upload-btn:hover {
        background: #002a4f;
    }

    .photo-upload-input {
        display: none;
    }

    .upload-hint {
        font-size: 12px;
        color: #666;
        margin-top: 8px;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .required {
        color: #e31e24;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        height: 55px;
        border: 1px solid #b0b0b0;
        border-radius: 10px;
        padding: 0 20px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }

    .form-group textarea {
        height: 120px;
        padding: 15px 20px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #317FF1;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(49, 127, 241, 0.1);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
        padding-top: 25px;
        border-top: 2px solid #E5EAF2;
    }

    .btn {
        padding: 14px 30px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.1);
        border: 2px solid #003B67;
        color: #003B67;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.2);
    }

    .btn-primary {
        background-color: #003B67;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #002a4f;
        transform: translateY(-2px);
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .photo-upload-container {
            flex-direction: column;
            text-align: center;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-card {
            padding: 20px;
        }
    }
</style>

<div class="dashboard-wrapper">
<div class="form-wrapper">


    <!-- Form Container -->
    <div class="form-container">
        <!-- Header -->
        <div class="form-header">
            <h1>Add New Customer</h1>
        </div>

        @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Customer Form Card -->
        <div class="form-card">
            <form method="POST" action="{{ route('admin.customer.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Photo Upload -->
                <div class="form-group">
                    <label>Customer Photo</label>
                    <div class="photo-upload-container">
                        <div class="photo-preview" id="photoPreview">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <label for="photo" class="photo-upload-btn">
                                <i class="fas fa-camera"></i>
                                Upload Photo
                            </label>
                            <input type="file" name="photo" id="photo" class="photo-upload-input" accept="image/*" onchange="previewPhoto(event)">
                            <p class="upload-hint">Max size: 2MB | Formats: JPEG, PNG, JPG, GIF</p>
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label>Customer Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter customer name" required>
                    </div>

                    <!-- Mobile No -->
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter mobile number">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password (min 6 characters)">
                    </div>

                    <!-- Address -->
                    <div class="form-group full-width">
                        <label>Address</label>
                        <textarea name="address" placeholder="Enter full address">{{ old('address') }}</textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    // Photo Preview Function
    function previewPhoto(event) {
        const preview = document.getElementById('photoPreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Photo Preview">';
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<i class="fas fa-user"></i>';
        }
    }
</script>
@endsection
