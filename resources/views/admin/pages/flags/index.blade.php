@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Visa Flags Management</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visa Flags</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Visa Flags List
                        </div>
                        @can('visa-flags.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#flagModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add New Flag
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="flags-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Alt Text</th>
                                        <th>Link</th>
                                        <th>Created At</th>
                                        @canany(['visa-flags.edit','visa-flags.delete'])
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

<!-- Add/Edit Flag Modal -->
<div class="modal fade" id="flagModal" tabindex="-1" aria-labelledby="flagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="flagModalLabel">Add New Flag</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="flagForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="flag_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Flag Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Flag Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="text-muted">Upload a flag image (PNG, JPG, SVG)</small>
                            <div class="invalid-feedback" id="image-error"></div>
                            <div id="image-preview" class="mt-2"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alt" class="form-label">Alt Text</label>
                            <input type="text" class="form-control" id="alt" name="alt">
                            <small class="text-muted">Alternative text for the image (for accessibility)</small>
                            <div class="invalid-feedback" id="alt-error"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="link" name="link" required>
                            <div class="invalid-feedback" id="link-error"></div>
                        </div>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="deleteModalLabel">Confirm Deletion</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this flag? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Style for flag images */
.flag-image {
    max-width: 50px;
    max-height: 30px;
    object-fit: contain;
}

/* Style for image preview */
#image-preview img {
    max-width: 100px;
    max-height: 60px;
    margin-top: 10px;
    border-radius: 4px;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#flags-table').DataTable({
        responsive: true,
        order: [
            [0, 'asc']
        ],
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.flags.index') }}",
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
                data: 'name'
            },
            {
                data: 'image',
                render: function(data) {
                    return data ? `<img src="/storage/${data}" class="flag-image" alt="Flag">` : 'No Image';
                }
            },
            {
                data: 'alt',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            {
                data: 'link',
                render: function(data) {
                    return data ? `<a href="${data}" target="_blank">${data}</a>` : 'N/A';
                }
            },
            {
                data: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
              @canany(['visa-flags.edit','visa-flags.delete'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('visa-flags.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-flag" 
                                data-id="${row.id}"
                                data-name="${row.name}"
                                data-image="${row.image || ''}"
                                data-alt="${row.alt || ''}"
                                data-link="${row.link || ''}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                            @can('visa-flags.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-flag" 
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
    $('#flagModal').on('hidden.bs.modal', function() {
        $('#flagForm')[0].reset();
        $('#flag_id').val('');
        $('#flagModalLabel').text('Add New Flag');
        $('#saveBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
        $('#image-preview').empty();
    });

   // Show Edit Modal
    $(document).on('click', '.edit-flag', function() {
        $('#flag_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#alt').val($(this).data('alt'));
        $('#link').val($(this).data('link'));

        // Show existing image preview if available
        const imagePath = $(this).data('image');
        if (imagePath) {
            $('#image-preview').html(`<img src="/storage/${imagePath}" class="img-thumbnail">`);
        }

        $('#flagModalLabel').text('Edit Flag');
        $('#saveBtn').text('Update');
        $('#flagModal').modal('show');
    });

    // Image preview handler
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').html(`<img src="${e.target.result}" class="img-thumbnail">`);
            }
            reader.readAsDataURL(file);
        }
    });

    // Submit Add/Edit Form
    $('#flagForm').submit(function(e) {
        e.preventDefault();

        var id = $('#flag_id').val();
        var url = id ?
            "{{ url('admin/flags') }}/" + id :
            "{{ route('admin.flags.store') }}";

        // Create FormData object for file upload
        var formData = new FormData(this);
        if (id) {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#flagModal').modal('hide');
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
                        message: xhr.responseJSON.message || 'Failed to save flag.',
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

    // Delete flag
    let deleteId;
    $(document).on('click', '.delete-flag', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: "{{ url('admin/flags') }}/" + deleteId,
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
                        message: xhr.responseJSON.message || 'Failed to delete flag.',
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