@extends('layout')

@section('content')
    <h2>Daftar</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Password (min. 6 karakter)</label>
        <input type="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label>Peran</label>
        <select name="role">
            @foreach (['klien', 'developer'] as $r)
                <option value="{{ $r }}" @selected(old('role', 'klien') == $r)>{{ ucfirst($r) }}</option>
            @endforeach
        </select>
        @error('role') <div class="error">{{ $message }}</div> @enderror

        <br><br>
        <button class="btn">Daftar</button>
    </form>
@endsection
