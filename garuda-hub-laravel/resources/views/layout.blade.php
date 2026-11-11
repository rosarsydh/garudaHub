<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garuda-Hub</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 0 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .btn { padding: 6px 12px; border: none; background: #2563eb; color: #fff; text-decoration: none; cursor: pointer; border-radius: 4px; }
        .btn-red { background: #dc2626; }
        .btn-gray { background: #6b7280; }
        .alert { padding: 10px; background: #dcfce7; margin-bottom: 15px; }
        .error { color: #dc2626; font-size: 14px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 6px; box-sizing: border-box; }
    </style>
</head>
<body>
        <div style="display:flex;gap:14px;align-items:center;flex-wrap:wrap;margin-bottom:10px;">
        <h1 style="margin:0;margin-right:auto;"><a href="{{ route('projects.index') }}" style="text-decoration:none;color:inherit;">Garuda-Hub</a></h1>
        <a href="{{ route('projects.index') }}">Proyek</a>
                @auth
            @if (auth()->user()->role === 'klien')
                <a href="{{ route('projects.create') }}">Pasang Proyek</a>
        @endif
            @if (auth()->user()->role !== 'admin')
                <a href="{{ route('dashboard') }}">Dasbor</a>
            @endif
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button class="btn btn-gray">Keluar</button>
            </form>
        @else
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('register') }}">Daftar</a>
        @endauth
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert" style="background:#fee2e2;">{{ session('error') }}</div>
    @endif

    @yield('content')
</body>
</html>
