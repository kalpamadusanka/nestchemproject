<div>
    @if ($openpaymentmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog-lg modal-dialog-centered modal-dialog-scrollable p-4">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Payments History</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Table to display purchase order items -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Payment Method</th>
                                    <th>Transaction ID</th>
                                    <th>Payment Account</th>
                                    <th>Amount</th>
                                    <th>Document</th>
                                    <th>Created at</th>


                                </tr>
                            </thead>
                            <tbody>
                                @if ($payments)
                                    @foreach ($payments as $popayments)
                                    <tr>

                                        <td>{{ $popayments->paymentMethod->payment_method ?? 'Not Updated'}}</td>
                                        <td>{{ $popayments->transactionId ?? 'Not Updated!' }}</td>
                                        <td>{{ $popayments->paymentAcc->account_name ?? 'Not Updated!' }}</td>
                                        <td>LKR {{ number_format($popayments->amount, 2, '.', ',') }}</td>
                                        <td>
                                            <button wire:click="viewdoc({{ $popayments->id }})">View Document</button>
                                        </td>
                                        <td>  {{ \Carbon\Carbon::parse($popayments->created_at)->format('Y M d h:i A') }}</td>
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

