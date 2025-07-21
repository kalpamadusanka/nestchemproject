<div>
    @if ($openorderitemsmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog-lg modal-dialog-centered modal-dialog-scrollable p-4">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Purchased Items</h5>
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
                                    <th>Unit price</th>
                                    <th>Discount</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($purchaseorderitems)
                                    @foreach ($purchaseorderitems as $poitems)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $poitems->item ?? 'Not Updated!' }}</td>
                                        <td>{{ $poitems->quantity }}</td>
                                        <td>LKR {{ number_format($poitems->unit_price, 2, '.', ',') }}</td>
                                        <td>{{ $poitems->discount }}%</td>
                                        <td>LKR {{ number_format($poitems->amount, 2, '.', ',') }}</td>
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

