@extends('layout')

@section('content')
    <h2>Edit Proyek</h2>
    <form action="{{ route('projects.update', $project) }}" method="POST">
        @method('PUT')
        @include('projects._form')
    </form>
@endsection
