<x-layout title="Orders">
    <div class="container mt-4">
        <div class="row">
            <!-- Product Selection -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">Pilih Produk</div>
                    <div class="card-body">
                        <form class="d-flex gap-2 mb-3" method="get">
                            <select name="category_id" id="category_id" class="form-control w-auto"
                                onchange="this.form.submit()">
                                <option value="">Semua kategori</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" class="form-control" name="search" placeholder="Cari produk" value="{{ request()->search }}">
                            <button type="submit" class="btn btn-dark">Cari</button>
                        </form>
                        <div class="row g-3">
                            @forelse ($products as $product)
                                <div class="col-md-4">
                                    <a href="{{ route('orders.create.detail', ['product' => $product->id]) }}" class="text-decoration-none">
                                        <div class="card product-card shadow-sm">
                                            <img src="{{ Storage::url($product->image) }}" class="card-img-top rounded-top" alt="{{ $product->name }}">
                                            <div class="card-body text-center">
                                                <h6 class="fw-bold">{{ $product->name }}</h6>
                                                <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                                <p class="mt-2 text-primary fw-bold">Rp{{ number_format($product->price) }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col text-center">Belum ada produk</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <form id="checkoutForm" class="card shadow-sm" method="post" action="{{ route('orders.checkout') }}">
                    @csrf
                    <div class="card-header bg-dark text-white fw-bold">Ringkasan Pesanan</div>
                    <div class="card-body">
                        <x-text-input name="customer" label="Nama Pelanggan" value="{{ session('order')->customer }}"></x-text-input>
                        <hr>
                        <div class="vstack gap-2">
                            @php $total = 0; @endphp
                            @forelse (session('order')->details as $detail)
                                @php $total += $detail->qty * $detail->price; @endphp
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ $detail->product->name }}</h6>
                                            <small class="text-muted">{{ $detail->qty }} x Rp{{ number_format($detail->price) }}</small>
                                        </div>
                                        <span class="fw-bold">Rp{{ number_format($detail->qty * $detail->price) }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">Belum ada produk</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <h5 class="text-primary">Rp{{ number_format($total) }}</h5>
                        </div>
                        <hr>
                        <x-text-input name="payment" label="Jumlah Pembayaran" type="number"></x-text-input>
                        <label for="payment_method" class="form-label mt-2">Metode Pembayaran</label>
                        <div class="btn-group d-flex flex-wrap" role="group">
                            <input type="radio" class="btn-check" name="payment_method" id="debit" value="debit">
                            <label class="btn btn-outline-dark" for="debit">Debit</label>
                            <input type="radio" class="btn-check" name="payment_method" id="ovo" value="ovo">
                            <label class="btn btn-outline-dark" for="ovo">OVO</label>
                            <input type="radio" class="btn-check" name="payment_method" id="dana" value="dana">
                            <label class="btn btn-outline-dark" for="dana">DANA</label>
                            <input type="radio" class="btn-check" name="payment_method" id="gopay" value="gopay">
                            <label class="btn btn-outline-dark" for="gopay">GoPay</label>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#confirmModal">Checkout</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-light w-100 mt-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin melanjutkan pembayaran?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" id="confirmCheckout">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .dropdown-menu {
            display: block; /* Mencegah dropdown tertutup jika ada masalah Bootstrap */
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .dropdown.show .dropdown-menu {
            visibility: visible;
            opacity: 1;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            min-height: 320px; /* Tambahkan tinggi minimal */
        }

        .product-card:hover {
            transform: scale(1.08);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .product-card img {
            height: 180px; /* Atur tinggi gambar */
            object-fit: cover; /* Pastikan gambar tidak terdistorsi */
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-group .btn {
            flex: 1;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });
        });
    </script>
</x-layout>
