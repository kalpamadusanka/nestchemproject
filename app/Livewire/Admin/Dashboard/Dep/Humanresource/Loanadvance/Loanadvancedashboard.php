<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Loanadvance;

use App\Models\Advance;
use App\Models\AdvanceDeduction;
use App\Models\Loan;
use App\Models\LoanRequest;
use App\Models\Repayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Loanadvancedashboard extends Component
{
    use WithPagination;

    public $activeTab = 'overview';
    public $statusFilter = '';
    public $searchTerm = '';
    public $chartPeriod = 'this_month';
    public $reportType = 'monthly';
    public $reportData = null;

    // Modal states
    public $showLoanModal = false;
    public $showAdvanceModal = false;


    public $showRequestDetailModal=false;
    public $showAdvanceDetailModal=false;

    public $showRepaymentDetailModal=false;

    protected $listeners = ['openRequestModal' => 'openRequestModal','openRepaymentModal'=>'openRepaymentModal'];

    // Form data
    public $loanForm = [
        'user_id' => '',
        'amount' => '',
        'type' => '',
        'purpose' => '',
        'repayment_months' => ''
    ];

    public $advanceForm = [
        'user_id' => '',
        'amount' => '',
        'reason' => '',
        'deduction_start_date' => ''
    ];

    // Dashboard data
    public $totalLoans = 0;
    public $pendingRequests = 0;
    public $approvedThisMonth = 0;
    public $overdueRepayments = 0;
    public $loanTrend = 0;
    public $approvedTrend = 0;
    public $newRequestsToday = 0;
    public $overdueThisWeek = 0;
    public $chartData = [45, 24, 8, 23];
    public $recentActivities = [];

    public $selectedRequest,$selectedRepayment,$selectedAdvance;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->loadDashboardData();
    }



    public function setActiveTab($tab)
    {
       $this->activeTab = $tab;
    $this->resetPage();
    $this->updateChartData();

    // Dispatch an event to tell JavaScript the tab changed
    $this->dispatch('tabChanged', tab: $tab);
    }

    public function loadDashboardData()
    {
        // Calculate totals
        $this->totalLoans = Loan::where('status', 'active')->sum('amount');
        $this->pendingRequests = LoanRequest::where('status', 'pending')->count();
        $this->approvedThisMonth = Loan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'approved')
            ->count();
        $this->overdueRepayments = Repayment::where('status', 'pending')
            ->where('due_date', '<', Carbon::now())
            ->count();

        // Calculate trends
        $lastMonthLoans = Loan::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('amount');
        $this->loanTrend = $lastMonthLoans > 0 ?
            (($this->totalLoans - $lastMonthLoans) / $lastMonthLoans) * 100 : 0;

        $lastMonthApproved = Loan::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->where('status', 'approved')
            ->count();
        $this->approvedTrend = $lastMonthApproved > 0 ?
            (($this->approvedThisMonth - $lastMonthApproved) / $lastMonthApproved) * 100 : 0;

        $this->newRequestsToday = LoanRequest::whereDate('created_at', Carbon::today())->count();
        $this->overdueThisWeek = Repayment::where('status', 'pending')
            ->whereBetween('due_date', [Carbon::now()->subWeek(), Carbon::now()])
            ->count();

        // Load recent activities
        $this->loadRecentActivities();

        // Load chart data
        $this->updateChartData();
    }

    public function loadRecentActivities()
    {
        $activities = [];

        // Recent loan approvals
        $recentApprovals = Loan::with('user')
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        foreach ($recentApprovals as $loan) {
            $activities[] = [
                'type' => 'approved',
                'icon' => 'check-lg',
                'description' => "Loan approved for <strong>{$loan->user->name}</strong>",
                'details' => "LKR" . number_format($loan->amount, 2) . " • " . ucfirst($loan->type) . " • " . $loan->updated_at->format('M d, Y g:i A')
            ];
        }

        // Recent requests
        $recentRequests = LoanRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($recentRequests as $request) {
            $activities[] = [
                'type' => 'pending',
                'icon' => 'clock',
                'description' => "New request from <strong>{$request->user->name}</strong>",
                'details' => "$" . number_format($request->amount, 2) . " • " . ucfirst($request->type) . " • " . $request->created_at->format('M d, Y g:i A')
            ];
        }

        // Recent repayments
        $recentRepayments = Repayment::with('loan.user')
            ->where('status', 'paid')
            ->orderBy('updated_at', 'desc')
            ->take(2)
            ->get();

        foreach ($recentRepayments as $repayment) {
            $activities[] = [
                'type' => 'repayment',
                'icon' => 'arrow-repeat',
                'description' => "Repayment received from <strong>{$repayment->loan->user->name}</strong>",
                'details' => "LKR" . number_format($repayment->amount, 2) . " • Installment • " . $repayment->updated_at->format('M d, Y g:i A')
            ];
        }

        // Sort by most recent and limit
        $this->recentActivities = collect($activities)
            ->sortByDesc(function ($activity) {
                return strtotime($activity['details']);
            })
            ->take(5)
            ->values()
            ->toArray();
    }

    public function updateChartData()
    {
        $period = $this->chartPeriod;
        $query = Loan::query();

        switch ($period) {
            case 'this_month':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'last_month':
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                      ->whereYear('created_at', Carbon::now()->subMonth()->year);
                break;
            case 'this_quarter':
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfQuarter(),
                    Carbon::now()->endOfQuarter()
                ]);
                break;
        }

        $approved = $query->where('status', 'active')->count();
        $pending = LoanRequest::where('status', 'pending')->count();
        $rejected =  LoanRequest::where('status', 'rejected')->count();
        $repaid = $query->where('status', 'completed')->count();

        $this->chartData = [$approved, $pending, $rejected, $repaid];
        $this->dispatch('chartUpdated', $this->chartData);
    }

    public function updateChart()
    {
        $this->updateChartData();
    }

    public function getLoanRequests()
    {
        $query = LoanRequest::with('user');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->searchTerm) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getAdvances()
    {
        return Advance::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getRepayments()
    {
        return Repayment::with('loan.user')
            ->orderBy('due_date', 'desc')
            ->paginate(10);
    }

    public function filterRequests()
    {
        $this->resetPage();
    }

    public function approveRequest($requestId)
    {
        $request = LoanRequest::find($requestId);

        if ($request) {
            DB::transaction(function () use ($request) {
                // Update request status
                $request->update(['status' => 'approved']);

                // Create loan record
                Loan::create([
                    'user_id' => $request->user_id,
                    'loan_request_id'=>$request->id,
                    'amount' => $request->amount,
                    'type' => $request->type,
                    'purpose' => $request->purpose,
                    'repayment_months' => $request->repayment_months,
                    'monthly_payment'=>$request->amount / $request->repayment_months,
                    'interest_rate'=>0,
                    'status' => 'active',
                    'approved_at' => Carbon::now(),
                    'approved_by' => Auth::user()->id
                ]);

                // Create repayment schedule
                $this->createRepaymentSchedule($request);
            });

            $this->loadDashboardData();
            session()->flash('message', 'Loan request approved successfully!');
        }
    }

    public function rejectRequest($requestId)
    {
        $request = LoanRequest::find($requestId);
        if ($request) {
            $request->update(['status' => 'rejected']);

            $this->loadDashboardData();
            session()->flash('message', 'Loan request rejected.');
        }
    }



    public function createRepaymentSchedule($request)
    {
        $monthlyAmount = $request->amount / $request->repayment_months;
        $startDate = Carbon::now()->addMonth();

        for ($i = 0; $i < $request->repayment_months; $i++) {
            Repayment::create([
                'loan_id' => $request->id,
                'amount' => $monthlyAmount,
                'due_date' => $startDate->copy()->addMonths($i),
                'status' => 'pending'
            ]);
        }
    }

    public function markAsPaid($repaymentId)
    {
        $repayment = Repayment::find($repaymentId);
        if ($repayment) {
            $repayment->update([
                'status' => 'paid',
                'paid_date' => Carbon::now()
            ]);
            $this->loadDashboardData();
            session()->flash('message', 'Repayment marked as paid.');
        }
    }

    public function generateReport()
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now();

        switch ($this->reportType) {
            case 'monthly':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'quarterly':
                $startDate = Carbon::now()->startOfQuarter();
                $endDate = Carbon::now()->endOfQuarter();
                break;
            case 'yearly':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
        }

        $totalLoans = Loan::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $totalRepaid = Repayment::whereBetween('paid_date', [$startDate, $endDate])
            ->where('status', 'paid')
            ->sum('amount');

        $outstanding = $totalLoans - $totalRepaid;
        $totalRequests = LoanRequest::whereBetween('created_at', [$startDate, $endDate])->count();
        $defaulted = Repayment::where('status', 'pending')
            ->where('due_date', '<', Carbon::now()->subDays(30))
            ->count();
        $defaultRate = $totalRequests > 0 ? ($defaulted / $totalRequests) * 100 : 0;

        $this->reportData = [
            'total_loans' => $totalLoans,
            'total_repaid' => $totalRepaid,
            'outstanding' => $outstanding,
            'default_rate' => round($defaultRate, 2)
        ];
    }

    // Modal methods
    public function openLoanModal()
    {
        $this->showLoanModal = true;
        $this->resetLoanForm();
    }

    public function closeLoanModal()
    {
        $this->showLoanModal = false;
        $this->resetLoanForm();
    }

    public function openAdvanceModal()
    {
        $this->showAdvanceModal = true;
        $this->resetAdvanceForm();
    }

    public function viewAdvancedetails($id){
      $this->showAdvanceDetailModal=true;
      $this->selectedAdvance=Advance::find($id);
    }
    public function closeAdvanceDetailModal(){
        $this->showAdvanceDetailModal=false;
    }
      public function openRequestModal($id)
    {
        $this->showRequestDetailModal = true;
        $this->selectedRequest=LoanRequest::find($id);
    }

    public function approveAdvance($id){
      $advancecheck=Advance::find($id);
      $advancecheck->status='active';
      $result=$advancecheck->save();
      $this->render();
      if($result){
        $this->updatedeductiontable($advancecheck);
        $this->dispatch('deductionstarted');
      }
    }

    public function updatedeductiontable($advancecheck){
        $advancededuct=new AdvanceDeduction();
        $advancededuct->advance_id=$advancecheck->id;
        $advancededuct->amount=$advancecheck->amount;
        $advancededuct->deduction_date=$advancecheck->deduction_start_date;
        $advancededuct->status='processed';
        $advancededuct->payroll_period=0;
        $advancededuct->processed_by=Auth::user()->id;
        $result=$advancededuct->save();


    }

    public function closeRequestDetailModal(){
        $this->showRequestDetailModal = false;
    }

    public function closeAdvanceModal()
    {
        $this->showAdvanceModal = false;
        $this->resetAdvanceForm();
    }

    public function resetLoanForm()
    {
        $this->loanForm = [
            'user_id' => '',
            'amount' => '',
            'type' => '',
            'purpose' => '',
            'repayment_months' => ''
        ];
    }

    public function resetAdvanceForm()
    {
        $this->advanceForm = [
            'user_id' => '',
            'amount' => '',
            'reason' => '',
            'deduction_start_date' => ''
        ];
    }

    public function submitLoan()
    {
        $this->validate([
            'loanForm.user_id' => 'required|exists:users,id',
            'loanForm.amount' => 'required|numeric|min:100',
            'loanForm.type' => 'required|string',
            'loanForm.purpose' => 'required|string|max:500',
            'loanForm.repayment_months' => 'required|integer|min:1|max:60'
        ]);

        LoanRequest::create([
            'user_id' => $this->loanForm['user_id'],
            'amount' => $this->loanForm['amount'],
            'type' => $this->loanForm['type'],
            'purpose' => $this->loanForm['purpose'],
            'repayment_months' => $this->loanForm['repayment_months'],
            'status' => 'pending',
            'requested_by' => Auth::user()->id
        ]);

        $this->closeLoanModal();
        $this->loadDashboardData();
        $this->render();
        session()->flash('message', 'Loan application submitted successfully!');
    }

    public function submitAdvance()
    {
        $this->validate([
            'advanceForm.user_id' => 'required|exists:users,id',
            'advanceForm.amount' => 'required|numeric|min:50',
            'advanceForm.reason' => 'required|string|max:500',
            'advanceForm.deduction_start_date' => 'required|date|after:today'
        ]);

        Advance::create([
            'user_id' => $this->advanceForm['user_id'],
            'amount' => $this->advanceForm['amount'],
            'reason' => $this->advanceForm['reason'],
            'deduction_start_date' => $this->advanceForm['deduction_start_date'],
            'status' => 'pending',
            'processed_by' => Auth::user()->id,
            'processed_at' => Carbon::now()
        ]);

        $this->closeAdvanceModal();
        $this->loadDashboardData();
        session()->flash('message', 'Advance payment processed successfully!');
    }

    public function viewRequest($requestId)
    {

        // Implement view request functionality
        $this->dispatch('openRequestModal', $requestId);
    }

    public function viewAdvance($advanceId)
    {
        // Implement view advance functionality
        $this->dispatch('openAdvanceModal', $advanceId);
    }

    public function viewRepayment($repaymentId)
    {
        // Implement view repayment functionality
        $this->dispatch('openRepaymentModal', $repaymentId);
    }
    public $repaymentForm = [
    'loan_id' => '',
    'amount' => '',
    'payment_date' => '',
    'payment_method' => '',
    'reference_number' => '',
    'notes' => ''
];

