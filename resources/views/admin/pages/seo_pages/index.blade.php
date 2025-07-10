    @extends('admin.layouts.app')

    @section('content')
        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <h1 class="page-title fw-semibold fs-18 mb-0">SEO Pages</h1>
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">SEO Pages</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Page URLs for SEO
                                </div>
                                <div class="card-toolbar">
                                @can('seo.create')    
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#pageModal">
                                        <i class="ri-add-line me-1 align-middle"></i>Add Page
                                    </button>
                                </div>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="pages-table" class="table text-nowrap table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>URL</th>
                                                <th>Reference Title</th>
                                                <th>Created At</th>
                                                @canany(['seo.edit', 'seo.delete'])
                                                <th>Action</th>
                                                @endcanany
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DataTables AJAX will fill this -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Page Modal -->
        <div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="pageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="pageModalLabel">Add New Page</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="pageForm" method="POST">
                        @csrf
                        <input type="hidden" id="page_id" name="id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="url" class="form-label">Page URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="/about-us" required>
                                <div class="invalid-feedback" id="url-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Reference Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="About Us">
                                <div class="invalid-feedback" id="title-error"></div>
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
                        <p>Are you sure you want to delete this page? This action cannot be undone.</p>
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
                var table = $('#pages-table').DataTable({
                    responsive: true,
                    order: [[1, 'asc']],
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: "{{ route('admin.pages.index') }}",
                        dataSrc: 'data',
                        error: function(xhr, error, thrown) {
                            console.log('error')
                        }
                    },
                    columns: [
                        {
                            data: null,
                            name: 'sr',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                // Fixed serial number calculation
                                var info = table.page.info();
                                return info.start + meta.row + 1;
                            }
                        },
                        {
                            data: 'url'
                        },
                        {
                            data: 'title',
                            render: function(data) {
                                return data || '<span class="text-muted">N/A</span>';
                            }
                        },
                        {
                            data: 'created_at',
                            render: function(data) {
                                return data ? new Date(data).toLocaleDateString('en-GB') : '-';
                            },
                            width: '15%'
                        },
                        @canany(['seo.edit', 'seo.delete'])
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                return `
                                    <div class="d-flex align-items-center gap-2 fs-15">
                                        @can('seo.edit')    
                                        <button class="btn btn-icon btn-sm btn-info-light m-1 edit-page"
                                                data-id="${data}"
                                                data-url="${row.url || ''}"
                                                data-title="${row.title || ''}"
                                                title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                        @endcan
                                        <button class="btn btn-icon btn-sm btn-secondary m-1 seo-page"
                                            data-id="${data}" title="SEO">
                                            <i class="ri-search-eye-line"></i>
                                        </button>
                                        @can('seo.delete')
                                        <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-page"
                                            data-id="${data}" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                        @endcan
                                    </div>
                                `;
                            },
                            width: '15%'
                        }
                        @endcanany
                    ],
                    language: {
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                        emptyTable: 'No pages found',
                        info: 'Showing _START_ to _END_ of _TOTAL_ pages',
                        infoEmpty: 'Showing 0 to 0 of 0 pages',
                        infoFiltered: '(filtered from _MAX_ total pages)',
                        lengthMenu: 'Show _MENU_ pages',
                        search: 'Search:',
                        zeroRecords: 'No matching pages found'
                    },
                    // Add this to fix serial numbers after draw
                    drawCallback: function(settings) {
                        // This ensures serial numbers are recalculated after each draw
                        var api = this.api();
                        var startIndex = api.context[0]._iDisplayStart;
                        
                        api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                            cell.innerHTML = startIndex + i + 1;
                        });
                    }
                });

                // Reset modal on hide
                $('#pageModal').on('hidden.bs.modal', function() {
                    $('#pageForm')[0].reset();
                    $('#page_id').val('');
                    $('#pageModalLabel').text('Add New Page');
                    $('#saveBtn').text('Save');
                    $('.invalid-feedback').text('').hide();
                    $('.form-control').removeClass('is-invalid');
                });

                // Edit page handler
                $(document).on('click', '.edit-page', function() {
                    $('#page_id').val($(this).data('id'));
                    $('#url').val($(this).data('url'));
                    $('#title').val($(this).data('title'));
                    $('#pageModalLabel').text('Edit Page');
                    $('#saveBtn').text('Update');
                    $('#pageModal').modal('show');
                });

                // Page form submit
                $('#pageForm').submit(function(e) {
                    e.preventDefault();
                    var $form = $(this);
                    var id = $('#page_id').val();
                    var url = id ? "{{ url('admin/pages') }}/" + id : "{{ route('admin.pages.store') }}";
                    var method = id ? 'PUT' : 'POST';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: $form.serialize() + (id ? '&_method=PUT' : ''),
                        success: function(response) {
                            if (response.success) {
                                $('#pageModal').modal('hide');
                                table.ajax.reload(null, false);
                                iziToast.success({
                                    message: response.message || 'Page saved successfully',
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
                                    message: xhr.responseJSON.message || 'Failed to save page',
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

                // Delete page handlers
                let deleteId;
                $(document).on('click', '.delete-page', function() {
                    deleteId = $(this).data('id');
                    $('#deleteModal').modal('show');
                });

                $('#confirmDelete').click(function() {
                    $.ajax({
                        url: "{{ url('admin/pages') }}/" + deleteId,
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
                                    message: response.message || 'Page deleted successfully',
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
                                message: xhr.responseJSON.message || 'Failed to delete page',
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
                    });
                });

                // SEO Modal handler
                $(document).on('click', '.seo-page', function() {
                    let pageId = $(this).data('id');
                    $('#seo_page_id').val(pageId);

                    // Clear old errors
                    $('#seoForm .invalid-feedback').text('').hide();
                    $('#seoForm .form-control, #seoForm .form-select').removeClass('is-invalid');

                    // Fetch existing SEO data for this page
                    $.get("{{ url('admin/pages') }}/" + pageId + "/seo", function(response) {
                        if (response.success && response.seo) {
                            $('#meta_title').val(response.seo.title || '');
                            $('#meta_description').val(response.seo.description || '');
                            $('#meta_keywords').val(response.seo.keywords || '');
                            $('#meta_image').val(response.seo.image || '');
                            $('#robots').val(response.seo.robots || 'index,follow');
                        } else {
                            // Reset form if no SEO data
                            $('#seoForm')[0].reset();
                            $('#seo_page_id').val(pageId); // Keep the page ID
                        }
                        $('#seoModal').modal('show');
                    });
                });

                // SEO form submit
                $('#seoForm').submit(function(e) {
                    e.preventDefault();
                    var pageId = $('#seo_page_id').val();
                    var $form = $(this);
                    var url = "{{ url('admin/pages') }}/" + pageId + "/seo";
                    
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
                                    message: xhr.responseJSON.message || 'Failed to save SEO settings',
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
