@extends('layout')

@section('content')
    <h2>Daftar Proyek</h2>

    <form method="GET" action="{{ route('projects.index') }}" style="display:flex;gap:8px;margin-bottom:15px;">
        <input type="text" name="q" value="{{ $q }}" maxlength="100" placeholder="Cari judul atau kategori...">
        <button class="btn" style="flex:none;">Cari</button>
    </form>
    @if ($q !== '')
        <p>Hasil pencarian untuk: <b>{{ $q }}</b> ({{ $projects->count() }} proyek)</p>
    @endif

    <table>
        <tr>
            <th>Judul</th>
            <th>Klien</th>
            <th>Kategori</th>
            <th>Budget</th>
            <th>Batas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $project->judul }} <small>({{ $project->bids_count }} penawaran)</small></td>
                <td>{{ $project->client->name }}</td>
                <td>{{ $project->kategori }}</td>
                <td>Rp {{ number_format($project->budget_min, 0, ',', '.') }} - {{ number_format($project->budget_max, 0, ',', '.') }}</td>
                <td>{{ $project->batas_lelang->format('Y-m-d') }}</td>
                <td>{{ $project->status }}</td>
                <td>
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-gray">Detail</a>
                    @if (auth()->id() === $project->client_id)
                        <a href="{{ route('projects.edit', $project) }}" class="btn">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus proyek ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-red">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada proyek yang cocok.</td></tr>
        @endforelse
    </table>
@endsection
