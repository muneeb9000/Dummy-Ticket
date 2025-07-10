@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Inquiries List</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inquiries</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Inquiries Table -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Customer Inquiries</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-basic" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        @canany(['inquiries.edit','inquiries.delete'])
                                        <th>Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiries as $inquiry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inquiry->name }}</td>
                                        <td>{{ $inquiry->number }}</td>
                                        <td>{{ $inquiry->email }}</td>
                                        <td>{{ Str::limit($inquiry->purpose, 40) }}</td>
                                       <td>{{ $inquiry->status }}</td>
                                        @canany(['inquiries.edit','inquiries.delete'])
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                @can('inquiries.delete')
                                                <button type="button" class="btn btn-icon btn-sm btn-danger-light"
                                                    data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                                    data-url="{{ route('admin.inquiries.destroy', $inquiry->id) }}"
                                                    title="Delete">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                                @endcan
                                            </div>
                                        </td>
                                        @endcanany
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-muted">Are you sure you want to delete this inquiry?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteConfirmationModal');
        
        deleteModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-url attribute
            var url = button.getAttribute('data-url');
            
            // Update the modal's form action
            var form = deleteModal.querySelector('#deleteForm');
            form.setAttribute('action', url);
        });
    });
</script>
