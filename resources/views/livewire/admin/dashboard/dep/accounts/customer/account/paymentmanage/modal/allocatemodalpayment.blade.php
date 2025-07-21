<div>
@if ($openpaymentaccmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Allocate Payment</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <!-- Payment Information -->
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="card-title">Payment Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Amount:</strong></p>
                                    <p>LKR&nbsp;{{ number_format($amount, 2) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Date:</strong></p>
                                    <p>{{ $payment_date->format('m/d/Y') }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>From:</strong></p>
                                    <p>{{ $customername }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Accounts -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Payment Account</h5>

                            @if($paymentAccounts->isEmpty())
                                <div class="alert alert-info">
                                    No payment accounts available.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Account Name</th>
                                                <th>Account Type</th>
                                                <th>Current Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($paymentAccounts as $account)
                                                <tr>
                                                    <td>{{ $account->account_name }}</td>
                                                    <td>{{ $account->account_type }}</td>
                                                    <td>LKR&nbsp;{{ number_format($account->balance, 2) }}</td>
                                                    <td>
                                                        <button
                                                            wire:click="allocateToAccount({{ $paymentid }}, {{ $account->id }})"
                                                            class="btn btn-sm btn-primary"
                                                        >
                                                            Allocate
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
