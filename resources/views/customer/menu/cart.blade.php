<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .cart-container {
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th {
            background: #343a40;
            color: white;
            padding: 15px;
        }
        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .cart-table img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        .btn-remove {
            color: red;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-remove:hover {
            text-decoration: underline;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .cart-summary {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            text-align: right;
            margin-top: 20px;
        }
        .summary-details {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .btn-checkout {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: none;
        }
        .empty-cart {
            text-align: center;
            padding: 50px;
        }
        .btn-continue {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-continue:hover {
            background-color: #333;
        }
        .continue-shopping {
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .continue-shopping a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

    <div class="container cart-container">
        <div id="cart-header" style="display: none;">
            <h2 class="text-center mb-4">Your Cart</h2>
            <div class="continue-shopping text-center">
                <a href="{{ route('catalog') }}">Continue Shopping</a>
            </div>
        </div>

        <div id="empty-cart" class="empty-cart" style="display: none;">
            <h2>Your cart</h2>
            <p>Your cart is currently empty.</p>
            <a href="{{ route('catalog') }}" class="btn-continue">CONTINUE SHOPPING →</a>
        </div>

        <table class="cart-table" id="cart-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="cart-items"></tbody>
        </table>

        <div class="cart-summary" id="cart-summary">
            <p class="summary-details">Total Produk: <span id="total-products">0</span></p>
            <p class="summary-details">Total Harga: Rp<span id="total-price">0</span></p>

            <!-- Checkout Form -->
            <form id="checkout-form" action="{{ route('customer.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="cart_data" id="cart-data">
                <button type="submit" id="checkout-btn" class="btn-checkout">CHECKOUT</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let cartContainer = document.getElementById("cart-items");
            let totalProducts = document.getElementById("total-products");
            let totalPrice = document.getElementById("total-price");
            let checkoutBtn = document.getElementById("checkout-btn");
            let cartSummary = document.getElementById("cart-summary");
            let cartHeader = document.getElementById("cart-header");
            let emptyCartMessage = document.getElementById("empty-cart");
            let cartTable = document.getElementById("cart-table");

            function updateCartUI() {
                cartContainer.innerHTML = "";
                let totalItemCount = 0;
                let totalCartPrice = 0;

                if (cart.length === 0) {
                    emptyCartMessage.style.display = "block";
                    cartTable.style.display = "none";
                    cartSummary.style.display = "none";
                    cartHeader.style.display = "none";
                    return;
                } else {
                    emptyCartMessage.style.display = "none";
                    cartTable.style.display = "table";
                    cartSummary.style.display = "flex";
                    cartHeader.style.display = "block";
                }

                cart.forEach((item, index) => {
                    let subtotal = item.price * item.quantity;
                    totalItemCount += item.quantity;
                    totalCartPrice += subtotal;

                    let row = document.createElement("tr");
                    row.innerHTML = `
                        <td><img src="/storage/${item.img}" alt="${item.name}"></td>
                        <td>${item.name} <br> <span class="btn-remove" data-index="${index}">Remove</span></td>
                        <td>Rp${item.price.toLocaleString()}</td>
                        <td>
                            <input type="number" class="quantity-input" data-index="${index}" value="${item.quantity}" min="1">
                        </td>
                        <td>Rp${subtotal.toLocaleString()}</td>
                    `;
                    cartContainer.appendChild(row);
                });

                totalProducts.textContent = totalItemCount;
                totalPrice.textContent = totalCartPrice.toLocaleString();
                checkoutBtn.style.display = "block";

                document.querySelectorAll(".quantity-input").forEach(input => {
                    input.addEventListener("input", function () {
                        let index = this.getAttribute("data-index");
                        let newValue = parseInt(this.value);
                        if (newValue > 0) {
                            cart[index].quantity = newValue;
                        } else {
                            cart[index].quantity = 1;
                        }
                        localStorage.setItem("cart", JSON.stringify(cart));
                        updateCartUI();
                    });
                });

                document.querySelectorAll(".btn-remove").forEach(button => {
                    button.addEventListener("click", function () {
                        let index = this.getAttribute("data-index");
                        cart.splice(index, 1);
                        localStorage.setItem("cart", JSON.stringify(cart));
                        updateCartUI();
                    });
                });
            }

            document.getElementById("checkout-form").addEventListener("submit", function (event) {
                if (cart.length === 0) {
                    event.preventDefault();
                    alert("Keranjang belanja kosong!");
                } else {
                    document.getElementById("cart-data").value = JSON.stringify(cart);
                }
            });

            updateCartUI();
        });
    </script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function renderCart() {
        let cartItemsContainer = document.getElementById('cart-items');
        let totalPrice = 0;
        cartItemsContainer.innerHTML = '';

        cart.forEach((item, index) => {
            let subtotal = item.price * item.quantity;
            totalPrice += subtotal;
            cartItemsContainer.innerHTML += `
                <tr>
                    <td>${item.name}</td>
                    <td class="text-end">Rp ${item.price.toLocaleString()}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="decreaseQuantity(${index})">-</button>
                        <span class="mx-2">${item.quantity}</span>
                        <button class="btn btn-sm btn-success" onclick="increaseQuantity(${index})">+</button>
                    </td>
                    <td class="text-end">Rp ${subtotal.toLocaleString()}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        });

        document.getElementById('total-price').innerText = totalPrice.toLocaleString();
    }

    function increaseQuantity(index) {
        if (cart[index].quantity < cart[index].stok) {
            cart[index].quantity++;
        } else {
            alert('Stok tidak mencukupi!');
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    function decreaseQuantity(index) {
        if (cart[index].quantity > 1) {
            cart[index].quantity--;
        } else {
            cart.splice(index, 1);
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    function removeItem(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    document.getElementById('checkout-btn').addEventListener('click', function() {
        fetch("{{ route('midtrans.token') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cart
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil!');
                        localStorage.removeItem('cart');
                        // Kirim request ke backend untuk update status transaksi ke "dikirim"
                        fetch("{{ route('update.status2') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    snap_token: data.snap_token
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log("Status transaksi diperbarui:", data);
                                window.location.href = '/order'; // Redirect setelah update
                            })
                            .catch(error => console.error("Error:", error));
                    },
                    onPending: function(result) {
                        alert('Menunggu pembayaran!');
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal!');
                    }
                });
            });
    });

    renderCart();
</script>
</body>
</html>
