@extends('admin.layout.master')

@section('title', 'Edit Help Article')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Help Article</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.help-center.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="article_title">Article Title</label>
                                        <input type="text" class="form-control" id="article_title" name="article_title" value="Getting Started Guide" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="General" selected>General</option>
                                            <option value="Logistics">Logistics</option>
                                            <option value="Technical">Technical</option>
                                            <option value="Billing">Billing</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" value="Admin" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Draft">Draft</option>
                                            <option value="Review">Review</option>
                                            <option value="Published" selected>Published</option>
                                            <option value="Archived">Archived</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea class="form-control" id="content" name="content" rows="6">Welcome to Peak Logistics! This guide will help you get started with our system and understand the basic features and functionality available to you.</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" value="getting started, beginner, guide" placeholder="Separate tags with commas">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <select class="form-control" id="priority" name="priority">
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High" selected>High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="views">Views</label>
                                        <input type="number" class="form-control" id="views" name="views" value="150" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Help Article
                                    </button>
                                    <a href="{{ route('admin.help-center.index') }}" class="btn btn-outline-custom">
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