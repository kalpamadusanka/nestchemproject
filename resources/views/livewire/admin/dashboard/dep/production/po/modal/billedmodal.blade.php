<div>
    @if ($openbilledmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Payment </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Payment method<span class="text-danger">*</span></label>
                            <select class="form-select @error('paymentmethod') is-invalid @enderror" wire:model.live="paymentmethod" id="paymentmethod">
                                <option value="" >Choose option</option>
                                @if ($paymentmthod)
                                @foreach ($paymentmthod as $payment)
                                <option value="{{$payment->id}}">{{$payment->payment_method}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment account<span class="text-danger">*</span></label>
                            <select class="form-select @error('paymentacc') is-invalid @enderror" wire:model.live="paymentacc" id="paymentacc">
                                <option value="" >Choose option</option>
                                @if ($paymentaccount)
                                @foreach ($paymentaccount as $payment)
                                <option value="{{$payment->id}}">{{$payment->account_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="number" step="0.01"  wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Transaction <i class="ri-node-tree"></i></label>
                            <input type="number"  wire:model="transactionno" class="form-control @error('transactionno') is-invalid @enderror" id="transactionno" >
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" wire:model="file" class="form-control @error('file') is-invalid @enderror" id="file">
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
