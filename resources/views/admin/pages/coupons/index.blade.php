@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Coupon Management</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Coupons List
                        </div>
                        @can('coupons.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#couponModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add Coupon
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="coupons-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Discount (%)</th>
                                        <th>Status</th>
                                        <th>Usage Limit</th>
                                        <th>Coupon Used</th>
                                        <th>Expiry Date</th>
                                        <th>Services</th>
                                        <th>Created At</th>
                                        @canany(['coupons.edit','coupons.delete'])
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

<!-- Add/Edit Coupon Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="couponModalLabel">Add New Coupon</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="couponForm" method="POST">
                @csrf
                <input type="hidden" id="coupon_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                        <div class="invalid-feedback" id="code-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="percentage" class="form-label">Discount Percentage</label>
                        <input type="number" class="form-control" id="percentage" name="percentage" min="1" max="100"
                            required>
                        <div class="invalid-feedback" id="percentage-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="usage_limit" class="form-label">Usage Limit (0 for unlimited)</label>
                        <input type="number" class="form-control" value="0" id="usage_limit" name="usage_limit" min="0">
                    </div>

                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                    </div>

                    <!-- In your coupon modal form, modify the applicable services section -->
                    <div class="mb-3">
                        <label class="form-label">Applicable Services</label>
                        <!-- Hidden inputs to ensure values are always sent -->
                        <input type="hidden" name="flight" value="0">
                        <input type="hidden" name="hotel" value="0">
                        <input type="hidden" name="insurance" value="0">
                        <input type="hidden" name="guide" value="0">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input service-check"  type="checkbox" id="flight" name="flight" value="1">
                                    <label class="form-check-label" for="flight">Flight</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input service-check" type="checkbox" id="hotel" name="hotel" value="1">
                                    <label class="form-check-label" for="hotel">Hotel</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input service-check" type="checkbox" id="insurance" name="insurance"
                                        value="1">
                                    <label class="form-check-label" for="insurance">Insurance</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input service-check" type="checkbox" id="guide" name="guide" value="1">
                                    <label class="form-check-label" for="guide">Guide</label>
                                </div>
                            </div>
                            <div id="service-error" class="text-danger mt-2" style="display: none;">
                                Please select at least one service.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveCouponBtn">Save</button>
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
                <p>Are you sure you want to delete this coupon? This action cannot be undone.</p>
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
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("service-form");
        form.addEventListener("submit", function(e) {
            const checkboxes = document.querySelectorAll(".service-check");
            const isChecked = Array.from(checkboxes).some(cb => cb.checked);

            if (!isChecked) {
                e.preventDefault();
                document.getElementById("service-error").style.display = "block";
            } else {
                document.getElementById("service-error").style.display = "none";
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    // Initialize DataTable with server-side processing
    var table = $('#coupons-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('admin.coupons.index') }}",
            type: 'GET',
            data: function(d) {
                // You can add additional parameters here if needed
            }
        },
        columns: [
            {
                data: null,
                name: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'code',
                name: 'code'
            },
            {
                data: 'percentage',
                name: 'percentage',
                render: function(data) {
                    return data + '%';
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    var badgeClass = '';
                    if (data === 'active') badgeClass = 'bg-success';
                    else if (data === 'inactive') badgeClass = 'bg-warning';
                    else if (data === 'expired') badgeClass = 'bg-danger';
                    return '<span class="badge ' + badgeClass + '">' + data.charAt(0)
                        .toUpperCase() + data.slice(1) + '</span>';
                }
            },
            {
                data: 'usage_limit',
                name: 'usage_limit',
                render: function(data) {
                    return data === null || data === 0 ? 'Unlimited' : data;
                }
            },
             {
                data: 'usages_count',
                name: 'usages_count',
                render: function(data) {
                    return data;
                }
            },
            {
                data: 'expiry_date',
                name: 'expiry_date',
                render: function(data) {
                    return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    var icons = '';
                    if (row.flight) icons += '<i class="ri-flight-takeoff-fill text-primary me-1" title="Flight"></i>';
                    if (row.hotel) icons += '<i class="ri-hotel-fill text-success me-1" title="Hotel"></i>';
                    if (row.insurance) icons += '<i class="ri-shield-check-fill text-info me-1" title="Insurance"></i>';
                    if (row.guide) icons += '<i class="ri-user-3-fill text-warning me-1" title="Guide"></i>';
                    return icons || '<span class="text-muted">None</span>';
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-GB');
                }
            },
                @canany(['coupons.edit','coupons.delete'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('coupons.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-coupon" 
                                data-id="${row.id}"
                                data-code="${row.code}"
                                data-percentage="${row.percentage}"
                                data-status="${row.status}"
                                data-usage_limit="${row.usage_limit}"
                                data-expiry_date="${row.expiry_date ? row.expiry_date.split('T')[0] : ''}"
                                data-flight="${row.flight}"
                                data-hotel="${row.hotel}"
                                data-insurance="${row.insurance}"
                                data-guide="${row.guide}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                            @can('coupons.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-coupon" 
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
    $('#couponModal').on('hidden.bs.modal', function() {
        $('#couponForm')[0].reset();
        $('#coupon_id').val('');
        $('#couponModalLabel').text('Add New Coupon');
        $('#saveCouponBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
        $('#service-error').hide();
    });

    // Show Edit Modal with data from data attributes
    $(document).on('click', '.edit-coupon', function() {
        $('#coupon_id').val($(this).data('id'));
        $('#code').val($(this).data('code'));
        $('#percentage').val($(this).data('percentage'));
        $('#status').val($(this).data('status'));
        $('#usage_limit').val($(this).data('usage_limit'));
        $('#expiry_date').val($(this).data('expiry_date'));

        // Reset all checkboxes first (will be overridden by actual values)
        $('.service-check').prop('checked', false);

        // Set checkboxes based on data
        if ($(this).data('flight') == 1) $('#flight').prop('checked', true);
        if ($(this).data('hotel') == 1) $('#hotel').prop('checked', true);
        if ($(this).data('insurance') == 1) $('#insurance').prop('checked', true);
        if ($(this).data('guide') == 1) $('#guide').prop('checked', true);

        $('#couponModalLabel').text('Edit Coupon');
        $('#saveCouponBtn').text('Update');
        $('#couponModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#couponForm').submit(function(e) {
        e.preventDefault();

        // Validate at least one service is selected
        const isServiceSelected = $('.service-check:checked').length > 0;
        if (!isServiceSelected) {
            $('#service-error').show();
            return false;
        } else {
            $('#service-error').hide();
        }

        var id = $('#coupon_id').val();
        var url = id ? "{{ url('admin/coupons') }}/" + id : "{{ route('admin.coupons.store') }}";
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + (id ? '&_method=PUT' : ''),
            beforeSend: function() {
                $('#saveCouponBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            },
            complete: function() {
                $('#saveCouponBtn').prop('disabled', false).html(id ? 'Update' : 'Save');
            },
            success: function(response) {
                if (response.success) {
                    $('#couponModal').modal('hide');
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
                        message: response.message || 'Failed to save coupon.',
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

    // Show error when trying to uncheck the last selected checkbox
    $('.service-check').change(function() {
        const checkedCount = $('.service-check:checked').length;
        if (checkedCount === 0) {
            $('#service-error').show();
        } else {
            $('#service-error').hide();
        }
    });

    // Delete coupon
    let deleteId;
    $(document).on('click', '.delete-coupon', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: "{{ url('admin/coupons') }}/" + deleteId,
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
                        message: xhr.responseJSON.message || 'Failed to delete coupon.',
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