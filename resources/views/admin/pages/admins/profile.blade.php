@extends('admin.layouts.app')
@section('content')
    <div class="main-content app-content">
        <div class="container">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Profile</h1>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>

            <div class="row mb-5">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Profile Image -->
                                <h6 class="fw-semibold mb-3">Profile Image:</h6>
                                <div class="mb-4 d-sm-flex align-items-center">
                                    <div class="mb-0 me-5">
                                        <span class="avatar avatar-xxl avatar-rounded">
                                            <img id="profile-img" src="{{ $user->getProfileImage() }}" alt="Profile Image">
                                            <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                                <input type="file" name="photo" class="position-absolute w-100 h-100 op-0" id="profile-change" onchange="previewImage(event)">
                                                <i class="fe fe-camera"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <h6 class="fw-semibold mb-3">Personal Information:</h6>
                                <div class="row gy-4 mb-4">
                                    <div class="col-xl-6">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" value="{{ $user->name }}" required>
                                        <small class="text-muted">Please enter your full name as per official documents.</small>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" value="{{ $user->email }}" required>
                                        <small class="text-muted">Your email should be in a valid format (e.g., user@example.com).</small>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="password" class="form-label">New Password <span class="text-danger"></span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter new password" >
                                        <small class="text-muted">Password must be at least 8 characters long.</small>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger"></span></label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" >
                                        <small class="text-muted">Ensure this matches the password field.</small>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary m-1">Save Changes</button>
                                        <button type="button" class="btn btn-secondary m-1" onclick="window.location.href='{{ route('admin.dashboard') }}'">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>