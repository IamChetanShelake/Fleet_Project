@extends('admin.layout.master')

@section('title', 'Tyre Stock')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Tyre Stock Management</h3>
                        <a href="{{ route('admin.tyre-stock.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Tyre Stock
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tyre ID</th>
                                        <th>Brand</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>STK-001</td>
                                        <td>Michelin</td>
                                        <td>295/80R22.5</td>
                                        <td>12</td>
                                        <td>Warehouse A</td>
                                        <td><span class="badge bg-success">In Stock</span></td>
                                        <td>
                                            <a href="{{ route('admin.tyre-stock.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tyre-stock.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tyre-stock.destroy', 1) }}" method="POST" style="display: inline;">
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
                                        <td>STK-002</td>
                                        <td>Bridgestone</td>
                                        <td>225/75R16</td>
                                        <td>8</td>
                                        <td>Warehouse B</td>
                                        <td><span class="badge bg-warning">Low Stock</span></td>
                                        <td>
                                            <a href="{{ route('admin.tyre-stock.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tyre-stock.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tyre-stock.destroy', 2) }}" method="POST" style="display: inline;">
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