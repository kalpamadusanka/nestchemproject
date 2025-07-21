<div>
    @if ($viewaddcollectionmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add collection</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->




                        <div class="mb-3">
                            <label class="form-label">Collection Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="collection_name" class="form-control @error('collection_name') is-invalid @enderror" id="collection_name">
                        </div>





                        <div class="mb-3">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="description" rows="4" placeholder="Enter your description here..."></textarea>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Submit</span>
                                <span wire:loading>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
