@extends('admin.layouts.app')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Bookings Management</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Booking List -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-basic" class="table text-nowrap table-bordered" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Info</th>
                                            <th>Contact</th>
                                            <th>Order No</th>
                                            <th>Services</th>
                                            <th>Form Name</th>
                                            <th>Total Price</th>
                                            <th>Discount</th>
                                            <th>Net Total</th>
                                            <th>Urgent</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <div class="fw-semibold">{{ $booking->title }}
                                                                {{ $booking->first_name }} {{ $booking->last_name }}</div>
                                                            <div class="text-muted fs-11">
                                                                {{ $booking->referral_source ?? 'No referral source' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">{{ $booking->email }}</div>
                                                    <div class="text-muted fs-11">{{ $booking->phone }}</div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">{{ $booking->order_no }}</div>
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2">
                                                        @if ($booking->flight_reservation)
                                                            <span class="badge bg-info-transparent" data-bs-toggle="tooltip"
                                                                title="Flight Reservation ({{ $booking->total_flight_reservation_travellers }} travelers)">
                                                                <i class="ri-plane-line me-1"></i>
                                                            </span>
                                                        @endif

                                                        @if ($booking->hotel_booking)
                                                            <span class="badge bg-primary-transparent"
                                                                data-bs-toggle="tooltip"
                                                                title="Hotel Booking ({{ $booking->total_hotel_booking_travelers }} travelers)">
                                                                <i class="ri-hotel-line me-1"></i>
                                                            </span>
                                                        @endif

                                                        @if ($booking->travel_insurance)
                                                            <span class="badge bg-success-transparent"
                                                                data-bs-toggle="tooltip"
                                                                title="Insurance: {{ $booking->insurance_purpose }}">
                                                                <i class="ri-shield-check-line me-1"></i>
                                                            </span>
                                                        @endif

                                                        @if ($booking->travel_guide)
                                                            <span class="badge bg-warning-transparent"
                                                                data-bs-toggle="tooltip"
                                                                title="Travel Guide ({{ $booking->num_of_cities }} cities)">
                                                                <i class="ri-guide-line me-1"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">
                                                        {{ preg_replace('/(?<!^)[A-Z]/', ' $0', $booking->type) }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="text-wrap">{{ $booking->total_price }}</div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">{{ $booking->discount ?? '0' }}</div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">
                                                        {{ $booking->total_price - $booking->discount }}</div>
                                                </td>
                                                <td>
                                                    <div class="text-wrap">
                                                        @if ($booking->urgent_reservation == 1)
                                                            6 to 8 hours
                                                        @elseif($booking->urgent_reservation == 2)
                                                            8 to 10 hours
                                                        @else
                                                            N/A
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                <span class="badge bg-{{ $booking->status == 'Completed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($booking->status ?? 'N/A') }}
                                                </span>
                                                </td>
                                                <td>{{ $booking->created_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{ route('admin.booking.detail', $booking->id) }}"
                                                            class="btn btn-icon btn-sm btn-info-light"
                                                            data-bs-toggle="tooltip" title="View">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    @can('bookings.approval')
                                                    @if( $booking->status == 'Pending')
                                                         <a href="javascript:void(0);"
                                                            class="btn btn-icon btn-sm btn-primary-light openActionModal"
                                                            data-id="{{ $booking->id }}" data-bs-toggle="tooltip"
                                                            title="Take Action">
                                                            <i class="ri-tools-line"></i>
                                                        </a>
                                                    @endif
                                                    @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              <!-- Booking Action Modal -->
                                <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="actionModalLabel">Take Action on Booking</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form method="POST" action="{{ route('admin.booking.approve') }}">
                                                @csrf
                                                <input type="hidden" name="booking_id" id="modalBookingId">
                                                <!-- Admin password field will be added here dynamically -->

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="action_type" class="form-label">Select Action Type</label>
                                                        <select class="form-control" name="status" id="action_type" required>
                                                            <option value="">-- Select --</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                        <div class="invalid-feedback" id="action_type-error"></div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="options[]" value="formSubmissionNotification" id="option1">
                                                                <label class="form-check-label" for="option1">New Form Submission Notification</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="options[]" value="receivedPaymentNow" id="option2">
                                                                <label class="form-check-label" for="option2">We Received Your Payment Just Now!</label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="options[]" value="confirmedSales" id="option3">
                                                                <label class="form-check-label" for="option3">Confirmed Sales - Successfully Received</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Proceed</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Admin Password Modal -->
                                <div class="modal fade" id="adminPasswordModal" tabindex="-1" aria-labelledby="adminPasswordModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="adminPasswordModalLabel">Admin Password Required</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="admin-password" class="form-label">Admin Password</label>
                                                <input type="password" class="form-control" id="admin-password"
                                                    placeholder="Enter Admin Password">
                                                <div id="password-error" class="text-danger mt-2 d-none">Password is required.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" id="submitAdminPassword">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Booking List -->
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const actionButtons = document.querySelectorAll(".openActionModal");
        const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
        const passwordModal = new bootstrap.Modal(document.getElementById('adminPasswordModal'));
        const modalBookingId = document.getElementById("modalBookingId");
        const adminPasswordInput = document.getElementById("admin-password");
        const submitPasswordBtn = document.getElementById("submitAdminPassword");
        const passwordError = document.getElementById("password-error");
        
        let currentBookingId = null;
        let currentForm = null;

        // When Take Action button is clicked
        actionButtons.forEach(button => {
            button.addEventListener("click", function () {
                currentBookingId = this.getAttribute("data-id");
                modalBookingId.value = currentBookingId;
                actionModal.show();
            });
        });

        // When Proceed button is clicked in action modal
        document.querySelector('#actionModal button[type="submit"]').addEventListener("click", function(e) {
            e.preventDefault();
            currentForm = this.closest('form');
            passwordModal.show();
        });

        // Handle password submission
        submitPasswordBtn.addEventListener("click", async function() {
            const password = adminPasswordInput.value.trim();
            
            if (!password) {
                passwordError.textContent = 'Password is required';
                passwordError.classList.remove('d-none');
                return;
            }
            
            // Verify password using API
            try {
                passwordError.classList.add('d-none');
                submitPasswordBtn.disabled = true;
                submitPasswordBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';
                
                const response = await fetch('{{ route("admin.verify-admin-password") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        password: password
                    })
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    passwordError.textContent = result.message || 'Password is incorrect';
                    passwordError.classList.remove('d-none');
                    submitPasswordBtn.disabled = false;
                    submitPasswordBtn.innerHTML = 'Submit';
                    return;
                }

                // Password is correct - proceed with form submission
                const passwordField = document.createElement('input');
                passwordField.type = 'hidden';
                passwordField.name = 'admin_password';
                passwordField.value = password;
                currentForm.appendChild(passwordField);
                
                passwordModal.hide();
                currentForm.submit();

            } catch (err) {
                console.error(err);
                passwordError.textContent = 'Something went wrong. Please try again.';
                passwordError.classList.remove('d-none');
                submitPasswordBtn.disabled = false;
                submitPasswordBtn.innerHTML = 'Submit';
            }
        });
        
        // Also allow pressing Enter in password field
        adminPasswordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                submitPasswordBtn.click();
            }
        });

        // Reset modal when closed
        passwordModal._element.addEventListener('hidden.bs.modal', function() {
            adminPasswordInput.value = '';
            passwordError.classList.add('d-none');
            submitPasswordBtn.disabled = false;
            submitPasswordBtn.innerHTML = 'Submit';
        });
    });
</script>
@endpush