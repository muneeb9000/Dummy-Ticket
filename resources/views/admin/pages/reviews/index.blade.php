@extends('admin.layouts.app')

@section('content')
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Reviews List</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews list</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Reviews List -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Customer Reviews</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-basic" class="table text-nowrap table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Review Excerpt</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        @canany(['reviews.edit','reviews.delete'])
                                        <th scope="col">Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div>{{ $review->name }}<br><small class="text-muted">{{ $review->email }}</small></div>
                                        </td>
                                        <td>{{ Str::limit(strip_tags($review->title), 50) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="ri-star-fill text-warning"></i>
                                                    @else
                                                        <i class="ri-star-line text-muted"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-1">({{ $review->rating }})</span>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit(strip_tags($review->review), 50) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $review->status ? 'success' : 'danger' }}">
                                                {{ $review->status ? 'Approved' : 'Pending' }}
                                            </span>
                                        </td>
                                         <td>{{ $review->created_at->format('d M Y') }}</td>
                                        @canany(['reviews.edit','reviews.delete'])
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <button type="button" class="btn btn-icon btn-sm btn-info-light" onclick="showReviewModal({{ json_encode($review->name) }}, {{ json_encode($review->review) }})" data-bs-toggle="tooltip" title="View Full Review">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                                @if(!$review->status && auth()->user()->can('reviews.edit'))
                                                    <a href="javascript:void(0);" onclick="showApproveModal({{ json_encode(route('admin.reviews.approve', $review->id)) }})" class="btn btn-icon btn-sm btn-success-light" data-bs-toggle="tooltip" title="Approve">
                                                        <i class="ri-check-line"></i>
                                                    </a>
                                                @endif
                                                @can('reviews.edit')
                                                <a href="javascript:void(0);" onclick="showEditModal({{ json_encode($review) }}, {{ json_encode(route('admin.reviews.update', $review->id)) }})" class="btn btn-icon btn-sm btn-warning-light" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                @endcan
                                                @can('reviews.delete')
                                                    <button type="button" class="btn btn-icon btn-sm btn-danger-light" onclick="showDeleteModal({{ json_encode(route('admin.reviews.destroy', $review->id)) }})" data-bs-toggle="tooltip" title="Delete">
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
        <!-- End Reviews List -->
    </div>
</div>

<!-- 👁️ Review View Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="reviewModalLabel">Review by <span id="reviewerName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-light rounded">
                    <p id="fullReviewContent" class="mb-0"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ✏️ Edit Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editReviewModalLabel">Edit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editReviewForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reviewExcerpt" class="form-label">Review Excerpt</label>
                        <textarea class="form-control" id="reviewExcerpt" name="review" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reviewDate" class="form-label">Review Date</label>
                        <input type="datetime-local" class="form-control" id="reviewDate" name="created_at" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🗑️ Delete Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteConfirmationLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-muted fs-16">
                Are you sure you want to delete this review? This action cannot be undone.
            </div>
            <div class="modal-footer">
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

<!-- ✅ Approve Modal -->
<div class="modal fade" id="approveConfirmationModal" tabindex="-1" aria-labelledby="approveConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="approveConfirmationLabel">Confirm Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-muted fs-16">
                Are you sure you want to approve this review?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="approveBtn" class="btn btn-success">Approve</a>
            </div>
        </div>
    </div>
</div>

<!-- 🔧 JS for Modal Actions -->
<script>
    function showReviewModal(name, review) {
        document.getElementById('reviewerName').textContent = name;
        document.getElementById('fullReviewContent').textContent = review;
        new bootstrap.Modal(document.getElementById('reviewModal')).show();
    }

    function showApproveModal(url) {
        const approveBtn = document.getElementById('approveBtn');
        approveBtn.setAttribute('data-url', url);
        new bootstrap.Modal(document.getElementById('approveConfirmationModal')).show();
    }

    function showDeleteModal(url) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.setAttribute('action', url);
        new bootstrap.Modal(document.getElementById('deleteConfirmationModal')).show();
    }

    function showEditModal(review, url) {
    const form = document.getElementById('editReviewForm');
    form.setAttribute('action', url);
    
    const createdAt = new Date(review.created_at);
    const formattedDate = createdAt.toISOString().slice(0, 16);
    
    document.getElementById('reviewExcerpt').value = review.review;
    document.getElementById('reviewDate').value = formattedDate;
    
    new bootstrap.Modal(document.getElementById('editReviewModal')).show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('approveBtn').addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        });
    });
</script>
@endsection