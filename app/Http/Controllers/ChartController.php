<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ChartController extends Controller
{
    /**
     * Display the sales chart with filtered data.
     */
    public function showChart(Request $request)
    {
        // Default: Fetch data for the current month
        $startDate = $request->start_date ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        // Jika hanya satu tanggal yang dipilih, pastikan filter mencakup tanggal tersebut
        if ($startDate == $endDate) {
            $endDate = Carbon::parse($startDate)->endOfDay()->format('Y-m-d H:i:s'); // Set endDate ke akhir hari
        } else {
            $endDate = Carbon::parse($endDate)->endOfDay()->format('Y-m-d H:i:s'); // Set endDate ke akhir hari untuk rentang tanggal
        }

        // Query orders dengan rentang tanggal yang telah diatur
        $orders = Order::query()
            ->with('details.product.category') // Include related data
            ->whereBetween('created_at', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
            ->when($request->search, function ($query) use ($request) {
                // Search berdasarkan nama customer
                $query->where('customer', 'like', '%' . $request->search . '%');
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get();

        // Pass data ke view
        return view('chart', [
            'orders' => $orders,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
