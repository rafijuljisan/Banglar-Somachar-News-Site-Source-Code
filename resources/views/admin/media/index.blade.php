@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">Media Manager</h4>
                <ul class="links">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard </a></li>
                    <li><a href="javascript:;">Media Manager </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">

                {{-- FOLDER NAVIGATION --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-folder-open"></i> Select Folder to Manage
                    </div>
                    <div class="card-body p-2">
                        <ul class="nav nav-pills">
                            @foreach($folders as $key => $label)
                                <li class="nav-item">
                                    <a class="nav-link {{ $currentFolder == $key ? 'active' : '' }}" 
                                       href="{{ route('admin.media.index', ['folder' => $key]) }}"
                                       style="margin-right: 5px; border: 1px solid #eee;">
                                        <i class="fas fa-folder{{ $currentFolder == $key ? '-open' : '' }}"></i> {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mr-table allproduct">

                    {{-- UPLOAD AREA --}}
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="upload-box" style="border: 2px dashed #0f78f2; background: #f2f9ff; padding: 30px; text-align: center; cursor: pointer; border-radius: 8px;" onclick="document.getElementById('fileUpload').click()">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 40px; color: #0f78f2;"></i>
                                <h4 class="mt-2 text-primary">Upload to: <span style="font-weight: 800; text-decoration: underline;">{{ $folders[$currentFolder] }}</span></h4>
                                <small class="text-muted">Supports JPG, PNG, GIF, WEBP (Max 10MB)</small>
                                
                                {{-- Hidden Inputs --}}
                                <input type="hidden" id="currentFolder" value="{{ $currentFolder }}">
                                <input type="file" id="fileUpload" name="file" style="display: none;" onchange="uploadImage(this)">
                                {{-- Hidden Input for REPLACE action --}}
                                <input type="file" id="replaceUpload" name="file" style="display: none;" onchange="executeReplace(this)">
                            </div>
                            
                            <div class="progress mt-3 d-none" style="height: 25px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- GALLERY GRID --}}
                    <div class="row" id="media-grid">
                        @foreach($files as $file)
                        <div class="col-lg-2 col-md-3 col-sm-4 mb-4 file-item">
                            <div class="card h-100 shadow-sm" style="border: 1px solid #eee;">
                                <div class="card-img-top-wrapper" style="height: 120px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f9f9f9; border-bottom:1px solid #eee;">
                                    {{-- Added ?v={{ $file['time'] }} to force browser to refresh image after replacement --}}
                                    <img src="{{ asset($currentPath . '/' . $file['basename']) }}?v={{ $file['time'] }}" class="card-img-top" alt="{{ $file['basename'] }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="card-body p-2 text-center">
                                    <p class="card-text text-truncate mb-1" style="font-size: 11px; color: #333;" title="{{ $file['basename'] }}">
                                        {{ $file['basename'] }}
                                    </p>
                                    <p class="mb-2" style="font-size: 10px; color: #999;">{{ $file['size'] }} KB</p>
                                    
                                    <div class="btn-group btn-group-sm" role="group">
                                        {{-- COPY BUTTON --}}
                                        <button type="button" class="btn btn-primary copy-link" data-link="{{ asset($currentPath . '/' . $file['basename']) }}" title="Copy Link">
                                            <i class="fas fa-link"></i>
                                        </button>
                                        {{-- REPLACE BUTTON (NEW) --}}
                                        <button type="button" class="btn btn-warning trigger-replace" data-name="{{ $file['basename'] }}" title="Replace Image">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        {{-- DELETE BUTTON --}}
                                        <button type="button" class="btn btn-danger delete-file" data-name="{{ $file['basename'] }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        @if(count($files) == 0)
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <h3 class="text-muted">No Images in {{ $folders[$currentFolder] }}</h3>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // --- VARIABLES ---
    var targetReplaceFilename = '';

    // --- UPLOAD NEW IMAGE ---
    function uploadImage(input) {
        if (input.files && input.files[0]) {
            var formData = new FormData();
            var folder = $('#currentFolder').val();
            
            formData.append('file', input.files[0]);
            formData.append('folder', folder);
            formData.append('_token', '{{ csrf_token() }}');

            startProgress();
            
            $.ajax({
                url: "{{ route('admin.media.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: progressXhr,
                success: function(response) {
                    finishProgress(response);
                },
                error: errorProgress
            });
        }
    }

    // --- TRIGGER REPLACE CLICK ---
    $('.trigger-replace').on('click', function() {
        targetReplaceFilename = $(this).data('name');
        
        // Open the hidden file input designated for replacement
        $('#replaceUpload').click(); 
    });

    // --- EXECUTE REPLACE (Called when file selected) ---
    function executeReplace(input) {
        if (input.files && input.files[0]) {
            
            if(!confirm('Wait! This will overwrite "' + targetReplaceFilename + '". \n\nAny post using this image will show the new version. Continue?')) {
                // Reset input so change event can fire again if they select same file
                input.value = ''; 
                return;
            }

            var formData = new FormData();
            var folder = $('#currentFolder').val();
            
            formData.append('file', input.files[0]);
            formData.append('folder', folder);
            formData.append('filename', targetReplaceFilename); // Important: Send existing name
            formData.append('_token', '{{ csrf_token() }}');

            startProgress();
            
            $.ajax({
                url: "{{ route('admin.media.replace') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: progressXhr,
                success: function(response) {
                    finishProgress(response);
                },
                error: errorProgress
            });
        }
    }

    // --- SHARED PROGRESS HELPERS ---
    function startProgress() {
        $('.progress').removeClass('d-none');
        $('.progress-bar').width('0%').text('0%').removeClass('bg-danger bg-success');
    }

    function progressXhr() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100;
                var percentVal = Math.round(percentComplete) + '%';
                $('.progress-bar').width(percentVal);
                $('.progress-bar').text(percentVal);
            }
        }, false);
        return xhr;
    }

    function finishProgress(response) {
        if (response.success) {
            $('.progress-bar').addClass('bg-success').text('Success!');
            if(typeof toastr !== 'undefined') toastr.success(response.success);
            else alert(response.success);
            setTimeout(function(){ location.reload(); }, 1000);
        }
    }

    function errorProgress(xhr) {
        $('.progress-bar').addClass('bg-danger').text('Failed');
        var msg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : 'Upload Failed';
        if(typeof toastr !== 'undefined') toastr.error(msg);
        else alert(msg);
    }

    // --- DELETE IMAGE ---
    $('.delete-file').on('click', function() {
        if(!confirm('Are you sure you want to delete this file?')) return;
        
        var filename = $(this).data('name');
        var folder = $('#currentFolder').val();
        var card = $(this).closest('.file-item');

        $.ajax({
            url: "{{ route('admin.media.delete') }}",
            type: 'POST',
            data: {
                filename: filename,
                folder: folder,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    card.fadeOut();
                    if(typeof toastr !== 'undefined') toastr.success(response.message);
                } else {
                    if(typeof toastr !== 'undefined') toastr.error(response.message);
                }
            }
        });
    });

    // --- COPY LINK ---
    $('.copy-link').on('click', function() {
        var link = $(this).data('link');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(link).select();
        document.execCommand("copy");
        $temp.remove();
        if(typeof toastr !== 'undefined') toastr.success('Link copied!');
        else alert('Link copied!');
    });
</script>
@endsection