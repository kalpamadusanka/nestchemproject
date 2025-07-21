<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Ticket Management</h4>
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
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Tickets</h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tickets</li>
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

                    @if (auth()->user() && auth()->user()->role == 'HR & Administration Executive' || auth()->user()->role == 'Superadmin')
                    <a href="{{ route('admin.dashboard.dep.human.resource.tickets.view.alltickets') }}" wire:navigate class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> View All tickets
                    </a>
                    @endif

                    <button class="btn btn-primary" wire:click="openticketModal">
                        <i class="bi bi-plus-circle"></i> Add New Ticket
                    </button>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats">
                            <div>
                                <p class="text-muted mb-1">New Tickets</p>
                                <h4>{{ $newticket ?? '0' }}</h4>
                            </div>
                            <div class="icon text-primary" style="width: 50px; height: 50px;">
                                <img src="{{ asset('svg/svgticket.svg') }}"
                                    style="width: 100%; height: 100%; object-fit: contain;" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats">
                            <div>
                                <p class="text-muted mb-1">Open Tickets</p>
                                <h4>{{ $openedticket ?? '0' }}</h4>
                            </div>
                            <div class="icon text-primary" style="width: 50px; height: 50px;">
                                <img src="{{ asset('svg/svgopenticket.svg') }}"
                                    style="width: 100%; height: 100%; object-fit: contain;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats">
                            <div>
                                <p class="text-muted mb-1">Solved Tickets</p>
                                <h4>{{ $solvedticket ?? '0' }}</h4>
                            </div>
                            <div class="icon text-primary" style="width: 50px; height: 50px;">
                                <img src="{{ asset('svg/svgsloved.svg') }}"
                                    style="width: 100%; height: 100%; object-fit: contain;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats">
                            <div>
                                <p class="text-muted mb-1">Pending Tickets</p>
                                <h4>{{ $pendingticket ?? '0' }}</h4>
                            </div>
                            <div class="icon text-primary" style="width: 50px; height: 50px;">
                                <img src="{{ asset('svg/svgpending.svg') }}"
                                    style="width: 100%; height: 100%; object-fit: contain;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold">Ticket List</h4>
                        <div class="d-flex gap-2">

                            <div class="form-group">
                            <select class="form-select form-select-sm" style="width: auto;" wire:model.live="priority">
                                <option value="">Priority</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>

                            </select>
                        </div>
                            <div class="form-group">
                            <select class="form-select form-select-sm" style="width: auto;" wire:model.live="status">
                                <option value="">Status</option>
                                <option value="reopened">On Hold</option>
                                <option value="inprogress">Open</option>
                                <option value="resolved">Resolved</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                            <div class="form-group">

                                <input type="text" id="date-range" class="form-select" wire:model="daterange"
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

            <div class="row">
                <div class="col-md-8">
                    @if ($alltickets->count() > 0)
                        @foreach ($alltickets as $ticket)
                            <div class="ticket-item">
                                <h5 class="d-flex justify-content-between">
                                    {{ $ticket->title ?? 'Not Updated!' }}
                                    @if ($ticket->t_status == 'inprogress')
                                        <span class="badge bg-success">Open</span>
                                    @elseif ($ticket->t_status == 'reopened')
                                        <span class="badge bg-warning">Hold</span>
                                    @elseif($ticket->t_status == 'resolved')
                                        <span class="badge bg-success">Resolved</span>
                                    @else
                                        <span class="badge bg-danger">Closed</span>
                                    @endif

                                </h5>
                                <p class="text-muted mb-0">
                                    Assigned to {{ $ticket->assignUser->name ?? 'Not Updated!' }}
                                    By {{ $ticket->addedBy->name ?? 'Not Updated!' }} |
                                    Updated {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}
                                </p>
                              <div class="col-md-6 p-0">
                                <select wire:model="t_status" class="form-select form-select-sm d-inline w-auto" wire:change="changeStatus({{ $ticket->id }})">
                                    <option value="inprogress" {{ $ticket->t_status == 'inprogress' ? 'selected' : '' }}>Open</option>
                                    <option value="reopened" {{ $ticket->t_status == 'reopened' ? 'selected' : '' }}>Hold</option>
                                    <option value="resolved" {{ $ticket->t_status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $ticket->t_status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                              </div>

                            </div>
                        @endforeach

                        @else
                        <div class="ticket-item">
                            <h5 class="d-flex justify-content-between">
                                <span class="badge bg-danger">Ticket Not Found!</span>
                            </h5>


                        </div>

                    @endif


                </div>
                <div class="col-md-4">
                    <div class="ticket-categories">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h6 class="mb-0">Ticket Categories</h6>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-sm btn-primary" id="show-add-category-form"
                                    wire:click="addticketCategory">Add Category</button>
                            </div>
                        </div>



                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category->category_name }}
                                    <span class="badge bg-secondary">
                                        {{ $category->tickets->count() }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.dashboard.dep.humanresource.tickets.tickedmodal.addticketmodal />
    <livewire:admin.dashboard.dep.humanresource.tickets.ticketcategory.ticketcategorymodal />
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
