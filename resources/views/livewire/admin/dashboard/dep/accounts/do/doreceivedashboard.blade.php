<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h4 class="me-3">DO Receiving Dashboard</h4>
                <nav class="nav">
                    <!-- Optional navigation tabs can go here -->
                </nav>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-3" onclick="window.history.back()">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back
                </button>
                <livewire:admin.dashboard.notifylayout />
            </div>
        </div>

        <!-- Activation alert (hidden by default) -->
        <div class="alert alert-danger mb-4" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>

        <!-- Dashboard Cards Section -->
        <div class="row mb-4">
            <!-- Total Sales Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR&nbsp;{{ number_format($orderTotal, 2) }}</div>
                                <div class="mt-2 text-success small">
                                    <i class="bi bi-arrow-up me-1"></i> 12% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Expenses Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Expenses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR&nbsp;{{ number_format($totalexpenses, 2) }}</div>
                                <div class="mt-2 text-danger small">
                                    <i class="bi bi-arrow-down me-1"></i> 3% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-graph-down fs-1 text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fuel Report Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Fuel Consumption</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fuelamount ?? 0 }}</div>
                                <div class="mt-2 text-muted small">
                                    <i class="bi bi-lightning-charge me-1"></i> 8% efficiency gain
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-fuel-pump fs-1 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Net Profit Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Net Profit</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR&nbsp;{{ number_format($netprofit, 2) }}</div>
                                <div class="mt-2 text-success small">
                                    <i class="bi bi-graph-up-arrow me-1"></i> 15% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-pie-chart fs-1 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Detailed Reports Section -->
        <div class="row">
            <!-- Sales Trend Chart -->
            <div class="col-xl-8 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Sales Trend</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical text-gray-400"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Export Data</a></li>
                                <li><a class="dropdown-item" href="#">Print</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="salesTrendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expense Breakdown -->
            <div class="col-xl-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Expense Breakdown</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="expensePieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="me-2">
                                <i class="bi bi-circle-fill text-primary"></i> Fuel
                            </span>
                            <span class="me-2">
                                <i class="bi bi-circle-fill text-success"></i> Maintenance
                            </span>
                            <span class="me-2">
                                <i class="bi bi-circle-fill text-info"></i> Labor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Transactions</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical text-gray-400"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">View All</a></li>
                        <li><a class="dropdown-item" href="#">Export</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>DO #</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Sales Rep</th>
                                <th>Sales</th>
                                <th>Unload</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($doendorders)
                                @foreach ($doendorders as $order)
                                    <tr>
                                        <td>DO-{{ $order->do_no ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->start_time)->format('Y M d h:i A') ?? 'N/A' }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->end_time)->format('Y M d h:i A') ?? 'N/A' }}
                                        </td>

                                        <td>{{ $order->salePerson->name ?? 'N/A' }}</td>
                                        <td>LKR&nbsp;{{ number_format($order->getGroupedSoPaymentsSum(), 2) }}</td>
                                        <td>
                                            @if ($order->unload_status == 0)
                                                <i class="fas fa-times text-danger"></i> <!-- X icon with red color -->
                                            @elseif ($order->unload_status == 1)
                                                <i class="fas fa-check text-success"></i>
                                                <!-- Tick icon with green color -->
                                            @endif
                                        </td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        @php
                                            $encryptedDoNo = encrypt($order->do_no);
                                        @endphp

                                        <td>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.dashboard.accounts.do.view', ['encryptedDoNo' => $encryptedDoNo]) }}"
                                                wire:navigate>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js for the dashboard charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample chart initialization (you'll need to implement with real data)
        document.addEventListener('livewire:navigated', function() {
            // Sales Trend Chart
            const salesCtx = document.getElementById('salesTrendChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales',
                        data: [15000, 18000, 21000, 19000, 22000, 21500],
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                        tension: 0.3
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });

            // Expense Pie Chart
            const expenseCtx = document.getElementById('expensePieChart').getContext('2d');
            new Chart(expenseCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Fuel', 'Maintenance', 'Labor', 'Other'],
                    datasets: [{
                        data: [55, 20, 15, 10],
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%',
                },
            });
        });
    </script>


</div>
