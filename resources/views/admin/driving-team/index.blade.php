@extends('admin.layout.master')

@section('title', 'Driving Team')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Driving Team Management</h3>
                        <a href="{{ route('admin.driving-team.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Driver
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>License Type</th>
                                        <th>Vehicle Type</th>
                                        <th>Experience (Years)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>Michael Johnson</td>
                                        <td>CDL Class A</td>
                                        <td>Truck</td>
                                        <td>8</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('admin.driving-team.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.driving-team.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.driving-team.destroy', 1) }}" method="POST" style="display: inline;">
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
                                        <td>Robert Williams</td>
                                        <td>CDL Class B</td>
                                        <td>Bus</td>
                                        <td>5</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('admin.driving-team.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.driving-team.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.driving-team.destroy', 2) }}" method="POST" style="display: inline;">
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