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

    /* New Consignment Page Styles */
    .consignment-container {
        padding: 50px 40px;
    }

    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .consignment-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 133px;
        height: 45px;
    }

    .step-label {
        font-size: 19px;
        font-weight: 500;
        color: #6c6c6c;
        text-align: center;
    }

    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #317ff1;
    }

    .step-line {
        width: 120px;
        height: 2px;
        background-color: #6c6c6c;
    }

    /* Form Styles */
    .consignment-form {
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
    .form-group select {
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

    .form-group input::placeholder {
        color: #4c4c4c;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #317ff1;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-group.half {
        flex: 1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper input {
        padding-right: 40px;
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

    /* Updated form styles */
    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #ED5A68;
    }

    .step.completed .step-label {
        color: #317ff1;
    }

    .step-line.completed {
        background-color: #317ff1;
        height: 3px;
    }

    .step-line.completed.green {
        background-color: #33C17F;
    }

    .step-line.active {
        background-color: #ED5A68;
        height: 3px;
    }

    /* Section Headers */
    .section-header-main {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 30px;
        padding: 1px 0;
    }

    .section-header-main h2 {
        font-size: 24px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .select-tag {
        color: #DC3545;
        font-size: 14px;
        font-weight: 500;
    }

    /* Freight Cost Options */
    .freight-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 28px;
    }

    .freight-option {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .freight-option h3 {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin: 0 0 10px 0;
    }

    .freight-fields {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .field-row {
        display: flex;
        gap: 10px;
    }

    .calculated-cost {
        text-align: right;
        font-size: 25px;
        font-weight: 500;
        color: #ED5A68;
        margin-top: 28px;
    }

    /* Itemized Expenses */
    .itemized-section {
        margin-top: 50px;
    }

    .expense-row {
        display: grid;
        grid-template-columns: 290px 290px 290px 45px;
        gap: 20px;
        align-items: end;
    }

    .add-btn {
        width: 45px;
        height: 45px;
        background: #317ff1;
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .total-expenses {
        text-align: right;
        font-size: 25px;
        font-weight: 500;
        color: #ED5A68;
        margin-top: 28px;
    }

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 15px;
    }

    .summary-card {
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        padding: 17px 18px;
    }

    .summary-card-header {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
    }

    .summary-card-header h3 {
        font-size: 24px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .summary-fields {
        display: flex;
        gap: 10px;
    }

    .summary-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .summary-field {
        border-bottom: 1px solid #000;
        padding-bottom: 0;
    }

    .summary-field label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 9px;
    }

    .summary-field .value {
        font-size: 14px;
        font-weight: 400;
        line-height: 1.43;
        color: #000;
    }

    /* Final Section */
    .final-section {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        justify-content: center;
        margin-top: 15px;
    }

    .final-input {
        width: 512px;
    }

    .confirm-btn {
        width: 512px;
        height: 45px;
        border: 2px solid #ED5A68;
        border-radius: 10px;
        background: white;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 8px 17px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 400;
        color: #ED5A68;
    }

    .confirm-btn input[type="checkbox"] {
        width: 24.57px;
        height: 22px;
        cursor: pointer;
    }
</style>

<div class="dashboard-wrapper">
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

    <div class="consignment-container">

    <!-- Updated Form Steps -->
    <div class="form-steps">
        <div class="step completed">
            <span class="step-label">Route & Parties</span>
        </div>
        <div class="step-line completed"></div>
        <div class="step completed">
            <span class="step-label">Freight & Assignment</span>
        </div>
        <div class="step-line completed green"></div>
        <div class="step active">
            <span class="step-label">Charges & Advance</span>
        </div>
        <div class="step-line active"></div>
        <div class="step">
            <span class="step-label">Booking Confirmed</span>
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

    <form class="consignment-form" method="POST" action="{{ route('admin.booking-confirmed.index') }}">
        @csrf
        
        <!-- Freight & Cost Breakdown Section -->
        <div class="section-header-main">
            <span style="font-size: 28px;">💰</span>
            <h2>Freight & Cost Breakdown</h2>
            <span class="select-tag">(Select Any One)</span>
        </div>

        <div class="freight-options">
            <!-- Rate By Weight -->
            <div class="freight-option">
                <h3>Rate By Weight</h3>
                <div class="freight-fields">
                    <div class="field-row">
                        <div class="form-group" style="flex: 1;">
                            <label style="font-size: 16px; font-weight: 500; color: #313131;">Freight Weight</label>
                            <input type="text" name="freight_weight" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label style="font-size: 16px; font-weight: 500; color: #313131;">Unit</label>
                            <select name="weight_unit" style="width: 100%; height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C; appearance: none; background: white;">
                                <option>Unit..</option>
                                <option>Kg</option>
                                <option>Tons</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Rate / Unit (QR)</label>
                        <input type="text" name="rate_per_unit" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>

            <!-- Rate By Package -->
            <div class="freight-option">
                <h3>Rate By Package</h3>
                <div class="freight-fields">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Total Packages</label>
                        <input type="text" name="total_packages" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Rate / Package (QR)</label>
                        <input type="text" name="rate_per_package" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>

            <!-- Fixed Rate -->
            <div class="freight-option">
                <h3>Fixed Rate</h3>
                <div class="freight-fields">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Fixed Freight Cost (QR)</label>
                        <input type="text" name="fixed_cost" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>
        </div>

        <div class="calculated-cost">
            Calculated Freight Cost (QR) =  00,00
        </div>

        <!-- Itemized Expenses Section -->
        <div class="itemized-section">
            <div class="section-header-main">
                <span style="font-size: 28px;">📦</span>
                <h2 style="font-size: 25px;">Itemized Expenses (Tolls, Surcharge, etc.)</h2>
            </div>

            <div class="expense-row">
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Type</label>
                    <input type="text" name="expense_type[]" placeholder="Type.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Amount (QR)</label>
                    <input type="text" name="expense_amount[]" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Remarks</label>
                    <input type="text" name="expense_remarks[]" placeholder="Optional Notes" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <button type="button" class="add-btn" onclick="addExpenseRow()">+</button>
            </div>

            <div class="total-expenses">
                Total Expenses (QR) = ₹ 00,00
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <!-- Trip Summary Overview -->
            <div class="summary-card">
                <div class="summary-card-header">
                    <span style="font-size: 28px;">📍</span>
                    <h3>Trip Summary Overview</h3>
                </div>
                <div class="summary-fields">
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Consigner</label>
                            <div class="value">Logistics 7</div>
                        </div>
                        <div class="summary-field">
                            <label>Route</label>
                            <div class="value">Qatar → Dubai</div>
                        </div>
                    </div>
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Scheduled Pickup Date & Time</label>
                            <div class="value">6 Dec 2025, 04:30 AM</div>
                        </div>
                        <div class="summary-field">
                            <label>Expected Delivery Date (Calculated)</label>
                            <div class="value">12 Dec 2025</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Freight Details -->
            <div class="summary-card">
                <div class="summary-card-header">
                    <span style="font-size: 28px;">🚚</span>
                    <h3>Freight Details</h3>
                </div>
                <div class="summary-fields">
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Total Distance (Kms)</label>
                            <div class="value">1344 kms</div>
                        </div>
                        <div class="summary-field">
                            <label>Total Travel Time</label>
                            <div class="value">72 hrs</div>
                        </div>
                        <div class="summary-field">
                            <label>Load / Weight</label>
                            <div class="value">2 Tons</div>
                        </div>
                    </div>
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Assigned Driver</label>
                            <div class="value">Rehman</div>
                        </div>
                        <div class="summary-field">
                            <label>Vehicle Type</label>
                            <div class="value">Toyota Hilux</div>
                        </div>
                        <div class="summary-field">
                            <label>Vehicle No</label>
                            <div class="value">QTR-HLX-1021</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Checks & Notes -->
        <div class="final-section">
            <div class="form-group final-input">
                <label style="font-size: 16px; font-weight: 500; color: #313131;">Final Checks & Notes</label>
                <input type="text" name="final_notes" placeholder="Instructions / Remarks" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 400; color: #000;">
            </div>
            <label class="confirm-btn">
                <input type="checkbox" name="confirm_booking" required>
                <span>Confirm Booking</span>
            </label>
        </div>

        <div class="form-actions" style="margin-top: 30px; display: flex; justify-content: space-between; width: 920px; margin-left: auto; margin-right: auto;">
            <a href="{{ route('admin.freight-assignment.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </div>
    </form>
    </div>
</div>

<script>
function addExpenseRow() {
    const expenseContainer = document.querySelector('.expense-row').parentElement;
    const newRow = document.querySelector('.expense-row').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelector('.add-btn').remove();
    expenseContainer.insertBefore(newRow, document.querySelector('.total-expenses'));
}
</script>
@endsection