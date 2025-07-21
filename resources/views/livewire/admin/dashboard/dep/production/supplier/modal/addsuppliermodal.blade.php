<div>
    @if ($opensupplieraddmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Supplier</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Supplier<span class="text-danger">*</span></label>
                            <input type="text" wire:model="supplier" class="form-control @error('supplier') is-invalid @enderror" id="supplier">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Person<span class="text-danger">*</span></label>
                            <input type="text" wire:model="contact_person" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                            <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" id="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="text" wire:model="address" class="form-control @error('address') is-invalid @enderror" id="address">
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
