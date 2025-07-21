<div class="col-lg-6 mb-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Documents & Attachments</h6>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible py-1 px-2 mb-0">
                    {{ session('message') }}
                    <button type="button" class="close p-0" style="top: -2px;" wire:click="$set('message', null)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                @foreach($documents as $document)
                    <div class="border rounded p-3 text-center position-relative" style="width: 120px;">
                        <button wire:click="deleteDocument({{ $document['id'] }})"
                                class="btn btn-sm btn-danger position-absolute"
                                style="top: -8px; right: -8px; width: 20px; height: 20px; line-height: 10px; padding: 0; border-radius: 50%;"
                                onclick="return confirm('Are you sure you want to delete this document?')">
                            &times;
                        </button>
                        <i class="bi bi-{{ $document['icon'] }} fs-1 text-{{ $document['color'] }}"></i>
                        <div class="mt-2 small text-truncate" style="max-width: 100px;" title="{{ $document['name'] }}">
                            {{ $document['name'] }}
                        </div>
                        @if($document['type'] === 'image')
                            <button wire:click="viewDocument({{ $document['id'] }})" class="btn btn-sm btn-link p-0">View</button>
                        @else
                            <button wire:click="downloadDocument({{ $document['id'] }})" class="btn btn-sm btn-link p-0">Download</button>
                        @endif
                    </div>
                @endforeach

                <div class="border rounded p-3 text-center" style="width: 120px; cursor: pointer;" >
                    <i class="bi bi-plus-circle fs-1 text-muted" ></i>
                    <button type="button" class="mt-2 small" wire:click="clickshowmodal">Add New</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    @if($showUploadModal)
        <div class="modal fade show" tabindex="-1" style="display: block;" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Document</h5>
                        <button type="button" class="close" wire:click="$set('showUploadModal', false)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="uploadDocument">
                            <div class="form-group">
                                <label for="newDocument">Select File (PDF or Image)</label>
                                <input type="file" class="form-control-file" wire:model="newDocument" id="newDocument">
                                @error('newDocument') <span class="text-danger small">{{ $message }}</span> @enderror
                                @if($newDocument)
                                    <div class="mt-2 small">
                                        Selected: {{ $newDocument->getClientOriginalName() }}
                                        ({{ number_format($newDocument->getSize() / 1024, 2) }} KB)
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-2" wire:click="$set('showUploadModal', false)">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading wire:target="newDocument">Uploading...</span>
                                    <span wire:loading.remove wire:target="newDocument">Upload</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>
    .gap-3 {
        gap: 1rem;
    }
    .modal {
        background-color: rgba(0,0,0,0.5);
    }
    .modal.show {
        display: block;
    }
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('closeModal', () => {
            // Reset the file input when modal closes
            const fileInput = document.getElementById('newDocument');
            if (fileInput) fileInput.value = '';
        });
    });
</script>
@endpush
