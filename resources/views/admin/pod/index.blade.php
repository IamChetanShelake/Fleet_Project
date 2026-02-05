@extends('admin.layout.master')

@section('title', 'POD Upload - Peak Logistics')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: #E5EAF2;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
        transition: margin-left 0.3s ease;
    }

    .pod-container {
        padding: 30px 40px;
        width: 100%;
    }

    .page-header {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .trip-info {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-back {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 9px 16px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #f5f5f5;
    }

    .content-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    .upload-section {
        padding: 30px;
        border-bottom: 1px solid #E5EAF2;
        background: #f8f9fa;
    }

    .upload-area {
        border: 2px dashed #317ff1;
        border-radius: 15px;
        padding: 50px;
        text-align: center;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        background: #f0f7ff;
        border-color: #2567d6;
    }

    .upload-area.dragover {
        background: #e3f2fd;
        border-color: #1976D2;
    }

    .upload-icon {
        font-size: 48px;
        color: #317ff1;
        margin-bottom: 15px;
    }

    .upload-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 10px;
    }

    .upload-subtitle {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }

    .upload-btn {
        background: #317ff1;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .upload-btn:hover {
        background: #2567d6;
    }

    #fileInput {
        display: none;
    }

    .files-section {
        padding: 30px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .files-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .file-card {
        background: #f8f9fa;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        border: 1px solid #e0e0e0;
    }

    .file-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .file-preview {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9ecef;
        overflow: hidden;
    }

    .file-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .file-preview .file-icon {
        font-size: 48px;
        color: #666;
    }

    .file-preview .video-icon {
        font-size: 48px;
        color: #ED5A68;
    }

    .file-preview .audio-icon {
        font-size: 48px;
        color: #33C17F;
    }

    .file-preview .pdf-icon {
        font-size: 48px;
        color: #F4CE5B;
    }

    .file-preview .unknown-icon {
        font-size: 48px;
        color: #317FF1;
    }

    .file-info {
        padding: 15px;
    }

    .file-name {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 5px;
    }

    .file-meta {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
    }

    .file-actions {
        display: flex;
        gap: 10px;
    }

    .file-action-btn {
        flex: 1;
        padding: 8px;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .file-action-btn.view {
        background: #E3F2FD;
        color: #1976D2;
    }

    .file-action-btn.download {
        background: #E8F5E9;
        color: #388E3C;
    }

    .file-action-btn.delete {
        background: #FFEBEE;
        color: #D32F2F;
    }

    .file-action-btn:hover {
        opacity: 0.8;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-icon {
        font-size: 64px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 10px;
    }

    .empty-text {
        font-size: 14px;
        color: #666;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #D4EDDA;
        color: #155724;
    }

    .alert-error {
        background: #F8D7DA;
        color: #721C24;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .pod-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
            justify-content: space-between;
        }

        .upload-area {
            padding: 30px;
        }

        .files-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="pod-container">
        <div class="page-header">
            <div>
                <h1>POD - Proof of Delivery</h1>
                <div class="trip-info">
                    Order No: <strong>{{ $transport->order_no ?? 'N/A' }}</strong> |
                    {{ $transport->pickup_location ?? 'N/A' }} → {{ $transport->delivery_location ?? 'N/A' }}
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.trip-status.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Trips
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        <div class="content-card">
            <!-- Upload Section -->
            <div class="upload-section">
                <form id="podUploadForm" method="POST" action="{{ route('admin.pod.store', $transport->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-title">Drag & Drop Files Here</div>
                        <div class="upload-subtitle">or click to browse from your computer (No file type or size limits)</div>
                        <button type="button" class="upload-btn" onclick="document.getElementById('fileInput').click()">
                            <i class="fas fa-folder-open"></i> Select Files
                        </button>
                        <input type="file" id="fileInput" name="files[]" multiple>
                    </div>
                    <div id="selectedFiles" style="margin-top: 20px;"></div>
                    <button type="submit" class="upload-btn" style="margin-top: 15px;" id="uploadBtn" disabled>
                        <i class="fas fa-upload"></i> Upload Files
                    </button>
                </form>
            </div>

            <!-- Files Section -->
            <div class="files-section">
                <h3 class="section-title">
                    <i class="fas fa-folder-open"></i>
                    Uploaded Files ({{ $pods->count() }})
                </h3>

                @if($pods->count() > 0)
                <div class="files-grid">
                    @foreach($pods as $pod)
                    <div class="file-card">
                        <div class="file-preview">
                            @php
                            $extension = pathinfo($pod->original_name, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                            $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'avi', 'mkv', 'webm']);
                            $isAudio = in_array(strtolower($extension), ['mp3', 'wav', 'ogg', 'm4a']);
                            $isPdf = strtolower($extension) === 'pdf';
                            @endphp

                            @if($isImage)
                            <img src="{{ asset($pod->file_path) }}" alt="{{ $pod->file_name }}">
                            @elseif($isVideo)
                            <div class="video-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            @elseif($isAudio)
                            <div class="audio-icon">
                                <i class="fas fa-music"></i>
                            </div>
                            @elseif($isPdf)
                            <div class="pdf-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            @else
                            <div class="unknown-icon">
                                <i class="fas fa-file"></i>
                            </div>
                            @endif
                        </div>
                        <div class="file-info">
                            <div class="file-name" title="{{ $pod->original_name }}">{{ $pod->original_name }}</div>
                            <div class="file-meta">
                                Uploaded: {{ $pod->created_at->format('M d, Y H:i') }}
                            </div>
                            <div class="file-actions">
                                @if($isImage || $isVideo || $isAudio)
                                <a href="{{ route('admin.pod.view', $pod->id) }}" target="_blank" class="file-action-btn view">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                @endif
                                <a href="{{ route('admin.pod.download', $pod->id) }}" class="file-action-btn download">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <form action="{{ route('admin.pod.destroy', $pod->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="file-action-btn delete" onclick="return confirm('Are you sure you want to delete this file?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div class="empty-title">No files uploaded yet</div>
                    <div class="empty-text">Upload photos, videos, documents, or any other files as proof of delivery.</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const selectedFiles = document.getElementById('selectedFiles');
    const uploadBtn = document.getElementById('uploadBtn');

    // Click to select files
    uploadArea.addEventListener('click', function(e) {
        if (e.target.tagName !== 'BUTTON') {
            fileInput.click();
        }
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function() {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            uploadBtn.disabled = false;
            selectedFiles.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileElement = document.createElement('div');
                fileElement.style.cssText = 'display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background: #f8f9fa; border-radius: 8px; margin-bottom: 10px;';
                fileElement.innerHTML = '<span style="display: flex; align-items: center; gap: 10px;"><i class="fas fa-file" style="color: #317ff1;"></i><span>' + file.name + '</span></span><span style="color: #33C17F; font-size: 12px;">Ready to upload</span>';
                selectedFiles.appendChild(fileElement);
            }
        }
    }
});
</script>
@endsection
