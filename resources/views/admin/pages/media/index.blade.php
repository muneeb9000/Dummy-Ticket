    @extends('admin.layouts.app')

    @section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Gallery Management</h1>
                @can('media.create')
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-plus me-2"></i>Add Media
            </button>
            @endcan


            </div>

            <!-- Centered Search -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <input type="text" id="search" class="form-control" placeholder="Search by title...">
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="bg-white rounded shadow-sm p-4">
            <div class="row" id="gallery-wrapper">
                @include('admin.pages.media.partials.gallery', ['media' => $media])
            </div>
        </div>
        </div>
    </div>

    <!-- Upload Image Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form id="uploadForm" method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload New Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="upload-title" class="form-label">Title</label>
            <input type="text" name="title" id="upload-title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="upload-alt_text" class="form-label">Alt Text</label>
            <input type="text" name="alt_text" id="upload-alt_text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="upload-caption" class="form-label">Caption</label>
            <input type="text" name="caption" id="upload-caption" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="upload-description" class="form-label">Description</label>
            <textarea name="description" id="upload-description" rows="3" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="upload-image" class="form-label">Select Image</label>
            <input type="file" name="image" id="upload-image" class="form-control" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-end gap-2">
          <button type="submit" class="btn btn-primary btn-sm">Upload</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


    <!-- Image Details Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form id="updateForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <!-- Image (left side) -->
                            <div class="col-md-5 d-flex align-items-center justify-content-center">
                                <div class="bg-white border rounded p-2 w-100 text-center" style="height: 300px;">
                                    <img id="modal-image" src="" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </div>

                            <!-- Editable Fields (right side) -->
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="modal-title" class="form-label">Title</label>
                                    <input type="text" name="title" id="modal-title" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="modal-alt" class="form-label">Alt Text</label>
                                    <input type="text" name="alt_text" id="modal-alt" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="modal-caption" class="form-label">Caption</label>
                                    <input type="text" name="caption" id="modal-caption" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="modal-description" class="form-label">Description</label>
                                    <textarea name="description" id="modal-description" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="mb-3 form-check form-switch">
                                    <label class="form-label" for="modal-status-toggle">Status</label><br>
                                    <input type="hidden" name="status" value="0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="modal-status-toggle" name="status" value="1">
                                    <label class="form-check-label" for="modal-status-toggle" id="status-label">Inactive</label>

                                </div>

                                <div class="mt-3">
                                    <label for="modal-path" class="form-label">Storage Path</label>
                                    <div class="input-group">
                                        <input type="text" id="modal-path" class="form-control" readonly>
                                        <button class="btn btn-outline-secondary" type="button" id="copy-path-btn">Copy</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer d-flex justify-content-end gap-2">
                        @can('media.edit')
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                        @endcan
                        @can('media.delete')
                        <button type="button" onclick="document.getElementById('deleteForm').submit();" class="btn btn-danger btn-sm">Delete</button>
                        @endcan
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    
                </form>
            </div>
        </div>
    </div>

    @endsection

    @push('styles')
    <style>
        .gallery-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    $(document).ready(function () {

        // AJAX Search Functionality
        $('#search').on('keyup', function () {
            const query = $(this).val();
            fetchGallery(query);
        });

        function fetchGallery(query = '') {
            $.ajax({
                url: "{{ route('admin.media.index') }}",
                method: 'GET',
                data: { search: query, ajax: true },
                success: function (data) {
                    $('#gallery-wrapper').html(data.html);
                }
            });
        }

           $(document).on('click', '.open-image-modal', function () {
            const image = $(this).data('image');
            const url = $(this).data('url');
            const title = $(this).data('title');
            const alt = $(this).data('alt');
            const status = $(this).data('status'); // should be 1 or 0
            const caption = $(this).data('caption');
            const description = $(this).data('description');
            const path = $(this).data('path');
            const deleteUrl = $(this).data('delete');

            $('#modal-image').attr('src', image);
            $('#modal-title').val(title);
            $('#modal-alt').val(alt);
            $('#modal-caption').val(caption);
            $('#modal-description').val(description);
            $('#modal-path').val(path);
            $('#deleteForm').attr('action', deleteUrl);
            $('#updateForm').attr('action', url);

            // Set toggle state and label
            $('#modal-status-toggle').prop('checked', status == 1);
            $('#status-label').text(status == 1 ? 'Active' : 'Inactive');

            $('#imageModal').modal('show');
        });

        // Update label on change
        $('#modal-status-toggle').on('change', function () {
            const label = $(this).is(':checked') ? 'Active' : 'Inactive';
            $('#status-label').text(label);
        });



        // Copy Path Button
        $('#copy-path-btn').on('click', function () {
            const pathInput = document.getElementById("modal-path");
            pathInput.select();
            pathInput.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(pathInput.value);
        });

    });
    </script>
    @endpush
