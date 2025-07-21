<div>
    @if ($openreceiptmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
     <div class="modal-dialog modal-lg modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title">View Payment Details</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-4">
                     <div class="col-md-6">
                         <div class="card h-100">
                             <div class="card-header bg-light">
                                 <h6 class="card-title">Basic Information</h6>
                             </div>
                             <div class="card-body">
                                 <div class="mb-3">
                                     <label class="form-label">ID:</label>
                                     <p class="form-control-static">PAY-{{ $payId ?? 'Not Found' }}</p>
                                 </div>


                                 <div class="mb-3">
                                     <label class="form-label">Customer:</label>
                                     <p class="form-control-static">{{ $customer ?? 'Customer Name' }}</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="card h-100">
                             <div class="card-header bg-light">
                                 <h6 class="card-title">Payment Details</h6>
                             </div>
                             <div class="card-body">
                                 <div class="mb-3">
                                     <label class="form-label">Invoice Number:</label>
                                     <p class="form-control-static">{{ $invoice_no ?? '00123' }}</p>
                                 </div>
                                 <div class="mb-3">
                                     <label class="form-label">Payment Type:</label>
                                     <p class="form-control-static badge bg-info">{{ ucfirst($type ?? 'cheque') }}</p>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="row mb-4">
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-header bg-light">
                                 <h6 class="card-title">Amount Details</h6>
                             </div>
                             <div class="card-body">

                                 <div class="mb-3">
                                     <label class="form-label">Paid Amount:</label>
                                     <p class="form-control-static">LKR {{ number_format($paid_amount ?? 1000.00, 2) }}</p>
                                 </div>
                                 <div class="mb-3">
                                     <label class="form-label">Balance to be Paid:</label>
                                     <p class="form-control-static">LKR {{ number_format($to_be_paid ?? 500.00, 2) }}</p>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>

                 <div class="row">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label">Created At:</label>
                             <p class="form-control-static">{{ $created_at ?? now()->subDays(2)->format('Y-m-d H:i:s') }}</p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label">Last Updated:</label>
                             <p class="form-control-static">{{ $updated_at ?? now()->format('Y-m-d H:i:s') }}</p>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                 <button type="button" class="btn btn-primary" onclick="printReceipt();">Print Receipt</button>
             </div>
         </div>
     </div>
 </div>
    @endif

     <div id="receipt-content" style="display: none;">
        <div style="max-width: 400px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
            <div style="text-align: center; margin-bottom: 20px;">
                <h2 style="margin: 0;">NEO</h2>
                <p style="margin: 5px 0 0; font-size: 16px;">Payment Receipt</p>
                <hr style="border-top: 1px dashed #000; margin: 10px 0;">
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <div><strong>Receipt No:</strong> PAY-{{ $payId ?? 'N/A' }}</div>
                <div><strong>Date:</strong> {{ now()->format('Y-m-d') }}</div>
            </div>

            <div style="margin-bottom: 15px;">
                <div><strong>Customer:</strong> {{ $customer ?? 'Customer Name' }}</div>
                <div><strong>Invoice No:</strong> {{ $invoice_no ?? 'N/A' }}</div>

            </div>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <thead>
                    <tr>
                        <th style="border-bottom: 1px solid #000; text-align: left; padding: 5px;">Description</th>
                        <th style="border-bottom: 1px solid #000; text-align: right; padding: 5px;">Amount (LKR)</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="padding: 5px;">Paid Amount</td>
                        <td style="text-align: right; padding: 5px;">{{ number_format($paid_amount ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;"><strong>Balance</strong></td>
                        <td style="text-align: right; padding: 5px;"><strong>{{ number_format($to_be_paid ?? 0, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>

            @if($type == 'cheque')
            <div style="margin-bottom: 15px;">
                <div><strong>Payment Method:</strong> Cheque</div>
                <div><strong>Cheque No:</strong> {{ $cheque_number ?? 'N/A' }}</div>
                <div><strong>Bank:</strong> {{ $bank_name ?? 'N/A' }}</div>
                <div><strong>Cheque Date:</strong> {{ $cheque_date ?? 'N/A' }}</div>
            </div>
            @else
            <div style="margin-bottom: 15px;">
                <strong>Payment Method:</strong> {{ ucfirst($type ?? 'other') }}
            </div>
            @endif

            <div style="text-align: center; margin-top: 30px; padding-top: 10px; border-top: 1px dashed #000;">
                <p style="margin: 5px 0;">Thank you for your payment!</p>
                <p style="margin: 5px 0; font-weight: bold;">NEO</p>
            </div>
        </div>
    </div>

    <!-- Print receipt script -->
    <script>
        function printReceipt() {
            // Get the receipt content
            const receiptContent = document.getElementById('receipt-content').innerHTML;

            // Open a new window and write the receipt content
            const printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Payment Receipt - NEO</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
                            @media print {
                                @page { size: auto; margin: 5mm; }
                            }
                        </style>
                    </head>
                    <body onload="window.print(); window.close();">
                        ${receiptContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
        }
    </script>
</div>
