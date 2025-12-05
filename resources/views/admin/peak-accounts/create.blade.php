@extends('admin.layout.master')

@section('title', 'Add Peak Account')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Add New Peak Account</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.peak-accounts.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_name">Account Name</label>
                                        <input type="text" class="form-control" id="account_name" name="account_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_type">Account Type</label>
                                        <select class="form-control" id="account_type" name="account_type" required>
                                            <option value="">Select Type</option>
                                            <option value="Operational">Operational</option>
                                            <option value="Reserve">Reserve</option>
                                            <option value="Payroll">Payroll</option>
                                            <option value="Investment">Investment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input type="text" class="form-control" id="account_number" name="account_number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="initial_balance">Initial Balance</label>
                                        <input type="number" class="form-control" id="initial_balance" name="initial_balance" step="0.01" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" id="currency" name="currency" required>
                                            <option value="USD" selected>USD ($)</option>
                                            <option value="EUR">EUR (€)</option>
                                            <option value="GBP">GBP (£)</option>
                                            <option value="INR">INR (₹)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Frozen">Frozen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="opening_date">Opening Date</label>
                                        <input type="date" class="form-control" id="opening_date" name="opening_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Save Account
                                    </button>
                                    <a href="{{ route('admin.peak-accounts.index') }}" class="btn btn-outline-custom">
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