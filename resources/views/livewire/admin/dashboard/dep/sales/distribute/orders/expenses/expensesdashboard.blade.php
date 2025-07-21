<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

        <div class="dashboard-container">
            <!-- Header Section -->
            <div class="dashboard-header">
                <div class="header-left">
                    <h1 class="page-title">Expenses Management-DO</h1>
                    <nav class="breadcrumbs">

                        <span class="divider"></span>
                        <span class="current">Expenses Dashboard - DO {{ $doNo ?? 'N/A' }}</span>
                    </nav>
                </div>
                <div class="header-right">

                    <livewire:admin.dashboard.notifylayout />
                </div>
            </div>
            <hr>

            <div class="dashboard-container">
  <!-- Header Section -->
  <header class="dashboard-header">
    <h1>Expenses Management</h1>
    <div class="header-actions">
      <button class="btn btn-primary"  wire:click="addexpenses">
        <i class="fas fa-plus"></i> Add Expense
      </button>

    </div>
  </header>

  <!-- Summary Cards -->
  <div class="summary-cards">
    <div class="card">
      <div class="card-body">
        <h5>Total Spent</h5>
      <h2>LKR&nbsp;{{ number_format($total ?? 0, 2) }}</h2>


      </div>
      <div class="card-icon bg-primary">
        <i class="fas fa-wallet"></i>
      </div>
    </div>




  </div>

  <!-- Main Content -->
  <div class="dashboard-content">
    <!-- Expenses Table -->
    <div class="card table-card">
      <div class="card-header">
        <h3>Recent Expenses</h3>
        <div class="table-actions">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search expenses..." wire:model.live="search">
          </div>

        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="expenses-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Reported By</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
             @if ($expensesRecord)
                 @foreach ($expensesRecord as $record)
                    <tr>
                <td>{{ $record->date ?? 'N/A' }}</td>
                <td>{{ $record->note ?? 'N/A' }}</td>
                <td class="text-danger">LKR&nbsp;{{ $record->amount ?? '0.00' }}</td>
                 <td class="text-danger">{{ $record->userData->name ?? 'N/A' }}</td>
                <td>
                  <button class="btn-icon" wire:click='deleterecord({{ $record->id }})'><i class="fas fa-trash"></i></button>
                </td>
              </tr>
                 @endforeach
             @endif



            </tbody>

          </table>
        </div>
      </div>
   <div class="card-footer">
    <div class="d-flex justify-content-between align-items-center">
        {{ $expensesRecord->links() }}
    </div>
</div>

    </div>

    <!-- Add Expense Modal (hidden by default) -->
    <div class="modal" id="add-expense-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Add New Expense</h3>
          <button class="btn-icon close-modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="expense-form">
            <div class="form-group">
              <label for="expense-amount">Amount</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" id="expense-amount" class="form-control" placeholder="0.00" step="0.01" required>
              </div>
            </div>

            <div class="form-group">
              <label for="expense-description">Description</label>
              <input type="text" id="expense-description" class="form-control" placeholder="What was this expense for?" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="expense-category">Category</label>
                <select id="expense-category" class="form-control" required>
                  <option value="">Select a category</option>
                  <option value="food">Food</option>
                  <option value="transport">Transportation</option>
                  <option value="business">Business</option>
                  <option value="entertainment">Entertainment</option>
                  <option value="education">Education</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="expense-date">Date</label>
                <input type="date" id="expense-date" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label for="expense-method">Payment Method</label>
              <select id="expense-method" class="form-control" required>
                <option value="">Select payment method</option>
                <option value="cash">Cash</option>
                <option value="credit-card">Credit Card</option>
                <option value="debit-card">Debit Card</option>
                <option value="bank-transfer">Bank Transfer</option>
                <option value="paypal">PayPal</option>
              </select>
            </div>

            <div class="form-group">
              <label for="expense-receipt">Receipt (optional)</label>
              <input type="file" id="expense-receipt" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-secondary close-modal">Cancel</button>
          <button class="btn btn-primary" type="submit" form="expense-form">Save Expense</button>
        </div>
      </div>
    </div>
  </div>
