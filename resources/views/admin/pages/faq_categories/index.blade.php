@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">FAQ Categories</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            FAQ Categories List
                        </div>
                        <div class="card-toolbar">
                            @can('faqs-categories.create')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Category
                            </button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Category</th>
                                        <th>Icon</th>
                                        <th>Created</th>
                                        @canany(['faqs-categories.edit','faqs-categories.delete'])
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
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon"
                            placeholder="e.g. ki-outline ki-category">
                        <small class="text-muted">Use any icon class from your icon library</small>
                        <div class="invalid-feedback" id="icon-error"></div>
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
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        var table = $('#categories-table').DataTable({
            responsive: true,
            order: [[0, 'asc']],
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('admin.faqs.categories.index') }}",
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
                { data: 'name' },
                { 
                    data: 'icon',
                    render: function(data) {
                        return data ? `<i class="${data}"></i> ${data}` : '';
                    }
                },
                { 
                    data: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString('en-GB');
                    }
                },
                 @canany(['faqs-categories.edit','faqs-categories.delete'])
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `

                            <div class="d-flex align-items-center gap-2 fs-15">
                                @can('faqs-categories.edit')
                                <button class="btn btn-icon btn-sm btn-info-light m-1 edit-category" 
                                    data-id="${row.id}"
                                    data-name="${row.name}"
                                    data-icon="${row.icon}">
                                    <i class="ri-edit-line"></i>
                                </button>
                                @endcan
                                @can('faqs-categories.delete')
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

    // Show Add Modal
    $('#addCategoryBtn').click(function() {
        $('#categoryModal').modal('show');
    });

    // Show Edit Modal
    $(document).on('click', '.edit-category', function() {
        $('#category_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#icon').val($(this).data('icon'));
        $('#categoryModalLabel').text('Edit Category');
        $('#saveBtn').text('Update');
        $('#categoryModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#categoryForm').submit(function(e) {
        e.preventDefault();

        var id = $('#category_id').val();
        var url = id ?
            "{{ url('admin/faqs/category') }}/" + id :
            "{{ route('admin.faqs.category.store') }}";
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + (id ? '&_method=PUT' : ''),
            success: function(response) {
                if (response.success) {
                    $('#categoryModal').modal('hide');
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
                            'Failed to save category.',
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

    // Delete category
    let deleteId;
    $(document).on('click', '.delete-category', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: "{{ url('admin/faqs/category') }}/" + deleteId,
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
                        'Failed to delete category.',
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