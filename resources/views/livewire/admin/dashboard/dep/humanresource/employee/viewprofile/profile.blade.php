<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 >Employee Profile</h4>
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

        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Employee Card -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-primary text-white mb-2" style="border-radius: 20px;height: 120px;">
                            <img src="{{ asset('storage/avatars/'.$userimg) }}" class="rounded-circle" width="80" alt="Profile">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $username ?? 'Not Updated' }}<span class="badge bg-success">✔</span></h5>
                            <p class="text-muted">{{ $userrole ?? 'Not Updated' }}</p>
                            <p><strong>Emp ID:</strong> CLT-{{ $empid ?? 'Not Updated' }}</p>
                            <p><strong>Date of Join:</strong> {{ $joindate ?? 'Not Updated' }}</p>
                            <p><strong>Report Office:</strong> Neo - {{ $useroffice ?? 'Not Updated' }}</p>
                            <a class="btn btn-dark" wire:click="editinfomodal({{ $empid }})">Edit Info</a>

                        </div>
                        <div class="card-footer">
                            <p><strong>Phone:</strong>{{ $phone ?? 'Not Updated' }}</p>
                            <p><strong>Email:</strong> {{ $email ?? 'Not Updated' }}</p>
                            <p><strong>Gender:</strong> {{ $gender ?? 'Not Updated' }}</p>
                            <p><strong>Birthdate:</strong>{{ $birthday ?? 'Not Updated' }}</p>
                            <p><strong>Address:</strong> {{ $address ?? 'Not Updated'}}</p>
                            <p><strong>Postal code:</strong> {{ $postalcode ?? 'Not Updated'}}</p>
                        </div>
                    </div>
                </div>

                <!-- Employee Details -->
                <div class="col-md-8">
                    <div class="accordion" id="employeeDetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankInfo">
                                    Bank Information
                                </button>
                            </h2>
                            <div id="bankInfo" class="accordion-collapse collapse show" data-bs-parent="#employeeDetails">
                                <div class="accordion-body">
                                    <p><strong>Bank Name:</strong> {{ $bankname ?? 'Not updated' }} </p>
                                    <p><strong>Bank Account No:</strong> {{ $accno ?? 'Not updated' }}</p>
                                    <p><strong>Branch:</strong> {{ $branch ?? 'Not updated' }}</p>
                                    <button type="button" class="btn-primary" wire:click="openbankmodal({{ $empid }})">Update</button>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#familyInfo">
                                    Family Information
                                </button>
                            </h2>
                            <div id="familyInfo" class="accordion-collapse collapse" data-bs-parent="#employeeDetails">
                                <div class="d-flex justify-content-between align-items-center px-3 py-2">

                                    <button type="button" class="btn btn-primary" wire:click="openfamilymodal({{ $empid }})">
                                        Update
                                    </button>
                                </div>

                                <div class="accordion-body">
                                    <div class="card-body">
                                        @if ($familyData)
                                            @foreach ($familyData as $data)
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <strong>Name:</strong>
                                                    <p>{{ $data->name ?? 'Not Updated!' }}</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <strong>Relationship:</strong>
                                                    <p>{{ $data->relationship ?? 'Not Updated!' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Date of Birth:</strong>
                                                    <p>{{ $data->dob ?? 'Not Updated!' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Phone:</strong>
                                                    <p>{{ $data->phone ?? 'Not Updated!'}}</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm" wire:click="deletefamilydata({{ $data->id }})">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#educationExperience">
                                    Education & Experience
                                </button>
                            </h2>
                            <div id="educationExperience" class="accordion-collapse collapse" data-bs-parent="#employeeDetails">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5>Education Details</h5>
                                                </div>
                                                <div class="col-md-4" >
                                                    <button type="button" class="btn btn-primary btn-sm" wire:click="openedumodal({{ $empid }})">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                            @if ($eduData)
                                                @foreach ($eduData as $edu)
                                                <div class="card mb-3 "> <!-- Added shadow for depth -->
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-3"> <!-- Flexbox for icon and title alignment -->
                                                            <i class="fas fa-university fa-2x text-primary me-3"></i> <!-- Icon for university -->
                                                            <h6 class="card-title mb-0">{{ $edu->institute ?? 'Not Updated' }}</h6> <!-- Title -->
                                                        </div>
                                                        <p class="card-text text-muted mb-2"> <!-- Course name -->
                                                            <i class="fas fa-book-open me-2"></i>{{ $edu->subject ?? 'Not Updated' }}
                                                        </p>
                                                        <p class="card-text text-muted"> <!-- Duration -->
                                                            @php
                                                            if (!empty($edu->daterange)) {
                                                                [$start, $end] = explode(' - ', $edu->daterange);
                                                                $formattedStart = \Carbon\Carbon::parse($start)->format('Y M d');
                                                                $formattedEnd = \Carbon\Carbon::parse($end)->format('Y M d');
                                                                $dateRange = $formattedStart . ' - ' . $formattedEnd;
                                                            } else {
                                                                $dateRange = 'Not Updated';
                                                            }
                                                        @endphp

                                                        <i class="fas fa-calendar-alt me-2"></i>{{ $dateRange }}

                                                        </p>
                                                        <div class="mt-3"> <!-- Additional details or buttons -->
                                                            <a  class="btn btn-outline-primary btn-sm" wire:click="remove({{ $edu->id }})">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5>Experience</h5>
                                                </div>
                                                <div class="col-md-4" >
                                                    <button type="button" class="btn btn-primary btn-sm" wire:click="openexpmodal({{ $empid }})">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                            @if ($experienceData)
                                            @foreach ($experienceData as  $exp)
                                            <div class="card mb-3 "> <!-- Added shadow and hover effect -->
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3"> <!-- Flexbox for icon and title alignment -->
                                                        <i class="fas fa-briefcase fa-2x text-primary me-3"></i> <!-- Icon for job -->
                                                        <div>
                                                            <h6 class="card-title mb-1">{{ $exp->position ?? 'Not Updated!' }}</h6> <!-- Job title -->
                                                            <p class="card-text text-muted mb-0">{{ $exp->employer ?? 'Not Updated!'}}</p> <!-- Company name -->
                                                        </div>
                                                    </div>
                                                    <p class="card-text text-muted mb-2"> <!-- Duration -->
                                                        @php
                                                        if (!empty($exp->daterange)) {
                                                            [$start, $end] = explode(' - ', $exp->daterange);
                                                            $formattedStart = \Carbon\Carbon::parse($start)->format('Y M d');
                                                            $formattedEnd = \Carbon\Carbon::parse($end)->format('Y M d');
                                                            $dateRange = $formattedStart . ' - ' . $formattedEnd;
                                                        } else {
                                                            $dateRange = 'Not Updated';
                                                        }
                                                    @endphp

                                                    <i class="fas fa-calendar-alt me-2"></i>{{ $dateRange }}
                                                    </p>
                                                    <div class="mt-3"> <!-- Additional details or buttons -->
                                                        <a href="#" class="btn btn-outline-primary btn-sm" wire:click="removeexp({{ $exp->id }})">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            @endif

                                            <!-- Add more experience cards as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($emphasassets)
                    <div class="mt-4">
                        <h5>Assets</h5>
                        <div class="row">
                            @foreach ($emphasassets as $asset)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $asset->code }}</h6>
                                        <p>{{ $asset->item }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
     <livewire:admin.dashboard.dep.humanresource.employee.viewprofile.bankdata.bankdetailsmodal />
     <livewire:admin.dashboard.dep.humanresource.employee.viewprofile.familydata.familymodal />
     <livewire:admin.dashboard.dep.humanresource.employee.viewprofile.edudata.edumodal />
     <livewire:admin.dashboard.dep.humanresource.employee.viewprofile.expereincedata.expmodal />
     <livewire:admin.dashboard.dep.humanresource.employee.viewprofile.profiledata.editdatamodal />
    </div>
    <style>

.card {
            border-radius: 20px;
            margin-bottom: 20px;

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
