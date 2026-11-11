@extends('layout')

@section('content')
    @if (auth()->user()->role === 'klien')
        <h2>Proyek Saya</h2>
        <p><a href="{{ route('projects.create') }}">Pasang proyek baru</a></p>

        <table>
            <tr><th>Judul</th><th>Status</th><th>Budget</th><th>Batas</th><th>Penawaran</th></tr>
            @forelse ($projects as $p)
                <tr>
                    <td><a href="{{ route('projects.show', $p) }}">{{ $p->judul }}</a></td>
                    <td>{{ $p->status }}</td>
                    <td>Rp {{ number_format($p->budget_min, 0, ',', '.') }} - {{ number_format($p->budget_max, 0, ',', '.') }}</td>
                    <td>{{ $p->batas_lelang->format('Y-m-d') }}</td>
                    <td>{{ $p->bids_count }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Anda belum memasang proyek.</td></tr>
            @endforelse
        </table>
    @else
        <h2>Penawaran Saya</h2>

        <table>
            <tr><th>Proyek</th><th>Klien</th><th>Harga</th><th>Durasi</th><th>Batas</th><th>Status</th></tr>
            @forelse ($bids as $b)
                <tr>
                    <td><a href="{{ route('projects.show', $b->project) }}">{{ $b->project->judul }}</a></td>
                    <td>{{ $b->project->client->name }}</td>
                    <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td>{{ $b->durasi }} hari</td>
                    <td>{{ $b->project->batas_lelang->format('Y-m-d') }}</td>
                    <td>
                        {{ $b->project->status }}
                        @if ($b->is_winner) <b>(Pemenang)</b> @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Anda belum mengajukan penawaran.</td></tr>
            @endforelse
        </table>
    @endif
@endsection
