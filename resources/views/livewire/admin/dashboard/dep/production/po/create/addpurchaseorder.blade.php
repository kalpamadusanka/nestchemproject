<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="me-3">Purchase Orders</h4>
            <nav class="nav">
                <!-- Navigation elements here -->
            </nav>
        </div>
        <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
            <i class="bi bi-arrow-left-circle me-2"></i>Back
        </button>
        <livewire:admin.dashboard.notifylayout />
    </div>

    <!-- Activation Alert -->
    <div class="alert alert-danger" hidden>
        <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
    </div>

    <!-- Purchases Overview Section -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Purchases Overview</h4>
            </div>
            <div class="card-body">
                <form  wire:submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-md-3 position-relative">
                            <label for="contact" class="form-label @error('contact') is-invalid @enderror">Contact</label>
                            <input type="text" wire:model.live="contact" wire:focus="showDropdown = true"
                                wire:blur="hideDropdown" class="form-control" id="contact"
                                placeholder="Search supplier...">

                            @if($showDropdown && count($suppliers) > 0)
                                <div class="dropdown-menu show w-100 mt-1 shadow-sm"
                                    style="max-height: 200px; overflow-y: auto;">
                                    @foreach($suppliers as $supplier)
                                        <a href="#"
                                            class="dropdown-item d-flex justify-content-between align-items-center py-2 px-3"
                                            wire:click.prevent="selectSupplier({{ $supplier->id }})">
                                            <div>
                                                <span class="fw-medium">{{ $supplier->contact_person }}</span>
                                                <br>
                                                <small class="text-muted">{{ $supplier->supplier }}</small>
                                            </div>

                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>


                        <div class="col-md-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" wire:model="date">
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="order-number" class="form-label">Order Number</label>
                            <input type="text" class="form-control @error('order_number') is-invalid @enderror" wire:model="order_number" id="order-number">
                        </div>
                        <div class="col-md-3">
                            <label for="reference" class="form-label">Reference (Optional)</label>
                            <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" wire:model="reference">
                        </div>
                        <div class="col-md-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-control @error('currency') is-invalid @enderror" id="currency" wire:model="currency">
                                <option value="LKR">LKR Sri Lankan Rupee</option>
                                <!-- Add other currencies as needed -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Amounts are</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model="amounttax" value="exclusive" id="tax-exclusive" checked>
                                <label class="form-check-label" for="tax-exclusive">
                                    Tax Exclusive
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model="amounttax" value="inclusive" id="tax-inclusive">
                                <label class="form-check-label" for="tax-inclusive">
                                    Tax Inclusive
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="min-width: 1400px;">
                                <thead>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Item</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Description</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                        style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Quantity</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                        style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Unit Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                       style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Disc %</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Account</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Tax</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Lot</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Batch</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Expire Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                         style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">Amount LKR</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $index => $row)
                                        <tr>
                                            <td style="position: relative;">
                                                <input type="text" class="form-control item-input @error('rows.' . $index . '.item') is-invalid @enderror"
                                                    wire:model.live="rows.{{ $index }}.item"
                                                    wire:keyup="fetchSuggestions({{ $index }})" data-index="{{ $index }}">

                                                @if(!empty($suggestions[$index]))
                                                    <div class="suggestions-box" id="suggestions-{{ $index }}"
                                                        style="position: absolute; background: white; border: 1px solid #ddd; z-index: 1000; width: 100%;border-radius:5px;">
                                                        @foreach($suggestions[$index] as $suggestion)
                                                            <div class="suggestion-item"
                                                                wire:click="selectItem({{ $index }}, '{{ $suggestion }}')"
                                                                style="padding: 5px; cursor: pointer;">
                                                                {{ $suggestion }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                            <td><input type="text" class="form-control @error('rows.' . $index . '.description') is-invalid @enderror"
                                                    wire:model="rows.{{ $index }}.description"></td>
                                            <td><input type="number" class="form-control @error('rows.' . $index . '.quantity') is-invalid @enderror"
                                                    wire:model="rows.{{ $index }}.quantity"></td>
                                            <td><input type="number" class="form-control @error('rows.' . $index . '.unit_price') is-invalid @enderror"
                                                    wire:model="rows.{{ $index }}.unit_price"></td>
                                            <td><input type="number" class="form-control"
                                                    wire:model="rows.{{ $index }}.discount"></td>
                                                    <td>
                                                        <select class="form-control @error('rows.' . $index . '.account') is-invalid @enderror" wire:model="rows.{{ $index }}.account">
                                                            <option value="">-- Select Account --</option>
                                                            @foreach($paymentAccounts as $account)
                                                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                            <td><input type="number" class="form-control"
                                                    wire:model="rows.{{ $index }}.tax_rate"></td>
                                                    <td><input type="number" class="form-control"
                                                        wire:model="rows.{{ $index }}.lot"></td>
                                                        <td><input type="number" class="form-control"
                                                            wire:model="rows.{{ $index }}.batch"></td>
                                                            <td><input type="date" class="form-control"
                                                                wire:model="rows.{{ $index }}.exp_date"></td>
                                            <td><input type="number" class="form-control"
                                                    wire:model="rows.{{ $index }}.amount" readonly></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="removeRow({{ $index }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="addRow">
                                Add a new line
                            </button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="subtotal" class="form-label">Subtotal</label>
                                <input type="text" class="form-control w-50" wire:model="subtotal" id="subtotal" value="0.00" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control w-50" id="total" wire:model="total" value="0.00" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="delivery-address" class="form-label">Delivery Address (Optional)</label>
                            <textarea class="form-control" id="delivery-address" rows="3"
                                wire:model="delivery_address"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="attention" class="form-label">Attention (Optional)</label>
                            <select wire:model="attention" class="form-select  @error('attention') is-invalid @enderror" id="attention">
                                <option value="">Select type</option>
                                 @if ($attentionlist)
                                     @foreach ($attentionlist as $a)
                                     <option value="{{ $a->id }}">{{ $a->name }}</option>
                                     @endforeach
                                 @endif

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Telephone (Optional)</label>
                            <input type="number" class="form-control" id="telephone" wire:model="telephone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="delivery-instructions" class="form-label">Note (Optional)</label>
                            <textarea class="form-control" id="note" rows="3" wire:model="note"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success">Save</button>

                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('poadded', function() {


                     Swal.fire({
                         icon: 'success',
                         title: 'Success!',
                         text: 'Purchase order added successfully!',
                         showConfirmButton: false,
                         timer: 3000,
                         toast: true,
                         position: 'top-end'
                     });
                 });
             </script>
</div>
