@extends('admin.layout.master')

@section('title', 'Add Admin Setting')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Add New Admin Setting</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.admin-panel.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="setting_name">Setting Name</label>
                                        <input type="text" class="form-control" id="setting_name" name="setting_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            <option value="System">System</option>
                                            <option value="Security">Security</option>
                                            <option value="Notifications">Notifications</option>
                                            <option value="User Management">User Management</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="setting_key">Setting Key</label>
                                        <input type="text" class="form-control" id="setting_key" name="setting_key" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="setting_value">Setting Value</label>
                                        <input type="text" class="form-control" id="setting_value" name="setting_value" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_type">Data Type</label>
                                        <select class="form-control" id="data_type" name="data_type" required>
                                            <option value="String">String</option>
                                            <option value="Boolean">Boolean</option>
                                            <option value="Number">Number</option>
                                            <option value="Array">Array</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
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

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="default_value">Default Value</label>
                                        <input type="text" class="form-control" id="default_value" name="default_value">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Save Admin Setting
                                    </button>
                                    <a href="{{ route('admin.admin-panel.index') }}" class="btn btn-outline-custom">
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