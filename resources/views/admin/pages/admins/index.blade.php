@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Admin Management</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admins</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Admins List
                        </div>
                        @can('admin.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adminModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Admin
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="admins-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        @canany(['admin.edit', 'admin.delete'])
                                        <th>Action</th>
                                        @endcanany
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

<!-- Add/Edit Admin Modal -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="adminModalLabel">Add New Admin</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adminForm" method="POST">
                @csrf
                <input type="hidden" id="admin_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="role-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            autocomplete="new-password">
                        <div class="invalid-feedback" id="password-error"></div>
                        <small class="text-muted">Leave blank to keep current password (when editing)</small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAdminBtn">Save</button>
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
                <p>Are you sure you want to delete this admin? This action cannot be undone.</p>
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
    // CSRF Token Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        var table = $('#admins-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: false, // Explicitly set to false
        ajax: {
            url: "{{ route('admin.users.index') }}",
            type: 'GET',
            dataSrc: 'data' // Point to the 'data' property in the response
        },
        columns: [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false,
                width: '5%'
            },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { 
                data: 'roles',
                render: function(data) {
                    return data && data.length > 0 ? data[0].name : 'N/A';
                }
            },
            { 
                data: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
            @canany(['admin.edit','admin.delete'])
            { 
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('admin.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-admin" 
                                data-id="${row.id}"
                                data-name="${row.name}"
                                data-email="${row.email}"
                                data-role="${row.roles && row.roles.length > 0 ? row.roles[0].id : ''}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                            @can('admin.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-admin" 
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
    $('#adminModal').on('hidden.bs.modal', function() {
        $('#adminForm')[0].reset();
        $('#admin_id').val('');
        $('#adminModalLabel').text('Add New Admin');
        $('#saveAdminBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
        $('#password').removeAttr('placeholder');
    });

    // Show Add Modal
    $('[data-bs-target="#adminModal"]').click(function() {
        $('#adminModalLabel').text('Add New Admin');
        $('#saveAdminBtn').text('Save');
    });

    // Show Edit Modal with data from data attributes
    $(document).on('click', '.edit-admin', function() {
        $('#admin_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#email').val($(this).data('email'));
        $('#role').val($(this).data('role'));
        $('#password').attr('placeholder', 'Leave blank to keep current password');

        $('#adminModalLabel').text('Edit Admin');
        $('#saveAdminBtn').text('Update');
        $('#adminModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#adminForm').submit(function(e) {
        e.preventDefault();

        const $btn = $('#saveAdminBtn');
        $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'
        );

        var id = $('#admin_id').val();
        var url = id ? `/admin/users/${id}` : "{{ route('admin.users.store') }}";
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ...$(this).serializeArray().reduce(function(obj, item) {
                    obj[item.name] = item.value;
                    return obj;
                }, {}),
                _method: method
            },
            success: function(response) {
                if (response.success) {
                    $('#adminModal').modal('hide');
                    table.ajax.reload(null, false);
                    iziToast.success({
                        message: response
                            .message, // use response.message from backend
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
                    Swal.fire('Error', xhr.responseJSON.message || 'Something went wrong.',
                        'error');
                }
            },
            complete: function() {
                $btn.prop('disabled', false).html(id ? 'Update' : 'Save');
            }
        });
    });

    // Delete admin
    let deleteId;
    $(document).on('click', '.delete-admin', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        const $btn = $(this);
        $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...'
        );

        $.ajax({
            url: `/admin/users/${deleteId}`,
            type: 'POST',
            data: {
                _method: 'DELETE'
            },
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload(null, false);
                    iziToast.success({
                        message: response
                        .message, // use response.message from backend
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
                Swal.fire('Error', xhr.responseJSON.message || 'Failed to delete admin.',
                    'error');
            },
            complete: function() {
                $btn.prop('disabled', false).text('Delete');
            }
        });
    });
});
</script>
@endpush