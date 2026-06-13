<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    @include('components.navmenu')

    <!-- Container -->
    <div class="container text-center mt-5">
        <!-- Notifikasi -->
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            Pesanan berhasil dibuat! Terima kasih telah berbelanja.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h2>Checkout Berhasil!</h2>
        <p>Pesanan Anda sedang diproses. Silakan tunggu konfirmasi lebih lanjut.</p>
        <a href="{{ route('catalog') }}" class="btn btn-primary">Kembali ke Katalog</a>
    </div>
    <script>
        setTimeout(() => {
            let alert = document.getElementById("success-alert");
            if (alert) {
                alert.style.display = "none";
            }
        }, 3000); // Hilang setelah 5 detik
    </script>

</body>
</html>
