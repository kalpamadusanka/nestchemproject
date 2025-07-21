<div>
    @if ($openmaterialaddmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Material</h5>
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
                                    <label class="form-label">Item Name<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="item_name" class="form-control @error('item_name') is-invalid @enderror" id="item_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Item Code<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" id="code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger">*</span></label>
                                    <select wire:model="category" class="form-select  @error('category') is-invalid @enderror" id="category">
                                        <option value="">Select Category</option>
                                         @if ($materialcategory)
                                             @foreach ($materialcategory as $category)
                                             <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                             @endforeach
                                         @endif

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Unit of Measurement (UOM) <span class="text-danger">*</span></label>

                                    <select wire:model="uom" class="form-control @error('uom') is-invalid @enderror" required>
                                        <option value="">Select unit</option>
                                        <option value="kg">kg</option>
                                        <option value="liters">liters</option>
                                        <option value="pieces">pieces</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Minimum Stock Level<span class="text-danger">*</span></label>
                                    <input type="text" wire:model="min_stock" class="form-control @error('min_stock') is-invalid @enderror" id="min_stock">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Warehouse<span class="text-danger">*</span></label>
                                    <select wire:model="warehouse" class="form-select  @error('warehouse') is-invalid @enderror" id="warehouse">
                                        <option value="">Select Category</option>
                                         @if ($warehouselist)
                                             @foreach ($warehouselist as $w)
                                             <option value="{{ $w->id }}">{{ $w->warehouse_name }}-{{ $w->warehouse_code }}</option>
                                             @endforeach
                                         @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Shelf No(Optional)<span class="text-danger">*</span></label>
                                    <textarea  wire:model="shelf_details" class="form-control @error('shelf_details') is-invalid @enderror" id="shelf_details"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" wire:model="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger">*</span></label>
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
