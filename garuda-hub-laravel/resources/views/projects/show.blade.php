@extends('layout')

@section('content')
    <h2>{{ $project->judul }} <small>({{ $project->status }})</small></h2>
    <p><b>Klien:</b> {{ $project->client->name }}</p>
    <p><b>Kategori:</b> {{ $project->kategori }}</p>
    <p><b>Budget:</b> Rp {{ number_format($project->budget_min, 0, ',', '.') }} - {{ number_format($project->budget_max, 0, ',', '.') }}</p>
    <p><b>Batas lelang:</b> {{ $project->batas_lelang->format('Y-m-d') }}</p>
    <p>{!! nl2br(e($project->deskripsi)) !!}</p>

    <h3>Penawaran ({{ $bids->count() }})</h3>
    <table>
        <tr><th>Developer</th><th>Harga</th><th>Durasi</th><th>Proposal</th><th></th></tr>
        @forelse ($bids as $bid)
            <tr @if ($bid->is_winner) style="background:#fff8e1" @endif>
                <td>
                    {{ $bid->developer->name }}
                    @if ($bid->is_winner) <b>(Pemenang)</b> @endif
                </td>
                <td>Rp {{ number_format($bid->harga, 0, ',', '.') }}</td>
                <td>{{ $bid->durasi }} hari</td>
                <td>{!! nl2br(e($bid->proposal)) !!}</td>
                <td>
                    @if (auth()->id() === $project->client_id && $project->status === 'terbuka')
                        <form action="{{ route('bids.pick', [$project, $bid]) }}" method="POST" onsubmit="return confirm('Pilih penawaran ini sebagai pemenang?')">
                            @csrf
                            <button class="btn">Pilih pemenang</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada penawaran.</td></tr>
        @endforelse
    </table>

    @auth
        @if (auth()->user()->role === 'developer')
            @if ($project->isOpen())
                <h3>Ajukan Penawaran</h3>
                <form action="{{ route('bids.store', $project) }}" method="POST">
                    @csrf
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" min="1" value="{{ old('harga') }}">
                    @error('harga') <div class="error">{{ $message }}</div> @enderror

                    <label>Durasi (hari)</label>
                    <input type="number" name="durasi" min="1" value="{{ old('durasi') }}">
                    @error('durasi') <div class="error">{{ $message }}</div> @enderror

                    <label>Proposal</label>
                    <textarea name="proposal" rows="4">{{ old('proposal') }}</textarea>
                    @error('proposal') <div class="error">{{ $message }}</div> @enderror

                    <br><br>
                    <button class="btn">Kirim penawaran</button>
                </form>
            @else
                <p><i>Lelang sudah ditutup; penawaran tidak dapat diajukan.</i></p>
            @endif
        @endif
    @else
        @if ($project->isOpen())
            <p><a href="{{ route('login') }}">Masuk</a> sebagai developer untuk mengajukan penawaran.</p>
        @endif
    @endauth

    <br>
    <a href="{{ route('projects.index') }}" class="btn btn-gray">Kembali</a>
@endsection
