@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>    
@endif

<h1>Popular Movie</h1>

<div class="row">
    @foreach ($movies as $movie)
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="row g-0">
                
                <div class="col-md-4">
                    <img src="{{ asset('images/' . $movie->foto_sampul) }}" 
                         class="img-fluid rounded-start" 
                         alt="{{ $movie->judul }}">
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        
                        <h5 class="card-title">{{ $movie->judul }}</h5>

                        <p class="card-text">
                            {{ Str::limit($movie->sinopsis, 100) }}
                        </p>

                        <a href="{{ url('/movie/' . $movie->id) }}" 
                           class="btn btn-success">
                           Lihat Selanjutnya
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $movies->links() }}
</div>

@endsection