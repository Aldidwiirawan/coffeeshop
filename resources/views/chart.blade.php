<x-layout>
    <x-slot:title>Penjualan Chart</x-slot:title>

    <div class="container">
        <!-- Filter Tanggal dan Pencarian -->
        <div class="d-flex mb-4 justify-content-between">
            <a href="{{ route('laporan.penjualan') }}" class="btn btn-dark">Kembali ke Laporan</a>
            <form method="get" class="d-flex gap-2 ms-2">
                <input type="date" class="form-control" name="start_date"
                    value="{{ request('start_date', $startDate) }}">
                <input type="date" class="form-control" name="end_date" value="{{ request('end_date', $endDate) }}">
                <input type="text" class="form-control" name="search" placeholder="Cari Customer"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark">Filter</button>
            </form>
            <div class="d-flex gap-2 ms-auto">
                <button id="downloadPNG" class="btn btn-dark">Download PNG</button>
                <button id="downloadCSV" class="btn btn-dark">Download CSV</button>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="card">
            <div class="card-body">
                <!-- Menambahkan style untuk memperbesar canvas -->
                <canvas id="salesChart" style="width: 100%; height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data untuk chart
        const labels = @json($orders->pluck('formatted_created_at')); // Label X-Axis (tanggal)
        const data = @json($orders->pluck('total')); // Data Y-Axis (total penjualan)

        // Pastikan ada data sebelum menampilkan chart
        if (labels.length > 0 && data.length > 0) {
            // Inisialisasi Chart.js
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line', // Jenis chart: Line
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna garis solid
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna isi transparan
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        } // Mulai dari 0 pada sumbu Y
                    }
                }
            });
        } else {
            // Jika tidak ada data, beri pesan atau tampilkan grafik kosong
            document.getElementById('salesChart').innerHTML = 'Tidak ada data untuk grafik ini.';
        }

        // Tombol Download PNG
        document.getElementById('downloadPNG').addEventListener('click', function() {
            const canvas = document.getElementById('salesChart');
            if (canvas) {
                const imageUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = 'chart_penjualan.png';
                link.click();
            } else {
                console.error('Canvas tidak ditemukan!');
            }
        });

        // Tombol Download CSV
        document.getElementById('downloadCSV').addEventListener('click', function() {
            const csvContent = "Tanggal,Total Penjualan\n" +
                labels.map((label, index) => `${label},${data[index]}`).join('\n');
            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'chart_penjualan.csv');
            link.click();
        });
    </script>
</x-layout>
