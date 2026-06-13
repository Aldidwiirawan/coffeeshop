<x-layout title="Order #{{ $order->id }}">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Order Details</h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Customer:</span>
                                <span class="text-muted">{{ $order->customer }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Date:</span>
                                <span class="text-muted">{{ $order->formatted_created_at }}</span>
                            </div>
                        </div>

                        <hr>

                        <h6 class="fw-bold">Order Items</h6>
                        <div class="list-group mb-3">
                            @foreach ($order->details as $detail)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold">{{ $detail->product ? $detail->product->name : 'Product not available' }}</span>
                                        <br>
                                        <small class="text-muted">{{ number_format($detail->qty) }} x Rp{{ number_format($detail->price) }}</small>
                                    </div>
                                    <span class="fw-bold">Rp{{ number_format($detail->qty * $detail->price) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold text-primary">Rp{{ number_format($order->total) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Payment:</span>
                                <span class="text-success">Rp{{ number_format($order->payment) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Change:</span>
                                <span class="text-danger">Rp{{ number_format($order->payment - $order->total) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center bg-light">
                        <a href="{{ route('orders.index') }}" class="btn btn-dark">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
