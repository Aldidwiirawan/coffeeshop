# Dwijaya Coffee - Web Based Coffee Shop Ordering System

Dwijaya Coffee adalah aplikasi berbasis website yang dibuat untuk membantu proses digitalisasi Coffee Shop Dwijaya dalam melakukan pemesanan produk secara online.

Aplikasi ini membantu pelanggan melakukan pemesanan dengan mudah serta membantu pihak coffee shop dalam mengelola produk, transaksi, stok, dan laporan penjualan secara lebih efektif.


## About Project

Permasalahan utama Coffee Shop Dwijaya adalah proses pelayanan dan promosi yang masih perlu dikembangkan melalui teknologi digital.

Dengan adanya sistem pemesanan berbasis web ini, pelanggan dapat melakukan pemesanan tanpa harus datang langsung ke tempat. Selain itu, data transaksi tersimpan secara otomatis sehingga memudahkan pengelolaan bisnis.


## Features

Customer:
- Register dan login akun
- Melihat daftar produk coffee
- Melihat detail produk
- Menambahkan produk ke keranjang
- Mengubah jumlah pesanan
- Menghapus produk dari keranjang
- Checkout pesanan
- Pembayaran digital
- Melihat riwayat transaksi
- Cetak bukti transaksi


Admin / Karyawan:
- Dashboard admin
- Mengelola kategori produk
- Mengelola data produk
- Menambah produk baru
- Mengubah informasi produk
- Menghapus produk
- Mengelola stok produk
- Memproses pesanan customer


Owner:
- Melihat laporan penjualan
- Melihat grafik transaksi
- Export laporan
- Mengelola data pengguna


## Technology Used

- Laravel
- PHP
- MySQL
- Blade Template
- Tailwind CSS
- JavaScript
- Midtrans Payment Gateway


## System Flow

1. Customer melakukan registrasi atau login akun
2. Customer memilih produk coffee
3. Produk ditambahkan ke keranjang
4. Customer melakukan checkout
5. Customer melakukan pembayaran digital
6. Karyawan menerima dan memproses pesanan
7. Pesanan dikirim kepada customer


## User Role

| Role | Description |
|---|---|
| Owner | Mengelola laporan penjualan dan pengguna |
| Karyawan | Mengelola produk, kategori, dan pesanan |
| Customer | Melakukan pemesanan dan pembayaran |


## Installation

Clone repository

```bash
git clone https://github.com/Sheva1012/dwijayacoffee.git
```

Masuk folder project

```bash
cd dwijayacoffee
```

Install dependency

```bash
composer install
```

Install package frontend

```bash
npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Konfigurasi database pada file .env

```env
DB_DATABASE=coffeeshop
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration

```bash
php artisan migrate
```

Menjalankan aplikasi

```bash
php artisan serve
```


## Database

Database:
- MySQL

Main table:
- Users
- Products
- Categories
- Orders
- Transactions


## Developer

Sheva Adrian

Github:
https://github.com/Sheva1012


## License

Project ini dibuat sebagai implementasi sistem informasi pemesanan Coffee Shop berbasis website.
