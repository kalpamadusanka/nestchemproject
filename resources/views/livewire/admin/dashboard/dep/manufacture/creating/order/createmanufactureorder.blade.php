<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="me-3">Manufacturing Orders</h4>
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
                <h4 class="card-title mb-0">Creating Manufacturing Order</h4>

            </div>

            <div class="card-body">
                <form wire:submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-md-3 position-relative">
                            <label for="product_group" class="form-label @error('product_group') is-invalid @enderror">Product group</label>
                            <select wire:model="product_group" class="form-select  @error('product_group') is-invalid @enderror" id="product_group">
                                <option value="">Select type</option>
                                @if ($productgroup)
                                    @foreach ($productgroup as $group)
                                        <option value="{{ $group->id }}">{{ $group->product_group }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="product" class="form-label @error('product') is-invalid @enderror">Product</label>
                            <select wire:model="product" class="form-select  @error('product') is-invalid @enderror" id="product">
                                <option value="">Select product</option>
                                @if ($products)
                                    @foreach ($products as $p)
                                        <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Material Selection Panel -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Materials</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label">Select Material</label>
                                            <select wire:model="selectedMaterial" class="form-select">
                                                <option value="">Choose Material</option>
                                                @foreach($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->material_id }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" wire:model="materialQuantity" class="form-control" min="1" value="1">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">&nbsp;</label>
                                            <button type="button" wire:click="addMaterial" class="btn btn-primary form-control">
                                                Add Material
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Selected Materials Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Code</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($selectedMaterials as $index => $material)
                                                <tr>

                                                    <td>{{ $material['code'] }}</td>
                                                    <td>
                                                        <input type="number"
                                                               wire:model="selectedMaterials.{{ $index }}.quantity"
                                                               class="form-control"
                                                               min="1" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                wire:click="removeMaterial({{ $index }})"
                                                                class="btn btn-sm btn-danger">
                                                            Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No materials added yet</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 py-2">
                        <div class="col-md-4">
                            <label for="barcodeText" class="form-label">Barcode Text</label>
                            <input type="text" class="form-control" id="barcodeText" wire:model="barcodeText" wire:keydown.debounce.500ms="generateBarcode">
                        </div>

                        <div class="col-md-4">
                            <label for="barcodeType" class="form-label">Barcode Type</label>
                            <select class="form-select" id="barcodeType" wire:model="barcodeType" wire:change="generateBarcode">
                                <option value="C128">CODE 128</option>
                                <option value="C39">CODE 39</option>
                                <option value="EAN13">EAN-13</option>
                                <option value="UPCA">UPC-A</option>
                                <option value="UPCE">UPC-E</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Barcode Preview</label>
                            <div class="border p-2 bg-white" style="min-height: 80px;">
                                @if ($barcodePreview)
                                    <div class="text-center  align-items-center justify-content-center">
                                        <div style="display: inline-block; margin: 0 auto;">
                                            {!! $barcodePreview !!}
                                        </div>
                                        <div class="mt-1 p-1 bg-light rounded text-center" style="font-family: monospace;">
                                            {{ $barcodeText }}
                                        </div>
                                    </div>
                                @else
                                    <div class="text-muted text-center d-flex align-items-center justify-content-center" style="height: 78px;">
                                        Barcode preview will appear here
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="order-number" class="form-label">Files</label>
                            <input type="file" wire:model="files" class="form-control " multiple>
                            <ul>
                                @foreach ($files as $file)
                                    <li>{{ $file->getClientOriginalName() }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <label for="reference" class="form-label">Quantity</label>
                            <input type="number" step="0.01" class="form-control @error('qty') is-invalid @enderror" id="qty" wire:model="qty">
                        </div>
                        <div class="col-md-3">
                            <label for="reference" class="form-label">Start Date</label>
                            <input type="date" step="0.01" class="form-control @error('st_date') is-invalid @enderror" id="st_date" wire:model="st_date">
                        </div>
                        <div class="col-md-3">
                            <label for="reference" class="form-label">End Date</label>
                            <input type="date" step="0.01" class="form-control @error('ed_date') is-invalid @enderror" id="ed_date" wire:model="ed_date">
                        </div>

                        <div class="col-md-3">
                            <label for="assigned_user" class="form-label @error('assigned_user') is-invalid @enderror">Assigned to</label>
                            <select wire:model="assigned_user" class="form-select  @error('assigned_user') is-invalid @enderror" id="assigned_user">
                                <option value="">Choose</option>
                                @if ($assignedperson)
                                    @foreach ($assignedperson as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <span class="indicator-label" wire:loading.remove>Add</span>
                                <span class="indicator-progress" wire:loading>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
         window.addEventListener('errormanufactureorderAdded', function(event) {
                        Swal.fire({
                            icon: 'error', // Change icon to 'error' instead of 'success'
                            title: 'Error!',
                            text: event.detail.message, // Show the error message
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            position: 'top-end'
                        });
                    });
        window.addEventListener('manufactureorderAdded', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'New manufacture order added successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
        window.addEventListener('materialstockwarning', function(event) {
                        Swal.fire({
                            icon: 'warning', // Change icon to 'error' instead of 'success'
                            title: 'warning!',
                            text: 'Please check material stock!', // Show the error message
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            position: 'top-end'
                        });
                    });

    </script>
</div>
