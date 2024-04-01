<div class="modal fade" id="editRecord" wire:ignore.self tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-record">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           {{ $slot}}
        </div>
      </div>
    </div>
  </div>