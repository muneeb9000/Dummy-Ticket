@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Roles & Permissions</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Roles List
                        </div>
                        @can('roles.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#roleModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Role
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="roles-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Created At</th>
                                        @canany(['roles.edit', 'roles.delete'])
                                        <th>Action</th>
                                        @endcanany
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Role Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="roleModalLabel">Add New Role</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="roleForm" method="POST">
                @csrf
                <input type="hidden" id="role_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback" id="name-error"></div>
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
                <p>Are you sure you want to delete this role? This action cannot be undone.</p>
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
    var table = $('#roles-table').DataTable({
        responsive: true,
        order: [
            [1, 'asc']
        ],
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.roles.index') }}",
            dataSrc: 'data',
            error: function(xhr, error, thrown) {
                console.error("AJAX Error:", xhr, error, thrown);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to load roles data. Please try again.',
                    icon: 'error'
                });
            }
        },
        columns: [{
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: true,
                searchable: true,
                width: '5%'
            },
            {
                data: 'name',
                name: 'name',
                render: function(data, type, row) {
                    return data || '<span class="text-muted">N/A</span>';
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return data ? new Date(data).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }) : '-';
                },
                width: '15%'
            },
              @canany(['roles.edit', 'roles.delete'])
            {
                data: 'id',
                name: 'actions',
                orderable: true,
                searchable: true,
                render: function(data, type, row) {
                    return `
                            <div class="d-flex align-items-center gap-2 fs-15">
                                @can('roles.edit')
                                <a href="{{ url('admin/roles') }}/${data}/permissions" 
                                class="btn btn-icon btn-sm btn-success m-1 permissions-role" 
                                title="Permissions">
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                                <button class="btn btn-icon btn-sm btn-info-light m-1 edit-role" 
                                    data-id="${data}"
                                    data-name="${row.name || ''}"
                                    title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                @endcan
                                @can('roles.delete')
                                <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-role" 
                                    data-id="${data}"
                                    title="Delete">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                                @endcan
                            </div>
                        `;
                },
                width: '10%'
            }
            @endcanany
        ],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
            emptyTable: 'No roles found',
            info: 'Showing _START_ to _END_ of _TOTAL_ roles',
            infoEmpty: 'Showing 0 to 0 of 0 roles',
            infoFiltered: '(filtered from _MAX_ total roles)',
            lengthMenu: 'Show _MENU_ roles',
            search: 'Search:',
            zeroRecords: 'No matching roles found'
        },
        initComplete: function() {
            console.log("DataTable initialized successfully");
        },
        drawCallback: function() {
            console.log("Table redrawn with", this.api().rows().count(), "rows");
        }
    });

    $('#roleModal').on('hidden.bs.modal', function() {
        $('#roleForm')[0].reset();
        $('#role_id').val('');
        $('#roleModalLabel').text('Add New Role');
        $('#saveBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
    });

    $(document).on('click', '.edit-role', function() {
        $('#role_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#roleModalLabel').text('Edit Role');
        $('#saveBtn').text('Update');
        $('#roleModal').modal('show');
    });

    $('#roleForm').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtn = $form.find('#saveBtn');
        var id = $('#role_id').val();
        var url = id ? "{{ url('admin/roles') }}/" + id : "{{ route('admin.roles.store') }}";
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: 'POST',
            data: $form.serialize() + (id ? '&_method=PUT' : ''),
            success: function(response) {
                if (response.success) {
                    $('#roleModal').modal('hide');
                    table.ajax.reload(null, false);
                    iziToast.success({
                        message: response.message || 'Role saved successfully',
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
                        message: xhr.responseJSON.message || 'Failed to save role',
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

    let deleteId;
    $(document).on('click', '.delete-role', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        var $deleteBtn = $(this);

        $.ajax({
            url: "{{ url('admin/roles') }}/" + deleteId,
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
                        message: response.message || 'Role deleted successfully',
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
                        message: xhr.responseJSON.message || 'Failed to delete role',
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
});
</script>
@endpush