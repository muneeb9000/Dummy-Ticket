@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">URL redirector</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">redirector</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            URL redirector List
                        </div>
                        <div class="card-toolbar">
                            @can('redirector.create')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#redirectModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Redirect
                            </button>
                            <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                                data-bs-target="#csvUploadModal">
                                <i class="ri-upload-line me-1 align-middle"></i> Upload CSV
                            </button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="redirector-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Original URL</th>
                                        <th>Redirect To</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @canany(['redirector.edit','redirector.delete'])
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Redirect Modal -->
<div class="modal fade" id="redirectModal" tabindex="-1" aria-labelledby="redirectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="redirectModalLabel">Add New Redirect</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="redirectForm" method="POST">
                @csrf
                <input type="hidden" id="redirect_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="url" class="form-label">Original URL</label>
                        <input type="text" class="form-control"  id="url" name="url" required placeholder="e.g. /old-page">
                        <small class="text-muted">The URL that should be redirected</small>
                        <div class="invalid-feedback" id="url-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="redirect_to" class="form-label">Redirect To</label>
                        <input type="text" class="form-control" id="redirect_to" name="redirect_to" required placeholder="e.g. /new-page">
                        <small class="text-muted">The destination URL (can be internal or external)</small>
                        <div class="invalid-feedback" id="redirect_to-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSV Upload Modal -->
<div class="modal fade" id="csvUploadModal" tabindex="-1" aria-labelledby="csvUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="csvUploadModalLabel">Upload Redirects via CSV</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="csvUploadForm" method="POST" action="{{ route('admin.redirect.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">CSV File</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        <small class="text-muted">Upload a CSV file with 'url' and 'redirect_to' columns</small>
                        <div class="invalid-feedback" id="csv_file-error"></div>
                    </div>
                    <div class="mb-3">
                        <div class="alert alert-info">
                            <h6 class="alert-heading">CSV Format Requirements:</h6>
                            <ul class="mb-0">
                                <li>File must be in CSV format</li>
                                <li>First row should be headers: <code>url</code>, <code>redirect_to</code></li>
                                <li>URLs should start with <code>/</code> for internal redirects</li>
                                <li>Maximum 1000 rows per file</li>
                                <li>Max file size: 2MB</li>
                            </ul>
                            <hr>
                            <a href="{{ asset('assets/sample.csv') }}" class="btn btn-sm btn-outline-primary mt-2" download>
                                <i class="ri-download-line me-1"></i> Download Sample CSV
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="deleteModalLabel">Confirm Deletion</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this redirect? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#redirector-table').DataTable({
        responsive: true,
        order: [[0, 'asc']],
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.redirector.index') }}",
            dataSrc: 'data'
        },
        columns: [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: true,
                searchable: true,
                width: '5%'
            },
            { 
                data: 'url',
                render: function(data) {
                    return `<code>${data}</code>`;
                }
            },
            { 
                data: 'redirect_to',
                render: function(data) {
                    return `<code>${data}</code>`;
                }
            },
            { 
                data: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
            { 
                data: 'updated_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
            @canany(['redirector.edit','redirector.delete'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('redirector.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-redirect" 
                                data-id="${row.id}"
                                data-url="${row.url}"
                                data-redirect_to="${row.redirect_to}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                            @can('redirector.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-redirect" 
                                data-id="${row.id}">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            @endcan
                        </div>
                    `;
                }
            }
            @endcanany
        ]       
    });

    // Reset form on modal close
    $('#redirectModal').on('hidden.bs.modal', function() {
        $('#redirectForm')[0].reset();
        $('#redirect_id').val('');
        $('#redirectModalLabel').text('Add New Redirect');
        $('#saveBtn').text('Save');
         $('#url').prop('disabled', false);
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
    });

    // Show Edit Modal
    $(document).on('click', '.edit-redirect', function() {
        $('#redirect_id').val($(this).data('id'));
        $('#url').val($(this).data('url'));
        $('#url').prop('disabled', true);
        $('#redirect_to').val($(this).data('redirect_to'));
        $('#redirectModalLabel').text('Edit Redirect');
        $('#saveBtn').text('Update');
        $('#redirectModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#redirectForm').submit(function(e) {
        e.preventDefault();

        var id = $('#redirect_id').val();
        var url = id ? 
            "{{ url('admin/redirector') }}/" + id : 
            "{{ route('admin.redirector.store') }}";
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + (id ? '&_method=PUT' : ''),
            success: function(response) {
                if (response.success) {
                    $('#redirectModal').modal('hide');
                    table.ajax.reload(null, false);
                    iziToast.success({
                        message: response.message,
                        position: 'topRight',
                        timeout: 9000,
                        backgroundColor: '#5cd174',
                        fontSize: '16px',
                        color: '#fff',
                        titleColor: '#fff',
                        messageColor: '#fff',
                        icon: 'fa fa-check-circle',
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutUp',
                        class: 'custom-toast',
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').hide();

                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '-error').text(value[0]).show();
                    });
                } else {
                    iziToast.error({
                        message: xhr.responseJSON.message || 
                            'Failed to save redirect.',
                        position: 'topRight',
                        timeout: 9000,
                        backgroundColor: '#e55353',
                        color: '#fff',
                        icon: 'fa fa-times-circle',
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutUp',
                        class: 'custom-toast',
                    });
                }
            }
        });
    });

    // Handle CSV Upload Form Submission
    $('#csvUploadForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $('#uploadBtn').prop('disabled', true).html('<i class="ri-loader-4-line ri-spin me-1"></i> Uploading...');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#csvUploadModal').modal('hide');
                table.ajax.reload(null, false);
                iziToast.success({
                    message: response.message,
                    position: 'topRight',
                    timeout: 9000,
                    backgroundColor: '#5cd174',
                    fontSize: '16px',
                    color: '#fff',
                    titleColor: '#fff',
                    messageColor: '#fff',
                    icon: 'fa fa-check-circle',
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutUp',
                    class: 'custom-toast',
                });
                $('#csvUploadForm')[0].reset();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').hide();

                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '-error').text(value[0]).show();
                    });
                } else {
                    iziToast.error({
                        message: xhr.responseJSON.message || 
                            'Failed to upload CSV file.',
                        position: 'topRight',
                        timeout: 9000,
                        backgroundColor: '#e55353',
                        color: '#fff',
                        icon: 'fa fa-times-circle',
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutUp',
                        class: 'custom-toast',
                    });
                }
            },
            complete: function() {
                $('#uploadBtn').prop('disabled', false).html('Upload');
            }
        });
    });

    // Delete redirect
    let deleteId;
    $(document).on('click', '.delete-redirect', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: "{{ url('admin/redirector') }}/" + deleteId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE'
            },
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload(null, false);
                    iziToast.success({
                        message: response.message,
                        position: 'topRight',
                        timeout: 9000,
                        backgroundColor: '#5cd174',
                        color: '#fff',
                        titleColor: '#fff',
                        messageColor: '#fff',
                        icon: 'fa fa-check-circle',
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutUp',
                        class: 'custom-toast',
                    });
                }
            },
            error: function(xhr) {
                iziToast.error({
                    message: xhr.responseJSON.message || 
                        'Failed to delete redirect.',
                    position: 'topRight',
                    timeout: 9000,
                    backgroundColor: '#e55353',
                    color: '#fff',
                    icon: 'fa fa-times-circle',
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutUp',
                    class: 'custom-toast',
                });
            }
        });
    });
});
</script>
@endpush