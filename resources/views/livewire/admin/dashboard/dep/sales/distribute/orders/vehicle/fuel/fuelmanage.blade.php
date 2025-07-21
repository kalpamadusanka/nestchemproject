<div>

<div class="fuel-container">


    <div class="fuel-table">
        <div class="table-header">
            <div>Date</div>
            <div>Amount (L)</div>
            <div>Cost</div>
            <div>Odometer</div>

        </div>

        @if ($fuelRecord)
           @foreach ($fuelRecord as $record)
    <div class="table-row">
        <div class="date-cell">
            <div class="date-day">{{ date('d M', strtotime($record->date)) }}</div>
            <div class="date-year">{{ date('Y', strtotime($record->date)) }}</div>
        </div>
        <div>{{ $record->amount ?? 'N/A' }} L</div>
        <div class="cost-cell">LKR {{ number_format($record->cost ?? 0, 2) }}</div>
        <div>{{ number_format($record->odometer ?? 0) }} km</div>
        <div>
            <button wire:click="deleteRecord({{ $record->id }})"
                    class="delete-btn">
                Delete
            </button>
        </div>
    </div>
@endforeach
        @endif
    </div>


</div>

<style>
    .delete-btn {
    background: #ef4444;
    color: white;
    border: none;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    cursor: pointer;
}

.delete-btn:hover {
    background: #dc2626;
}

.delete-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
:root {
    --primary: #4361ee;
    --primary-dark: #3a56d4;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --text: #2b2d42;
    --text-light: #8d99ae;
    --bg: #f8f9fa;
    --card-bg: #ffffff;
    --border: #e9ecef;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: var(--bg);
    color: var(--text);
    line-height: 1.6;
    padding: 0;
    margin: 0;
}

.fuel-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.fuel-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.fuel-title:before {
    content: "";
    display: block;
    width: 5px;
    height: 1.8rem;
    background: var(--primary);
    border-radius: 3px;
}

.fuel-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-light);
}

.fuel-table {
    background-color: var(--card-bg);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}

.table-header {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.5fr 1fr;
    color: white;
    font-weight: 600;
    padding: 1rem 1.5rem;
    align-items: center;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.table-row {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.5fr 1fr;
    padding: 1rem 1.5rem;
    align-items: center;
    border-bottom: 1px solid var(--border);
    transition: all 0.2s ease;
    position: relative;
}

.table-row:last-child {
    border-bottom: none;
}

.table-row:hover {
    background-color: #f8fafc;
}

.table-row::after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: transparent;
    transition: all 0.3s ease;
}

.table-row:hover::after {
    background: var(--primary);
}

.date-cell {
    display: flex;
    flex-direction: column;
}

.date-day {
    font-weight: 600;
}

.date-year {
    font-size: 0.75rem;
    color: var(--text-light);
}

.cost-cell {
    font-weight: 600;
    color: var(--primary);
}

.efficiency-cell {
    display: flex;
    justify-content: flex-end;
}

.efficiency-badge {
    background-color: #e6f7ff;
    color: var(--primary);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.fuel-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    font-size: 0.875rem;
}

.action-btn i {
    font-size: 0.9rem;
}

.primary {
    background-color: var(--primary);
    color: white;
}

.primary:hover {
    background-color: var(--primary-dark);
}

.secondary {
    background-color: white;
    color: var(--primary);
    border: 1px solid var(--border);
}

.secondary:hover {
    background-color: #f8f9fa;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.table-row {
    animation: fadeIn 0.4s ease-out forwards;
    animation-delay: calc(var(--row-index) * 0.05s);
}

/* Responsive */
@media (max-width: 768px) {
    .table-header, .table-row {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .table-header div:nth-child(4),
    .table-row div:nth-child(4),
    .table-header div:nth-child(5),
    .table-row div:nth-child(5) {
        display: none;
    }

    .fuel-stats {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .table-header, .table-row {
        grid-template-columns: 1fr 1fr;
        padding: 0.75rem 1rem;
    }

    .table-header div:nth-child(3),
    .table-row div:nth-child(3) {
        display: none;
    }

    .fuel-actions {
        flex-direction: column;
    }

    .action-btn {
        justify-content: center;
    }
}
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</div>
