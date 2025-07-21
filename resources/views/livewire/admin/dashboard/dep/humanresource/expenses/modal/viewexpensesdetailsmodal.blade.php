<div>
    @if ($openexpensedetailsmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">View Expenses Details</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Expenses For<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="expensesfor" class="form-control @error('expensesfor') is-invalid @enderror" id="expensesfor" readonly>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Transaction No<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="transactionno" class="form-control @error('transactionno') is-invalid @enderror" id="transactionno" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Expenses Category<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="expensecategory" class="form-control @error('expensecategory') is-invalid @enderror" id="expensecategory" readonly>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Amount<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Payment method<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="paymentmethod" class="form-control @error('paymentmethod') is-invalid @enderror" id="paymentmethod" readonly>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Merchant<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="merchant" class="form-control @error('merchant') is-invalid @enderror" id="merchant" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="note" rows="4" placeholder="Enter your reason here..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="documentUpload">
                                Invoice/Receipt <span class="text-danger">*</span>
                            </label>
                            <input
                                type="file"
                                class="form-control"
                                id="documentUpload"
                                wire:model="document"
                                accept=".pdf, .doc, .docx, .jpg, .jpeg, .png"
                                required
                            >
                            <small class="form-text text-muted">
                                Accepted formats: PDF, DOC, JPG, PNG (Max size: 5MB)
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Update</span>
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
