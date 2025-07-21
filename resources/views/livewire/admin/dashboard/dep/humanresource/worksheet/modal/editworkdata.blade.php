
<div>
    @if ($opeeditnworkmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Today's work</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Employee Name<span class="text-danger">*</span></label>
                           <input type="text" wire:model="employee_name" class="form-control" placeholder="Employee Name" readonly>
                        </div>




                        <div class="mb-3">
                            <label class="form-label">Note<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="note" rows="4" placeholder="Enter your note here..."></textarea>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Close</button>
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
