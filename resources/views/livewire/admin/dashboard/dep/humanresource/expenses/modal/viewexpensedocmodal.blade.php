<div>
    @if ($viewexpensedoc)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Expenses</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->

                        @if ($documentPreviewUrl)
                        <div class="mb-3">
                            <label class="form-label">Document Preview:</label>
                            <div>
                                @if (preg_match('/\.(jpg|jpeg|png)$/i', $documentPreviewUrl))
                                    <img src="{{ $documentPreviewUrl }}" alt="Document Preview" class="img-fluid mb-3">
                                @else
                                    <a href="{{ $documentPreviewUrl }}" target="_blank" class="btn btn-info">
                                        View Document
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif


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
