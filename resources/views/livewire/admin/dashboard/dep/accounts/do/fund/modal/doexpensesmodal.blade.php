<div>
    @if ($doexpmodal)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Allocate New Expense</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submit">
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                    wire:model="amount" placeholder="Enter amount" step="0.01">
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">DO</label>
                                <select class="form-select @error('starteddo') is-invalid @enderror"
                                    wire:model="starteddo">
                                    <option value="">Select DO</option>
                                    @if ($startedDo)
                                        @foreach ($startedDo as $s)
                                            <option value="{{ $s->do_no }}">DO-{{ $s->do_no ?? 'N/A' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('starteddo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment account</label>
                                <select class="form-select @error('paymentaccount') is-invalid @enderror"
                                    wire:model="paymentaccount">
                                    <option value="">Select account</option>
                                    @if ($paymentAccount)
                                        @foreach ($paymentAccount as $acc)
                                            <option value="{{ $acc->id }}">{{ $acc->account_name ?? 'N/A' }}
                                            </option> <!-- Fixed variable from $s to $acc -->
                                        @endforeach
                                    @endif
                                </select>
                                @error('paymentaccount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" wire:model="note" rows="2"></textarea>
                                </div>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit for Approval</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    @endif

</div>
