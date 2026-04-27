@extends('layouts.app')

@section('title', 'Tambah Movie')

@section('content')

<a href="{{ url('/movies/data') }}" class="btn btn-primary mt-4">List Movie</a>

<h2 class="mb-4">Tambah Movie Baru</h2>

{{-- ERROR VALIDATION --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/movies/store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">ID Film:</label>
        <input type="text" name="id" class="form-control" value="{{ old('id') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Judul:</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori:</label>
        <select name="category_id" class="form-select" required>
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Sinopsis:</label>
        <textarea name="sinopsis" class="form-control" rows="4" required>{{ old('sinopsis') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tahun:</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Pemain:</label>
        <input type="text" name="pemain" class="form-control" value="{{ old('pemain') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Sampul:</label>
        <input type="file" name="foto_sampul" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>

</form>

@endsection