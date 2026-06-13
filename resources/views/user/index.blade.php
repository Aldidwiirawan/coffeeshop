<x-layout>
    <x-slot:title>Users</x-slot:title>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <form class="row g-3" method="GET" action="{{ route('users.index') }}">
                <div class="col-auto">
                    <label class="visually-hidden" for="search">Cari User</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Cari user"
                        value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark mb-3">Cari</button>
                </div>
            </form>
            <div class="d-flex mb-2 justify-content-end">
                <a href="{{ route('users.create') }}" class="btn btn-dark">Tambah</a>
            </div>
        </div>
        <div class="card overflow-hidden">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipe User</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->usertype }}</td>
                            <td align="right">
                                @if ($user->usertype !== 'customer')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-user-{{ $user->id }}').submit(); }">Hapus</a>
                                    <form id="delete-user-{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>Customer</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
