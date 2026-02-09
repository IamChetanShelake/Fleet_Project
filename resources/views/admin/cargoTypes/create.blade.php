@extends('admin.layout.master')

@section('title', 'Add Admin Setting')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-card">
                        <div class="card-header">
                            <h3 class="mb-0">Add New Cargo Type</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.cargoTypes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cargo_name">Cargo Name</label>
                                            <input type="text" class="form-control" id="cargo_name" name="cargo_name"
                                                required>
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
                                        <input type="file" name="image" id="image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-custom">
                                            <i class="fas fa-save mr-2"></i> Save Cargo Type
                                        </button>
                                        <a href="{{ route('admin.cargoTypes.index') }}" class="btn btn-outline-custom">
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
