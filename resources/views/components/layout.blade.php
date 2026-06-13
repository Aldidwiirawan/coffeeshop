<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background:rgb(15, 50, 124);
            color: white;
            position: fixed;
            padding-top: 15px;
            transition: width 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar.shrink {
            width: 80px;
        }

        /* Header (Icon + Toko Sembako) */
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* Mengurangi jarak */
            width: 100%;
            padding: 5px 15px;
        }

        /* Tombol Burger */
        #toggleSidebar {
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
        }

        /* Judul Toko */
        .sidebar h4 {
            font-size: 1.2rem;
            margin: 0;
            transition: 0.3s;
        }

        .sidebar.shrink h4 {
            display: none;
        }

        /* Logo */
        .logo {
            text-align: center;
            margin: 15px 0;
        }

        .logo img {
            width: 120px;
            max-width: 100%;
            min-width: 60px;
            height: auto;
            transition: width 0.3s;
        }

        .sidebar.shrink .logo img {
            width: 70px;
        }

        /* Menu */
        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            width: 100%;
            transition: 0.3s;
        }

        .sidebar a i {
            font-size: 18px;
            margin-right: 10px;
        }

        .sidebar.shrink a span {
            display: none;
        }

        /* Konten */
        .content {
            margin-left: 260px;
            padding: 20px;
            height: 100vh;
            transition: margin-left 0.3s;
        }

        .content.shrink {
            margin-left: 80px;
        }

        .user-info {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            padding-bottom: 10px;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar h4 {
                display: none;
            }

            .sidebar a span {
                display: none;
            }

            .content {
                margin-left: 80px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button id="toggleSidebar"><i class="bi bi-list"></i></button>
            <h4>Dwijaya Coffee</h4>
        </div>
        <div class="logo">
            <img src="{{ Storage::url('logo dwijaya.jpg') }}" alt="Logo Dwijaya Coffee" class="img-thumbnail">
        </div>

        <a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> <span>Dashboard</span></a>

        @if(auth()->user()->usertype === 'admin')
            <a href="{{ route('orders.index') }}"><i class="bi bi-cart"></i> <span>Orders</span></a>
            <a href="{{ route('categories.index') }}"><i class="bi bi-tags"></i> <span>Categories</span></a>
            <a href="{{ route('products.index') }}"><i class="bi bi-box"></i> <span>Products</span></a>
        @elseif(auth()->user()->usertype === 'owner')
            <a href="{{ route('users.index') }}"><i class="bi bi-people"></i> <span>Users</span></a>
            <a href="{{ route('laporan.penjualan') }}"><i class="bi bi-bar-chart"></i> <span>Reports</span></a>
        @endif

        <!-- Nama User dan Logout di bawah -->
        <div class="user-info">
            <div>{{ auth()->user()->name }}</div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm mt-2">Logout</button>
            </form>
        </div>
    </div>

    <!-- Konten -->
    <div class="content" id="content">
        @isset($title)
            <h4 class="fw-bold border-bottom pb-2">{{ $title }}</h4>
        @endisset
        {{ $slot }}
    </div>

    <!-- JavaScript untuk Toggle Sidebar -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('shrink');
            document.getElementById('content').classList.toggle('shrink');
        });
    </script>
</body>
</html>
