<div>
    @if ($viewexpdatamodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Education details</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Employer<span class="text-danger">*</span></label>
                            <input type="text" wire:model="employer" id="employer" class="form-control @error('employer') is-invalid @enderror" placeholder="Enter employer name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Position<span class="text-danger">*</span></label>
                            <input type="text" wire:model="position" id="position" class="form-control @error('position') is-invalid @enderror" placeholder="Position">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Start Date<span class="text-danger">*</span></label>
                            <input type="date" id="start_date" wire:model="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Select start date">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Date<span class="text-danger">*</span></label>
                            <input type="date" id="end_date" wire:model="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="Select end date">
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save changes</span>
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
