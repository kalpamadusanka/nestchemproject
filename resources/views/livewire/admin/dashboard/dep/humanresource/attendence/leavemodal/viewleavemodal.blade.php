<div>
    @if ($openleaveviewmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Employee Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="emp_name" class="form-control @error('emp_name') is-invalid @enderror" id="emp_name" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <input type="text" wire:model="leave_type" class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" disabled>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">From<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="from_date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" disabled>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">To<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="to_date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">No of Date<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="no_of_date" class="form-control @error('no_of_date') is-invalid @enderror" id="no_of_date" disabled>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Remaining Date<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="remaining_date" class="form-control @error('remaining_date') is-invalid @enderror" id="remaining_date" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reason<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="reason" rows="4" placeholder="Enter your reason here..." disabled></textarea>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
