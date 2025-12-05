@extends('admin.layout.master')

@section('title', 'Tyre Maintenance')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Tyre Maintenance Management</h3>
                        <a href="{{ route('admin.tyre-maintenance.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Tyre Record
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tyre ID</th>
                                        <th>Vehicle</th>
                                        <th>Brand</th>
                                        <th>Size</th>
                                        <th>Condition</th>
                                        <th>Last Maintenance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>TYR-001</td>
                                        <td>TRK-001</td>
                                        <td>Michelin</td>
                                        <td>295/80R22.5</td>
                                        <td><span class="badge bg-success">Good</span></td>
                                        <td>2023-11-15</td>
                                        <td>
                                            <a href="{{ route('admin.tyre-maintenance.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tyre-maintenance.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tyre-maintenance.destroy', 1) }}" method="POST" style="display: inline;">
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
                                        <td>TYR-002</td>
                                        <td>VAN-002</td>
                                        <td>Bridgestone</td>
                                        <td>225/75R16</td>
                                        <td><span class="badge bg-warning">Fair</span></td>
                                        <td>2023-10-20</td>
                                        <td>
                                            <a href="{{ route('admin.tyre-maintenance.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tyre-maintenance.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tyre-maintenance.destroy', 2) }}" method="POST" style="display: inline;">
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