<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .total {
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Laporan Penjualan</h1>
    <h2>Period: {{ $validated['start_date'] }} to {{ $validated['end_date'] }}</h2>

    <!-- Tabel Data Penjualan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Payment</th>
                <th>Total</th>
                <th>User</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSales = 0;
            @endphp

            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ number_format($order->payment) }}</td>
                    <td>{{ number_format($order->total) }}</td>
                    <td>{{ $order->user->name ?? 'Unknown User' }}</td>
                    <td>{{ $order->formatted_created_at }}</td>
                </tr>
                @php
                    $totalSales += $order->total;
                @endphp
            @endforeach
        </tbody>
    </table>

    <!-- Total Penjualan -->
    <div class="total">
        <strong>Total Penjualan: Rp{{ number_format($totalSales) }}</strong>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
