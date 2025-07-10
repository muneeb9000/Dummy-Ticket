@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Frequently Asked Questions</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            FAQs List
                        </div>
                        @can('faqs.create')
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#faqModal">
                                <i class="ri-add-line me-1 align-middle"></i>Add New FAQ
                            </button>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="faqs-table" class="table text-nowrap table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Category</th>
                                        <th>Created</th>
                                        @canany(['faqs.edit','faqs.delete','faqs.view'])
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

<!-- Add/Edit FAQ Modal -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="faqModalLabel">Add New FAQ</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="faqForm" method="POST">
                @csrf
                <input type="hidden" id="faq_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                            <div class="invalid-feedback" id="question-error"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                            <div class="invalid-feedback" id="answer-error"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="category_id-error"></div>
                        </div>
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

<!-- View Full Content Modal -->
<div class="modal fade" id="viewContentModal" tabindex="-1" aria-labelledby="viewContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="viewContentModalLabel">Full Content</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-light rounded">
                    <h5 id="modalQuestion" class="mb-3"></h5>
                    <p id="modalAnswer" class="mb-0"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
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
                <p>Are you sure you want to delete this FAQ? This action cannot be undone.</p>
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
    // Function to limit words
    function limitWords(text, limit) {
        if (!text) return '';
        const words = text.trim().split(/\s+/);
        if (words.length > limit) {
            return words.slice(0, limit).join(' ') + '...';
        }
        return text;
    }

    // Initialize DataTable
    var table = $('#faqs-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: false, // Changed to false since we're loading all data at once
        ajax: {
            url: "{{ route('admin.faqs.index') }}",
            dataSrc: 'data'
        },
        columns: [{
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                },
                orderable: false,
                searchable: false,
                width: '5%'
            },
            {
                data: 'question',
                render: function(data, type, row) {
                    const limitedQuestion = limitWords(data, 50);
                    return `<div class="text-gray-900" style="white-space: normal; word-wrap: break-word;">${limitedQuestion}</div>`;
                }
            },
            {
                data: 'answer',
                render: function(data, type, row) {
                    const limitedAnswer = limitWords(data, 50);
                    const formattedAnswer = limitedAnswer.replace(/\n/g, '<br>');
                    return `<div class="text-gray-700" style="white-space: normal; word-wrap: break-word;">${formattedAnswer}</div>`;
                }
            },
            {
                data: 'category',
                render: function(data, type, row) {
                    return data ? `
                        <div class="flex items-center gap-2">
                            <span class="text-gray-800">${data.name}</span>
                        </div>
                    ` : '';
                }
            },
            {
                data: 'created_at',
                render: function(data) {
                    return data ? new Date(data).toLocaleDateString('en-GB') : '';
                }
            },
             @canany(['faqs.edit','faqs.delete','faqs.view'])
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2 fs-15">
                            @can('faqs.view')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 view-content" 
                                data-question="${escapeHtml(row.question)}"
                                data-answer="${escapeHtml(row.answer)}"
                                title="View full content">
                                <i class="ri-eye-line"></i>
                            </button>
                            @endcan
                            @can('faqs.edit')
                            <button class="btn btn-icon btn-sm btn-info-light m-1 edit-faq" 
                                data-id="${row.id}"
                                data-question="${escapeHtml(row.question)}"
                                data-answer="${escapeHtml(row.answer)}"
                                data-category-id="${row.category_id}">
                                <i class="ri-edit-line"></i>
                            </button>
                            @endcan
                            @can('faqs.delete')
                            <button class="btn btn-icon btn-sm btn-danger-light m-1 delete-faq" 
                                data-id="${row.id}">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            @endcan
                        </div>
                    `;
                }
            }
            @endcanany
        ],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"></div> Loading...'
        },
        order: [[4, 'desc']] // Default sort by created_at descending
    });

    // Helper function to escape HTML
    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
            .replace(/\n/g, "\\n");
    }

    // Helper function to unescape HTML
    function unescapeHtml(text) {
        return text
            .replace(/&amp;/g, "&")
            .replace(/&lt;/g, "<")
            .replace(/&gt;/g, ">")
            .replace(/&quot;/g, '"')
            .replace(/&#039;/g, "'")
            .replace(/\\n/g, "\n");
    }

    // Show View Content Modal
    $(document).on('click', '.view-content', function() {
        const question = unescapeHtml($(this).data('question'));
        const answer = unescapeHtml($(this).data('answer'));
        $('#modalQuestion').text(question);
        $('#modalAnswer').html(answer.replace(/\n/g, '<br>'));
        $('#viewContentModal').modal('show');
    });

    // Reset form on modal close
    $('#faqModal').on('hidden.bs.modal', function() {
        $('#faqForm')[0].reset();
        $('#faq_id').val('');
        $('#faqModalLabel').text('Add New FAQ');
        $('#saveBtn').text('Save');
        $('.invalid-feedback').text('').hide();
        $('.form-control').removeClass('is-invalid');
        $('.form-select').removeClass('is-invalid');
    });

    // Show Add Modal
    $('#addFaqBtn').click(function() {
        $('#faqModal').modal('show');
    });

    // Show Edit Modal
    $(document).on('click', '.edit-faq', function() {
        const faqId = $(this).data('id');
        const question = unescapeHtml($(this).data('question'));
        const answer = unescapeHtml($(this).data('answer'));
        const categoryId = $(this).data('category-id');

        $('#faq_id').val(faqId);
        $('#question').val(question);
        $('#answer').val(answer);
        $('#category_id').val(categoryId);
        $('#faqModalLabel').text('Edit FAQ');
        $('#saveBtn').text('Update');
        $('#faqModal').modal('show');
    });

    // Submit Add/Edit Form
    $('#faqForm').submit(function(e) {
        e.preventDefault();

        var id = $('#faq_id').val();
        var url = id ? "{{ url('admin/faqs') }}/" + id : "{{ route('admin.faqs.store') }}";
        var method = id ? 'PUT' : 'POST';

        // Show loading state
        $('#saveBtn').prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + (id ? '&_method=PUT' : ''),
            success: function(response) {
                if (response.success) {
                    $('#faqModal').modal('hide');
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
                    $('.form-select').removeClass('is-invalid');
                    $('.invalid-feedback').hide();

                    $.each(errors, function(key, value) {
                        let element = $('#' + key);
                        element.addClass('is-invalid');
                        $('#' + key + '-error').text(value[0]).show();
                    });
                } else {
                    iziToast.error({
                        message: xhr.responseJSON.message ||
                            'An error occurred while saving.',
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
            },
            complete: function() {
                $('#saveBtn').prop('disabled', false).text(id ? 'Update' : 'Save');
            }
        });
    });

    // Delete FAQ
    let deleteId;
    $(document).on('click', '.delete-faq', function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        // Show loading state
        $(this).prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...'
        );

        $.ajax({
            url: "{{ url('admin/faqs') }}/" + deleteId,
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
                        'An error occurred while deleting.',
                    position: 'topRight',
                    timeout: 9000,
                    backgroundColor: '#e55353',
                    color: '#fff',
                    icon: 'fa fa-times-circle',
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutUp',
                    class: 'custom-toast',
                });
            },
            complete: function() {
                $('#confirmDelete').prop('disabled', false).text('Delete');
            }
        });
    });
});
</script>
@endpush