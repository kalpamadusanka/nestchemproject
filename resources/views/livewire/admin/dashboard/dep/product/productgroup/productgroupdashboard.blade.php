<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Product Group Management</h4>
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
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Product </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Group</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product group List</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <a wire:click="productgroupaddmodal" class="btn btn-primary" >
                        <i class="bi bi-plus-circle"></i>&nbsp; Add Product Group
                    </a>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Group List</h4>

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
                                                        aria-label="Name: activate to sort column descending">Code</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Product Group</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Office: activate to sort column ascending">Added By
                                                    </th>


                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Status</th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 100px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @if ($requestdata)
                                                @foreach ($requestdata as $data)
                                                   <tr>
                                                        <td>{{ $data->code }}</td>
                                                        <td>{{  $data->product_group }}</td>
                                                        <td>{{  $data->addedBy->name ?? 'Not Updated' }}</td>

                                                        <td>
                                                            @if ($data->status == 1)
                                                            <span class="badge badge-success">Active</span>

                                                        @elseif($data->status == 0)
                                                            <span class="badge badge-danger">Transferred & Released</span>

                                                        @endif
                                                        </td>



                                                        <td>


                                                            @if (auth()->user()->role == 'Superadmin')
                                                            <a href="#"
                                                                class="btn btn-round btn-danger btn-icon btn-sm remove"
                                                                wire:click="deletedata({{ $data->id }})"><i
                                                                    class="fas fa-trash"></i></a>
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

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

      <livewire:admin.dashboard.dep.product.productgroup.modal.productgroupmodal/>



        </div>
    </div>
<script>

    window.addEventListener('errorproductgroupadded', function(event) {
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

        window.addEventListener('productgroupadded', function() {


Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Product group added successfully!',
    showConfirmButton: false,
    timer: 3000,
    toast: true,
    position: 'top-end'
});
});

window.addEventListener('errorproductgroupdeleted', function(event) {
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

        window.addEventListener('productgroupdeleted', function() {


Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Product group deleted successfully!',
    showConfirmButton: false,
    timer: 3000,
    toast: true,
    position: 'top-end'
});
});

    </script>

</div>
