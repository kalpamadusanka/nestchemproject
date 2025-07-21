<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

        <div class="dashboard-container">
            <!-- Header Section -->
            <div class="dashboard-header">
                <div class="header-left">
                    <h1 class="page-title">DO Management</h1>
                    <nav class="breadcrumbs">

                        <span class="divider"></span>
                        <span class="current">Vehicle Dashboard - DO{{ $doNo ?? 'N/A' }}</span>
                    </nav>
                </div>
                <div class="header-right">
                    <button class="back-button" onclick="window.history.back()">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span>Back</span>
                    </button>
                    <livewire:admin.dashboard.notifylayout />
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div class="stat-info">
                        <h3>1,245 km</h3>
                        <p>Avg. Monthly Distance</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="bi bi-fuel-pump"></i>
                    </div>
                    <div class="stat-info">
                        <h3>8.2 L/100km</h3>
                        <p>Fuel Efficiency</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="stat-info">
                        <h3>2</h3>
                        <p>Active Issues</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Trips Today</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="content-grid">
                <!-- Trip Management Card -->
                <livewire:admin.dashboard.dep.sales.distribute.orders.vehicle.trip.tripmanage :doNo="$doNo" />
                <!-- Fuel Records Card -->
                <div class="content-card fuel-card">
                    <div class="card-header">
                        <h2>Fuel Management</h2>
                        <button class="btn-icon" wire:click="addfuelrecord">
                            <i class="bi bi-plus-lg"></i> Add Record
                        </button>
                    </div>
                    <livewire:admin.dashboard.dep.sales.distribute.orders.vehicle.fuel.fuelmanage :doNo="$doNo" />
                </div>


                <!-- Damage Reports Card -->
                <livewire:admin.dashboard.dep.sales.distribute.orders.vehicle.damage.damagemanage :doNo="$doNo" />
            </div>

            <!-- Modals -->
            <livewire:admin.dashboard.dep.sales.distribute.orders.vehicle.fuel.modal.fuelrecordmodal />


            <!-- Add Fuel Modal -->
            <div class="modal fade" id="addFuelModal" tabindex="-1" aria-hidden="true">
                <!-- Modal content would go here -->
            </div>

            <!-- Add Damage Modal -->
            <div class="modal fade" id="addDamageModal" tabindex="-1" aria-hidden="true">
                <!-- Modal content would go here -->
            </div>
        </div>

        <style>
            /* Modern Dashboard Styles */
            .dashboard-container {
                padding: 2rem;
                background-color: #f8fafc;
                min-height: 100vh;
            }

            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
            }

            .header-left {
                display: flex;
                flex-direction: column;
            }

            .page-title {
                font-size: 1.8rem;
                font-weight: 600;
                color: #1e293b;
                margin: 0;
            }

            .breadcrumbs {
                font-size: 0.875rem;
                color: #64748b;
                margin-top: 0.5rem;
            }

            .breadcrumbs a {
                color: #3b82f6;
                text-decoration: none;
            }

            .breadcrumbs .divider {
                margin: 0 0.5rem;
            }

            .header-right {
                display: flex;
                align-items: center;
                gap: 1rem;
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

            /* Stats Grid */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .stat-card {
                background: white;
                border-radius: 0.5rem;
                padding: 1.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .stat-icon {
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.25rem;
            }

            .bg-primary {
                background-color: #3b82f6;
            }

            .bg-success {
                background-color: #10b981;
            }

            .bg-warning {
                background-color: #f59e0b;
            }

            .bg-info {
                background-color: #06b6d4;
            }

            .stat-info h3 {
                font-size: 1.25rem;
                margin: 0;
                color: #1e293b;
            }

            .stat-info p {
                margin: 0.25rem 0 0;
                font-size: 0.875rem;
                color: #64748b;
            }

            /* Content Grid */
            .content-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            @media (min-width: 1024px) {
                .content-grid {
                    grid-template-columns: 2fr 1fr;
                }
            }

            .content-card {
                background: white;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .card-header {
                padding: 1.25rem 1.5rem;
                border-bottom: 1px solid #e2e8f0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .card-header h2 {
                font-size: 1.25rem;
                font-weight: 600;
                margin: 0;
                color: #1e293b;
            }

            .btn-icon {
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

            .btn-icon:hover {
                background-color: #e0e7ff;
            }

            /* Trip Form */
            .trip-form {
                padding: 1.5rem;
            }

            .form-row {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .form-group label {
                font-size: 0.875rem;
                color: #64748b;
                font-weight: 500;
            }

            .modern-select,
            .modern-input {
                padding: 0.5rem 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                transition: border-color 0.2s;
            }

            .modern-select:focus,
            .modern-input:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .form-actions {
                display: flex;
                gap: 1rem;
                margin-top: 1.5rem;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
                transition: all 0.2s;
            }

            .btn-primary {
                background-color: #3b82f6;
                color: white;
                border: none;
            }

            .btn-primary:hover {
                background-color: #2563eb;
            }

            .btn-secondary {
                background-color: white;
                color: #64748b;
                border: 1px solid #e2e8f0;
            }

            .btn-secondary:hover {
                background-color: #f8fafc;
                color: #3b82f6;
            }

            .btn-secondary:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            /* Fuel Table */
            .fuel-table {
                padding: 0 1.5rem 1.5rem;
            }

            .table-header {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                padding: 0.75rem 0;
                border-bottom: 1px solid #e2e8f0;
                font-size: 0.75rem;
                text-transform: uppercase;
                color: #64748b;
                font-weight: 600;
                letter-spacing: 0.05em;
            }

            .table-row {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                padding: 0.75rem 0;
                border-bottom: 1px solid #f1f5f9;
                font-size: 0.875rem;
                color: #334155;
            }

            /* Damage List */
            .damage-list {
                padding: 0 1.5rem 1.5rem;
            }

            .damage-item {
                display: flex;
                align-items: center;
                padding: 1rem 0;
                border-bottom: 1px solid #f1f5f9;
                gap: 1rem;
            }

            .damage-severity {
                width: 0.75rem;
                height: 0.75rem;
                border-radius: 50%;
            }

            .damage-severity.low {
                background-color: #10b981;
            }

            .damage-severity.medium {
                background-color: #f59e0b;
            }

            .damage-severity.high {
                background-color: #ef4444;
            }

            .damage-info h4 {
                font-size: 0.875rem;
                font-weight: 500;
                margin: 0;
                color: #1e293b;
            }

            .damage-info p {
                font-size: 0.75rem;
                margin: 0.25rem 0 0;
                color: #64748b;
            }

            .damage-status {
                font-size: 0.75rem;
                font-weight: 500;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                margin-left: auto;
            }

            .damage-status.pending {
                background-color: #fef3c7;
                color: #92400e;
            }

            .damage-status.resolved {
                background-color: #dcfce7;
                color: #166534;
            }
        </style>

        <script>
            // You can keep your existing event listeners
            window.addEventListener('productstocknotavailable', function(event) {
                Swal.fire({
                    icon: 'warning',
                    title: 'warning!',
                    text: 'The product you are looking for is currently not available on the shelf. Please check back later or contact a staff member for assistance.',
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true,
                    position: 'top-end'
                });
            });

            window.addEventListener('dovehiclerecordered', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'The Vehicle records are saved successfully!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });
            window.addEventListener('fuelRecordAdded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Fuel record has been successfully saved!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });

              window.addEventListener('damagerepdeleted', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Damage record has been deleted successfully!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });


            window.addEventListener('damagerecordAdded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Damage record has been successfully saved!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });
              window.addEventListener('fuelrecorddeleted', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Fuel record has been deleted successfully!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });

              window.addEventListener('recordAddFailed', function(event) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: event.detail.message || 'Something went wrong while saving the damage record.',
                     showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'


                });
            });

            window.addEventListener('fuelRecordFailed', function(event) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: event.detail.message || 'Something went wrong while saving the fuel record.',
                  showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });


            window.addEventListener('dovehicleendkmupdated', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Distance & End km records are saved successfully!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    </div>





</div>
