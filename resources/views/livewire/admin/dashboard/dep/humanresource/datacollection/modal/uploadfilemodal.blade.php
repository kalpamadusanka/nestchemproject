<div>
    @if ($viewaddfilemodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Data</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->


                        <!-- Input Fields -->

                        <div class="mb-3">
                            <label class="form-label">Upload Files <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" wire:model="files" multiple class="form-control" id="fileUpload">
                                <label class="input-group-text" for="fileUpload">Choose Files</label>
                            </div>

                            @error('files.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <small class="text-muted">You can upload multiple files (Max: 2MB per file).</small>

                            <!-- File Preview Section -->
                            @if ($files)
                                <ul class="list-group mt-3">
                                    @foreach ($files as $file)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $file->getClientOriginalName() }}
                                            <span class="badge bg-primary rounded-pill">
                                                {{ number_format($file->getSize() / 1024, 2) }} KB
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
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
