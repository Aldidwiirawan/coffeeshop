<x-layout>
    <x-slot:title>Category</x-slot:title>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show animated fadeIn" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <form class="d-flex gap-2 w-100" method="get">
                <input type="text" class="form-control search-input" placeholder="Cari kategori..." name="search" value="{{ request()->search }}">
                <button type="submit" class="btn search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
            <div class="mb-4">
            <a href="/categories/create" class="btn add-btn animated pulse">
                <i class="bi bi-plus-lg"></i> Tambah Kategori
            </a>
        </div>

        <div class="card modern-card animated fadeInUp">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-header">
                        <tr>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr class="border-bottom animated fadeIn">
                            <td class="p-3">{{ $category?->name }}</td>
                            <td class="p-3">
                                <span class="badge {{ $category->active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $category->active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="p-3 text-end">
                                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn edit-btn">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('delete')
                                    <button class="btn delete-btn">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted p-4">Belum ada kategori</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .modern-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border: none;
            transition: transform 0.3s;
        }
        .modern-card:hover {
            transform: scale(1.02);
        }

        .table-header {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
        }
        .search-input {
            border-radius: 8px;
            padding: 10px 15px;
            border: 2px solid #007bff;
            transition: all 0.3s;
        }
        .search-input:focus {
            border-color: #6610f2;
            box-shadow: 0 0 10px rgba(102, 16, 242, 0.5);
        }

        .search-btn {
            border-radius: 8px;
            background: #007bff;
            color: white;
            padding: 8px 12px;
            transition: all 0.3s;
            border: none;
        }
        .search-btn:hover {
            background: #0056b3;
        }

        .add-btn {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
        }
        .add-btn:hover {
            background: #218838;
        }

        .edit-btn, .delete-btn {
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s;
        }
        .edit-btn {
            background: #ffc107;
            color: white;
            border: none;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
        }
        .edit-btn:hover {
            background: #e0a800;
        }
        .delete-btn:hover {
            background: #c82333;
        }

        .table-hover tbody tr:hover {
            background: rgba(0, 123, 255, 0.05);
            transition: background 0.3s;
        }

        .animated {
            animation-duration: 0.8s;
            animation-fill-mode: both;
        }
        .fadeIn {
            animation-name: fadeIn;
        }
        .fadeInUp {
            animation-name: fadeInUp;
        }
        .pulse {
            animation-name: pulse;
            animation-iteration-count: infinite;
            animation-duration: 1.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</x-layout>
