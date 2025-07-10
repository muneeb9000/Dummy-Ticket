@extends('admin.layouts.app')

@section('content')
    <style>
        .seo-dot {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-right: 6px;
            vertical-align: middle;
            background-color: #adb5bd;
            /* default gray */
            border: 1px solid #ced4da;
        }

        .seo-dot.green {
            background-color: #30c750 !important;
            border-color: #1e7e34;
        }

        .seo-dot.yellow {
            background-color: #ffd500 !important;
            border-color: #ffb300;
        }

        .seo-dot.red {
            background-color: #e53935 !important;
            border-color: #b71c1c;
        }

        .seo-dot.gray {
            background-color: #adb5bd !important;
            border-color: #adb5bd;
        }
    </style>

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Blog Management</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blog Articles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Add Category Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="addCategoryForm" onsubmit="handleCategorySubmit(event)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" id="newCategoryName" class="form-control" placeholder="Category Name" required>
                                <div class="text-danger mt-1" id="nameError" style="display:none;"></div>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="slug" id="newCategorySlug" class="form-control" placeholder="Category Slug" required>
                                <div class="text-danger mt-1" id="slugError" style="display:none;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

           
            <!-- Blog Form -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="ri-article-line me-2"></i>Edit Blog Post
                            </div>
                            <p class="text-muted mb-0">Update the details below to modify the blog article</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" class="needs-validation"
                                 enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Blog Title -->
                                <div class="mb-4">
                                    <label for="blog-title" class="form-label fs-14 text-dark">Title<span
                                            class="text-danger ms-1">*</span></label>
                                    <input type="text" id="blog-title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter blog title" value="{{ old('title', $blog->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="blog-category" class="form-label fs-14 text-dark">
                                            Category <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <select id="blog-category" name="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                                +
                                            </button>
                                        </div>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                       <div class="col-md-6 mb-4">
                                        <label for="blog-image" class="form-label fs-14 text-dark">Featured Image</label>
                                        <div class="input-group">
                                            <input type="text" id="blog-image" name="media_id"
                                                class="form-control @error('image') is-invalid @enderror"
                                                value="{{ old('media_id', $blog->media->image_url ?? 'NA') }}"
                                                placeholder="Image URL" readonly>
                                            <input type="hidden" id="blog-media-id" name="media_id" value="{{ old('media_id', $blog->media_id) }}">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mediaLibraryModal">
                                                <i class="ri-image-line"></i>
                                            </button>
                                        </div>
                                        <div class="form-text">Recommended size: 1200x630 pixels, Max 2MB</div>
                                        @error('media_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#mediaLibraryModal">
                                        <i class="ri-image-add-line me-1"></i> Add Media
                                    </button>
                                </div>

                                <!-- Blog Content Section -->
                                <div class="mb-4">
                                    <label for="tinymce-content" class="form-label fs-14 text-dark">Content<span
                                            class="text-danger ms-1">*</span></label>
                                    <textarea id="tinymce-content" name="content" class="form-control @error('content') is-invalid @enderror"
                                        rows="10">{{ old('content', $blog->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Write your blog content with proper formatting</div>
                                </div>

                                <div class="row">
                                    <!-- SEO Fields Section -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <i class="ri-search-eye-line me-2"></i>SEO Settings
                                            </div>
                                            <p class="text-muted mb-0">Optimize your blog post for search engines</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">SEO Title</label>
                                                <input type="text" name="meta_title" id="meta_title"
                                                    class="form-control @error('meta_title') is-invalid @enderror"
                                                    maxlength="70" value="{{ old('meta_title', $blog->seo->title) }}">
                                                <small class="form-text text-muted">Recommended: ≤ 70 characters</small>
                                                @error('meta_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">SEO Description</label>
                                                <textarea name="meta_description" id="meta_description"
                                                    class="form-control @error('meta_description') is-invalid @enderror" maxlength="160" rows="2">{{ old('meta_description', $blog->seo->description) }}</textarea>
                                                <small class="form-text text-muted">Recommended: ≤ 160 characters</small>
                                                @error('meta_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_keywords" class="form-label">SEO Keywords</label>
                                                <input type="text" name="meta_keywords" id="meta_keywords"
                                                    class="form-control @error('meta_keywords') is-invalid @enderror"
                                                    value="{{ old('meta_keywords', $blog->seo->keywords) }}">
                                                <small class="form-text text-muted">Comma-separated, optional</small>
                                                @error('meta_keywords')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="focus_keyword" class="form-label">Focus Keyword</label>
                                                <input type="text" name="focus_keyword" id="focus_keyword"
                                                    class="form-control @error('focus_keyword') is-invalid @enderror"
                                                    value="{{ old('focus_keyword', $blog->seo->focus_keyword) }}">
                                                <small class="form-text text-muted">The main keyword you want to rank for</small>
                                                @error('focus_keyword')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_image" class="form-label">SEO Image URL</label>
                                                <input type="text" name="meta_image" id="meta_image"
                                                    class="form-control @error('meta_image') is-invalid @enderror"
                                                    value="{{ old('meta_image', $blog->seo->image) }}">
                                                <small class="form-text text-muted">Leave blank to use featured image.</small>
                                                @error('meta_image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">Slug</label>
                                                <input type="text" name="slug" id="url_slug"
                                                    class="form-control @error('slug') is-invalid @enderror"
                                                    maxlength="70" value="{{ old('slug', $blog->slug) }}">
                                                <small class="form-text text-muted"></small>
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="robots" class="form-label">Search Engine Visibility</label>
                                                <select name="robots" id="robots" required
                                                    class="form-select @error('robots') is-invalid @enderror">
                                                    <option value="index,follow" 
                                                        {{ old('robots', $blog->robots ?? 'index,follow') == 'index,follow' ? 'selected' : '' }}>
                                                        Default (index, follow)
                                                    </option>
                                                    <option value="noindex, nofollow"
                                                        {{ old('robots', $blog->robots) == 'noindex, nofollow' ? 'selected' : '' }}>
                                                        Noindex, Nofollow
                                                    </option>
                                                    <option value="noindex, follow"
                                                        {{ old('robots', $blog->robots) == 'noindex, follow' ? 'selected' : '' }}>
                                                        Noindex, Follow
                                                    </option>
                                                    <option value="index, nofollow"
                                                        {{ old('robots', $blog->robots) == 'index, nofollow' ? 'selected' : '' }}>
                                                        Index, Nofollow
                                                    </option>
                                                </select>
                                                @error('robots')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">
                                        <i class="ri-arrow-left-line me-1"></i> Back to List
                                    </a>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line me-1"></i> Update Blog
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::app-content -->

    <!-- Media Library Modal -->
    <div class="modal fade" id="mediaLibraryModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title fw-semibold d-flex align-items-center" id="mediaModalLabel">
                        <i class="ri-image-2-line me-2"></i>Media Library
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <form id="media-upload-form" enctype="multipart/form-data" class="p-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="file" name="image" id="media-upload-input" class="form-control form-control-sm" accept="image/*" required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="ri-upload-line me-1"></i> Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                   
                        <!-- Left: Media Thumbnails -->
                        <div class="col-lg-8 border-end">
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0 text-muted">Select an image</h6>
                                    <small class="text-muted">{{ count($media) }} items</small>
                                </div>
                               <div class="row g-3" id="media-thumbnails">
                                    @foreach ($media as $item)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="card border-0 shadow-sm h-100 media-item position-relative overflow-hidden"
                                                data-id="{{ $item['id'] }}"
                                                data-title="{{ $item['title'] }}" 
                                                data-url="{{ $item['image_url'] }}"
                                                data-caption="{{ $item['caption'] ?? '' }}"
                                                data-alt_text="{{ $item['alt_text'] ?? '' }}"
                                                style="cursor: pointer; transition: all 0.2s ease;">
                                                <div class="position-relative overflow-hidden rounded-top"
                                                    style="aspect-ratio: 1;">
                                                    <img src="{{ $item['image_url'] ?? $item->image_url }}" 
                                                        alt="{{ $item['title'] ?? $item->title }}"
                                                        class="w-100 h-100 object-fit-cover"
                                                        onerror="this.src='/images/no-image.png';">
                                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-0 d-flex align-items-center justify-content-center media-overlay"
                                                        style="transition: opacity 0.2s ease;">
                                                        <i class="ri-check-line text-white fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="card-body p-2">
                                                    <p class="mb-0 small text-truncate fw-medium">{{ $item['title'] ?? $item->title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if (empty($media))
                                    <div class="text-center py-5">
                                        <i class="ri-image-line display-1 text-muted opacity-50"></i>
                                        <h6 class="mt-3 text-muted">No media files found</h6>
                                        <p class="text-muted small">Upload some images to get started</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Right: Image Details Panel -->
                        <div class="col-lg-4">
                            <div class="p-4 h-100">
                                <div id="media-details" style="display: none;">
                                    <h6 class="text-muted mb-3">Image Details</h6>
                                    <div class="text-center mb-4">
                                        <img id="selected-image" src="" class="img-fluid rounded shadow-sm"
                                            style="max-height: 200px;" />
                                    </div>
                                  <!-- TITLE -->
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-muted">TITLE</label>
                                    <input type="text" class="form-control form-control-sm" id="media-title" data-field="title" />
                                </div>
                                <!-- CAPTION -->
                               <div class="mb-3">
                                    <label class="form-label small fw-semibold text-muted">CAPTION</label>
                                    <textarea class="form-control form-control-sm" id="media-caption" data-field="caption" rows="2"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-muted">ALT TEXT</label>
                                    <textarea class="form-control form-control-sm" id="media-alt_text" data-field="alt_text" rows="2"></textarea>
                                </div>
                                    <div class="mb-4">
                                        <label class="form-label small fw-semibold text-muted">URL</label>
                                        <p class="mb-0 small text-break font-monospace bg-light p-2 rounded"
                                            id="media-url"></p>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-success" id="insert-to-editor">
                                            <i class="ri-upload-line me-2"></i>Insert
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="copyToClipboard()">
                                            <i class="ri-file-copy-line me-1"></i>Copy URL
                                        </button>
                                         <button type="button" class="btn btn-outline-danger btn-sm" id="delete-media-btn">
                                            <i class="ri-delete-bin-line me-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                                <div id="no-selection" class="text-center py-5">
                                    <i class="ri-cursor-line display-4 text-muted opacity-25"></i>
                                    <h6 class="mt-3 text-muted">Select an image</h6>
                                    <p class="text-muted small mb-0">Click on any image to view details and insert into
                                        your content</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .media-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .media-item:hover .media-overlay {
            opacity: 0.8 !important;
        }

        .media-item.selected {
            border: 2px solid var(--bs-primary) !important;
            transform: translateY(-2px);
        }

        .media-item.selected .media-overlay {
            opacity: 0.9 !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    console.log('🚀 MediaLibraryManager: DOM Content Loaded');

    // Main MediaLibraryManager Class
    class MediaLibraryManager {
            constructor() {
                console.log('📦 MediaLibraryManager: Constructor called');
                this.debounceTimer = null;
                this.selectedMediaId = '';
                this.selectedImageUrl = '';
                this.selectedImageAlt = '';
                this.currentInsertTarget = null;
                this.debounceDelay = 500;
                this.mediaModal = null;
                
                this.init();
            }

            init() {
                console.log('🔧 MediaLibraryManager: Initializing all components');
                try {
                    this.initAutoSave();
                    this.initMediaModalTriggers();
                    this.initMediaItemSelection();
                    this.initInsertButton();
                    this.initMediaUpload();
                    this.initCopyToClipboard();
                    this.initFeaturedImagePreview();
                    this.initModalReset();
                    this.initDeleteButton(); // Add this line
                    console.log('✅ MediaLibraryManager: All components initialized successfully');
                } catch (error) {
                    console.error('❌ MediaLibraryManager: Initialization failed', error);
                }
            }

            // Add this new initialization method
            initModalReset() {
                console.log('🔄 ModalReset: Initializing modal reset functionality');
                this.mediaModal = document.getElementById('mediaLibraryModal');
                if (this.mediaModal) {
                    console.log('🎭 ModalReset: Found media modal, adding event listener');
                    this.mediaModal.addEventListener('hidden.bs.modal', () => {
                        console.log('👋 ModalReset: Modal hidden, resetting state');
                        this.resetModalState();
                    });
                } else {
                    console.warn('⚠️ ModalReset: Media modal not found');
                }
            }

            // Add this new method
            resetModalState() {
                console.log('🔄 ModalReset: Resetting modal state');
                
                // Clear selected items
                document.querySelectorAll('.media-item').forEach(item => {
                    item.classList.remove('selected');
                });
                console.log('🧹 ModalReset: Cleared selected items');
                
                // Reset details panel
                const mediaDetails = document.getElementById('media-details');
                const noSelection = document.getElementById('no-selection');
                if (mediaDetails && noSelection) {
                    mediaDetails.style.display = 'none';
                    noSelection.style.display = 'block';
                    console.log('🔄 ModalReset: Reset details panel visibility');
                }
                
                // Clear global variables
                this.selectedMediaId = '';
                this.selectedImageUrl = '';
                this.selectedImageAlt = '';
                console.log('🧹 ModalReset: Cleared global variables', {
                    selectedMediaId: this.selectedMediaId,
                    selectedImageUrl: this.selectedImageUrl,
                    selectedImageAlt: this.selectedImageAlt
                });
            }
               initDeleteButton() {
                console.log('🗑️ DeleteButton: Initializing delete button');
                
                const deleteBtn = document.getElementById('delete-media-btn');
                if (!deleteBtn) {
                    console.warn('⚠️ DeleteButton: Delete button not found');
                    return;
                }

                console.log('🗑️ DeleteButton: Button found, setting up event listener');
                
                deleteBtn.addEventListener('click', () => {
                    console.log('👆 DeleteButton: Delete button clicked');
                    this.handleDelete();
                });
            }

          handleDelete() {
                    console.log('🗑️ Delete: Starting delete process');

                    if (!this.selectedMediaId) {
                        console.warn('⚠️ Delete: No media selected');
                        return;
                    }

                    console.log('📋 Delete: Deleting media with ID:', this.selectedMediaId);

                    // Show loading state on delete button
                    const deleteBtn = document.getElementById('delete-media-btn');
                    const originalBtnContent = deleteBtn.innerHTML;
                    deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';
                    deleteBtn.disabled = true;

                    fetch(`/admin/delete-media/${this.selectedMediaId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('📡 Delete: Response received', { status: response.status, ok: response.ok });
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('✅ Delete: Delete successful', data);
                        if (data.success) {
                            // Remove the media item from the DOM immediately
                            const mediaItem = document.querySelector(`.media-item[data-id="${this.selectedMediaId}"]`);
                            if (mediaItem) {
                                // Get the parent column div that contains the media item
                                const parentCol = mediaItem.closest('.col-6, .col-md-4, .col-lg-3');
                                if (parentCol) {
                                    parentCol.remove();
                                } else {
                                    mediaItem.remove();
                                }
                                console.log('🗑️ Delete: Media item removed from DOM');
                                
                                // Check if the deleted image is being used as featured image
                                const featuredMediaId = document.getElementById('blog-media-id')?.value;
                                if (featuredMediaId === this.selectedMediaId) {
                                    console.log('🖼️ Delete: Clearing featured image as it was deleted');
                                    const blogImageInput = document.getElementById('blog-image');
                                    const blogMediaIdInput = document.getElementById('blog-media-id');
                                    if (blogImageInput) blogImageInput.value = '';
                                    if (blogMediaIdInput) blogMediaIdInput.value = '';
                                    
                                    // Hide featured image preview
                                    const preview = document.getElementById('featured-image-preview');
                                    if (preview) {
                                        preview.style.display = 'none';
                                    }
                                }
                            }
                            
                            // Reset the modal state immediately
                            this.resetModalState();
                        }
                    })
                    .catch(error => {
                        console.error('❌ Delete: Delete failed', error);
                        // Silently handle error - just reset button state
                    })
                    .finally(() => {
                        // Reset button state
                        deleteBtn.innerHTML = originalBtnContent;
                        deleteBtn.disabled = false;
                    });
                }

        // Auto-save functionality
        initAutoSave() {
            console.log('💾 AutoSave: Initializing auto-save functionality');
            
            document.addEventListener('input', (e) => {
                if (e.target.matches('#media-title, #media-caption, #media-alt_text')) {
                    console.log('📝 AutoSave: Input detected on field:', e.target.dataset.field);
                    
                    const mediaId = e.target.dataset.id;
                    const field = e.target.dataset.field;
                    const value = e.target.value;
                   
                    if (mediaId) {
                        console.log('🔄 AutoSave: Starting auto-save', { mediaId, field, value });
                        this.autoSave(mediaId, field, value);
                    } else {
                        console.error('❌ AutoSave: No media ID found for field:', field);
                    }
                }
            });
        }

        

      autoSave(mediaId, field, value) {
            console.log('⏱️ AutoSave: Debouncing save operation', { mediaId, field, value });
            
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                const route = `/admin/media-library/${mediaId}`;
                console.log('🌐 AutoSave: Making API request', { mediaId, route, field, value });
                
                fetch(route, {
                    method: "PUT", 
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest" 
                    },
                    body: JSON.stringify({ field, value })
                })
                .then(response => {
                    console.log('📡 AutoSave: Response received', { status: response.status, ok: response.ok });
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ AutoSave: Save successful', data);
                    if (data.success) {
                        console.log('🎉 AutoSave: Success message:', data.message);
                        
                        // Update the media item in the modal and library
                        const mediaItem = document.querySelector(`[data-media-id="${mediaId}"]`);
                        const modalMediaItem = document.querySelector(`.modal [data-media-id="${mediaId}"]`);
                        
                        // Update both the main library item and modal item if they exist
                        [mediaItem, modalMediaItem].forEach(item => {
                            if (item) {
                                item.setAttribute(`data-${field}`, value);
                                
                                if (field === 'title') {
                                    const titleElement = item.querySelector('.card-body p');
                                    if (titleElement) titleElement.textContent = value;
                                }
                                
                                // Also update any input fields in the modal
                                const inputField = item.querySelector(`[name="${field}"]`);
                                if (inputField) {
                                    inputField.value = value;
                                }
                            }
                        });
                        
                        // If this is the currently selected media in the modal, update the form fields
                        if (this.selectedMedia && this.selectedMedia.id === mediaId) {
                            this.selectedMedia[field] = value;
                        }
                    }
                })
                .catch(error => {
                    console.error('❌ AutoSave: Save failed', error);
                });
            }, this.debounceDelay);
        }

        // Modal trigger setup
        initMediaModalTriggers() {
            console.log('🎭 Modal: Initializing modal triggers');
            
            const triggers = document.querySelectorAll('[data-bs-target="#mediaLibraryModal"]');
            console.log(`🎭 Modal: Found ${triggers.length} modal triggers`);
            
            triggers.forEach((button, index) => {
                console.log(`🎭 Modal: Setting up trigger ${index + 1}`, button);
                
                button.addEventListener('click', () => {
                    this.currentInsertTarget = button.classList.contains('btn-info') ? 'editor' : 'featured-image';
                    console.log('🎯 Modal: Insert target set to:', this.currentInsertTarget);
                });
            });
        }

        // Media item selection
        initMediaItemSelection() {
            console.log('🖼️ MediaSelection: Initializing media item selection');
            
            const mediaItems = document.querySelectorAll('.media-item');
            console.log(`🖼️ MediaSelection: Found ${mediaItems.length} media items`);

            mediaItems.forEach((item, index) => {
                console.log(`🖼️ MediaSelection: Setting up item ${index + 1}`, item.getAttribute('data-id'));
                this.setupSingleMediaItem(item);
            });
        }

        setupSingleMediaItem(item) {
            console.log('🔧 MediaSelection: Setting up single media item', item.getAttribute('data-id'));
            
            // Remove any existing listeners to prevent duplicates
            const newItem = item.cloneNode(true);
            item.parentNode.replaceChild(newItem, item);
            
            const mediaDetails = document.getElementById('media-details');
            const noSelection = document.getElementById('no-selection');
            
            console.log('🔍 MediaSelection: Found required elements', {
                mediaDetails: !!mediaDetails,
                noSelection: !!noSelection
            });
            
            newItem.addEventListener('click', () => {
                console.log('👆 MediaSelection: Item clicked', newItem.getAttribute('data-id'));
                this.selectMediaItem(newItem, mediaDetails, noSelection);
            });
            
            return newItem;
        }

        selectMediaItem(item, mediaDetails, noSelection) {
            console.log('🔄 MediaSelection: Selecting media item');
            
            // Clear previous selections
            document.querySelectorAll('.media-item').forEach(i => {
                i.classList.remove('selected');
            });
            console.log('🧹 MediaSelection: Cleared previous selections');
            
            // Set new selection
            item.classList.add('selected');
            console.log('✨ MediaSelection: Added selected class to item');

            const mediaId = item.getAttribute('data-id');
            const url = item.getAttribute('data-url');
            const title = item.getAttribute('data-title');
            const caption = item.getAttribute('data-caption');
            const altText = item.getAttribute('data-alt_text') || title;

            console.log('📋 MediaSelection: Extracted data', { mediaId, url, title, caption, altText });

            // Update details panel
            this.updateDetailsPanel(mediaId, url, title, caption, altText);
            
            // Update global variables
            this.selectedMediaId = mediaId;
            this.selectedImageUrl = url;
            this.selectedImageAlt = altText;
            
            console.log('🌐 MediaSelection: Updated global variables', {
                selectedMediaId: this.selectedMediaId,
                selectedImageUrl: this.selectedImageUrl,
                selectedImageAlt: this.selectedImageAlt
            });
            
            // Show details panel
            if (mediaDetails && noSelection) {
                mediaDetails.style.display = 'block';
                noSelection.style.display = 'none';
                console.log('👁️ MediaSelection: Details panel shown, no-selection hidden');
            }
        }

        updateDetailsPanel(mediaId, url, title, caption, altText) {
            console.log('📝 MediaSelection: Updating details panel');
            
            const elements = {
                selectedImage: document.getElementById('selected-image'),
                mediaTitle: document.getElementById('media-title'),
                mediaCaption: document.getElementById('media-caption'),
                mediaAltText: document.getElementById('media-alt_text'),
                mediaUrl: document.getElementById('media-url')
            };

            console.log('🔍 MediaSelection: Found panel elements', Object.keys(elements).filter(key => elements[key]));

            if (elements.selectedImage) {
                elements.selectedImage.src = url;
                console.log('🖼️ MediaSelection: Updated selected image src');
            }

            if (elements.mediaTitle) {
                elements.mediaTitle.value = title || '';
                elements.mediaTitle.setAttribute('data-id', mediaId);
                elements.mediaTitle.setAttribute('data-field', 'title');
                console.log('📝 MediaSelection: Updated media title');
            }

            if (elements.mediaCaption) {
                elements.mediaCaption.value = caption || '';
                elements.mediaCaption.setAttribute('data-id', mediaId);
                elements.mediaCaption.setAttribute('data-field', 'caption');
                console.log('📝 MediaSelection: Updated media caption');
            }

            if (elements.mediaAltText) {
                elements.mediaAltText.value = altText || '';
                elements.mediaAltText.setAttribute('data-id', mediaId);
                elements.mediaAltText.setAttribute('data-field', 'alt_text');
                console.log('📝 MediaSelection: Updated media alt text');
            }

            if (elements.mediaUrl) {
                elements.mediaUrl.innerText = url;
                console.log('🔗 MediaSelection: Updated media URL display');
            }
        }

        // Insert button functionality
        initInsertButton() {
            console.log('🔘 InsertButton: Initializing insert button');
            
            const insertButton = document.getElementById('insert-to-editor');
            if (!insertButton) {
                console.warn('⚠️ InsertButton: Insert button not found');
                return;
            }

            console.log('🔘 InsertButton: Button found, setting up event listener');
            
            insertButton.addEventListener('click', () => {
                console.log('👆 InsertButton: Insert button clicked');
                this.handleInsert();
            });
        }

        handleInsert() {
            console.log('🚀 Insert: Starting insert process');
            
            if (!this.selectedMediaId) {
                console.warn('⚠️ Insert: No media selected');
                alert('Please select an image first');
                return;
            }

            console.log('📋 Insert: Using selected media', {
                id: this.selectedMediaId,
                url: this.selectedImageUrl,
                target: this.currentInsertTarget
            });

            const altText = document.getElementById('media-alt_text')?.value || this.selectedImageAlt;
            console.log('🏷️ Insert: Using alt text:', altText);
            
            if (this.currentInsertTarget === 'featured-image') {
                console.log('🖼️ Insert: Inserting as featured image');
                this.insertAsFeaturedImage();
            } else {
                console.log('✏️ Insert: Inserting into editor');
                this.insertIntoEditor(altText);
            }

            this.closeModal();
        }

        insertAsFeaturedImage() {
            console.log('🖼️ FeaturedImage: Inserting as featured image');
            
            const featuredImageInput = document.getElementById('blog-image');
            const featuredMediaIdInput = document.getElementById('blog-media-id');
            
            console.log('🔍 FeaturedImage: Found inputs', {
                imageInput: !!featuredImageInput,
                mediaIdInput: !!featuredMediaIdInput
            });
            
            if (featuredImageInput && featuredMediaIdInput) {
                featuredImageInput.value = this.selectedImageUrl;
                featuredMediaIdInput.value = this.selectedMediaId;
                this.updateFeaturedImagePreview(this.selectedImageUrl);
                console.log('✅ FeaturedImage: Successfully set featured image');
            } else {
                console.error('❌ FeaturedImage: Required inputs not found');
            }
        }

        insertIntoEditor(altText) {
            console.log('✏️ Editor: Inserting into editor');
            
            if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                console.log('📝 Editor: Using TinyMCE editor');
                const content = `<img src="${this.selectedImageUrl}" alt="${altText}" class="img-fluid" data-media-id="${this.selectedMediaId}" />`;
                tinymce.activeEditor.execCommand('mceInsertContent', false, content);
                console.log('✅ Editor: Content inserted into TinyMCE');
            } else {
                console.log('📝 Editor: Falling back to textarea');
                const editor = document.getElementById('tinymce-content');
                if (editor) {
                    const content = `<img src="${this.selectedImageUrl}" alt="${altText}" class="img-fluid" />`;
                    editor.value += content;
                    console.log('✅ Editor: Content inserted into textarea');
                } else {
                    console.error('❌ Editor: No editor found');
                }
            }
        }

        closeModal() {
            console.log('🚪 Modal: Closing media library modal');
            const modal = bootstrap.Modal.getInstance(document.getElementById('mediaLibraryModal'));
            if (modal) {
                modal.hide();
                console.log('✅ Modal: Modal closed successfully');
            } else {
                console.warn('⚠️ Modal: Modal instance not found');
            }
        }

        // Featured image preview
        updateFeaturedImagePreview(imageUrl) {
            console.log('🖼️ Preview: Updating featured image preview', imageUrl);
            
            const preview = document.getElementById('featured-image-preview');
            if (preview) {
                if (imageUrl) {
                    preview.style.display = 'block';
                    const img = preview.querySelector('img');
                    if (img) {
                        img.src = imageUrl;
                        console.log('✅ Preview: Featured image preview updated');
                    }
                } else {
                    preview.style.display = 'none';
                    console.log('👁️ Preview: Featured image preview hidden');
                }
            } else {
                console.warn('⚠️ Preview: Featured image preview element not found');
            }
        }

        initFeaturedImagePreview() {
            console.log('🖼️ Preview: Initializing featured image preview');
            const existingImage = document.getElementById('blog-image')?.value;
            if (existingImage) {
                console.log('🔍 Preview: Found existing featured image:', existingImage);
                this.updateFeaturedImagePreview(existingImage);
            }
        }

        // Media upload functionality
        initMediaUpload() {
            console.log('📤 Upload: Initializing media upload');
            
            const form = document.getElementById('media-upload-form');
            if (!form) {
                console.warn('⚠️ Upload: Upload form not found');
                return;
            }

            console.log('📤 Upload: Form found, setting up event listener');
            
            form.addEventListener('submit', (e) => {
                console.log('📤 Upload: Form submitted');
                this.handleMediaUpload(e);
            });
        }

       handleMediaUpload(e) {
                e.preventDefault();
                console.log('📤 Upload: Processing upload');

                const input = document.getElementById('media-upload-input');
                const file = input?.files[0];
                
                if (!file) {
                    console.warn('⚠️ Upload: No file selected');
                    return;
                }

                console.log('📄 Upload: File selected', { name: file.name, size: file.size, type: file.type });

                const form = e.currentTarget.closest('form');
                const uploadButton = form.querySelector('button[type="submit"]');
                const originalButtonText = uploadButton.innerHTML;
                
                // Set loading state
                uploadButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Uploading...';
                uploadButton.disabled = true;

                const formData = new FormData();
                const fileName = file.name.replace(/\.[^/.]+$/, "");
                
                formData.append('image', file);
                formData.append('title', fileName);
                formData.append('alt_text', fileName);
                formData.append('caption', fileName);
                formData.append('_token', '{{ csrf_token() }}');

                console.log('📦 Upload: FormData prepared', { fileName });

                fetch("{{ route('admin.media.upload') }}", {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    console.log('📡 Upload: Response received', { status: response.status, ok: response.ok });
                    return response.json();
                })
                .then(data => {
                    console.log('📤 Upload: Response data', data);
                    if (data.success) {
                        this.handleUploadSuccess(data, input);
                    } else {
                        console.error('❌ Upload: Upload failed', data.message);
                        alert("Upload failed: " + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('❌ Upload: Network error', error);
                    alert("Upload failed.");
                })
                .finally(() => {
                    // Reset button to original state
                    if (uploadButton) {
                        uploadButton.innerHTML = originalButtonText;
                        uploadButton.disabled = false;
                    }
                });
            }

        handleUploadSuccess(data, input) {
            console.log('✅ Upload: Processing successful upload', data);
            
            const newItemHtml = this.createMediaItemHtml(data);
            const mediaThumbnails = document.getElementById('media-thumbnails');
            
            if (mediaThumbnails) {
                mediaThumbnails.insertAdjacentHTML('afterbegin', newItemHtml);
                console.log('🎨 Upload: New media item added to DOM');
                
                // Get the newly added item and set up its event listener
                const newItem = mediaThumbnails.querySelector('.media-item');
                if (newItem) {
                    console.log('🔧 Upload: Setting up event listener for new item', newItem.getAttribute('data-id'));
                    
                    // Add event listener to the new item
                    this.setupSingleMediaItem(newItem);
                    
                    // Auto-select the new item
                    console.log('👆 Upload: Auto-selecting new media item');
                    newItem.click();
                } else {
                    console.error('❌ Upload: New media item not found after insertion');
                }
            } else {
                console.error('❌ Upload: Media thumbnails container not found');
            }

            // Clear input
            input.value = '';
            console.log('🧹 Upload: Input cleared');
        }

        createMediaItemHtml(data) {
            console.log('🏗️ Upload: Creating media item HTML');
            return `
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 media-item position-relative overflow-hidden"
                        data-id="${data.id}"
                        data-title="${data.title}" 
                        data-url="${data.image_url}"
                        data-caption="${data.caption || ''}"
                        data-alt_text="${data.alt_text || ''}"
                        style="cursor: pointer; transition: all 0.2s ease;">
                        <div class="position-relative overflow-hidden rounded-top"
                            style="aspect-ratio: 1;">
                            <img src="${data.image_url}" 
                                alt="${data.title}"
                                class="w-100 h-100 object-fit-cover"
                                onerror="this.src='/images/no-image.png';">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-0 d-flex align-items-center justify-content-center media-overlay"
                                style="transition: opacity 0.2s ease;">
                                <i class="ri-check-line text-white fs-3"></i>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <p class="mb-0 small text-truncate fw-medium">${data.title}</p>
                        </div>
                    </div>
                </div>`;
        }

        // Copy to clipboard functionality
        initCopyToClipboard() {
            console.log('📋 Clipboard: Initializing copy to clipboard');
            // Function will be called globally
        }
    }

    // Category Manager Class
    class CategoryManager {
        constructor() {
            console.log('📂 CategoryManager: Constructor called');
            this.init();
        }

        init() {
            console.log('🔧 CategoryManager: Initializing category management');
            this.initCategoryForm();
        }

        initCategoryForm() {
            console.log('📝 CategoryManager: Setting up category form');
            
            const form = document.getElementById('addCategoryForm');
            if (!form) {
                console.warn('⚠️ CategoryManager: Category form not found');
                return;
            }

            console.log('📝 CategoryManager: Form found, setting up event listener');
            
            form.addEventListener('submit', (e) => {
                console.log('📝 CategoryManager: Form submitted');
                this.handleCategorySubmit(e);
            });
        }

        handleCategorySubmit(e) {
            e.preventDefault();
            console.log('📝 CategoryManager: Processing category submission');
            
            const nameInput = document.getElementById('newCategoryName');
            const slugInput = document.getElementById('newCategorySlug');
            const errorBox = document.getElementById('categoryError');
            const name = nameInput?.value;
            const slug = slugInput?.value;
            
            console.log('📝 CategoryManager: Category name:', name, 'Slug:', slug);
            
            if (errorBox) {
                errorBox.style.display = 'none';
            }
            
            if (!name || !slug) {
                console.warn('⚠️ CategoryManager: Category name or slug not provided');
                this.handleCategoryError('Both name and slug are required.');
                return;
            }

            console.log('🌐 CategoryManager: Making API request');
            
            fetch("{{ route('admin.blog-categories.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    name: name,
                    slug: slug 
                })
            })
            .then(response => {
                console.log('📡 CategoryManager: Response received', { status: response.status, ok: response.ok });
                return response.json();
            })
            .then(data => {
                console.log('📂 CategoryManager: Response data', data);
                if (data.success) {
                    this.handleCategorySuccess(data, nameInput, slugInput);
                } else {
                    this.handleCategoryError(data.message || 'Something went wrong.');
                }
            })
            .catch(error => {
                console.error('❌ CategoryManager: Network error', error);
                this.handleCategoryError('Error saving category.');
            });
        }

        handleCategorySuccess(data, nameInput) {
            console.log('✅ CategoryManager: Category created successfully', data.data);
            
            const select = document.getElementById('blog-category');
            if (select) {
                const newOption = new Option(data.data.name, data.data.id, true, true);
                select.add(newOption);
                select.dispatchEvent(new Event('change'));
                console.log('📋 CategoryManager: New option added to select');
            }
            
            if (nameInput) {
                nameInput.value = '';
                console.log('🧹 CategoryManager: Input cleared');
            }
            
            this.closeModal();
        }

        handleCategoryError(message) {
            console.error('❌ CategoryManager: Error occurred', message);
            const errorBox = document.getElementById('categoryError');
            if (errorBox) {
                errorBox.innerText = message;
                errorBox.style.display = 'block';
            }
        }

        closeModal() {
            console.log('🚪 CategoryManager: Closing category modal');
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
            if (modal) {
                modal.hide();
                console.log('✅ CategoryManager: Modal closed successfully');
            }
        }
    }

    // Global copy function
    window.copyToClipboard = function() {
        console.log('📋 Clipboard: Copy function called');
        
        const urlElement = document.getElementById('media-url');
        if (!urlElement) {
            console.error('❌ Clipboard: Media URL element not found');
            return;
        }
        
        const url = urlElement.innerText;
        console.log('📋 Clipboard: Copying URL:', url);
        
        navigator.clipboard.writeText(url).then(function() {
            console.log('✅ Clipboard: URL copied successfully');
            
            const btn = event.target.closest('button');
            if (btn) {
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="ri-check-line me-1"></i>Copied!';
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-outline-success');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-outline-success');
                    btn.classList.add('btn-outline-secondary');
                    console.log('🔄 Clipboard: Button state reset');
                }, 2000);
            }
        }).catch(err => {
            console.error('❌ Clipboard: Failed to copy:', err);
        });
    };

    // Initialize both managers
    try {
        const mediaManager = new MediaLibraryManager();
        const categoryManager = new CategoryManager();
        console.log('🎉 Application: All managers initialized successfully');
    } catch (error) {
        console.error('💥 Application: Failed to initialize managers', error);
    }
});
</script>
@endpush

@push('scripts')
<script src="https://cdn.tiny.cloud/1/afc43j2v3ynsla4sz2kpr5rfwzn1lyyn7mvygwuleacp6v6a/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        tinymce.init({
            selector: '#tinymce-content',
            height: 300,
            menubar: false,
            plugins: 'image link media code table lists',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image media table | code',
            branding: false,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: false,
            content_style: "body { font-family: 'Inter', sans-serif; font-size: 14px; }",
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
        });
    });
</script>
@endpush
