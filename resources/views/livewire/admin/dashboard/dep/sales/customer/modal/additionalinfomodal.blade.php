<div>
    @if ($openadditionalinfomodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Additional info</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                         <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Area<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="area" class="form-control @error('area') is-invalid @enderror" id="area">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sales representative<span class="text-danger">*</span></label>
                                    <select wire:model="sales_rep" class="form-select  @error('sales_rep') is-invalid @enderror" id="sales_rep">
                                        <option value="">Choose..</option>
                                         @if ($salesrep)
                                             @foreach ($salesrep as $s)
                                             <option value="{{ $s->id }}">{{ $s->name }}</option>
                                             @endforeach
                                         @endif

                                    </select>
                                </div>
                            </div>
                         </div>
                       <div class="row">
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" wire:model="address" class="form-control @error('credit_period') is-invalid @enderror" id="credit_period">
                            </div>


                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Customer Acc No<span class="text-danger">*</span></label>
                                <input type="text" wire:model="acc_no" class="form-control @error('acc_no') is-invalid @enderror" id="acc_no">
                            </div>
                           </div>
                       </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Credit period(Days)<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="credit_period" class="form-control @error('credit_period') is-invalid @enderror" id="credit_period">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Credit limit<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="credit_limit" class="form-control @error('credit_limit') is-invalid @enderror" id="credit_limit">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Contact person<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="contact_person" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" id="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone 2<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="phone_two" class="form-control @error('phone_two') is-invalid @enderror" id="phone_two">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Billing address<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="billing_address" class="form-control @error('billing_address') is-invalid @enderror" id="billing_address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fax<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="fax" class="form-control @error('fax') is-invalid @enderror" id="fax">
                                </div>
                            </div>
                        </div>
                        @if($signature)
                        <img src="{{ $signature }}" alt="Signature Preview" width="300" />
                    @else
                        <p>No signature available.</p>
                    @endif



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
