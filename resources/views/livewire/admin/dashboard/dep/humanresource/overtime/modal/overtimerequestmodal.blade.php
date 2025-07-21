<div>
    @if ($openovertimerequestmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Overtime request</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Employee<span class="text-danger">*</span></label>
                            <select wire:model="emp" class="form-select  @error('emp') is-invalid @enderror" id="emp">
                                <option value="">Select employee</option>
                                 @if ($employees)
                                     @foreach ($employees as $emp)
                                     <option value="{{ $emp->user_id }}">{{ $emp->username }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category<span class="text-danger">*</span></label>
                            <select wire:model="category" class="form-select  @error('category') is-invalid @enderror" id="category">
                                <option value="">Select category</option>
                                 @if ($categories)
                                     @foreach ($categories as $cat)
                                     <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Start Time<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End Time<span class="text-danger">*</span></label>
                                    <input type="datetime-local" wire:model="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time">
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
