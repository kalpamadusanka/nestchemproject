<div>
    @if ($openpurchasedmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Purchase Order </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Attention<span class="text-danger">*</span></label>
                            <select wire:model="attention" class="form-select  @error('attention') is-invalid @enderror" id="attention">
                                <option value="">Choose option</option>
                                 @if ($attentionlist)
                                     @foreach ($attentionlist as $a)
                                     <option value="{{ $a->id }}">{{ $a->name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" rows="3"
                                    wire:model="note"></textarea>
                            </div>
                        </div>



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
