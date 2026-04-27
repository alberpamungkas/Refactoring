<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MovieService
{
    public function getMovies($search = null)
    {
        $query = Movie::latest();

        if ($search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('sinopsis', 'like', "%$search%");
        }

        return $query->paginate(6);
    }

    public function getMovieById($id)
    {
        return Movie::findOrFail($id);
    }

    public function store($request)
    {
        $fileName = $this->uploadImage($request);

        return Movie::create([
            'id' => $request->id,
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'sinopsis' => $request->sinopsis,
            'tahun' => $request->tahun,
            'pemain' => $request->pemain,
            'foto_sampul' => $fileName,
        ]);
    }

    public function update($request, $id)
    {
        $movie = Movie::findOrFail($id);

        if ($request->hasFile('foto_sampul')) {

            // hapus foto lama
            if (File::exists(public_path('images/' . $movie->foto_sampul))) {
                File::delete(public_path('images/' . $movie->foto_sampul));
            }

            $fileName = $this->uploadImage($request);
        } else {
            $fileName = $movie->foto_sampul;
        }

        return $movie->update([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'sinopsis' => $request->sinopsis,
            'tahun' => $request->tahun,
            'pemain' => $request->pemain,
            'foto_sampul' => $fileName,
        ]);
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);

        if (File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        return $movie->delete();
    }

    private function uploadImage($request)
    {
        $fileName = Str::uuid() . '.' . $request->file('foto_sampul')->getClientOriginalExtension();
        $request->file('foto_sampul')->move(public_path('images'), $fileName);

        return $fileName;
    }
}