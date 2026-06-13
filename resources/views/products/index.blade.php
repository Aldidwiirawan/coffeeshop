<x-layout>
    <x-slot:title>Products</x-slot:title>
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success fade-in" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <form class="d-flex gap-2" method="get">
                <input type="text" class="form-control shadow-sm" placeholder="Cari produk..." name="search" value="{{ request()->search }}">
                <button type="submit" class="btn btn-primary shadow-sm hover-scale">Cari</button>
            </form>
            <a href="{{ route('products.create') }}" class="btn btn-success shadow-sm hover-scale">+ Tambah Produk</a>
        </div>

        <div class="card shadow-lg rounded-3 overflow-hidden fade-in">
            <table class="table table-hover align-middle m-0">
                <thead class="bg-gradient text-white">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="fade-in">
                            <td>
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="rounded shadow-sm hover-scale" style="width: 80px; height: 80px; object-fit: cover; transition: transform 0.3s ease-in-out;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning shadow-sm hover-scale">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm hover-scale">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4 fade-in">Belum ada produk yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.5s ease-in-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
        .bg-gradient {
            background: linear-gradient(135deg, #343a40, #212529);
        }
    </style>
</x-layout>
