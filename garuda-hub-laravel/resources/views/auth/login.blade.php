@extends('layout')

@section('content')
    <h2>Masuk</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Password</label>
        <input type="password" name="password">

        <br><br>
        <button class="btn">Masuk</button>
    </form>
@endsection
