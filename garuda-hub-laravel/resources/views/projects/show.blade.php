@extends('layout')

@section('content')
    <h2>{{ $project->judul }}</h2>
    <p><b>Klien:</b> {{ $project->client->name }}</p>
    <p><b>Kategori:</b> {{ $project->kategori }}</p>
    <p><b>Budget:</b> {{ number_format($project->budget_min) }} - {{ number_format($project->budget_max) }}</p>
    <p><b>Batas lelang:</b> {{ $project->batas_lelang->format('d M Y') }}</p>
    <p><b>Status:</b> {{ $project->status }}</p>
    <p>{{ $project->deskripsi }}</p>

    <h3>Penawaran (Bid)</h3>
    <table>
        <tr><th>Developer</th><th>Harga</th><th>Durasi (hari)</th><th>Proposal</th></tr>
        @forelse ($project->bids as $bid)
            <tr>
                <td>{{ $bid->developer->name }}</td>
                <td>{{ number_format($bid->harga) }}</td>
                <td>{{ $bid->durasi }}</td>
                <td>{{ $bid->proposal }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada penawaran.</td></tr>
        @endforelse
    </table>

    <br>
    <a href="{{ route('projects.index') }}" class="btn btn-gray">Kembali</a>
@endsection