</div>
<livewire:admin.dashboard.dep.sales.distribute.orders.expenses.modal.addexpensesmodal/>
<!-- CSS Styles (would typically be in a separate file) -->
<style>
  :root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --info: #4895ef;
    --warning: #f8961e;
    --danger: #f72585;
    --light: #f8f9fa;
    --dark: #212529;
    --gray: #6c757d;
  }
   .back-button {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                background: none;
                border: none;
                color: #3b82f6;
                font-size: 0.875rem;
                cursor: pointer;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                transition: background-color 0.2s;
            }

            .back-button:hover {
                background-color: #e0e7ff;
            }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 0;
  }

  .dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
  }

  .dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
  }

  .dashboard-header h1 {
    font-size: 28px;
    font-weight: 600;
    color: var(--dark);
    margin: 0;
  }

  .header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .btn {
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-primary {
    background-color: var(--primary);
    color: white;
  }

  .btn-primary:hover {
    background-color: var(--secondary);
  }

  .btn-outline-secondary {
    background-color: transparent;
    border: 1px solid var(--gray);
    color: var(--gray);
  }

  .btn-outline-secondary:hover {
    background-color: #e9ecef;
  }

  .btn-sm {
    padding: 5px 10px;
    font-size: 14px;
  }

  .btn-icon {
    background: none;
    border: none;
    color: var(--gray);
    cursor: pointer;
    padding: 5px;
    font-size: 16px;
  }

  .btn-icon:hover {
    color: var(--dark);
  }

  .profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
  }

  .summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
  }

  .card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
  }

  .card-body {
    padding: 20px;
  }

  .card h5 {
    font-size: 14px;
    color: var(--gray);
    margin: 0 0 5px 0;
    font-weight: 500;
  }

  .card h2 {
    font-size: 28px;
    margin: 0 0 5px 0;
    color: var(--dark);
  }

  .card-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
  }

  .bg-primary { background-color: var(--primary); }
  .bg-success { background-color: var(--success); }
  .bg-info { background-color: var(--info); }
  .bg-warning { background-color: var(--warning); }
  .bg-danger { background-color: var(--danger); }

  .table-card {
    margin-bottom: 30px;
  }

  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
  }

  .card-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
  }

  .table-actions {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .search-box {
    position: relative;
  }

  .search-box i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
  }

  .search-box input {
    padding: 8px 15px 8px 35px;
    border-radius: 6px;
    border: 1px solid #ced4da;
    font-size: 14px;
    width: 200px;
  }

  .expenses-table {
    width: 100%;
    border-collapse: collapse;
  }

  .expenses-table th {
    text-align: left;
    padding: 12px 15px;
    font-weight: 600;
    color: var(--gray);
    font-size: 14px;
    border-bottom: 1px solid #e9ecef;
  }

  .expenses-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
  }

  .expenses-table tr:hover {
    background-color: #f8f9fa;
  }

  .badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    color: white;
  }

  .badge-primary { background-color: var(--primary); }
  .badge-success { background-color: var(--success); }
  .badge-info { background-color: var(--info); }
  .badge-warning { background-color: var(--warning); }
  .badge-danger { background-color: var(--danger); }

  .text-danger { color: var(--danger); }
  .text-muted { color: var(--gray); }

  .card-footer {
    padding: 15px 20px;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: center;
  }

  .pagination {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .pagination span {
    font-size: 14px;
    color: var(--gray);
  }

  /* Modal Styles */


  .modal-content {
    background-color: white;

    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }



  .form-group {
    margin-bottom: 20px;
  }

  .form-row {
    display: flex;
    gap: 15px;
  }

  .form-row .form-group {
    flex: 1;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 14px;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 14px;
  }

  .input-group {
    display: flex;
  }

  .input-group-text {
    padding: 10px;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-right: none;
    border-radius: 6px 0 0 6px;
  }

  .input-group .form-control {
    border-radius: 0 6px 6px 0;
    border-left: none;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .summary-cards {
      grid-template-columns: 1fr;
    }

    .table-actions {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }

    .search-box input {
      width: 100%;
    }

    .form-row {
      flex-direction: column;
      gap: 0;
    }
  }
</style>
<script>

   window.addEventListener('expensesadded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'New Expenses record added successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
         window.addEventListener('expensesdeleted', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Expenses deleted successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });


        window.addEventListener('expensesadderror', function() {


            Swal.fire({
                icon: 'error', // Change icon to 'error' instead of 'success'
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
    </div>
</div>
