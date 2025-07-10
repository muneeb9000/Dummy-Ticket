@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Snippet Management</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Snippets</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Snippets List
                        </div>
                        @can('snippets.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#snippetModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Snippet
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="snippets-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Scope</th>
                                        <th>Page Route</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Snippet Modal -->
<div class="modal fade" id="snippetModal" tabindex="-1" aria-labelledby="snippetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="snippetModalLabel">Add New Snippet</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="snippetForm" method="POST">
                @csrf
                <input type="hidden" id="snippet_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Snippet Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="head">Head</option>
                                <option value="body">Body</option>
                                <option value="footer">Footer</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="is_global" class="form-label">Scope</label>
                            <select class="form-select" id="is_global" name="is_global" required>
                                <option value="1">Global</option>
                                <option value="0">Page Specific</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="pageRouteContainer">
                            <label for="page_route" class="form-label">Page Route</label>
                            <input type="text" class="form-control" id="page_route" name="page_route">
                            <div class="invalid-feedback" id="page_route-error"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <textarea class="form-control" id="code" name="code" rows="8" required></textarea>
                        <div class="invalid-feedback" id="code-error"></div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="active" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveSnippetBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Code Preview Modal -->
<div class="modal fade" id="codePreviewModal" tabindex="-1" aria-labelledby="codePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="codePreviewModalLabel">Code Preview</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <pre id="codePreviewContent" class="p-3 bg-light rounded" style="white-space: pre-wrap; word-wrap: break-word;"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
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
                <p>Are you sure you want to delete this snippet? This action cannot be undone.</p>
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
    // Initialize DataTable with server-side processing
    var table = $('#snippets-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.snippets.index') }}",
            type: 'GET'
        },
        columns: [
            {
                data: null,
                name: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            {
                data: 'type',
                name: 'type',
                render: function(data) {
                    return data.charAt(0).toUpperCase() + data.slice(1);
                }
            },
            {
                data: 'is_global',
                name: 'is_global',
                render: function(data) {
                    return data ? 'Global' : 'Page Specific';
                }
            },
            {
                data: 'page_route',
                name: 'page_route',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    var badgeClass = data === 'active' ? 'bg-success' : 'bg-danger';
                    var statusText = data === 'active' ? 'Active' : 'Inactive';
                    return '<span class="badge ' + badgeClass + '">' + statusText + '</span>';
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
             @can(['snippets.edit','snippets.delete'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    var buttons = `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            <button class="btn btn-icon btn-sm btn-secondary-light m-1 view-snippet" 
                                data-code="${encodeURIComponent(row.code)}"
                                title="View Code">
                                <i class="ri-eye-line"></i>
                            </button>`;
                    
                    @can('snippets.edit')
                    buttons += `
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-snippet" 
                                data-id="${row.id}"
                                data-name="${row.name}"
                                data-type="${row.type}"
                                data-is_global="${row.is_global}"
                                data-page_route="${row.page_route}"
                                data-code="${encodeURIComponent(row.code)}"
                                data-status="${row.status}"
                                title="Edit">
                                <i class="ri-edit-line"></i>
                            </button>`;
                    @endcan
                    
                    @can('snippets.delete')
                    buttons += `
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-snippet" 
                                data-id="${row.id}"
                                title="Delete">
                                <i class="ri-delete-bin-line"></i>
                            </button>`;
                    @endcan
                    
                    buttons += `</div>`;
                    
                    return buttons;
                }
            }
            @endcanany
        ]
    });

    // Show code preview modal
    $(document).on('click', '.view-snippet', function() {
        var code = decodeURIComponent($(this).data('code'));
        $('#codePreviewContent').text(code);
        $('#codePreviewModal').modal('show');
    });

    // Show/hide page route field based on scope selection
    $('#is_global').change(function() {
        if ($(this).val() == '1') {
            $('#pageRouteContainer').hide();
        } else {
            $('#pageRouteContainer').show();
        }
    }).trigger('change');

    // Reset form on modal close
    $('#snippetModal').on('hidden.bs.modal', function() {
        $('#snippetForm')[0].reset();
        $('#snippet_id').val('');
        $('#snippetModalLabel').text('Add New Snippet');
        $('#saveSnippetBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
        $('#is_global').trigger('change');
    });

    // Show Edit Modal with data from data attributes
    $(document).on('click', '.edit-snippet', function() {
        $('#snippet_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#type').val($(this).data('type'));
        $('#is_global').val($(this).data('is_global'));
        $('#page_route').val($(this).data('page_route'));
        $('#code').val(decodeURIComponent($(this).data('code')));
        $('#status').prop('checked', $(this).data('status') === 'active');

        $('#snippetModalLabel').text('Edit Snippet');
        $('#saveSnippetBtn').text('Update');
        $('#snippetModal').modal('show');
        $('#is_global').trigger('change');
    });

    // Submit Add/Edit Form
    $('#snippetForm').submit(function(e) {
        e.preventDefault();

        // Get form data including checkbox status
        var formData = $(this).serializeArray();
        var status = $('#status').is(':checked') ? 'active' : 'inactive';
        formData.push({name: 'status', value: status});
        
        var id = $('#snippet_id').val();
        if (id) {
            formData.push({name: '_method', value: 'PUT'});
        }

        var url = id ? "{{ url('admin/snippets') }}/" + id : "{{ route('admin.snippets.store') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: $.param(formData),
            beforeSend: function() {
                $('#saveSnippetBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            },
            complete: function() {
                $('#saveSnippetBtn').prop('disabled', false).html(id ? 'Update' : 'Save');
            },
            success: function(response) {
                if (response.status) {
                    $('#snippetModal').modal('hide');
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
                console.log('Error:', xhr.responseJSON);
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
                        message: xhr.responseJSON?.message || 'Failed to save snippet.',
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

    // Delete snippet
    let deleteId;
    $(document).on('click', '.delete-snippet', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: "{{ url('admin/snippets') }}/" + deleteId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE'
            },
            beforeSend: function() {
                $('#confirmDelete').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
            },
            complete: function() {
                $('#confirmDelete').prop('disabled', false).html('Delete');
            },
            success: function(response) {
                if (response.status) {
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
                    message: xhr.responseJSON?.message || 'Failed to delete snippet.',
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