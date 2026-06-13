<x-layout>
    <x-slot:title>Orders</x-slot:title>

    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger:hover {
            background: #b30000;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background 0.3s ease-in-out;
        }
    </style>

    <div class="container mt-4">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        <div class="card p-3">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded">
                <h5 class="mb-0">Order List</h5>
            </div>

            <div class="card-body">
                <div class="d-flex mb-3 justify-content-between align-items-center">
                    <form class="d-flex align-items-center gap-2" method="get">
                        <input type="date" class="form-control w-auto" name="start_date" value="{{ request()->start_date ?? date('Y-m-01') }}">
                        <input type="date" class="form-control w-auto" name="end_date" value="{{ request()->end_date ?? date('Y-m-d') }}">
                        <input type="text" class="form-control shadow-sm" placeholder="Cari order..." name="search" value="{{ request()->search }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Payment</th>
                                <th>Total</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>Order #{{ $order->id }}</td>
                                    <td>{{ $order->customer }}</td>
                                    <td>Rp {{ number_format($order->payment) }}</td>
                                    <td>Rp {{ number_format($order->total) }}</td>
                                    <td>{{ $order->user->name ?? 'Unknown User' }}</td>
                                    <td>
                                        <span class="badge
                                            {{ $order->status == 'Pending' ? 'bg-warning' : '' }}
                                            {{ $order->status == 'Processing' ? 'bg-primary' : '' }}
                                            {{ $order->status == 'Completed' ? 'bg-success' : '' }}
                                            {{ $order->status == 'Canceled' ? 'bg-danger' : '' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="d-flex justify-content-center gap-2">
                                        @if ($order->status == 'Completed' || $order->status == 'Selesai')
                                            <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-primary">View</a>
                                        @endif

                                        <a href="{{ route('orders.edit', ['order' => $order->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus order ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No orders available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#table-orders').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 15, 20],
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "zeroRecords": "No records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Search:",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>
</x-layout>
