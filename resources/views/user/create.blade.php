<x-layout>
    <x-slot name="title">Tambah User</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama">
                                <label for="name" class="form-label">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="usertype" name="usertype">
                                    <option value="admin">admin</option>
                                    <option value="owner">owner</option>
                                </select>
                                <label for="usertype">Tipe User</label>
                            </div>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
