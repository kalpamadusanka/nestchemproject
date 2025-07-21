<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 class="mb-0 me-3">Admin Management</h4>
              <nav class="nav">

              </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout/>

          </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>

        <div class="col-md-12 py-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">

                    <h4 class="card-title mb-0">Admin Management</h4>
                    <button class="btn btn-primary"  wire:click="addAdmin">Add</button>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6" >

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row d-flex justify-content-between align-items-center">

                                    <div class="col-md-12">
                                        <!-- Search input aligned to the right -->
                                        <div id="datatable_filter" class="dataTables_filter" style="float: right;">
                                            <label><input type="search" class="form-control form-control-sm" placeholder="Search records" wire:model.live="search" aria-controls="datatable"></label>
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
                                                aria-label="Name: activate to sort column descending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 330px;"
                                                aria-label="Position: activate to sort column ascending">
                                                Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 330px;"
                                                aria-label="Office: activate to sort column ascending">Position
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 330px;"
                                                aria-label="Age: activate to sort column ascending">Last Login</th>
                                            <th class="disabled-sorting text-right sorting" tabindex="0"
                                                aria-controls="datatable" rowspan="1" colspan="1"
                                                style="width: 330px;"
                                                aria-label="Actions: activate to sort column ascending">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Position</th>
                                            <th rowspan="1" colspan="1">Last login</th>
                                            <th class="disabled-sorting text-right" rowspan="1"
                                                colspan="1">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                     @if ($systemusers)
                                         @foreach ($systemusers as $u)
                                         <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->role }}</td>
                                            <td>{{ $u->last_login }}</td>
                                            <td class="text-right">

                                                <a href="#"
                                                    class="btn btn-round btn-warning btn-icon btn-sm edit" wire:click="assignRole({{ $u->id }})"><i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="deleteUser({{ $u->id }})"><i
                                                        class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                         @endforeach
                                     @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Showing {{ $systemusers->firstItem() }} to {{ $systemusers->lastItem() }} of {{ $systemusers->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        {{ $systemusers->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div>

        <!-- Grid of Cards -->
  <livewire:admin.dashboard.systemuser.addadmin.addadminmodal/>
    </div>
    <style>


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
    </style>
</div>
