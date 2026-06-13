<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function penjualan(Request $request)
    {
        // Data untuk ringkasan laporan
        $productsSold = OrderDetail::query()->sum('qty');
        $revenue = Order::query()->sum('total');
        $ordersCount = Order::query()->count();
        $productsCount = Product::query()->count();

        // Filter dan data pesanan
        $orders = Order::with(['details.product' => function ($query) {
            $query->whereNotNull('name'); // Pastikan produk terkait ada
        }])
        ->when($request->start_date, function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->start_date);
        })
        ->when($request->end_date, function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->end_date);
        })
        ->when($request->customer, function ($query) use ($request) {
            return $query->where('customer', 'like', '%' . $request->customer . '%');
        })
        ->when($request->product, function ($query) use ($request) {
            return $query->whereHas('details', function ($query) use ($request) {
                return $query->whereHas('product', function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->product . '%');
                });
            });
        })
        ->orderByDesc('created_at')
        ->paginate(10);

        // Kirim data ke view
        return view('laporan.penjualan', [
            'productsSold' => $productsSold,
            'revenue' => $revenue,
            'ordersCount' => $ordersCount,
            'productsCount' => $productsCount,
            'orders' => $orders,
        ]);
    }
}
