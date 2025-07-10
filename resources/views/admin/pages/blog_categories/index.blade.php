@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Blog Categories</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Categories</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Blog Categories List
                        </div>
                        @can('blog-categories.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Category
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Category Name</th>
                                        <th>Slug </th>
                                        <th>Created At</th>
                                        @canany(['blog-categories.edit', 'admin.delete'])
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

<!-- Add/Edit Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="categoryModalLabel">Add New Category</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryForm" method="POST">
                @csrf
                <input type="hidden" id="category_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                        <div class="invalid-feedback" id="slug-error"></div>
                        <small class="text-muted">URL-friendly version of the name (lowercase, hyphens instead of spaces)</small>
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
                <p>Are you sure you want to delete this category? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- SEO Settings Modal -->
        <div class="modal fade" id="seoModal" tabindex="-1" aria-labelledby="seoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="seoModalLabel">SEO Settings</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="seoForm" method="POST">
                        @csrf
                        <input type="hidden" id="seo_page_id" name="page_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">SEO Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control"
                                    maxlength="70">
                                <small class="form-text text-muted">Recommended: ≤ 70 characters</small>
                                <div class="invalid-feedback" id="meta_title-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">SEO Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" maxlength="160" rows="2"></textarea>
                                <small class="form-text text-muted">Recommended: ≤ 160 characters</small>
                                <div class="invalid-feedback" id="meta_description-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">SEO Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control">
                                <small class="form-text text-muted">Comma-separated, optional</small>
                                <div class="invalid-feedback" id="meta_keywords-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="meta_image" class="form-label">SEO Image URL</label>
                                <input type="text" name="meta_image" id="meta_image" class="form-control">
                                <small class="form-text text-muted">Leave blank to use featured image.</small>
                                <div class="invalid-feedback" id="meta_image-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="robots" class="form-label">Search Engine Visibility</label>
                                <select name="robots" id="robots" class="form-select">
                                    <option value="index,follow">Default (index, follow)</option>
                                    <option value="noindex, nofollow">Noindex, Nofollow</option>
                                    <option value="noindex, follow">Noindex, Follow</option>
                                    <option value="index, nofollow">Index, Nofollow</option>
                                </select>
                                <div class="invalid-feedback" id="robots-error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveSeoBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#categories-table').DataTable({
        responsive: true,
        order: [
            [0, 'asc']
        ],
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.blog-categories.index') }}",
            dataSrc: 'data'
        },
        columns: [ {
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
                data: 'slug'
            },
            {
                data: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
              @canany(['blog-categories.edit','blog-categories.delete'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('blog-categories.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-category" data-id="${row.id}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                             <button class="btn btn-icon btn-sm btn-secondary m-1 seo-page"
                                data-id="${row.id}" title="SEO">
                                <i class="ri-search-eye-line"></i>
                            </button>
                            @can('blog-categories.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-category" 
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
    $('#categoryModal').on('hidden.bs.modal', function() {
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
        $('#categoryModalLabel').text('Add New Category');
        $('#saveBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
    });

    // Show Edit Modal
    $(document).on('click', '.edit-category', function() {
        var row = table.row($(this).parents('tr')).data();
        $('#category_id').val(row.id);
        $('#name').val(row.name);
        $('#slug').val(row.slug);
        $('#categoryModalLabel').text('Edit Category');
        $('#saveBtn').text('Update');
        $('#categoryModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#categoryForm').submit(function(e) {
        e.preventDefault();

        var id = $('#category_id').val();
        var url = id ?
            "{{ url('admin/blog-categories') }}/" + id :
            "{{ route('admin.blog-categories.store') }}";

     
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + (id ? '&_method=PUT' : ''),
            success: function(response) {
                console.log('Success response:', response);
                if (response.success) {
                    // Close modal
                    $('#categoryModal').modal('hide');
                    // Reload table data
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
                } else {
                    console.log("Unexpected success:false response received.");
                    iziToast.error({
                        message: response.message || 'Something went wrong.',
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

        });
    });

    // Delete category
    let deleteId;
    $(document).on('click', '.delete-category', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {


        $.ajax({
            url: "{{ url('admin/blog-categories') }}/" + deleteId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE'
            },
            success: function(response) {
                console.log('Delete response:', response);

                if (response.success) {
                    // Close modal
                    $('#deleteModal').modal('hide');

                    // Reload table data
                    table.ajax.reload(null, false);
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
                    // Show success message

                  
                } else {
                     console.error('Delete operation failed.');

                }
            },
            error: function(xhr) {
                console.log('Delete error:', xhr);

                console.log('Error: ' + (xhr.responseJSON?.message || 'Failed to delete.'));
                iziToast.error({
                    message: response.message || 'Something went wrong.',
                    position: 'topRight',
                    timeout: 9000,
                    backgroundColor: '#e55353',
                    color: '#fff',
                    icon: 'fa fa-times-circle',
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutUp',
                    class: 'custom-toast',
                });

            },
            complete: function() {
                // Re-enable delete button
                $('#confirmDelete').prop('disabled', false).text('Delete');
            }
        });
    });

   // Show SEO Modal with existing values
    $(document).on('click', '.seo-page', function() {
        let categoryId = $(this).data('id');
        $('#seo_page_id').val(categoryId);

        // Clear old errors
        $('#seoForm .invalid-feedback').text('').hide();
        $('#seoForm .form-control, #seoForm .form-select').removeClass('is-invalid');

        // Fetch existing SEO data for this category
        $.get("{{ url('admin/blog-categories') }}/" + categoryId + "/seo", function(response) {
            if (response.success && response.seo) {
                // Map the response fields to your form fields
                $('#meta_title').val(response.seo.title || '');
                $('#meta_description').val(response.seo.description || '');
                $('#meta_keywords').val(response.seo.keywords || '');
                $('#meta_image').val(response.seo.image || '');
                $('#robots').val(response.seo.robots || 'index,follow');
            } else {
                // Blank if no SEO data
                $('#seoForm')[0].reset();
            }
            $('#seoModal').modal('show');
        }).fail(function(xhr) {
            console.error("Error fetching SEO data:", xhr.responseText);
            $('#seoForm')[0].reset();
            $('#seoModal').modal('show');
        });
    });

    // Handle SEO form submit
    $('#seoForm').submit(function(e) {
        e.preventDefault();
        var categoryId = $('#seo_page_id').val();
        var $form = $(this);
        var url = "{{ url('admin/blog-categories') }}/" + categoryId + "/seo";
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $form.serialize(),
            success: function(response) {
                if (response.success) {
                    $('#seoModal').modal('hide');
                    iziToast.success({
                        message: response.message || 'SEO settings saved successfully',
                        position: 'topRight',
                        timeout: 9000,
                        backgroundColor: '#5cd174',
                        color: '#fff',
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
                    $('#seoForm .form-control, #seoForm .form-select').removeClass('is-invalid');
                    $('#seoForm .invalid-feedback').hide();

                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '-error').text(value[0]).show();
                    });
                } else {
                    iziToast.error({
                        message: xhr.responseJSON?.message || 'Failed to save SEO settings',
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



});
</script>
@endpush