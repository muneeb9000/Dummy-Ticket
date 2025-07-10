@if($media->count() > 0)
    <div class="row gallery-grid mb-4">
        @foreach($media as $item)
        <div class="col-6 col-md-4 col-lg-3 gallery-item mb-4">
            <div class="position-relative border rounded overflow-hidden">
            <img
                src="{{ $item->image_url }}"
                class="img-fluid gallery-img open-image-modal"
                alt="{{ $item->alt_text ?? '' }}"
                style="cursor:pointer"
                data-image="{{ $item->image_url }}"
                data-url="{{ route('admin.media.show', $item->id) }}"
                data-title="{{ $item->title }}"
                data-alt="{{ $item->alt_text }}"
                data-status="{{ ucfirst($item->status) }}"
                data-caption="{{ $item->caption }}"
                data-description="{{ $item->description }}"
                data-path="{{ $item->image_url }}"
                data-delete="{{ route('admin.media.destroy', $item->id) }}"
                >

            <div class="d-flex align-items-center justify-content-between px-2 py-2 bg-light border-top">
                <small class="text-truncate" style="max-width: 80%;">{{ $item->title }}</small>
                <i class="fas fa-eye text-muted"></i>
            </div>
        </div>

        </div>
        @endforeach
       
    </div>
@else
    <div class="col-12 text-center py-5">No images found</div>
@endif
