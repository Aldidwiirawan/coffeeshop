<x-layout>
    <x-slot name="title">Edit User</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama" value="{{ $user->name }}"
                                    @if ($user->usertype === 'customer') disabled @endif>
                                <label for="name" class="form-label">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" value="{{ $user->email }}"
                                    @if ($user->usertype === 'customer') disabled @endif>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password"
                                    @if ($user->usertype === 'customer') disabled @endif>
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control" id="usertype" name="usertype" disabled>
                                    <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="owner" {{ $user->usertype == 'owner' ? 'selected' : '' }}>Owner</option>
                                    <option value="customer" {{ $user->usertype == 'customer' ? 'selected' : '' }}>Customer</option>
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
