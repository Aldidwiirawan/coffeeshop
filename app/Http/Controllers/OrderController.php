<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Query order dengan scope dari model
        $orders = Order::with(['details.product'])
            ->search($request->search) // 🔹 Panggil scope pencarian
            ->dateRange($request->start_date, $request->end_date) // 🔹 Panggil scope tanggal
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed,Canceled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    public function destroy(Order $order)
    {
        // Menghapus detail order jika ada
        $order->details()->delete();

        // Menghapus order
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
