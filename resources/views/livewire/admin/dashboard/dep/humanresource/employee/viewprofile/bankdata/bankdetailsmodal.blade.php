<div>
    @if ($viewbankdatamodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Bank details</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="bankname" id="bankname" class="form-control @error('bankname') is-invalid @enderror" placeholder="Enter bank name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Acc No <span class="text-danger">*</span></label>
                            <input type="number" wire:model="accno" id="accno" class="form-control @error('accno') is-invalid @enderror" placeholder="Account No">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Branch <span class="text-danger">*</span></label>
                            <input type="text" wire:model="branch" id="branch" class="form-control @error('branch') is-invalid @enderror" placeholder="Branch">
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save changes</span>
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
