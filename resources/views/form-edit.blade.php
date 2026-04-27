@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')

<h2 class="mb-4">Edit Movie</h2>

<form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">ID Film:</label>
        <input type="text" class="form-control" value="{{ $movie->id }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Judul:</label>
        <input type="text" name="judul" class="form-control" value="{{ $movie->judul }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori:</label>
        <select name="category_id" class="form-select" required>
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ $movie->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Sinopsis:</label>
        <textarea name="sinopsis" class="form-control" rows="4" required>{{ $movie->sinopsis }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tahun:</label>
        <input type="number" name="tahun" class="form-control" value="{{ $movie->tahun }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Pemain:</label>
        <input type="text" name="pemain" class="form-control" value="{{ $movie->pemain }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Sebelumnya:</label><br>
        <img src="{{ asset('images/' . $movie->foto_sampul) }}" 
             class="img-thumbnail" width="120">
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Sampul:</label>
        <input type="file" name="foto_sampul" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>

</form>

@endsection