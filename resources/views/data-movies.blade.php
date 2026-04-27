@extends('layouts.app')

@section('title', 'Data Movie')

@section('content')

<h1>Data Movie</h1>

@include('partials.table-movies', ['movies' => $movies])

<div class="d-flex justify-content-center">
    {{ $movies->links() }}
</div>

@endsection