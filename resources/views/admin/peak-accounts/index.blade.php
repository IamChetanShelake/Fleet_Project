@extends('admin.layout.master')

@section('title', 'Peak Accounts')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Peak Accounts Management</h3>
                        <a href="{{ route('admin.peak-accounts.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Account
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Account Name</th>
                                        <th>Type</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Last Transaction</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>Main Operating Account</td>
                                        <td>Operational</td>
                                        <td>$125,450.00</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>2023-12-15</td>
                                        <td>
                                            <a href="{{ route('admin.peak-accounts.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.peak-accounts.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.peak-accounts.destroy', 1) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Fuel & Maintenance Reserve</td>
                                        <td>Reserve</td>
                                        <td>$25,800.00</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>2023-12-10</td>
                                        <td>
                                            <a href="{{ route('admin.peak-accounts.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.peak-accounts.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.peak-accounts.destroy', 2) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection