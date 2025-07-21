{{-- resources/views/livewire/admin/loan-dashboard.blade.php --}}
<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="dashboard-container">
            <!-- Header Section -->
            <div class="dashboard-header">
                <div class="header-left">
                    <h1 class="dashboard-title">Loan & Advance Management</h1>
                    <nav class="dashboard-nav">
                        <a href="#" class="nav-item {{ $activeTab === 'overview' ? 'active' : '' }}"
                           wire:click="setActiveTab('overview')">Overview</a>
                        <a href="#" class="nav-item {{ $activeTab === 'requests' ? 'active' : '' }}"
                           wire:click="setActiveTab('requests')">Loan Requests</a>
                        <a href="#" class="nav-item {{ $activeTab === 'advances' ? 'active' : '' }}"
                           wire:click="setActiveTab('advances')">Advance Payments</a>
                        <a href="#" class="nav-item {{ $activeTab === 'repayments' ? 'active' : '' }}"
                           wire:click="setActiveTab('repayments')">Repayments</a>
                        <a href="#" class="nav-item {{ $activeTab === 'reports' ? 'active' : '' }}"
                           wire:click="setActiveTab('reports')">Reports</a>
                    </nav>
                </div>
                <div class="header-right">
                    <button class="btn btn-back" onclick="window.history.back()">
                        <i class="bi bi-arrow-left-circle me-2"></i>Back
                    </button>
                    <livewire:admin.dashboard.notifylayout />
                </div>
            </div>

            @if($activeTab === 'overview')
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="summary-card card-1">
                        <div class="card-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="card-content">
                            <h3>Total Loans</h3>
                            <p>LKR&nbsp;{{ number_format($totalLoans, 2) }}</p>
                            <span class="trend {{ $loanTrend >= 0 ? 'positive' : 'negative' }}">
                                {{ $loanTrend >= 0 ? '↑' : '↓' }} {{ abs($loanTrend) }}% from last month
                            </span>
                        </div>
                    </div>

                    <div class="summary-card card-2">
                        <div class="card-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="card-content">
                            <h3>Pending Requests</h3>
                            <p>{{ $pendingRequests }}</p>
                            <span class="trend negative">↑ {{ $newRequestsToday }} new today</span>
                        </div>
                    </div>

                    <div class="summary-card card-3">
                        <div class="card-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="card-content">
                            <h3>Approved This Month</h3>
                            <p>{{ $approvedThisMonth }}</p>
                            <span class="trend {{ $approvedTrend >= 0 ? 'positive' : 'negative' }}">
                                {{ $approvedTrend >= 0 ? '↑' : '↓' }} {{ abs($approvedTrend) }}% from last month
                            </span>
                        </div>
                    </div>

                    <div class="summary-card card-4">
                        <div class="card-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="card-content">
                            <h3>Overdue Repayments</h3>
                            <p>{{ $overdueRepayments }}</p>
                            <span class="trend negative">↑ {{ $overdueThisWeek }} this week</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="main-content">
                    <!-- Recent Activity Section -->
                    <div class="content-section recent-activity">
                        <div class="section-header">
                            <h2>Recent Activity</h2>
                            <a href="#" class="view-all" wire:click="setActiveTab('requests')">View All</a>
                        </div>
                        <div class="activity-list">
                            @forelse($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon {{ $activity['type'] }}">
                                        <i class="bi bi-{{ $activity['icon'] }}"></i>
                                    </div>
                                    <div class="activity-details">
                                        <p>{!! $activity['description'] !!}</p>
                                        <small>{{ $activity['details'] }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No recent activity found.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Loan Status Chart -->
                    <div class="content-section chart-section">
                        <div class="section-header">
                            <h2>Loan Status Overview</h2>
                            <div class="chart-options">
                                <select class="form-select" wire:model.live="chartPeriod" wire:change="updateChart">
                                    <option value="this_month">This Month</option>
                                    <option value="last_month">Last Month</option>
                                    <option value="this_quarter">This Quarter</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="loanStatusChart" wire:ignore></canvas>
                        </div>
                    </div>
                </div>
            @endif

            @if($activeTab === 'requests')
                <div class="content-section">
                    <div class="section-header">
                        <h2>Loan Requests</h2>
                        <div class="d-flex gap-2">
                            <select class="form-select" wire:model="statusFilter" wire:change="filterRequests">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search..." wire:model="searchTerm" wire:input="filterRequests">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Applicant</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loanRequests as $request)
                                    <tr>
                                        <td>#{{ $request->id }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>LKR&nbsp;{{ number_format($request->amount, 2) }}</td>
                                        <td>{{ ucfirst($request->type) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $request->status === 'approved' ? 'success' : ($request->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($request->status === 'pending')
                                                <button class="btn btn-sm btn-success" wire:click="approveRequest({{ $request->id }})">
                                                    Approve
                                                </button>
                                                <button class="btn btn-sm btn-danger" wire:click="rejectRequest({{ $request->id }})">
                                                    Reject
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-info" wire:click="viewRequest({{ $request->id }})">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No loan requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $loanRequests->links() }}
                </div>
            @endif

            @if($activeTab === 'advances')
                <div class="content-section">
                    <div class="section-header">
                        <h2>Advance Payments</h2>
                        <button class="btn btn-primary" wire:click="openAdvanceModal">
                            <i class="bi bi-plus-circle"></i> Process Advance
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($advances as $advance)
                                    <tr>
                                        <td>#{{ $advance->id }}</td>
                                        <td>{{ $advance->user->name }}</td>
                                        <td>LKR&nbsp;{{ number_format($advance->amount, 2) }}</td>
                                        <td>{{ $advance->reason }}</td>
                                        <td>
                                            <span class="badge bg-{{ $advance->status === 'approved' ? 'success' : ($advance->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($advance->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $advance->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if ($advance->status != 'active')
                                                 <button class="btn btn-sm btn-success" wire:click="approveAdvance({{ $advance->id }})">
                                                    Approve
                                                </button>
                                            @endif

                                            <button class="btn btn-sm btn-info" wire:click="viewAdvancedetails({{ $advance->id }})">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No advance payments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $advances->links() }}
                </div>
            @endif

            @if($activeTab === 'repayments')
                <div class="content-section">
                    <div class="section-header">
                        <h2>Repayments</h2>
                        <button class="btn btn-primary" wire:click="openRepaymentNewModal" hidden>
                            <i class="bi bi-cash-coin"></i> Record Payment
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loan ID</th>
                                    <th>Borrower</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($repayments as $repayment)
                                    <tr>
                                        <td>#{{ $repayment->id }}</td>
                                        <td>#{{ $repayment->loan_id }}</td>
                                        <td>{{ $repayment->loan->user->name }}</td>
                                        <td>LKR&nbsp;{{ number_format($repayment->amount, 2) }}</td>
                                        <td>{{ $repayment->due_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $repayment->status === 'paid' ? 'success' : ($repayment->due_date->isPast() ? 'danger' : 'warning') }}">
                                                {{ $repayment->status === 'paid' ? 'Paid' : ($repayment->due_date->isPast() ? 'Overdue' : 'Pending') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($repayment->status !== 'paid')
                                                <button class="btn btn-sm btn-success" wire:click="markAsPaid({{ $repayment->id }})">
                                                    Mark Paid
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-info" wire:click="viewRepayment({{ $repayment->id }})">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No repayments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $repayments->links() }}
                </div>
            @endif

            @if($activeTab === 'reports')
                <div class="content-section">
                    <div class="section-header">
                        <h2>Reports</h2>
                        <div class="d-flex gap-2">
                            <select class="form-select" wire:model="reportType">
                                <option value="monthly">Monthly Report</option>
                                <option value="quarterly">Quarterly Report</option>
                                <option value="yearly">Yearly Report</option>
                            </select>
                            <button class="btn btn-primary" wire:click="generateReport">
                                <i class="bi bi-file-earmark-text"></i> Generate Report
                            </button>
                        </div>
                    </div>

                    @if($reportData)
                        <div class="report-summary">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <h4>Total Loans</h4>
                                        <p class="stat-value">LKR&nbsp;{{ number_format($reportData['total_loans'], 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <h4>Total Repaid</h4>
                                        <p class="stat-value">LKR&nbsp;{{ number_format($reportData['total_repaid'], 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <h4>Outstanding</h4>
                                        <p class="stat-value">LKR&nbsp;{{ number_format($reportData['outstanding'], 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <h4>Default Rate</h4>
                                        <p class="stat-value">{{ $reportData['default_rate'] }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="quick-actions">
                <button class="action-btn primary" wire:click="openLoanModal">
                    <i class="bi bi-plus-circle"></i> New Loan
                </button>
                <button class="action-btn secondary" wire:click="openAdvanceModal">
                    <i class="bi bi-cash-coin"></i> Process Advance
                </button>
                <button class="action-btn light" wire:click="generateReport">
                    <i class="bi bi-file-earmark-text"></i> Generate Report
                </button>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @if($showLoanModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Loan Application</h5>
                        <button type="button" class="btn-close" wire:click="closeLoanModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submitLoan">
                            <div class="mb-3">
                                <label class="form-label">Applicant</label>
                                <select class="form-select" wire:model="loanForm.user_id" required>
                                    <option value="">Select Applicant</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" wire:model="loanForm.amount" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loan Type</label>
                                <select class="form-select" wire:model="loanForm.type" required>
                                    <option value="">Select Type</option>
                                    <option value="personal">Personal Loan</option>
                                    <option value="business">Business Loan</option>
                                    <option value="emergency">Emergency Loan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Purpose</label>
                                <textarea class="form-control" wire:model="loanForm.purpose" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Repayment Months</label>
                                <input type="number" class="form-control" wire:model="loanForm.repayment_months" min="1" max="60" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeLoanModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="submitLoan">Submit Application</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    @if($showAdvanceModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Process Advance Payment</h5>
                        <button type="button" class="btn-close" wire:click="closeAdvanceModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submitAdvance">
                            <div class="mb-3">
                                <label class="form-label">Employee</label>
                                <select class="form-select" wire:model="advanceForm.user_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" wire:model="advanceForm.amount" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" wire:model="advanceForm.reason" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deduction Start Date</label>
                                <input type="date" class="form-control" wire:model="advanceForm.deduction_start_date" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeAdvanceModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="submitAdvance">Process Advance</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
    <!-- Loan Request Detail Modal -->
@if($showRequestDetailModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loan Request Details</h5>
                    <button type="button" class="btn-close" wire:click="closeRequestDetailModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedRequest)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Request ID:</label>
                                    <p>#{{ $selectedRequest->id }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Applicant:</label>
                                    <p>{{ $selectedRequest->user->name }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Amount:</label>
                                    <p>LKR{{ number_format($selectedRequest->amount, 2) }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Type:</label>
                                    <p>{{ ucfirst($selectedRequest->type) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Status:</label>
                                    <p>
                                        <span class="badge bg-{{ $selectedRequest->status === 'approved' ? 'success' : ($selectedRequest->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($selectedRequest->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="detail-group">
                                    <label>Repayment Period:</label>
                                    <p>{{ $selectedRequest->repayment_months }} months</p>
                                </div>
                                <div class="detail-group">
                                    <label>Request Date:</label>
                                    <p>{{ $selectedRequest->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Monthly Payment:</label>
                                    <p>LKR{{ number_format($selectedRequest->amount / $selectedRequest->repayment_months, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-group">
                            <label>Purpose:</label>
                            <p>{{ $selectedRequest->purpose }}</p>
                        </div>
                        @if($selectedRequest->status === 'pending')
                            <div class="action-buttons mt-3">
                                <button class="btn btn-success" wire:click="approveRequest({{ $selectedRequest->id }})">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                                <button class="btn btn-danger" wire:click="rejectRequest({{ $selectedRequest->id }})">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeRequestDetailModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif

<!-- Advance Detail Modal -->
@if($showAdvanceDetailModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advance Payment Details</h5>
                    <button type="button" class="btn-close" wire:click="closeAdvanceDetailModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedAdvance)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Advance ID:</label>
                                    <p>#{{ $selectedAdvance->id }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Employee:</label>
                                    <p>{{ $selectedAdvance->user->name }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Amount:</label>
                                    <p>LKR{{ number_format($selectedAdvance->amount, 2) }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Status:</label>
                                    <p>
                                        <span class="badge bg-{{ $selectedAdvance->status === 'approved' ? 'success' : ($selectedAdvance->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($selectedAdvance->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Request Date:</label>
                                    <p>{{ $selectedAdvance->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Deduction Start:</label>
                                    <p>{{ \Carbon\Carbon::parse($selectedAdvance->deduction_start_date)->format('M d, Y') }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Processed By:</label>
                                    <p>{{ $selectedAdvance->processedBy->name ?? 'System' }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Processing Date:</label>
                                    <p>{{ $selectedAdvance->processed_at ? $selectedAdvance->processed_at->format('M d, Y g:i A') : 'Not processed' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-group">
                            <label>Reason:</label>
                            <p>{{ $selectedAdvance->reason }}</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeAdvanceDetailModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif

<!-- Repayment Detail Modal -->
@if($showRepaymentDetailModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Repayment Details</h5>
                    <button type="button" class="btn-close" wire:click="closeRepaymentModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedRepayment)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Repayment ID:</label>
                                    <p>#{{ $selectedRepayment->id }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Loan ID:</label>
                                    <p>#{{ $selectedRepayment->loan_id }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Borrower:</label>
                                    <p>{{ $selectedRepayment->loan->user->name }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Amount:</label>
                                    <p>LKR{{ number_format($selectedRepayment->amount, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-group">
                                    <label>Due Date:</label>
                                    <p>{{ $selectedRepayment->due_date->format('M d, Y') }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Status:</label>
                                    <p>
                                        <span class="badge bg-{{ $selectedRepayment->status === 'paid' ? 'success' : ($selectedRepayment->due_date->isPast() ? 'danger' : 'warning') }}">
                                            {{ $selectedRepayment->status === 'paid' ? 'Paid' : ($selectedRepayment->due_date->isPast() ? 'Overdue' : 'Pending') }}
                                        </span>
                                    </p>
                                </div>
                                <div class="detail-group">
                                    <label>Payment Date:</label>
                                    <p>{{ $selectedRepayment->paid_date ? $selectedRepayment->paid_date->format('M d, Y g:i A') : 'Not paid' }}</p>
                                </div>
                                <div class="detail-group">
                                    <label>Payment Method:</label>
                                    <p>{{ $selectedRepayment->payment_method ? ucfirst(str_replace('_', ' ', $selectedRepayment->payment_method)) : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        @if($selectedRepayment->reference_number)
                            <div class="detail-group">
                                <label>Reference Number:</label>
                                <p>{{ $selectedRepayment->reference_number }}</p>
                            </div>
                        @endif
                        @if($selectedRepayment->notes)
                            <div class="detail-group">
                                <label>Notes:</label>
                                <p>{{ $selectedRepayment->notes }}</p>
                            </div>
                        @endif
                        @if($selectedRepayment->status !== 'paid')
                            <div class="action-buttons mt-3">
                                <button class="btn btn-success" wire:click="markAsPaid({{ $selectedRepayment->id }})">
                                    <i class="bi bi-check-circle"></i> Mark as Paid
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeRepaymentModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif

<style>
.detail-group {
    margin-bottom: 15px;
}

.detail-group label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
}

.detail-group p {
    margin: 0;
    color: #6c757d;
}

.action-buttons {
    border-top: 1px solid #dee2e6;
    padding-top: 15px;
}

.action-buttons .btn {
    margin-right: 10px;
}
</style>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        document.addEventListener('livewire:navigated', function() {
    let loanStatusChart = null;

    function initChart() {
        const ctx = document.getElementById('loanStatusChart');
        if (ctx) {
            // Destroy old chart if it exists
            if (loanStatusChart) {
                loanStatusChart.destroy();
            }

            loanStatusChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected', 'Repaid'],
                    datasets: [{
                        data: @json($chartData),
                        backgroundColor: [
                            '#2ecc71',
                            '#f39c12',
                            '#e74c3c',
                            '#3498db'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }
    }

    // Initialize chart on first load
    initChart();

    // Reinitialize chart when tab changes
    Livewire.on('tabChanged', function({ tab }) {
        if (tab === 'overview') {
            setTimeout(initChart, 100); // Small delay to ensure DOM is ready
        }
    });

    // Update chart data if Livewire sends new data
    Livewire.on('chartUpdated', function(data) {
        if (loanStatusChart) {
            loanStatusChart.data.datasets[0].data = data;
            loanStatusChart.update();
        }
    });
});
        </script>


    <style>
        /* Include all your existing CSS styles here */
        .dashboard-container {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-left {
            display: flex;
            flex-direction: column;
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .dashboard-nav {
            display: flex;
            gap: 20px;
        }

        .nav-item {
            text-decoration: none;
            color: #7f8c8d;
            font-weight: 500;
            padding-bottom: 5px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .nav-item.active {
            color: #3498db;
            border-bottom: 2px solid #3498db;
        }

        .nav-item:hover {
            color: #3498db;
        }

        .btn-back {
            background-color: #f8f9fa;
            color: #3498db;
            border: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background-color: #e8f4fc;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: white;
        }

        .card-1 .card-icon { background-color: #3498db; }
        .card-2 .card-icon { background-color: #f39c12; }
        .card-3 .card-icon { background-color: #2ecc71; }
        .card-4 .card-icon { background-color: #e74c3c; }

        .card-content h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .card-content p {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .trend {
            font-size: 12px;
        }

        .positive { color: #2ecc71; }
        .negative { color: #e74c3c; }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .content-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .view-all {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }

        .approved { background-color: #2ecc71; }
        .pending { background-color: #f39c12; }
        .repayment { background-color: #3498db; }
        .rejected { background-color: #e74c3c; }

        .activity-details p {
            margin: 0;
            font-size: 14px;
            color: #2c3e50;
        }

        .activity-details small {
            color: #95a5a6;
            font-size: 12px;
        }

        .chart-container {
            height: 250px;
            margin-top: 20px;
        }

        .quick-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .primary {
            background-color: #3498db;
            color: white;
        }

        .secondary {
            background-color: #2ecc71;
            color: white;
        }

        .light {
            background-color: white;
            color: #2c3e50;
            border: 1px solid #ecf0f1;
        }

        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card h4 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .report-summary {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .main-content {
                grid-template-columns: 1fr;
            }

            .dashboard-nav {
                flex-wrap: wrap;
            }
        }
    </style>

    <script>
          window.addEventListener('deductionstarted', function() {


                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Deduction started successfully',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });
    </script>
</div>
