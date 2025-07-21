<div>
    @if ($openstockitemsmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog-lg modal-dialog-centered modal-dialog-scrollable p-4">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Material stock</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Table to display purchase order items -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Material Code</th>
                                    <th>Quantity</th>

                                    <th>Lot</th>
                                    <th>Batch</th>
                                    <th>Exp date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($purchaseorderitems)
                                    @foreach ($purchaseorderitems as $index => $poitems)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $poitems->materialData->code ?? 'Not Updated!' }}</td>
                                            <td>{{ $poitems->qty }}</td>

                                            <td>{{ $poitems->lot }}</td>
                                            <td>{{ $poitems->batch }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($poitems->exp_date)->format('Y M d h:i A') }}

                                                @if(\Carbon\Carbon::parse($poitems->exp_date)->isPast())
                                                    <span class="badge bg-danger">Expired</span>
                                                @else
                                                    <span class="badge bg-warning" x-data="{ timeLeft: (new Date('{{ \Carbon\Carbon::parse($poitems->exp_date)->toIso8601String() }}').getTime() - new Date().getTime()) / 1000 }"
                                                        x-init="setInterval(() => {
                                                            if (timeLeft > 0) {
                                                                timeLeft--;
                                                                let days = Math.floor(timeLeft / 86400);
                                                                let hours = Math.floor((timeLeft % 86400) / 3600);
                                                                let minutes = Math.floor((timeLeft % 3600) / 60);
                                                                let seconds = Math.floor(timeLeft % 60);
                                                                $el.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                                                            } else {
                                                                $el.innerText = 'Expired';
                                                                $el.classList.replace('bg-warning', 'bg-danger');
                                                            }
                                                        }, 1000)">
                                                    </span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