// Add these methods to your component class:

public function openRepaymentModal($id)
{
    $this->showRepaymentDetailModal = true;
    $this->selectedRepayment=Repayment::find($id);
    $this->resetRepaymentForm();
}

public function openRepaymentNewModal(){

}

public function closeRepaymentModal()
{
    $this->showRepaymentDetailModal = false;
    $this->resetRepaymentForm();
}

public function resetRepaymentForm()
{
    $this->repaymentForm = [
        'loan_id' => '',
        'amount' => '',
        'payment_date' => '',
        'payment_method' => '',
        'reference_number' => '',
        'notes' => ''
    ];
}

public function submitRepayment()
{
    $this->validate([
        'repaymentForm.loan_id' => 'required|exists:loans,id',
        'repaymentForm.amount' => 'required|numeric|min:0.01',
        'repaymentForm.payment_date' => 'required|date',
        'repaymentForm.payment_method' => 'required|string',
        'repaymentForm.reference_number' => 'nullable|string|max:100',
        'repaymentForm.notes' => 'nullable|string|max:500'
    ]);

    DB::transaction(function () {
        // Create repayment record
        $repayment = Repayment::create([
            'loan_id' => $this->repaymentForm['loan_id'],
            'amount' => $this->repaymentForm['amount'],
            'payment_date' => $this->repaymentForm['payment_date'],
            'payment_method' => $this->repaymentForm['payment_method'],
            'reference_number' => $this->repaymentForm['reference_number'],
            'notes' => $this->repaymentForm['notes'],
            'status' => 'paid',
            'paid_at' => $this->repaymentForm['payment_date'],
            'processed_by' => Auth::user()->id
        ]);

        // Update loan balance or status if fully paid
        $loan = Loan::find($this->repaymentForm['loan_id']);
        $totalPaid = $loan->repayments()->where('status', 'paid')->sum('amount');

        if ($totalPaid >= $loan->amount) {
            $loan->update(['status' => 'completed']);
        }
    });

    $this->closeRepaymentModal();
    $this->loadDashboardData();
    session()->flash('message', 'Repayment recorded successfully!');
}

public function getActiveLoans()
{
    return Loan::with('user')
        ->where('status', 'active')
        ->get();
}

// Update the render method to include activeLoans:
public function render()
{
    $data = [
        'loanRequests' => $this->getLoanRequests(),
        'advances' => $this->getAdvances(),
        'repayments' => $this->getRepayments(),
        'users' => User::where('role', '!=', 'admin')->get(),
        'activeLoans' => $this->getActiveLoans()
    ];
    return view('livewire.admin.dashboard.dep.humanresource.loanadvance.loanadvancedashboard', $data)
        ->layout('livewire.admin.dashboard.layout.master');
}
}
