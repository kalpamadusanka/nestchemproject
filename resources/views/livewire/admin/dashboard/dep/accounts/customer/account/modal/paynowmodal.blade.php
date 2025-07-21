<div>
    @if ($openpaynowmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                 <form wire:submit.prevent="submit" enctype="multipart/form-data">
    <!-- Account Type -->
    <div class="mb-3">
        <label for="paymentMethod" class="form-label">Payment Method</label>
        <select class="form-select" id="paymentMethod" wire:model="payment_method">
            <option selected>Select method</option>
            <option>Credit Card</option>
            <option>Bank Transfer</option>
            <option>Check</option>
            <option>Cash</option>
        </select>
    </div>

    <!-- Amount -->
    <div class="mb-3">
        <label class="form-label">Amount<span class="text-danger">*</span></label>
        <input type="number" step="0.01" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="code">
    </div>

    <!-- Receipt/Image Upload with Preview -->
   <!-- Receipt/Image Upload with Preview -->
<div class="mb-3">
    <label for="receipt" class="form-label">Upload Receipt/Proof of Payment</label>
    <input type="file" class="form-control" id="receipt" wire:model.live="receipt"
           accept="image/*,.pdf" wire:change="previewFile">

    <!-- Preview Section -->
    @if($previewImage)
        <div class="mt-3 border p-3">
            <h6>Preview:</h6>
            @if($previewImage === 'pdf')
                <div class="alert alert-info d-flex align-items-center">
                    <i class="fas fa-file-pdf fa-2x me-3"></i>
                    <div>
                        <strong>PDF File</strong><br>
                        {{ $receipt->getClientOriginalName() }}
                    </div>
                </div>
            @else
                <div class="position-relative" style="max-width: 300px;">
                    <img src="{{ $previewImage }}" alt="Receipt Preview" class="img-fluid rounded border">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                            wire:click="removePreview">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <div class="form-text">Max file size: 2MB (JPEG, PNG, PDF)</div>
    @error('receipt') <span class="text-danger">{{ $message }}</span> @enderror
</div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            <span wire:loading.remove>Pay Now</span>
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
