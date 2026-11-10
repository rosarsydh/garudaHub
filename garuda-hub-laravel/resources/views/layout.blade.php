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
    <h1><a href="{{ route('projects.index') }}" style="text-decoration:none;color:inherit;">Garuda-Hub</a></h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</body>
</html>
