<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h2 class="me-3 fw-bold text-primary">Asset Management</h2>
            <div class="input-group search-box" style="width: 300px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Search assets...">
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                <i class="bi bi-plus-circle me-2"></i>Add Asset
            </button>
            <livewire:admin.dashboard.notifylayout />
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card summary-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Asset Value</h6>
                            <h3 class="card-title fw-bold">$1,245,678</h3>
                        </div>
                        <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-white text-primary">+12.5% from last month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Assets Count</h6>
                            <h3 class="card-title fw-bold">1,287</h3>
                        </div>
                        <i class="bi bi-box-seam fs-1 opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-white text-success">+8 new this week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Depreciating</h6>
                            <h3 class="card-title fw-bold">$245,320</h3>
                        </div>
                        <i class="bi bi-graph-down fs-1 opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-white text-warning">5.2% annual rate</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Maintenance Due</h6>
                            <h3 class="card-title fw-bold">24</h3>
                        </div>
                        <i class="bi bi-tools fs-1 opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-white text-info">3 critical</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row">
        <!-- Asset List Table -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Assets</h5>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="bi bi-filter me-1"></i> Filter
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Asset ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#AST-1001</td>
                                    <td>Office Building A</td>
                                    <td>Real Estate</td>
                                    <td>$450,000</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Downtown</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#AST-1002</td>
                                    <td>Company Vehicles</td>
                                    <td>Transportation</td>
                                    <td>$120,000</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Main Garage</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#AST-1003</td>
                                    <td>Server Rack</td>
                                    <td>IT Equipment</td>
                                    <td>$85,000</td>
                                    <td><span class="badge bg-warning text-dark">Maintenance</span></td>
                                    <td>Data Center</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#AST-1004</td>
                                    <td>Office Furniture</td>
                                    <td>Furniture</td>
                                    <td>$65,000</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>All Floors</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#AST-1005</td>
                                    <td>Manufacturing Equipment</td>
                                    <td>Machinery</td>
                                    <td>$525,678</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Factory Floor</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <div>Showing 1 to 5 of 1,287 entries</div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Charts and Quick Actions -->
        <div class="col-lg-4">
            <!-- Asset Value Distribution Pie Chart -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Asset Value Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 250px;">
                        <!-- Chart would be rendered here with Chart.js or similar -->
                        <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height: 100%;">
                            <p class="text-muted">Pie chart visualization</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span><span class="badge bg-primary me-2">&nbsp;</span> Real Estate</span>
                            <span class="fw-bold">42%</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><span class="badge bg-success me-2">&nbsp;</span> Machinery</span>
                            <span class="fw-bold">32%</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><span class="badge bg-warning me-2">&nbsp;</span> IT Equipment</span>
                            <span class="fw-bold">12%</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span><span class="badge bg-info me-2">&nbsp;</span> Other</span>
                            <span class="fw-bold">14%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-outline-primary w-100 mb-2 text-start">
                        <i class="bi bi-file-earmark-text me-2"></i> Generate Asset Report
                    </button>
                    <button class="btn btn-outline-success w-100 mb-2 text-start">
                        <i class="bi bi-arrow-down-up me-2"></i> Record Asset Transfer
                    </button>
                    <button class="btn btn-outline-warning w-100 mb-2 text-start">
                        <i class="bi bi-tools me-2"></i> Schedule Maintenance
                    </button>
                    <button class="btn btn-outline-danger w-100 text-start">
                        <i class="bi bi-trash me-2"></i> Dispose Asset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Asset Modal -->
<div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAssetModalLabel">Add New Asset</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="assetName" class="form-label">Asset Name</label>
                            <input type="text" class="form-control" id="assetName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="assetCategory" class="form-label">Category</label>
                            <select class="form-select" id="assetCategory" required>
                                <option value="">Select Category</option>
                                <option>Real Estate</option>
                                <option>Machinery</option>
                                <option>IT Equipment</option>
                                <option>Furniture</option>
                                <option>Vehicles</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="assetValue" class="form-label">Value ($)</label>
                            <input type="number" class="form-control" id="assetValue" required>
                        </div>
                        <div class="col-md-6">
                            <label for="purchaseDate" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" id="purchaseDate" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="assetLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="assetLocation" required>
                        </div>
                        <div class="col-md-6">
                            <label for="assetCondition" class="form-label">Condition</label>
                            <select class="form-select" id="assetCondition" required>
                                <option value="">Select Condition</option>
                                <option>New</option>
                                <option>Good</option>
                                <option>Fair</option>
                                <option>Poor</option>
                                <option>Needs Repair</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="assetDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="assetDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="assetImage" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" id="assetImage">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Asset</button>
            </div>
        </div>
    </div>

    </div>

</div>
