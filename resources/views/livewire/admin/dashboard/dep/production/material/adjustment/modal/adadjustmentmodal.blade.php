<div>
    @if ($openadjustmentmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Adjustment</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Adjustment Type <i class="ri-node-tree"></i></label>
                            <select wire:model="adjustment_type" class="form-select  @error('adjustment_type') is-invalid @enderror" id="adjustment_type">
                                <option value="">Select type</option>
                                 @if ($adjustmenttype)
                                     @foreach ($adjustmenttype as $type)
                                     <option value="{{ $type->id }}">{{ $type->adjustment_type }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Lot<i class="ri-node-tree"></i></label>
                                    <input type="text" wire:model="lot" class="form-control @error('lot') is-invalid @enderror" id="lot">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Batch<i class="ri-node-tree"></i></label>
                                    <input type="text" wire:model="batch" class="form-control @error('batch') is-invalid @enderror" id="batch">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity<i class="ri-node-tree"></i></label>
                            <input type="text" wire:model="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reference No (Optional)<i class="ri-node-tree"></i></label>
                            <input type="text" wire:model="reference_number" class="form-control @error('reference_number') is-invalid @enderror" id="reference_number">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Reason<i class="ri-node-tree"></i></label>
                            <textarea wire:model="reason" class="form-control" id="reason"></textarea>
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
