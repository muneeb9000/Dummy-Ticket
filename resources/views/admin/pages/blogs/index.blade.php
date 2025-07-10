@extends('admin.layouts.app')

@section('content')
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
             <!-- Page Header -->
             <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Blog List</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog list</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->
            <!-- Blog List -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Blog Posts
                            </div>
                            @can('blogs.create')
                            <div>
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                                    <i class="ri-add-line me-1"></i> Add New Blog
                                </a>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-basic" class="table text-nowrap table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="5%">Sr</th>
                                            <th scope="col" width="15%">Image</th>
                                            <th scope="col" width="20%">Title</th>
                                            <th scope="col" width="15%">Category</th>
                                            <th scope="col" width="20%">Excerpt</th>
                                            <th scope="col" width="15%">Created At</th>
                                            @canany(['blogs.edit', 'blogs.delete'])
                                            <th scope="col" width="10%">Actions</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                  <img src="{{ $blog->media->image_url ?? 'N/A' }}" alt="{{ $blog->media->alt_text ?? 'N/A' }}" width="100" class="img-thumbnail">
                                                </td>
                                                <td style="word-wrap: break-word;">{{ Str::limit($blog->title, 25) }}</td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $blog->categoryRelation->name ?? 'No Category' }}
                                                    </span

                                                </td>
                                               
                                                <td>{!! Str::limit(strip_tags($blog->content), 50) !!}</td>
                                                <td>
                                                    <div>
                                                        <div>{{ $blog->created_at->format('M d, Y') }}</div>
                                                        <small class="text-muted">{{ $blog->created_at->format('h:i A') }}</small>
                                                    </div>
                                                </td>
                                                @canany(['blogs.edit','blogs.delete'])
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        @can('blogs.edit')
                                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                           class="btn btn-icon btn-sm btn-info-light"
                                                           data-bs-toggle="tooltip" title="Edit">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        @endcan
                                                        @can('blogs.delete')
                                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light" 
                                                            onclick="confirmDelete('{{ route('admin.blogs.destroy', $blog->id) }}')"
                                                            data-bs-toggle="tooltip" title="Delete">
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
            <!-- End of Blog List -->
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="deleteConfirmationLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-muted fs-16">Are you sure you want to delete this blog post? This action cannot be undone.</p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #dee2e6;">
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
    <script>
        function confirmDelete(deleteUrl) {
            document.getElementById('deleteForm').action = deleteUrl;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        }
    </script>
@endsection

