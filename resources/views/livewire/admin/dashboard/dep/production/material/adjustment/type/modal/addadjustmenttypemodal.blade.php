<div>
    @if ($openadjustmenttypemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Adjustment Type </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Adjustment Name <i class="ri-node-tree"></i></label>
                            <input type="text"  wire:model="adjustment_type" class="form-control @error('adjustment_type') is-invalid @enderror" id="adjustment_type" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type<i class="ri-node-tree"></i></label>
                            <select wire:model="type" class="form-select  @error('type') is-invalid @enderror" id="type">
                                <option value="">Select type</option>
                                <option value="increase">Positive Adjustments (Stock Increase)</option>
                                <option value="decrease">Negative Adjustments (Stock Decrease)</option>

                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Description<i class="ri-node-tree"></i></label>
                            <textarea wire:model="description" class="form-control" id="description"></textarea>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save</span>
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
