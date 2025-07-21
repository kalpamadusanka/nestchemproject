<div>
   @if ($openloadproduct)
   <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">New Product Load Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <!-- Search and Filter Row -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="productSearch" class="form-label">Search Products</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="productSearch" placeholder="Search products..." wire:model.live="search">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="preparedBy" class="form-label">Prepared by</label>
                            <select class="form-select" id="preparedBy" wire:model="prepared_by">
                                <option value="{{ $currentuser }}">{{ $currentuser ?? 'N/A' }}</option>

                            </select>
                        </div>
                    </div>


                    <!-- Product Selection Table -->
                    <div class="table-responsive mb-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover table-sm">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th >Select</th>
                                    <th>Product Name</th>
                                    <th>Shelf</th>
                                    <th>Product Group</th>
                                    <th>Available</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products)
                                @foreach ($products as $index => $p)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="products.{{ $index }}.selected">
                                    </td>
                                    <td>
                                        {{ $p['product_name'] ?? 'N/A' }}
                                        <input type="hidden"
                                               wire:model="products.{{ $index }}.product_name"
                                               value="{{ $p['product_name'] }}">
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm"
                                                wire:model="products.{{ $index }}.shelf_id">
                                            <option value="">Select Shelf</option>
                                            @foreach($p['available_shelves'] as $shelf)
                                                <option value="{{ $shelf['id'] }}">
                                                    {{ $shelf['shelf_no'] }} ({{ $shelf['qty'] }} units)
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $p['product_group'] ?? 'N/A' }}</td>
                                    <td>{{ $p['total_qty'] }}&nbsp;{{ $p['uom'] }}</td>
                                    <td width="150px">
                                        <input type="number"
                                               class="form-control form-control-sm product-quantity"
                                               wire:model="products.{{ $index }}.quantity"
                                               min="0"
                                               max="{{ $p['total_qty'] }}">
                                    </td>
                                </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                    <!-- Batch Details -->


                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="notes" wire:model="note" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove>Load</span>
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
