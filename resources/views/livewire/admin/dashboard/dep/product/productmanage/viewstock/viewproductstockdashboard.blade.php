<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Product Stock</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <div>
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Products </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Stock</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('admin.dashboard.dep.manufacture.add.product') }}" wire:navigate
                        class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>Add new Product
                    </a>
                </div>

            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Product List</h4>

                        </div>

                        <div class="card-body">

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="datatable_length"><label>Show <select
                                                    name="datatable_length" aria-controls="datatable"
                                                    class="custom-select custom-select-sm form-control form-control-sm"
                                                    fdprocessedid="95g48">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="-1">All</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-12">
                                                <!-- Search input aligned to the right -->
                                                <div id="datatable_filter" class="dataTables_filter d-flex gap-2 justify-content-end align-items-center">
                                                    <label>
                                                        <input type="search" class="form-control form-control-sm" placeholder="Search records" wire:model.live="search" aria-controls="datatable">
                                                    </label>
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group">

                                                            <input type="text" id="date-range" class="form-control form-control-sm" wire:model="daterange"
                                                                placeholder="Select date range">
                                                        </div>
                                                        <script>
                                                            document.addEventListener('livewire:navigated', () => {
                                                                flatpickr("#date-range", {
                                                                    mode: "range",
                                                                    dateFormat: "Y-m-d", // Customize as needed
                                                                    wrap: false, // Set to false if you are not using a wrapper element
                                                                    onReady: function(selectedDates, dateStr, instance) {
                                                                        // Create and append the "Apply" button
                                                                        const applyButton = document.createElement("button");
                                                                        applyButton.type = "button";
                                                                        applyButton.innerText = "Apply";
                                                                        applyButton.className =
                                                                        "flatpickr-apply-btn btn btn-primary mt-2"; // Add custom styles if needed

                                                                        // Append the button below the calendar
                                                                        instance.calendarContainer.appendChild(applyButton);

                                                                        // Handle "Apply" button click
                                                                        applyButton.addEventListener("click", () => {
                                                                            // Trigger Livewire model update with selected date range
                                                                            const dateRange = instance.input.value;
                                                                            @this.set('daterange', dateRange);
                                                                            @this.call('applyDate');
                                                                            // Close the Flatpickr calendar
                                                                            instance.close();
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable"
                                            class="table table-striped table-bordered dataTable dtr-inline"
                                            cellspacing="0" width="100%" role="grid"
                                            aria-describedby="datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Product Name</th>

                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Product code</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                       UOM</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Stock Qty</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Barcode</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Lot</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Exp Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Product group</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Unit price</th>

                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                    aria-controls="datatable" rowspan="1" colspan="1"
                                                    style="width: 330px;"
                                                    aria-label="Actions: activate to sort column ascending">Action
                                                </th>
                                                </tr>
                                            </thead>
                                            <tfoot>



                                            </tfoot>

                                            <tbody>

                                                @if ($productdata)
                                                @foreach ($productdata as $data)
                                                    <tr>
                                                        <td>{{ $data->productData->product_name }}</td>
                                                        <td>{{ $data->productData->product_code }}</td>
                                                        <td>{{ $data->productData->uom }}</td>
                                                        <td>{{ $data->qty }}</td>
                                                        <td>{{ $data->barcode }}</td>
                                                        <td>{{ $data->lot ?? 'Not Updated' }}</td>
                                                        <td>{{ $data->exp_date ?? 'Not Updated' }}</td>
                                                        <td>{{ $data->productGroup->product_group ?? 'Not Updated' }}</td>
                                                        <td>{{ $data->unit_price ? 'LKR ' . number_format($data->unit_price, 2) : 'Not Updated' }}</td>

                                                        <td>
                                                            @if ($data->status == 1)
                                                            <div style="display: flex; gap: 8px;">
                                                                <!-- Edit Button -->
                                                                <button
                                                                    wire:click="editRecord({{ $data->id }})"
                                                                    style="
                                                                        padding: 8px 12px;
                                                                        background: #ffffff;
                                                                        color: #4f46e5;
                                                                        border: 1px solid #e0e0e0;
                                                                        border-radius: 6px;
                                                                        font-size: 14px;
                                                                        font-weight: 500;
                                                                        cursor: pointer;
                                                                        display: inline-flex;
                                                                        align-items: center;
                                                                        gap: 6px;
                                                                        transition: all 0.2s ease;
                                                                        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                                                                    "
                                                                    onmouseover="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'; this.style.borderColor='#c7d2fe'"
                                                                    onmouseout="this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'; this.style.borderColor='#e0e0e0'"
                                                                    title="Edit"
                                                                >
                                                                    <span style="font-size: 16px;">✏️</span>
                                                                    <span>Edit</span>
                                                                </button>

                                                                <!-- Assign Shelf Button -->
                                                                <button
                                                                    wire:click="assignshelfData({{ $data->id }})"
                                                                    style="
                                                                        padding: 8px 12px;
                                                                        background: #ffffff;
                                                                        color: #4f46e5;
                                                                        border: 1px solid #e0e0e0;
                                                                        border-radius: 6px;
                                                                        font-size: 14px;
                                                                        font-weight: 500;
                                                                        cursor: pointer;
                                                                        display: inline-flex;
                                                                        align-items: center;
                                                                        gap: 6px;
                                                                        transition: all 0.2s ease;
                                                                        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                                                                    "
                                                                    onmouseover="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'; this.style.borderColor='#c7d2fe'"
                                                                    onmouseout="this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'; this.style.borderColor='#e0e0e0'"
                                                                    title="Assign Shelf"
                                                                >
                                                                    <span style="font-size: 16px;">📋</span>
                                                                    <span>Assign Shelf</span>
                                                                </button>

                                                                <!-- Shelf Data Button -->
                                                                <button
                                                                    wire:click="getshelfData({{ $data->id }})"
                                                                    style="
                                                                        padding: 8px 12px;
                                                                        background: #ffffff;
                                                                        color: #4f46e5;
                                                                        border: 1px solid #e0e0e0;
                                                                        border-radius: 6px;
                                                                        font-size: 14px;
                                                                        font-weight: 500;
                                                                        cursor: pointer;
                                                                        display: inline-flex;
                                                                        align-items: center;
                                                                        gap: 6px;
                                                                        transition: all 0.2s ease;
                                                                        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                                                                    "
                                                                    onmouseover="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'; this.style.borderColor='#c7d2fe'"
                                                                    onmouseout="this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'; this.style.borderColor='#e0e0e0'"
                                                                    title="Shelf Data"
                                                                >
                                                                    <span style="font-size: 16px;">📊</span>
                                                                    <span>Shelf Data</span>
                                                                </button>
                                                            </div>

                                                        @else


                                                                <a class="btn btn-round btn-danger btn-icon btn-sm remove"
                                                                    wire:click="decline({{ $data->id }})"><i
                                                                        class="fas fa-times"></i></a>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                            <ul class="pagination">
                                               {{ $productdata->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

            <livewire:admin.dashboard.dep.product.productmanage.viewstock.modal.assignshelfmodal/>
            <livewire:admin.dashboard.dep.product.productmanage.viewstock.modal.viewshelfmodal/>
            <livewire:admin.dashboard.dep.product.productmanage.viewstock.modal.editstockmodal/>

        </div>
    </div>
    <script>
        window.addEventListener('errorassignedshelf', function(event) {
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
           window.addEventListener('qtyerror', function(event) {
               Swal.fire({
                   icon: 'error', // Change icon to 'error' instead of 'success'
                   title: 'Error!',
                   text: 'Invalid quantity assigned !', // Show the error message
                   showConfirmButton: false,
       timer: 3000,
       toast: true,
       position: 'top-end'
               });
           });
           window.addEventListener('shelfover', function(event) {
               Swal.fire({
                   icon: 'error', // Change icon to 'error' instead of 'success'
                   title: 'Error!',
                   text: '⚠️ Shelf Capacity Alert: The current shelf capacity is insufficient to store additional items. Please take immediate action to resolve the issue.', // Show the error message
                   showConfirmButton: false,
       timer: 6000,
       toast: true,
       position: 'top-end'
               });
           });


           window.addEventListener('qtyassignederror', function(event) {
               Swal.fire({
                   icon: 'warning', // Change icon to 'error' instead of 'success'
                   title: 'warning!',
                   text: 'The quantity for this product stock has already been assigned to a shelf!', // Show the error message
                   showConfirmButton: false,
       timer: 3000,
       toast: true,
       position: 'top-end'
               });
           });

           window.addEventListener('assignedshelf', function() {


   Swal.fire({
       icon: 'success',
       title: 'Success!',
       text: 'Shelf assigned successfully!',
       showConfirmButton: false,
       timer: 3000,
       toast: true,
       position: 'top-end'
   });
   });

   window.addEventListener('productstockrecordupdated', function() {


Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Record updated successfully!',
    showConfirmButton: false,
    timer: 3000,
    toast: true,
    position: 'top-end'
});
});

       </script>

</div>
