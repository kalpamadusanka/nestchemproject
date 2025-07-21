<div>
    @if ($openpaymentaccountaddmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add New Account</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->
                        <div class="mb-3">
                            <label class="form-label">Account Type<span class="text-danger">*</span></label>
                            <select wire:model="account_type" class="form-select  @error('account_type') is-invalid @enderror" id="account_type">
                                <option value="">Select type</option>
                                 @if ($accType)
                                     @foreach ($accType as $type)
                                     <option value="{{ $type->id }}">{{ $type->account_type }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>

                        <!-- Code -->
                        <div class="mb-3">
                            <label class="form-label">Code<span class="text-danger">*</span></label>
                            <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" id="code">
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea wire:model="description" class="form-control" id="description"></textarea>
                        </div>



                        <!-- Checkboxes -->


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
