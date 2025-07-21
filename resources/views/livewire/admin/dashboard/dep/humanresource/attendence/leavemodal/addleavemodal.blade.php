<div>
    @if ($openleavemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Employee Name<span class="text-danger">*</span></label>
                            <select wire:model="empname" class="form-select  @error('empname') is-invalid @enderror" id="empname">
                                <option value="">Select employee</option>
                                 @if ($employees)
                                     @foreach ($employees as $emp)
                                     <option value="{{ $emp->user_id }}">{{ $emp->username }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>



                        <div class="mb-3">
                            <label class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <select wire:model="leave_type" class="form-select  @error('leave_type') is-invalid @enderror" id="leave_type">
                                <option value="">Select type</option>
                                <option value="medical_leave">Medical Leave</option>
                                <option value="casual_leave">Casual Leave</option>
                                <option value="annual_leave">Annual Leave</option>
                                <option value="short_leave">Short Leave</option>
                                <option value="half_day">Half day</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">From<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="from_date" class="form-control @error('from_date') is-invalid @enderror" id="from_date">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">To<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="to_date" class="form-control @error('to_date') is-invalid @enderror" id="to_date">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">No of Date<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="no_of_date" class="form-control @error('no_of_date') is-invalid @enderror" id="no_of_date">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Remaining Date<span class="text-danger">*</span></label>
                                    <input type="number" wire:model="remaining_date" class="form-control @error('remaining_date') is-invalid @enderror" id="remaining_date">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reason<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="reason" rows="4" placeholder="Enter your reason here..."></textarea>
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
