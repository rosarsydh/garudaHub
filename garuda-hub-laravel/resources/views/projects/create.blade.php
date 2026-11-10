@extends('layout')

@section('content')
    <h2>Tambah Proyek</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @include('projects._form')
    </form>
@endsection
