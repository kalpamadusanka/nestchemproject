<div class="col-lg-6 mb-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-secondary">Payment Finalization</h6>
            <button wire:click="loadData" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Summary Section -->
         <div class="mb-4 p-3 border rounded bg-light">
    <div class="row">
        <div class="col-md-4">
            <p class="mb-1"><strong>Total Revenue:</strong></p>
            <h6 class="text-info">LKR&nbsp;{{ number_format($totalRevenue ?? 0, 2) }}</h6>
        </div>
        <div class="col-md-4">
            <p class="mb-1"><strong>Credit Sales:</strong></p>
            <h6 class="text-info">LKR&nbsp;{{ number_format($creditSales ?? 0, 2) }}</h6>
        </div>
        <div class="col-md-4">
            <p class="mb-1"><strong>Cheque:</strong></p>
            <h6 class="text-info">LKR&nbsp;{{ number_format($chequetotal ?? 0, 2) }}</h6>
        </div>
    </div>
     <div class="row">
        <div class="col-md-4">
            <p class="mb-1"><strong>Total Expenses:</strong></p>
            <h6 class="text-primary">LKR&nbsp;{{ number_format($totalExpenses ?? 0, 2) }}</h6>
        </div>
        <div class="col-md-4">
            <p class="mb-1"><strong>Cutomer Due</strong></p>
            <h6 class="text-primary">LKR&nbsp;{{ number_format($customerdue ?? 0, 2) }}</h6>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <p class="mb-1"><strong>Expected Cash:</strong></p>
            <h4 class="text-success">LKR&nbsp;{{ number_format($expectedCash ?? 0, 2) }}</h4>
        </div>
        <div class="col-md-6">
            <p class="mb-1"><strong>Received Cash:</strong></p>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">LKR</span>
                </div>
                <input
                    type="number"
                    class="form-control"
                    wire:model.lazy="receivedCash"
                    step="0.01"
                    min="0"
                >
            </div>
            @error('receivedCash') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <p class="mb-1"><strong>Expected Cheque:</strong></p>
            <h4 class="text-success">LKR&nbsp;{{ number_format($expectedcheque ?? 0, 2) }}</h4>
        </div>
        <div class="col-md-6">
            <p class="mb-1"><strong>Received Cheque:</strong></p>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">LKR</span>
                </div>
                <input
                    type="number"
                    class="form-control"
                    wire:model.lazy="receivedCheque"
                    step="0.01"
                    min="0"
                >
            </div>
            @error('receivedCheque') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert {{ $cashBalance == 0 ? 'alert-success' : ($cashBalance > 0 ? 'alert-danger' : 'alert-warning') }}">
                <strong>Balance (Cash):</strong>
                <span>
                    LKR&nbsp;{{ number_format($cashBalance, 2) }}
                    {{ $cashBalance == 0 ? '(Exact amount)' : ($cashBalance > 0 ? 'Shortage' : 'Over') }}
                </span>
            </div>
        </div>
        <div class="col-12">
            <div class="alert {{ $chequeBalance == 0 ? 'alert-success' : ($chequeBalance > 0 ? 'alert-danger' : 'alert-warning') }}">
                <strong>Balance (Cheque):</strong>
                <span>
                    LKR&nbsp;{{ number_format(abs($chequeBalance), 2) }}
                    {{ $chequeBalance == 0 ? '(Exact amount)' : ($chequeBalance > 0 ? 'Shortage' : 'Over') }}
                </span>
            </div>
        </div>
    </div>

    @if ($isFinalized && $existingFinalization && !$exFinalization)
      <button
        wire:click="finalizePayments"
        class="btn btn-primary btn-block mt-2"
       disabled
    >
        Finalize Payments
    </button>
        <button
        wire:click="approved({{ $doNo }})"
        class="btn btn-primary btn-block mt-2"

    >
        Approve
    </button>
    @elseif (!$isFinalized)
      <button
        wire:click="finalizePayments"
        class="btn btn-primary btn-block mt-2"

    >
        Finalize Payments
    </button>
    @elseif ($exFinalization == 1)
      <button
        wire:click="finalizePayments"
        class="btn btn-primary btn-block mt-2"
       disabled
    >
        Finalize Payments
    </button>
        <button
        wire:click="approved({{ $doNo }})"
        class="btn btn-primary btn-block mt-2"
disabled
    >
        Approve
    </button>
    @endif
</div>

            <!-- Activity Log -->
            {{-- <h6 class="mt-4 mb-3 font-weight-bold text-secondary">Activity Log</h6>
            <div class="timeline">
                @forelse($activities as $activity)
                <div class="timeline-item">
                    <div class="timeline-item-marker">
                        <div class="timeline-item-marker-indicator bg-{{ $activity['color'] }}"></div>
                    </div>
                    <div class="timeline-item-content">
                        <div class="d-flex justify-content-between">
                            <span>{{ $activity['type'] }}</span>
                            <small class="text-muted">{{ $activity['date'] }}, {{ $activity['time'] }}</small>
                        </div>
                        <p class="mb-0 small text-muted">
                            ${{ $activity['amount'] }} via {{ $activity['method'] }}
                            @if($activity['details'])
                                <br>{{ $activity['details'] }}
                            @endif
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-3">
                    No activities found
                </div>
                @endforelse
            </div> --}}
        </div>
    </div>
</div>
