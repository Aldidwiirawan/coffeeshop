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
            padding: 8px 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-nav .nav-link {
            color: white !important;
            margin-right: 15px;
            font-size: 16px;
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
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">
                  <img src="/storage/logo dwijaya.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
                  Coffee Shop
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="menu">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="catalog">Catalog</a>
                      </li>
                      <li class="nav-item cart-icon">
                          <a class="nav-link" href="cart">
                              <i class="bi bi-cart"></i> Cart
                              <span id="cart-count" class="cart-count">0</span> <!-- Notifikasi keranjang -->
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
</body>
