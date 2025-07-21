<div>
    @if ($openticketmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Ticket</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" wire:model="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event category <span class="text-danger">*</span></label>
                            <select wire:model="evntcategory" class="form-select  @error('evntcategory') is-invalid @enderror" id="location">
                                <option value="">Select category</option>
                                 @if ($categories)
                                     @foreach ($categories as $c)
                                     <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" wire:model="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Enter Subject">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assign To <span class="text-danger">*</span></label>
                            <select wire:model="assignuser" class="form-select  @error('assignuser') is-invalid @enderror" id="location">
                                <option value="">Select user</option>
                                 @if ($systemusers)
                                     @foreach ($systemusers as $s)
                                     <option value="{{ $s->id }}">{{ $s->name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ticket Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="ticket_description" placeholder="Add Question"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priority<span class="text-danger">*</span></label>
                            <select wire:model="priority" class="form-select  @error('priority') is-invalid @enderror" id="priority">
                                <option value="">Select Priority</option>
                                <option value="high">High</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-select  @error('status') is-invalid @enderror" id="status">
                                <option value="">Select Status</option>
                                <option value="inprogress">Inprogress</option>
                                <option value="reopened">Reopened</option>
                                <option value="closed">Closed</option>
                            </select>
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
