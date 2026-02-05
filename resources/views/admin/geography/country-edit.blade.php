@extends('admin.layout.master')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
    }

    /* Top Navigation Bar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-container {
        flex: 0 0 300px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 10px 20px 10px 45px;
        border: 1px solid #6c6c6c;
        border-radius: 30px;
        font-size: 18px;
        color: #666262;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #004271;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .task-dropdown {
        padding: 11px;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        background: white;
        cursor: pointer;
        font-size: 16px;
        color: black;
        transition: all 0.3s ease;
    }

    .task-dropdown:hover {
        border-color: #004271;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-left: auto;
    }

    .btn-main-account {
        background: #003b67;
        color: white;
        padding: 13px 46px;
        border-radius: 10px;
        border: none;
        font-weight: 500;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-main-account:hover {
        background: #002a4f;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f5f5f5;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .icon-btn:hover {
        background: #e0e0e0;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Geography Edit Page Styles */
    .geography-container {
        padding: 50px 40px;
    }

    .geography-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .geography-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-view {
        background: #317FF1;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    /* Form Styles */
    .geography-form {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 50px;
        padding: 24px 46px 40px;
        max-width: 1035px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px 60px;
        position: relative;
    }

    .form-grid::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #e0e0e0;
        transform: translateX(-50%);
    }

    .form-section {
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-icon {
        font-size: 28px;
    }

    .section-header h2 {
        font-size: 24px;
        font-weight: 500;
        color: black;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #313131;
        margin-bottom: 5px;
    }

    .required {
        color: #e31e24;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        height: 45px;
        border: 1px solid #313131;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
    }

    .form-group textarea {
        height: auto;
        resize: vertical;
        padding: 12px 17px;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #4c4c4c;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #317ff1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        background: white;
    }

    .select-wrapper svg {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 0 20px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.2);
        border: 1px solid #317ff1;
        color: black;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.3);
    }

    .btn-primary {
        background-color: #317ff1;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e5a99;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        max-width: 1035px;
        margin-left: auto;
        margin-right: auto;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
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

    /* Responsive */
    @media (max-width: 1200px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .form-grid::before {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .geography-container {
            padding: 1rem;
        }

        .geography-form {
            border-radius: 20px;
            padding: 20px;
        }

        .header-actions {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>

<div class="dashboard-wrapper">
   

    <div class="geography-container">
        <div class="geography-header">
            <h1 class="geography-title">Edit Country</h1>
            <div class="header-actions">
                <a href="{{ route('admin.countries.show', $country->id) }}" class="btn-view">
                    <i class="fas fa-eye"></i> View Country
                </a>
                <a href="{{ route('admin.countries.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Countries
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="geography-form" method="POST" action="{{ route('admin.countries.update', $country->id) }}">
            @csrf
            @method('PUT')

            <div class="section-header">
                <span class="section-icon">🌍</span>
                <h2>Edit Country Details</h2>
            </div>

            <div class="form-grid">
                <div class="form-section">
                    <div class="form-group">
                        <label>Country Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $country->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Country Code <span class="required">*</span></label>
                        <input type="text" name="code" value="{{ old('code', $country->code) }}" maxlength="10" required>
                    </div>

                    <div class="form-group">
                        <label>Currency</label>
                        <input type="text" name="currency" value="{{ old('currency', $country->currency) }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="select-wrapper">
                            <select name="status">
                                <option value="1" {{ old('status', $country->status) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !old('status', $country->status) ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label>Region</label>
                        <div class="select-wrapper">
                            <select name="region">
                                <option value="">Select Region</option>
                                <option value="Middle East" {{ old('region', $country->region) == 'Middle East' ? 'selected' : '' }}>Middle East</option>
                                <option value="Asia" {{ old('region', $country->region) == 'Asia' ? 'selected' : '' }}>Asia</option>
                                <option value="Europe" {{ old('region', $country->region) == 'Europe' ? 'selected' : '' }}>Europe</option>
                                <option value="Africa" {{ old('region', $country->region) == 'Africa' ? 'selected' : '' }}>Africa</option>
                                <option value="Americas" {{ old('region', $country->region) == 'Americas' ? 'selected' : '' }}>Americas</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3" placeholder="Additional information about the country">{{ old('description', $country->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.countries.show', $country->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Country</button>
            </div>
        </form>
    </div>
</div>
@endsection