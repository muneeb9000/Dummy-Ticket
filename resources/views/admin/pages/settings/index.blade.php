@extends('admin.layouts.app')

@section('content')

<div class="main-content app-content">
    <div class="container">

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <input type="hidden" name="admin_password" id="hidden-admin-password">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                <li class="nav-item m-1">
                    <a class="nav-link active" data-bs-toggle="tab" href="#personal-info" role="tab">Site
                        Information</a>
                </li>
                <li class="nav-item m-1">
                    <a class="nav-link" data-bs-toggle="tab" href="#account-settings" role="tab">Payment Gateways</a>
                </li>
                <li class="nav-item m-1">
                    <a class="nav-link" data-bs-toggle="tab" href="#email-settings" role="tab">E-Mailing Server</a>
                </li>
                <li class="nav-item m-1">
                    <a class="nav-link" data-bs-toggle="tab" href="#labels" role="tab">TawkTo</a>
                </li>
            </ul>

            <div class="tab-content p-4 bg-white border mt-4">
                <!-- Site Information -->
                <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                    <div class="row gy-4 mb-4">
                        <div class="col-xl-6">
                            <label for="site-title" class="form-label">Site Title</label>
                            <input type="text" id="site-title" name="site_name"
                                class="form-control @error('site_name') is-invalid @enderror" placeholder="Site Title"
                                value="{{ old('site_name', setting('site_name')) }}" required>
                            @error('site_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-primary m-1 mt-3 show-admin-modal">Save
                                Changes</button>
                        </div>
                    </div>
                </div>

                <!-- Payment Gateways -->
                <div class="tab-pane fade" id="account-settings" role="tabpanel">
                    <h6 class="fw-semibold mb-3">Stripe</h6>
                    <div class="row gy-4 mb-4">
                        <div class="col-xl-6">
                            <label for="stripe-secret-key" class="form-label">Secret Key</label>
                            <input type="text" id="stripe-secret-key" name="stripe_key"
                                class="form-control @error('stripe_key') is-invalid @enderror"
                                value="{{ old('stripe_key', setting('stripe_key')) }}">
                            @error('stripe_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="row gy-4 mb-4">
                        <div class="col-xl-6">
                            <label for="stripe-webhook_secret" class="form-label">Secret webhook secret</label>
                            <input type="text" id="stripe-webhook_secret" name="webhook_secret"
                                class="form-control @error('webhook_secret') is-invalid @enderror"
                                value="{{ old('webhook_secret', setting('webhook_secret')) }}">
                            @error('webhook_secret')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h6 class="fw-semibold mb-3">PayPal</h6>
                    <div class="row gy-4 mb-4">
                        <div class="col-xl-6">
                            <label for="paypal-secret-key" class="form-label">Secret Key</label>
                            <input type="text" id="paypal-secret-key" name="paypal_key"
                                class="form-control @error('paypal_key') is-invalid @enderror"
                                value="{{ old('paypal_key', setting('paypal_key')) }}">
                            @error('paypal_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="paypal-client-id" class="form-label mt-3">Client ID</label>
                            <input type="text" id="paypal-client-id" name="paypal_client_id"
                                class="form-control @error('paypal_client_id') is-invalid @enderror"
                                value="{{ old('paypal_client_id', setting('paypal_client_id')) }}">
                            @error('paypal_client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="paypal-mode" class="form-label mt-3">Mode</label>
                            <input type="text" id="paypal-mode" name="paypal_mode"
                                class="form-control @error('paypal_mode') is-invalid @enderror"
                                value="{{ old('paypal_mode', setting('paypal_mode')) }}">
                            @error('paypal_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button type="button" class="btn btn-primary m-1 mt-3 show-admin-modal">Save
                                Changes</button>
                        </div>
                    </div>
                </div>

                <!-- E-Mailing Server -->
                <div class="tab-pane fade" id="email-settings" role="tabpanel">
                    <div class="row gy-4 mb-4">
                        <div class="col-md-6">
                            <label for="mail-mailer" class="form-label">Mailer</label>
                            <input type="text" id="mail-mailer" name="mail_mailer"
                                class="form-control @error('mail_mailer') is-invalid @enderror"
                                value="{{ old('mail_mailer', setting('mail_mailer')) }}">
                            @error('mail_mailer')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="host" class="form-label">Host</label>
                            <input type="text" id="host" name="mail_host"
                                class="form-control @error('mail_host') is-invalid @enderror"
                                value="{{ old('mail_host', setting('mail_host')) }}">
                            @error('mail_host')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="port-id" class="form-label">Port</label>
                            <input type="number" id="port-id" name="mail_port"
                                class="form-control @error('mail_port') is-invalid @enderror"
                                value="{{ old('mail_port', setting('mail_port')) }}">
                            @error('mail_port')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="mail_username"
                                class="form-control @error('mail_username') is-invalid @enderror"
                                value="{{ old('mail_username', setting('mail_username')) }}">
                            @error('mail_username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="mail_password"
                                class="form-control @error('mail_password') is-invalid @enderror"
                                value="{{ old('mail_password', setting('mail_password')) }}">
                            @error('mail_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="encryption-url" class="form-label">Encryption</label>
                            <input type="text" id="encryption-url" name="mail_encryption"
                                class="form-control @error('mail_encryption') is-invalid @enderror"
                                value="{{ old('mail_encryption', setting('mail_encryption')) }}">
                            @error('mail_encryption')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="from-address" class="form-label">From Address</label>
                            <input type="email" id="from-address" name="mail_from_address"
                                class="form-control @error('mail_from_address') is-invalid @enderror"
                                value="{{ old('mail_from_address', setting('mail_from_address')) }}">
                            @error('mail_from_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="from-name" class="form-label">From Name</label>
                            <input type="text" id="from-name" name="mail_from_name"
                                class="form-control @error('mail_from_name') is-invalid @enderror"
                                value="{{ old('mail_from_name', setting('mail_from_name')) }}">
                            @error('mail_from_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-6">
                            <label for="cc_address" class="form-label">CS Email</label>
                            <input type="email" id="cc_address" name="cc_address"
                                class="form-control @error('cc_address') is-invalid @enderror"
                                value="{{ old('cc_address', setting('cc_address')) }}">
                            @error('cc_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-6">
                            <label for="admin_email" class="form-label">Admin Email</label>
                            <input type="email" id="admin_email" name="admin_email"
                                class="form-control @error('admin_email') is-invalid @enderror"
                                value="{{ old('admin_email', setting('admin_email')) }}">
                            @error('admin_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary m-1 mt-3 show-admin-modal">Save Changes</button>
                </div>

                <!-- TalkTo -->
                <div class="tab-pane fade" id="labels" role="tabpanel">
                    <div class="row gy-4 mb-4">
                        <div class="col-xl-6">
                            <label for="link" class="form-label">TawkTo Embed Link</label>
                            <input type="text" id="link" name="talkto_link"
                                class="form-control @error('talkto_link') is-invalid @enderror"
                                value="{{ old('talkto_link', setting('talkto_link')) }}">
                            @error('talkto_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="talkto_enabled" value="0">
                        <input class="form-check-input" type="checkbox" id="talkto-enabled" name="talkto_enabled"
                            value="1" {{ old('talkto_enabled', setting('talkto_enabled')) ? 'checked' : '' }}>
                        <label for="talkto-enabled" class="form-check-label">Enabled</label>
                    </div>
                    <button type="button" class="btn btn-primary m-1 mt-3 show-admin-modal">Save Changes</button>
                </div>
            </div>
        </form>

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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            let triggeredSaveBtn = null;

            document.querySelectorAll('.show-admin-modal').forEach(button => {
                button.addEventListener('click', function() {
                    triggeredSaveBtn = this;
                    document.getElementById('admin-password').value = '';
                    document.getElementById('password-error').classList.add('d-none');
                    new bootstrap.Modal(document.getElementById('adminPasswordModal')).show();
                });
            });

            document.getElementById('submitAdminPassword').addEventListener('click', async function() {
                const pw = document.getElementById('admin-password').value.trim();
                if (!pw) {
                    document.getElementById('password-error').classList.remove('d-none');
                    return;
                }

                // Verify password using API
                try {
                    const response = await fetch('{{ route("admin.verify-admin-password") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            password: pw
                        })
                    });

                    const result = await response.json();

                    if (!response.ok || !result.success) {
                        document.getElementById('password-error').textContent = result.message ||
                            'Unauthorized.';
                        document.getElementById('password-error').classList.remove('d-none');
                        return;
                    }

                    document.getElementById('hidden-admin-password').value = pw;
                    bootstrap.Modal.getInstance(document.getElementById('adminPasswordModal'))
                    .hide();
                    triggeredSaveBtn.closest('form').submit();

                } catch (err) {
                    console.error(err);
                    document.getElementById('password-error').textContent = 'Something went wrong.';
                    document.getElementById('password-error').classList.remove('d-none');
                }
            });
        });
        </script>


    </div>
</div>
@endsection
