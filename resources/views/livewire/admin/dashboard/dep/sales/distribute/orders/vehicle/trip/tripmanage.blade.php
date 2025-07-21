<div>
    <div class="content-card trip-card">
            <div class="card-header">
                <h2>Trip Management</h2>
                <div class="card-actions">
                    <button class="btn-icon" title="History">
                        <i class="bi bi-clock-history"></i>
                    </button>
                </div>
            </div>

            <div class="trip-form">
          <form wire:submit.prevent="submit">
    <div class="form-row">
        <div class="form-group">
            <label>Start KM</label>
            <input type="number" class="modern-input" wire:model="startkm" placeholder="Enter odometer reading"
                   @if($activeTrip) disabled @endif>
            @error('startkm') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>End KM</label>
            <input type="number" class="modern-input" wire:model="endkm"
                   placeholder="Will update after trip" @if($activeTrip) disabled @endif>
            @error('endkm') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Initial Fuel</label>
            <input type="number" class="modern-input" wire:model="fuel"
                   placeholder="Litres in tank" @if($activeTrip) disabled @endif step="0.01">
            @error('initialFuel') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        @if($activeTrip)
        <div class="form-group">
            <label>Final Fuel</label>
            <input type="number" class="modern-input" wire:model="finalFuel"
                   placeholder="Litres remaining" step="0.01" @if($activeTrip) disabled @endif>
            @error('finalFuel') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        @endif
    </div>

    <div class="form-actions">
        <button class="btn-primary start-trip" type="submit" @if($activeTrip) disabled @endif>
            <i class="bi bi-play-circle"></i> Start Trip
        </button>
        <button class="btn-secondary end-trip" type="submit" @if(!$activeTrip) disabled @endif>
            <i class="bi bi-stop-circle"></i> End Trip
        </button>
    </div>
</form>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</form>
            </div>
        </div>

</div>
