<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dwijaya Coffee</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/logo dwijaya.jpg') }}" type="image/x-icon">

    <style>
    /* Navbar Styling */
    .navbar {
        background: rgba(0, 0, 0, 0.9);
        transition: top 0.4s ease-in-out;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: white !important;
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem;
        color: white !important;
        transition: color 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover {
        color: #ffc107 !important;
    }

    /* Efek sembunyi navbar */
    .navbar.hidden {
        top: -70px;
    }

    /* Tombol Sign In */
    .btn-warning {
        background-color: #ffc107;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        transition: background 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #ff9800;
    }

    /* Badge Keranjang */
    .badge {
        font-size: 0.8rem;
        padding: 5px 8px;
    }

    /* Footer Styling */
    footer {
        background: #222;
        color: white;
        padding: 20px 0;
        margin-top: 50px;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        text-align: center;
    }

    .footer-container img {
        height: 50px;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
        }
    }

    /* Animasi warna berjalan untuk nama */
    .animated-text {
        font-size: 1.1rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    .letter {
        display: inline-block;
        font-weight: bold;
        animation: colorAnimation 3s infinite linear;
    }
    .logout-btn {
        font-size: 14px; /* Sesuaikan ukuran */
        font-weight: bold;
        color: #15120a;
        transition: background-color 0.3s ease, color 0.3s ease;
        border-radius: 5px;
        text-align: center;
    }
    .logout-btn:hover {
        background-color: rgb(136, 29, 148);
        color: white !important; /* Warna teks saat hover */
    }

    @keyframes colorAnimation {
        0% { color: #ff5733; }
        25% { color: #ffbd33; }
        50% { color: #33ff57; }
        75% { color: #3388ff; }
        100% { color: #ff5733; }
    }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('storage/logo dwijaya.jpg') }}" alt="Logo Dwijaya" width="40" class="me-2" />
                <span class="fw-bold">DWIJAYA COFFEE</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2"><a class="nav-link" href="#home">HOME</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#about">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">MENU</a></li>
                </ul>

                <!-- Ikon Keranjang & Tombol Sign In -->
                <div class="d-flex align-items-center ms-3"> <!-- Tambah jarak kiri -->
                    @auth
                        <div class="dropdown">
                            <a class="animated-text text-white" href="#" id="userDropdown" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu text-center" style="min-width: 80px; left: 50%; transform: translateX(-50%);">
                                <li>
                                    <a class="dropdown-item logout-btn fw-bold small px-3 py-1" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="btn btn-warning fw-bold px-4" href="{{ route('login') }}">SIGN IN</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- JavaScript untuk Hide Navbar saat Scroll -->
    <script>
        let prevScrollpos = window.pageYOffset;
        window.onscroll = function () {
            let currentScrollPos = window.pageYOffset;
            let navbar = document.getElementById("navbar");

            if (prevScrollpos > currentScrollPos) {
                navbar.classList.remove("hidden"); // Munculkan navbar saat scroll ke atas
            } else {
                navbar.classList.add("hidden"); // Sembunyikan navbar saat scroll ke bawah
            }
            prevScrollpos = currentScrollPos;
        };

        document.addEventListener("DOMContentLoaded", function() {
            let nameElement = document.querySelector(".animated-text");
            let nameText = nameElement.textContent.trim();
            let animatedHTML = "";

            for (let i = 0; i < nameText.length; i++) {
                animatedHTML += `<span class="letter" style="animation-delay: ${i * 0.1}s">${nameText[i]}</span>`;
            }

            nameElement.innerHTML = animatedHTML;
        });
    </script>

    <!-- Content -->
    <main class="pt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container footer-container">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/logo dwijaya.jpg') }}" alt="Logo Dwijaya" class="me-3">
                <p class="m-0 fw-bold">DWIJAYA COFFEE</p>
            </div>
            <p class="m-0">&copy; 2024 Dwijaya Coffee. All Rights Reserved.</p>
            <div class="d-flex align-items-center">
                <p class="m-0 fw-bold">DWIJAYA COFFEE</p>
                <img src="{{ asset('storage/logo dwijaya.jpg') }}" alt="Logo Dwijaya" class="ms-3">
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
