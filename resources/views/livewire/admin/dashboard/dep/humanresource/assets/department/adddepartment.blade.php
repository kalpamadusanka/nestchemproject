<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Department</h4>
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
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Assets </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Company</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="exportDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item" href="#">PDF</a></li>
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                        </ul>
                    </div>


                    <button class="btn btn-primary" wire:click="opendepartmentmodal">
                        <i class="bi bi-plus-circle"></i> Add Department
                    </button>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Department List</h4>

                        </div>

                        <div class="card-body">

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">

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
                                                        aria-label="Name: activate to sort column descending">Department</th>


                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Status</th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Department</th>
                                                    <th rowspan="1" colspan="1">Status</th>
                                                    <th class="disabled-sorting text-right" rowspan="1" colspan="1">Actions</th>
                                                </tr>


                                            </tfoot>

                                            <tbody>
                                                @if ($departments)
                                                    @foreach ($departments as $dep)
                                                        <tr>
                                                            <td>{{ $dep->department_name }}</td>
                                                            <td>
                                                                @if ($dep->status == 0)
                                                                <span class="badge badge-danger">Deactive</span>

                                                                @else
                                                                <span class="badge badge-success">Active</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($dep->status==0)
                                                                <a
                                                                class="btn btn-round btn-success btn-icon btn-sm remove" wire:click="activedepartment({{ $dep->id }})"><i
                                                                    class="fas fa-check"></i></a>
                                                                @else
                                                                <a
                                                                class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="deactivedepartment({{ $dep->id }})"><i
                                                                    class="fas fa-times"></i></a>

                                                                @endif


                                                                        @if (auth()->user()->role == 'Superadmin')
                                                                        <a href="#"
                                                                        class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="deletedepartment({{ $dep->id }})"><i
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
                                                {{ $departments->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

            <livewire:admin.dashboard.dep.humanresource.assets.department.modal.adddepartmentmodal/>

        </div>
    </div>

    <style>
      .card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-stats {
    padding: 10px;
}

.icon {
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon-design {
    background-color: #007bff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}
        .icon-container {
            font-size: 30px;
            color: #007bff;
        }

        .dashboard-title {
            margin-top: 20px;
            font-size: 18px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            margin-bottom: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        .nav-link {
            color: #000;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .btn-new {
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-new:hover {
            background-color: #6c757d;
            color: #fff;
        }

        .notification-badge {
            background-color: #dc3545;
            color: #fff;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 14px;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            background-color: #6c757d;
            color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card .card-header {
            font-size: 1.2rem;
            font-weight: bold;
            background-color: transparent;
            border-bottom: none;
        }

        .card-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-stats .icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .ticket-item {
            background: #ffffff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .ticket-item .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            border-radius: 12px;
        }

        .ticket-categories {
            background: #ffffff;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ticket-categories h5 {
            margin-bottom: 1rem;
        }

        .ticket-categories .list-group-item {
            border: none;
            padding: 0.5rem 1rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons .btn {
            border-radius: 12px;
        }
    </style>
</div>
