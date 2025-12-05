@extends('admin.layout.master')

@section('title', 'Edit Billing Entity')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Billing Entity</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.billing-entities.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entity_name">Entity Name</label>
                                        <input type="text" class="form-control" id="entity_name" name="entity_name" value="Acme Corporation" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entity_type">Entity Type</label>
                                        <select class="form-control" id="entity_type" name="entity_type" required>
                                            <option value="Corporate Client" selected>Corporate Client</option>
                                            <option value="Logistics Partner">Logistics Partner</option>
                                            <option value="Government">Government</option>
                                            <option value="Individual">Individual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="John Doe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="john@acme.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="+1 (555) 123-4567" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3">123 Corporate Avenue, Business District</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_id">Tax ID</label>
                                        <input type="text" class="form-control" id="tax_id" name="tax_id" value="TAX-123456789">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billing_cycle">Billing Cycle</label>
                                        <select class="form-control" id="billing_cycle" name="billing_cycle">
                                            <option value="Monthly" selected>Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Annual">Annual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Billing Entity
                                    </button>
                                    <a href="{{ route('admin.billing-entities.index') }}" class="btn btn-outline-custom">
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