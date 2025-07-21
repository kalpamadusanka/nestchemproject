<div>
    @if ($openfilepreviewmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Preview Document </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->
                        <!-- Name -->
                        <div id="document-preview" class="mt-5">
                            <label class="fs-6 fw-semibold mb-2">Document Previews</label>
                            <div id="preview-container">
                                <!-- Use Livewire to pass the document paths -->
                                @if ($documents)
                                    @php
                                        // Split the documents string by commas and loop through each document
                                        $documentArray = explode(',', $documents);
                                    @endphp

                                    @foreach ($documentArray as $document)
                                        @php
                                            // Generate the URL for each document
                                            $documentUrl = asset('storage/popaymentdoc/' . trim($document));
                                            $fileExtension = pathinfo($document, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                            <div class="mb-3">
                                                <img src="{{ $documentUrl }}" class="img-fluid mb-2" alt="Document Preview" />
                                            </div>
                                        @elseif ($fileExtension === 'pdf')
                                            <div class="mb-3">
                                                <embed src="{{ $documentUrl }}" type="application/pdf" width="100%" height="500px" />
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <p>Document preview is not available for this file type: {{ $fileExtension }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p>No documents available for preview.</p>
                                @endif
                            </div>
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
