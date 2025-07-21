<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Purchase Order Confirmation </title>
    <style>
        body {
            background-color: #ffffff;
            font-family: "Alata", sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            width: 100px;
            height: 100px;
        }
        .company-details {
            text-align: right;
            margin-top: 20px;
        }
        .company-details p {
            font-size: 14px;
            margin: 5px 0;
        }
        .company-details .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .company-details .company-contact {
            color: #666;
        }
        .note {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice">
        <div class="header">
            <div>
                <!-- Supplier Logo -->
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTllVwrsAPH55qj4qPWvcOA3Nc-R4GP67NYGQ&s" alt="BTS">
            </div>
            <div class="company-details" style="padding-right: 20px;">
                <p class="company-name">Nestchem Lanka Holdings Pvt Ltd</p>
                <p class="company-contact">info.nestchem@gmail.com</p>
                <p class="company-contact">No.188,Malwana Rd,thiththapaththara,<br> Hanwella, Sri Lanka</p>
                <p class="company-contact">+94-71 914 4144</p>

            </div>
        </div>

        <table>
            <tr>
                <td>
                    <p class="font-bold text-gray-800">Supplier:</p>
                    @if ($order)
                    <p class="text-gray-500">
                        {{ $order->contact_person->contact_person ?? 'Not Updated' }}<br />
                        {{ $order->contact_person->address ?? 'Not Updated' }}
                    </p>
                    <p class="text-gray-500"> {{ $order->contact_person->email ?? 'Not Updated' }}</p>
                    @endif
                </td>
                <td align="right">
                  @if ($order)
                      <p>Order Number: <span class="text-gray-500">{{ $order->order_no }}</span></p>
                      <p>Order Date: <span class="text-gray-500"> {{ \Carbon\Carbon::parse($order->date)->format('Y M d h.i A') ?? 'Not Updated' }}</span></p>
                      <p>Delivery Date: <span class="text-gray-500"> {{ \Carbon\Carbon::parse($order->received_date)->format('Y M d h.i A') ?? 'Not Updated' }}</span></p>
                  @endif
                </td>
            </tr>
        </table>

        <p class="note">Order Received: Please confirm the details below for further processing of the goods.</p>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>LKR {{ number_format($item->unit_price, 2, '.', ',') }}</td>
                        <td>{{ $item->discount }} %</td>
                        <td>LKR {{ number_format($item->amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Total Amount</strong></td>
                    <td><strong>LKR {{ number_format($order->total, 2, '.', ',') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            Thank you for your business. Please verify all the information and confirm the receipt of the items.
        </div>
    </div>
</body>
</html>
