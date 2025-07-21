<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="me-3">Material Requesting</h4>
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
                <h4 class="card-title mb-0">Add Material Request</h4>
            </div>
            <div class="card-body">
                <form  wire:submit.prevent="submit">


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
                                        style="width: 130px;"
                                        aria-label="Position: activate to sort column ascending">Quantity</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                        style="width: 130px;"
                                       aria-label="Position: activate to sort column ascending">Uom</th>
                                       <th class="sorting" tabindex="0" aria-controls="datatable"
                                       style="width: 230px;"
                                      aria-label="Position: activate to sort column ascending">Req Code</th>
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
                                                <td><input type="text" class="form-control @error('rows.' . $index . '.uom') is-invalid @enderror"
                                                    wire:model="rows.{{ $index }}.uom"></td>
                                                    <td><input type="text" class="form-control @error('rows.' . $index . '.reqcode') is-invalid @enderror"
                                                        wire:model="rows.{{ $index }}.reqcode"></td>

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




                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success">Request</button>

                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('materialrequested', function() {


                     Swal.fire({
                         icon: 'success',
                         title: 'Success!',
                         text: 'Material requested successfully!',
                         showConfirmButton: false,
                         timer: 3000,
                         toast: true,
                         position: 'top-end'
                     });
                 });
             </script>
</div>
