<div>
    @if ($openstockeeditmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Lot No<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="lot" class="form-control @error('lot') is-invalid @enderror" id="lot">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Exp Date<span class="text-danger">*</span></label>
                                    <input type="date" wire:model="exp_date" class="form-control @error('exp_date') is-invalid @enderror" id="exp_date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Unit Price<span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" wire:model="unitprice" class="form-control @error('unitprice') is-invalid @enderror" id="unitprice">
                                </div>
                            </div>

                        </div>



                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save</span>
                                <span wire:loading>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
