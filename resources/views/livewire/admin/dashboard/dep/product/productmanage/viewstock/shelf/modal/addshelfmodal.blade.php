<div>
    @if ($openshelfaddmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Shelf</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Shelf No<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="shelf_no" class="form-control @error('shelf_no') is-invalid @enderror" id="shelf_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Capacity (qty)<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="capacity" class="form-control @error('capacity') is-invalid @enderror" id="capacity">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Warehouse<span class="text-danger">*</span></label>
                                    <select wire:model="warehouse" class="form-select  @error('warehouse') is-invalid @enderror" id="warehouse">
                                        <option value="">Select warehouse</option>
                                         @if ($warehouses)
                                             @foreach ($warehouses as $warehouse)
                                             <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                             @endforeach
                                         @endif

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Note<span class="text-danger">*</span></label>
                                    <textarea  wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
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
