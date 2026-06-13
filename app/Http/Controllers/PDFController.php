<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;


class PDFController extends Controller
{
    public function download(Request $request)
    {
        // Validate the date inputs
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Select all data from Order
        $orders = Order::all();

        // Generate the PDF from the view
        $pdf = Pdf::loadView('download', compact('orders', 'validated'));

        // Download the PDF
        return $pdf->download('laporan_penjualan.pdf');
    }
}
