<div>
    <div class="content-card damage-card">
            <div class="card-header">
                <h2>Damage Reports</h2>
                <button class="btn-icon" data-bs-toggle="modal" wire:click="damagereportmodal">
                    <i class="bi bi-plus-lg"></i> Report Damage
                </button>
            </div>

            <div class="damage-list">
    @if ($damagerecord)
       @foreach ($damagerecord as $dmg)
    <div class="damage-item">
        <div class="damage-severity medium"></div>
        <div class="damage-info">
            <h4>{{ $dmg->problem ?? 'N/A' }}</h4>
            <p>Reported: {{ $dmg->created_at ?? 'N/A' }} by {{ $dmg->reportedData->name ?? 'User not found' }}</p>
        </div>

        @if ($loguser->id == $dmg->reported_by)
            <select wire:change="updateStatus({{ $dmg->id }}, $event.target.value)">
                <option value="0" {{ $dmg->status == 0 ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ $dmg->status == 1 ? 'selected' : '' }}>Resolved</option>
            </select>

            <!-- Add delete button - only visible to the reporter -->
            <button wire:click="deleteDamage({{ $dmg->id }})" class="delete-button" title="Delete Report">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button>
        @endif

        <div class="damage-status {{ $dmg->status == 1 ? 'resolved' : 'pending' }}">
            {{ $dmg->status == 1 ? 'Resolved' : 'Pending' }}
        </div>
    </div>
@endforeach
    @endif
</div>
<style>
    .delete-button {
    background: #ff4444;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delete-button:hover {
    background: #cc0000;
}

.delete-button svg {
    margin-right: 4px;
}
</style>

        </div>
        <livewire:admin.dashboard.dep.sales.distribute.orders.vehicle.damage.modal.dmagereportmodal/>
</div>
