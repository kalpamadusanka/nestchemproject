<div>
    @if ($openeditmanufacturemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $selectedmanufactureno }}</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="confirmSubmit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="manufactureproduct" class="form-control @error('manufactureproduct') is-invalid @enderror" id="manufactureproduct" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Product group<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="productgroup" class="form-control @error('productgroup') is-invalid @enderror" id="productgroup" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Barcode<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="barcode" class="form-control @error('barcode') is-invalid @enderror" id="barcode" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Barcode type<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="barcodeType" class="form-control @error('barcodeType') is-invalid @enderror" id="barcodeType" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Quantity<span class="text-danger"></span></label>
                                    <input type="text" wire:model="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger">*</span></label>
                                    <input type="date" wire:model="startDate" class="form-control @error('startDate') is-invalid @enderror" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">End Date<span class="text-danger">*</span></label>
                                    <input type="date" wire:model="endDate" class="form-control @error('endDate') is-invalid @enderror" id="endDate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                                </div>
                            </div>
                            @if($manufacturestatus != 'finished')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select wire:model="manufacturestatus" class="form-select @error('manufacturestatus') is-invalid @enderror" id="manufacturestatus">
                                        <option value="ongoing">In progress</option>
                                        <option value="finished">Finished</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save changes</span>
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

    <!-- Confirmation Modal -->
    @if($showConfirmationModal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Confirm Status Change</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark this manufacturing process as finished? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelConfirmation">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="submit">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
