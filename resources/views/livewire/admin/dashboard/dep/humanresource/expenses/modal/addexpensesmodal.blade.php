<div>
    @if ($openexpensemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Expenses</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Employee Name</label>
                            <select wire:model="empname" class="form-select  @error('empname') is-invalid @enderror" id="empname">
                                <option value="">Select employee</option>
                                 @if ($employees)
                                     @foreach ($employees as $emp)
                                     <option value="{{ $emp->username }}">{{ $emp->username }}</option>
                                     @endforeach
                                 @endif

                            </select>
                            <small class="text-muted">You have not chosen an employee. This may be treated as a company expense.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment method<span class="text-danger">*</span></label>
                            <select wire:model="paymentmethod" class="form-select  @error('paymentmethod') is-invalid @enderror" id="paymentmethod">
                                <option value="">Select method</option>
                                 @if ($paymentmethods)
                                     @foreach ($paymentmethods as $method)
                                     <option value="{{ $method->payment_method }}">{{ $method->payment_method }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Transaction/Ref No<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="transaction" class="form-control @error('transaction') is-invalid @enderror" id="transaction">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Merchant<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="merchant" class="form-control @error('merchant') is-invalid @enderror" id="merchant">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="required form-label">Expenses category<span class="text-danger">*</span></label>
                            <select wire:model="expensecategory" class="form-select  @error('expensecategory') is-invalid @enderror" id="expensecategory">
                                <option value="">Select method</option>
                                 @if ($expensecategories)
                                     @foreach ($expensecategories as $expcatewgory)
                                     <option value="{{ $expcatewgory->category_name }}">{{ $expcatewgory->category_name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="note" rows="4" placeholder="Enter your reason here..."></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Amount<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="amount" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount">

                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Currency<span class="text-danger">*</span></label>
                                    <select wire:model="currency" class="form-select  @error('currency') is-invalid @enderror" id="currency">
                                        <option value="">Select currency</option>
                                             <option value="LKR">LKR</option>
                                             <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
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
