<div>
    @if ($viewdocmodal)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered mw-750px">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Upload Documents</h5>
                        <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="submit" enctype="multipart/form-data">
                            <!-- Multiple File Upload -->
                            <div class="mb-4">
                                <label for="documents" class="form-label">Upload Documents</label>
                                <input type="file" id="documents" class="form-control" wire:model="documents" multiple>
                                @error('documents.*') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                                <button type="submit" class="btn btn-primary"
                                        {{ $documents ? '' : 'disabled' }}>
                                    <span wire:loading.remove>Submit</span>
                                    <span wire:loading>Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
