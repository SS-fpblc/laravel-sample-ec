<!-- button : open modal -->
<button type="button" class="button {{ $button_class }}" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#modal_{{ $modal_unique }}">
    {{ $button_txt }}
</button>
<!-- modal -->
<div class="modal fade" id="modal_{{ $modal_unique }}" tabindex="-1" aria-labelledby="modal-{{ $modal_unique }}-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fnt_bold" id="modal-{{ $modal_unique }}-title">{{ $modal_title }}</h5>
            </div>
            <div class="modal-body">
                @include($modal_body, $modal_body_arg)
            </div>
        </div>
    </div>
</div>