<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function menu()
    {
        $products = Product::all(); // Ambil semua produk
        return view('customer.menu.home-menu', compact('products'));
    }

    public function catalog()
    {
        $products = Product::all(); // Ambil semua produk
        return view('customer.menu.catalog', compact('products'));
    }

     public function index(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $products = $query->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->where('active', 1)->get();

        return view('products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'image' => 'required|image'
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok; // Menyimpan jumlah stok
        $product->image = Storage::disk('public')->put('products', $request->image);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->where('active', 1)->get();

        return view('products.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|integer|min:0'
        ]);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok; // Memperbarui jumlah stok
        if ($request->image) {
            $product->image = Storage::disk('public')->put('products', $request->image);
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }


}
