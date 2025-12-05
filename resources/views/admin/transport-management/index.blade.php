@extends('admin.layout.master')

@section('title', 'Transport Management')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Transport Management Dashboard</h3>
                        <a href="{{ route('admin.transport-management.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Transport Route
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Route Name</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Distance (km)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>NYC to BOS Express</td>
                                        <td>New York, NY</td>
                                        <td>Boston, MA</td>
                                        <td>345</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('admin.transport-management.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.transport-management.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.transport-management.destroy', 1) }}" method="POST" style="display: inline;">
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
                                        <td>LA to SF Coastal</td>
                                        <td>Los Angeles, CA</td>
                                        <td>San Francisco, CA</td>
                                        <td>615</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('admin.transport-management.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.transport-management.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.transport-management.destroy', 2) }}" method="POST" style="display: inline;">
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