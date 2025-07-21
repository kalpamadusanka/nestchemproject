<div>
    @if ($openfuelmodal)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Fuel Record</h5>
                        <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="saveFuelRecord">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" wire:model="date" required>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="odometer" class="form-label">Odometer (km/miles)</label>
                                    <input type="number" class="form-control" id="odometer" wire:model="odometer" step="0.1" required>
                                    @error('odometer') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="amount" class="form-label">Fuel Amount (liters/gallons)</label>
                                    <input type="number" class="form-control" id="amount" wire:model="amount" step="0.01" required>
                                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cost" class="form-label">Total Cost</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="cost" wire:model="cost" step="0.01" required>
                                    </div>
                                    @error('cost') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" wire:model="notes" rows="2"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="saveFuelRecord">Save Record</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
