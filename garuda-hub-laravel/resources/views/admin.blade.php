@extends('layout')

@section('content')
    <h2>Admin</h2>

    <h3>Kelola User</h3>
    <table>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>Peran</th><th>Aksi</th></tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    @if ($u->id === auth()->id())
                        <i>(akun Anda)</i>
                    @else
                        <form action="{{ route('admin.users.role', $u) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PATCH')
                            <select name="role" style="width:auto">
                                @foreach (['klien', 'developer', 'admin'] as $r)
                                    <option value="{{ $r }}" @selected($u->role === $r)>{{ $r }}</option>
                                @endforeach
                            </select>
                            <button class="btn">Ubah</button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus user beserta proyek dan penawarannya?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-red">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <h3>Kelola Proyek</h3>
    <table>
        <tr><th>ID</th><th>Judul</th><th>Klien</th><th>Status</th><th>Aksi</th></tr>
        @foreach ($projects as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td><a href="{{ route('projects.show', $p) }}">{{ $p->judul }}</a></td>
                <td>{{ $p->client->name }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus proyek beserta penawarannya?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-red">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
