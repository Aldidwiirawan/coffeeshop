<x-layout>
    <x-slot:title>Laporan Penjualan</x-slot:title>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistik Penjualan -->
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Products Terjual</h5>
                        <h1 class="fw-bold text-success">{{ number_format($productsSold) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Pendapatan</h5>
                        <h1 class="fw-bold text-primary">{{ number_format($revenue) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Orders</h5>
                        <h1 class="fw-bold text-info">{{ number_format($ordersCount) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Products</h5>
                        <h1 class="fw-bold text-warning">{{ number_format($productsCount) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Filter -->
        <div class="d-flex mb-2 justify-content-between">
            <form class="d-flex gap-2 mb-4" method="get">
                <input type="date" class="form-control" name="start_date" value="{{ request()->start_date }}">
                <input type="date" class="form-control" name="end_date" value="{{ request()->end_date }}">
                <input type="text" class="form-control" name="customer" placeholder="Cari Customer"
                    value="{{ request()->customer }}">
                <input type="text" class="form-control" name="product" placeholder="Cari Produk"
                    value="{{ request()->product }}">
                <button type="submit" class="btn btn-dark">Filter</button>
            </form>

            <!-- Button to go to the chart page -->
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('chart', ['start_date' => request()->start_date, 'end_date' => request()->end_date, 'search' => request()->search]) }}"
                    class="btn btn-dark">Lihat Chart Penjualan</a>
                <a href="{{ route('download', [
                    'start_date' => request()->start_date ?? date('Y-m-01'),
                    'end_date' => request()->end_date ?? date('Y-m-d'),
                ]) }}"
                    class="btn btn-dark">
                    Download PDF
                </a>
            </div>
        </div>

        <!-- Tabel Laporan Penjualan -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Kembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer }}</td>
                                <td>{{ $order->formatted_created_at }}</td>
                                <td>
                                    <ul>
                                        @foreach ($order->details as $detail)
                                            <li>{{ $detail->product->category->name ?? 'Kategori tidak ditemukan' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-end">Rp{{ number_format($order->total) }}</td>
                                <td class="text-end">Rp{{ number_format($order->payment) }}</td>
                                <td class="text-end">Rp{{ number_format($order->payment - $order->total) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data penjualan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between">
            <div>{{ $orders->links() }}</div>
            <div>Total Data: {{ $orders->total() }}</div>
        </div>
    </div>
</x-layout>
