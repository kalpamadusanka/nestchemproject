<div>
    @if ($opendamagemodal)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Damage Record</h5>
                        <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                    </div>

                    <!-- Modal Body -->
                 <div class="modal-body p-4">
    <form wire:submit.prevent="saveFuelRecord">
        <!-- Problem Description -->
        <div class="mb-3">
            <label for="problem" class="form-label">Problem Description</label>
            <textarea
                class="form-control"
                id="problem"
                rows="3"
                wire:model="problem"
                placeholder="Enter the problem description..."
            ></textarea>
            @error('problem') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Status Selection -->


        <!-- Hidden Submit Button (for Enter key submission) -->
        <button type="submit" class="d-none"></button>
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
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
