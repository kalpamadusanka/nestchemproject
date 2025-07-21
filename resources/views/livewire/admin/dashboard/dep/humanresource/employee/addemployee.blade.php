<div>
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Employee Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>

        <div class="content py-4">
           <a href="{{ route('neo.existing.employee.view') }}" wire:navigate class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >
            view employees
           </a>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Employee</h5>
                </div>
                <div class="card-body">
                  <form wire:submit.prevent="submit">
                    <div class="row">
                      <div class="col-md-5 pr-1">
                        <div class="form-group">
                          <label>Company (disabled)</label>
                          <input type="text" class="form-control" disabled="" placeholder="Company" value="Nestchem Lanka pvt(Ltd)">
                        </div>
                      </div>
                      <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" wire:model="username" wire:focus="showSuggestions" wire:blur="hideSuggestions">
                            @if (!empty($suggestions))
                            <ul class="list-group ">
                                @foreach ($suggestions as $option)
                                <a wire:click="selectOption('{{ $option->id }}')">
                                    <li class="list-group-item d-flex align-items-center py-2 px-3">
                                        <!-- Display the option name -->
                                        <span class="text-gray-800 fw-bold">{{ $option->name }}</span>
                                    </li>
                                  </a>
                                @endforeach
                            </ul>
                        @endif

                        </div>

                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" wire:model="email" class="form-control" placeholder="Email">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" placeholder="Company" value="Mike" wire:model="firstname">
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" placeholder="Last Name" value="Andrew" wire:model="lastname">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" wire:model="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" class="form-control" wire:model="birthday">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" wire:model="address">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 pr-1">
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" placeholder="City" value="Mike" wire:model="city">
                        </div>
                      </div>
                      <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>Country</label>
                          <input type="text" class="form-control" placeholder="Country" value="Andrew" wire:model="country">
                        </div>
                      </div>
                      <div class="col-md-3 pl-1">
                        <div class="form-group">
                          <label>Postal Code</label>
                          <input type="number" class="form-control" placeholder="ZIP Code" wire:model="postalcode">
                        </div>
                      </div>
                      <div class="col-md-3 pl-1">
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="number" class="form-control" placeholder="Contact" wire:model="contact">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2" style="float: right">
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove>Save changes</span>
                            <span wire:loading>Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        <script>
            window.addEventListener('employeedetailsadded', function() {
                         Swal.fire({
                             icon: 'success',
                             title: 'Success!',
                             text: 'System User Details Updated!',
                             showConfirmButton: false,
                             timer: 3000,
                             toast: true,
                             position: 'top-end'
                         });
                     });
                     window.addEventListener('employeedetailserror', function() {
                         Swal.fire({
                             icon: 'error',
                             title: 'Error!',
                             text: 'Something went wrong!',
                             showConfirmButton: false,
                             timer: 3000,
                             toast: true,
                             position: 'top-end'
                         });
                     });

                 </script>
      </div>

      <style>
          .card {
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
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
      </style>
</div>
