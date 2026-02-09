@extends('admin.layout.master')

@section('title', 'Edit Admin Setting')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-card">
                        <div class="card-header">
                            <h3 class="mb-0">Edit Cargo Type</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.cargoTypes.update', $cargotype->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cargo_name">Cargo Name</label>
                                            <input type="text" class="form-control" id="cargo_name" name="cargo_name"
                                                value="{{ $cargotype->title }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $cargotype->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <input type="file" name="image" id="image" class="form-control-file">
                                    </div>
                                    <div class="col">
                                        <img src="{{ asset($cargotype->image) }}" alt="{{ $cargotype->title }}"
                                            width="100" class="mt-2">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-custom">
                                            <i class="fas fa-save mr-2"></i> update Cargo Type
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
