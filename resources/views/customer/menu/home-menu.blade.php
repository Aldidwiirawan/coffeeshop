<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #2c3e50, #4a69bd);
            padding: 15px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
        }
        .navbar-brand {
            font-size: 26px;
            font-weight: bold;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-nav .nav-link {
            color: white !important;
            margin-right: 15px;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #f1c40f !important;
        }
        .navbar-toggler {
            border: none;
            background: transparent;
        }
        .navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }
        .cart-icon {
            position: relative;
            display: inline-block;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
        }
        .product-card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            padding: 15px;
            text-align: center;
            background: white;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .product-card img {
            width: 100%;
            border-radius: 10px;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .product-card:hover img {
            transform: scale(1.05);
        }
        .btn-order {
            background-color: #28a745;
            color: white;
            border-radius: 8px;
            padding: 8px 12px;
            border: none;
            transition: background-color 0.3s;
            width: 100%;
        }
        .btn-order:hover {
            background-color: #218838;
        }
        .filter-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .filter-bar select,
        .filter-bar input,
        .filter-bar button {
            height: 40px;
            border-radius: 8px;
        }
        .container .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .col-md-4, .col-lg-3 {
            flex: 1 1 250px;
            max-width: 250px;
        }
    </style>
</head>
<body>
    @include('components.navmenu')

    <div class="container mt-5">
        <h2 class="fw-bold text-center">Our Coffee Menu</h2>

        <div class="container text-center mt-7">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <h5 class="mt-2 text-secondary">{{ $product->name }}</h5>
                            <p class="text-muted">{{ $product->brand }}</p>
                            <p class="fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let cart = [];
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-id');
                let productImage = this.getAttribute('data-img');
                let productName = this.getAttribute('product-name');
                let productPrice = parseInt(this.getAttribute('product-price'));
                let productStok = parseInt(this.getAttribute('product-stok'));

                let existingProduct = cart.find(item => item.id === productId);
                if (existingProduct) {
                    existingProduct.quantity += 1;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        stok: productStok,
                        img: productImage,
                        quantity: 1
                    });
                }

                updateCartCount();
                localStorage.setItem('cart', JSON.stringify(cart));

                Swal.fire({
                    title: "Berhasil!",
                    text: "Produk '" + productName + "' telah ditambahkan ke keranjang.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });

        function updateCartCount() {
            let cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').innerText = cartCount;
        }

        window.onload = function() {
            cart = JSON.parse(localStorage.getItem('cart')) || [];
            updateCartCount();
        };
    </script>
</body>
</html>
