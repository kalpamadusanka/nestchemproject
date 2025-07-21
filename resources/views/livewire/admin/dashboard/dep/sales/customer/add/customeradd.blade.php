<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

         <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Customer Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>

        <div class="container-fluid px-0 px-md-2" style="padding-top: 3%">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="mb-3 mb-md-0">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Add</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Add New Customer</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="submit">
                                <div class="row mb-3">
                                    <div class="col-md-3 position-relative">
                                        <label for="customer_name"
                                            class="form-label @error('customer_name') is-invalid @enderror">Customer/Company
                                            Name</label>
                                        <input type="text" wire:model.live="customer_name" class="form-control"
                                            id="customer_name" placeholder="Customer name">
                                    </div>


                                    <div class="col-md-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text"
                                            class="form-control @error('address') is-invalid @enderror" id="address"
                                            wire:model="address">
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text"
                                            class="form-control @error('contact_person') is-invalid @enderror"
                                            wire:model="contact_person" id="contact_person">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="form-label">Fax</label>
                                        <input type="text" class="form-control @error('fax') is-invalid @enderror"
                                            id="fax" wire:model="fax">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mobile" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            wire:model="email">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Phone</label>
                                        <div class="form-check">
                                            <input type="number"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" wire:model="phone">
                                        </div>
                                        <div class="form-check">
                                            <input type="number"
                                                class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile" wire:model="mobile">
                                        </div>
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="billing_address" class="form-label">Billing Address</label>
                                            <input type="text" class="form-control w-50"
                                                wire:model="billing_address" id="billing_address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="total" class="form-label">Vat Registration</label>
                                            <input type="text" class="form-control w-50" id="vat_no"
                                                wire:model="vat_no">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea class="form-control" id="note" rows="3" wire:model="note"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="signature-pad-container">
                                        <div class="signature-controls">
                                            <button class="btn-clear" id="clear_button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                                Clear
                                            </button>

                                        </div>
                                        <canvas id="signature_pad"></canvas>
                                        <input type="hidden" id="signature_data" wire:model="signatureData">
                                    </div>


                                </div>


                                <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"
                                    integrity="sha256-W+ivNvVjmQX6FTlF0S+SCDMjAuTVNKzH16+kQvRWcTg=" crossorigin="anonymous"></script>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success" id="finish_button">Save</button>

                                        <button class="btn btn-danger" type="reset">Cancel</button>
                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <livewire:admin.dashboard.dep.sales.do.modal.adddomodal />
    </div>

    <script>
        document.addEventListener("livewire:navigated", function() {
            var canvas = document.querySelector("#signature_pad");
            var signaturePad = new SignaturePad(canvas, {
                minWidth: 1,
                maxWidth: 2,
            });

            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                let storedData = signaturePad.toData();
                signaturePad.clear(); // otherwise isEmpty() might return incorrect value
                signaturePad.fromData(storedData);
            }

            window.addEventListener("resize", resizeCanvas);
            resizeCanvas();

            var clearButton = document.querySelector("#clear_button");
            clearButton.addEventListener("click", function() {
                signaturePad.clear();
            });

            var finishButton = document.querySelector("#finish_button");
            finishButton.addEventListener("click", function() {
                const svgDataUrl = signaturePad.toDataURL("image/svg+xml");
                @this.set('signatureData', svgDataUrl);
            });
        });
    </script>

    <style>
        /* Add responsive styles */
        @media (max-width: 767.98px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .card-header,
            .card-body {
                padding: 0.75rem;
            }

            .dataTables_filter {
                flex-direction: column !important;
            }

            .dataTables_filter label {
                width: 100% !important;
                margin-bottom: 0.5rem;
            }

            .dataTables_length select {
                width: 80px !important;
            }
        }

        @media (min-width: 768px) {
            .dataTables_filter {
                flex-direction: row !important;
                align-items: center;
            }
        }

        .signature-pad-container {
            position: relative;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }

        #signature_pad {
            width: 100%;
            height: 200px;
            border: 1px dashed #cbd5e0;
            border-radius: 4px;
            background-color: #f8fafc;
        }

        .signature-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .signature-instruction {
            color: #64748b;
            font-size: 0.875rem;
            font-style: italic;
        }

        .btn-clear {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #64748b;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-clear:hover {
            background: #f1f5f9;
            border-color: #cbd5e0;
        }

        .btn-clear svg {
            color: #ef4444;
        }

        .btn-finish {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #3b82f6;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 0.9375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-finish:hover {
            background: #2563eb;
        }

        .btn-finish:active {
            background: #1d4ed8;
        }

        .btn-finish svg {
            color: white;
        }
    </style>
    <script>
        window.addEventListener('errorcustomerAdded', function(event) {
            Swal.fire({
                icon: 'error', // Change icon to 'error' instead of 'success'
                title: 'error!',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 5000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('customerAdded', function() {
            var canvas = document.querySelector("#signature_pad");
            var signaturePad = new SignaturePad(canvas, {
                minWidth: 1,
                maxWidth: 2,
            });
            signaturePad.clear();
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'New customer added successfully',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>

</div>
