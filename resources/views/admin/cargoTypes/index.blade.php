@extends('admin.layout.master')

@section('title', 'Admin Panel')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Cargo Type Management</h3>
                            <a href="{{ route('admin.cargoTypes.create') }}" class="btn btn-custom">
                                <i class="fas fa-plus mr-2"></i> Add New Cargo Type
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Static data for now -->
                                        @foreach ($CargoTypes as $cargoType)
                                            <tr>
                                                <td>{{ $cargoType->id }}</td>
                                                <td>{{ $cargoType->title }}</td>
                                                <td>{{ $cargoType->description }}</td>
                                                <td><img src="{{ asset('cargo_images/' . $cargoType->image) }}"
                                                        alt="{{ $cargoType->title }}" width="50"></td>
                                                <td>{{ $cargoType->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.cargoTypes.edit', $cargoType->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.cargoTypes.destroy', $cargoType->id) }}"
                                                        method="POST" class="d-inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this cargo type?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
