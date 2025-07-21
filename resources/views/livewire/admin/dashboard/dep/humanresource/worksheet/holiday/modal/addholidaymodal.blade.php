<div>
    @if ($openholidaymodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Holiday</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Holiday Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="holiday_name" id="title" class="form-control @error('holiday_name') is-invalid @enderror" placeholder="Enter holiday name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date<span class="text-danger">*</span></label>
                            <input type="date" wire:model="holiday" id="title" class="form-control @error('holiday') is-invalid @enderror" placeholder="Pick date">
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
