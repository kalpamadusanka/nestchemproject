<div>
    @if ($openattendencemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add attendence</h5>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Time-In<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="intime" class="form-control @error('intime') is-invalid @enderror" id="intime">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Time-Out<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="outtime" class="form-control @error('outtime') is-invalid @enderror" id="outtime">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note<span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="note" rows="4" placeholder="Enter your reason here..."></textarea>
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
