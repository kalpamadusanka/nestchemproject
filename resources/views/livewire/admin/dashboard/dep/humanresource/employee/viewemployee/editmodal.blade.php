<div>
    @if ($viewuserdetailmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Details</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Enter last name">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" wire:model="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" wire:model="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter city">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact <span class="text-danger">*</span></label>
                            <input type="text" wire:model="contact" id="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Enter contact">
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
