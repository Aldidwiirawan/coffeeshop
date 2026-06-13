<x-layout>
    <x-slot:title>Tambah Product</x-slot:title>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option>Belum ada kategori</option>
                                    @endforelse
                                </select>
                            </div>
                            <x-text-input label="Nama" name="name" placeholder="Masukkan nama produk"
                                value="{{ old('name') }}"></x-text-input>
                            <x-text-input label="Harga" name="price" type="number"
                                placeholder="Masukkan harga produk" value="{{ old('price') }}"></x-text-input>
                            <x-text-input label="Stok" name="stok" type="number"
                                placeholder="Masukkan jumlah stok produk" value="{{ old('stok') }}"></x-text-input>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="image" name="image"
                                    accept="image/jpeg, image/png">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
