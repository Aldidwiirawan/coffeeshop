<x-layout>
    <x-slot:title>Edit Order</x-slot:title>

    <div class="container mt-4">
        <div class="card p-4">
            <div class="card-header bg-dark text-white rounded">
                <h5 class="mb-0">Edit Order #{{ $order->id }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer Name</label>
                        <input type="text" class="form-control" value="{{ $order->customer }}" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Payment</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($order->payment) }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Total</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($order->total) }}" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Order Status</label>
                        <select class="form-select" name="status" required>
                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
