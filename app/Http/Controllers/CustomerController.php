<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function menu()
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Kirimkan produk ke tampilan
        return view('customer.menu.home-menu', compact('products'));
    }

    public function catalog(Request $request)
    {
        if (!session('order')) {
            $order = new Order();
            $order->customer = '-';

            // Pastikan user sudah login sebelum mengakses ID
            if (auth()->check()) {
                $order->user_id = auth()->user()->id;
            } else {
                $order->user_id = null; // Bisa diubah sesuai kebutuhan
            }

            session(['order' => $order]);
        }

        // Hanya mengambil kategori yang aktif
        $categories = Category::query()->where('active', 1)->get();

        // Query produk berdasarkan kategori yang aktif
        $productsQuery = Product::query()->whereHas('category', function ($query) {
            $query->where('active', 1);
        });

        if ($request->category_id) {
            $productsQuery->where('category_id', $request->category_id);
        }

        if ($request->search) {
            $productsQuery->where('name', 'like', "%{$request->search}%");
        }

        $products = $productsQuery->get();

        return view('customer.menu.catalog', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function checkout(Request $request)
    {
        $cartData = json_decode($request->cart_data, true);
        if (!$cartData || count($cartData) === 0) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja kosong!');
        }

        $user = auth()->user(); // Ambil user yang login

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $order = new Order();
        $order->user_id = $user->id;

        $order = new Order();
        $order->user_id = $user->id;
        $order->customer = $user->name; // Pastikan menyimpan nama user
        $order->total = collect($cartData)->sum(fn($item) => $item['price'] * $item['quantity']);
        $order->status = 'pending';
        $order->save();

        foreach ($cartData as $item) {
            $order->details()->create([
                'product_id' => $item['id'],
                'qty' => $item['quantity'],
                'price' => $item['price'],
                'active' => 1, 
            ]);
        }

        return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat!');
    }

}
