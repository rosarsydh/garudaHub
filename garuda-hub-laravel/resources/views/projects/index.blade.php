@extends('layout')

@section('content')
    <h2>Daftar Proyek</h2>
    <a href="{{ route('projects.create') }}" class="btn">+ Tambah Proyek</a>
    <br><br>

    <table>
        <tr>
            <th>Judul</th>
            <th>Klien</th>
            <th>Kategori</th>
            <th>Budget</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $project->judul }}</td>
                <td>{{ $project->client->name }}</td>
                <td>{{ $project->kategori }}</td>
                <td>{{ number_format($project->budget_min) }} - {{ number_format($project->budget_max) }}</td>
                <td>{{ $project->status }}</td>
                <td>
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-gray">Detail</a>
                    <a href="{{ route('projects.edit', $project) }}" class="btn">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus proyek ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-red">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada proyek.</td></tr>
        @endforelse
    </table>
@endsection
