@extends('admin.layout.master')

@section('title', 'Edit Expense')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Expense</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.expense-tracking.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expense_type">Expense Type</label>
                                        <input type="text" class="form-control" id="expense_type" name="expense_type" value="Fuel Purchase" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount" value="350.00" step="0.01" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expense_date">Expense Date</label>
                                        <input type="date" class="form-control" id="expense_date" name="expense_date" value="2023-12-15" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="Fuel" selected>Fuel</option>
                                            <option value="Maintenance">Maintenance</option>
                                            <option value="Salaries">Salaries</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Tolls">Tolls</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_method">Payment Method</label>
                                        <select class="form-control" id="payment_method" name="payment_method">
                                            <option value="Credit Card" selected>Credit Card</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Check">Check</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved" selected>Approved</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">Fuel purchase for TRK-001, 50 gallons premium diesel</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor">Vendor</label>
                                        <input type="text" class="form-control" id="vendor" name="vendor" value="Peak Fuel Station">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="receipt_number">Receipt Number</label>
                                        <input type="text" class="form-control" id="receipt_number" name="receipt_number" value="FUEL-2023-12-001">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Expense
                                    </button>
                                    <a href="{{ route('admin.expense-tracking.index') }}" class="btn btn-outline-custom">
                                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection