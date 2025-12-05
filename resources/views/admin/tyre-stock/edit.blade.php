@extends('admin.layout.master')

@section('title', 'Edit Tyre Stock')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Tyre Stock</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tyre-stock.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tyre_id">Tyre ID</label>
                                        <input type="text" class="form-control" id="tyre_id" name="tyre_id" value="STK-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" value="Michelin" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" class="form-control" id="size" name="size" value="295/80R22.5" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="12" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <select class="form-control" id="location" name="location" required>
                                            <option value="Warehouse A" selected>Warehouse A</option>
                                            <option value="Warehouse B">Warehouse B</option>
                                            <option value="Main Office">Main Office</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="In Stock" selected>In Stock</option>
                                            <option value="Low Stock">Low Stock</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" class="form-control" id="supplier" name="supplier" value="Michelin Direct">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="2023-10-15">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3">Bulk purchase with 10% discount</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Tyre Stock
                                    </button>
                                    <a href="{{ route('admin.tyre-stock.index') }}" class="btn btn-outline-custom">
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