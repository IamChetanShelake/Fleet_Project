@extends('admin.layout.master')

@section('title', 'Edit Brand')

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

    .form-container-wrapper {
        width: 100%;
    }

    /* Top Navbar */
    .top-navbar {
        height: 60px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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

    .task-dropdown {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 11px 0;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 11px 20px;
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
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .back-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #003B67;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .filter-icon {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 22px;
        color: #003B67;
    }

    /* Form Card */
    .brand-form {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 20px;
        padding: 40px;
    }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .section-header i {
        font-size: 24px;
        color: #003B67;
    }

    .section-header h2 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px 40px;
        margin-bottom: 40px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .required {
        color: #ED5A68;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        height: 45px;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 0 17px;
        font-size: 14px;
        font-weight: 400;
        color: #000;
        background: #fff;
    }

    .form-group textarea {
        height: 120px;
        padding: 15px 17px;
        resize: vertical;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #999;
    }

    /* Attach Documents Section */
    .attach-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #ddd;
    }

    .attach-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .attach-header i {
        font-size: 24px;
        color: #000;
    }

    .attach-header h3 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .file-upload-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
        margin-bottom: 30px;
    }

    .file-upload-group {
        display: flex;
        flex-direction: column;
    }

    .file-upload-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-choose-btn {
        height: 40px;
        padding: 5px 20px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #000;
        cursor: pointer;
        white-space: nowrap;
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }

    .file-name {
        font-size: 14px;
        color: #666;
    }

    /* Image Preview */
    .image-preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .image-preview {
        width: 120px;
        height: 120px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview .placeholder {
        color: #999;
        font-size: 12px;
        text-align: center;
    }

    /* Submit Button */
    .submit-section {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-submit {
        height: 50px;
        padding: 0 50px;
        border-radius: 10px;
        border: none;
        background: #317FF1;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #2669cc;
    }
</style>

<div class="dashboard-wrapper">
<div class="form-container-wrapper">
    <!-- Top Navigation Bar -->
    <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search..">
        </div>

        <div class="task-dropdown">
            Task <i class="fas fa-chevron-down"></i>
        </div>

        <div class="nav-actions">
            <button class="btn-main-account">Go To Main Account</button>
            <button class="icon-btn">
                <i class="fas fa-cog"></i>
            </button>
            <button class="icon-btn">
                <i class="fas fa-bell"></i>
            </button>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <a href="{{ route('admin.brands.index') }}" class="back-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h1>My Brands</h1>
            </div>
            <button class="filter-icon">
                <i class="fas fa-filter"></i>
            </button>
        </div>

        <!-- Brand Form -->
        <form class="brand-form" method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Brand Details Section -->
            <div class="section-header">
                <i class="fas fa-tag"></i>
                <h2>Brand Details</h2>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label><i class="fas fa-signature" style="margin-right: 8px;"></i>Brand Name<span class="required">*</span></label>
                    <input type="text" name="name" placeholder="e.g., Toyota" value="{{ old('name', $brand->name) }}" required>
                    @error('name')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-link" style="margin-right: 8px;"></i>Slug</label>
                    <input type="text" name="slug" placeholder="e.g., toyota" value="{{ old('slug', $brand->slug) }}">
                    @error('slug')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-align-left" style="margin-right: 8px;"></i>Description</label>
                    <textarea name="description" placeholder="Enter brand description">{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-toggle-on" style="margin-right: 8px;"></i>Status</label>
                    <select name="is_active">
                        <option value="1" {{ old('is_active', $brand->is_active) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $brand->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Attach Logo Section -->
            <div class="attach-section">
                <div class="attach-header">
                    <i class="fas fa-paperclip"></i>
                    <h3>Attach Logo</h3>
                </div>

                <div class="file-upload-grid">
                    <div class="file-upload-group">
                        <label>Brand Logo</label>

                        <!-- Current Logo Preview -->
                        <div class="image-preview-container">
                            <div class="image-preview" id="logo-preview">
                                @if($brand->logo)
                                    <img src="{{ asset($brand->logo) }}" alt="Current Logo">
                                @else
                                    <div class="placeholder">No Logo</div>
                                @endif
                            </div>
                            <small style="color: #666; font-size: 12px;">Current Logo</small>
                        </div>

                        <div class="file-input-wrapper">
                            <label for="brand-logo" class="file-choose-btn">Choose File</label>
                            <input type="file" id="brand-logo" name="logo" accept="image/*" onchange="updateFileName(this, 'logo-name')">
                            <span class="file-name" id="logo-name">No File Chosen</span>
                        </div>
                        <small style="color: #666; font-size: 12px;">Accepted formats: JPEG, PNG, JPG, GIF. Maximum size: 5MB. Leave empty to keep current logo</small>
                        @error('logo')
                            <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit-section">
                <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function updateFileName(input, spanId) {
    const fileName = input.files[0] ? input.files[0].name : 'No File Chosen';
    document.getElementById(spanId).textContent = fileName;

    // Update preview if it's an image
    const file = input.files[0];
    const previewId = spanId.replace('-name', '-preview');
    const preview = document.getElementById(previewId);

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">';
        };
        reader.readAsDataURL(file);
    } else if (file) {
        preview.innerHTML = '<div class="placeholder">File Selected</div>';
    }
    // If no file selected, keep existing preview
}
</script>
@endsection