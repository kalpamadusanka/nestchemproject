<div>
    @if ($openadjustmentmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Product group </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->



                          <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Reference Number</label>

                            <input type="text" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" wire:model="ref_no">
                          </div>

                          <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Date Adjustment*</label>
                            <input type="date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" wire:model="adjust_date">
                          </div>

                          <div class="adjustment-items" style="margin-top: 30px;">
                            <h3 style="margin-bottom: 16px; font-size: 16px; color: #333;">Adjustment Items</h3>

                            <div style="overflow-x: auto; max-width: 100%;">
                                <table style="width: 100%; min-width: 800px; border-collapse: collapse; margin-bottom: 15px; font-size: 14px;">
                                  <thead style="font-weight: bold; background-color: #f5f5f5;">
                                    <tr>
                                      <th style="padding: 10px; border: 1px solid #ddd;">Item Number</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">Rack/Shelf</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">UOM</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">Adjustment Qty</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">Type</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">Price Per Unit</th>
                                      <th style="padding: 10px; border: 1px solid #ddd;">In Stock</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td style="padding: 8px; border: 1px solid #ddd;">
                                        <select style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px;" wire:model.live="item">
                                          <option>Please select an option...</option>
                                          @if ($products)
                                           @foreach ($products as $p)
                                           <option value="{{ $p->id }}">{{ $p->product_name }} - {{ $p->product_code }}</option>
                                           @endforeach
                                          @endif
                                        </select>
                                      </td>
                                      <td style="padding: 8px; border: 1px solid #ddd;">
                                        <select style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px;" wire:model.live="shelf">
                                          <option>Please select an option...</option>
                                          @if ($shelfs)
                                           @foreach ($shelfs as $s)
                                           <option value="{{ $s->id }}">{{ $s->shelf_no }}</option>
                                           @endforeach
                                          @endif
                                        </select>
                                      </td>
                                      <td style="padding: 8px; border: 1px solid #ddd;">{{ $uom ?? 'Not updated' }}</td>
                                      <td style="padding: 8px; border: 1px solid #ddd;"><input type="number" wire:model="adjust_qty"></td>
                                      <td style="padding: 8px; border: 1px solid #ddd;">
                                        <select style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px;" wire:model="type">
                                          <option>Please select an option...</option>
                                          <option value="damaged">Damaged Goods</option>
                                          <option value="expired">Expired Stock</option>
                                          <option value="discrepancy">Inventory Discrepancy</option>
                                          <option value="theft">Theft/Loss</option>
                                          <option value="sample">Samples</option>
                                          <option value="other">Other</option>
                                        </select>
                                      </td>
                                      <td style="padding: 8px; border: 1px solid #ddd;">{{ $price ?? 'Not Updated' }}</td>
                                      <td style="padding: 8px; border: 1px solid #ddd;">{{ $instock ?? 'Not Updated' }}</td>

                                    </tr>
                                  </tbody>
                                </table>
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
