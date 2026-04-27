<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Interfaces\MovieRepositoryInterface;

class MovieService
{
    protected $movieRepo;

    public function __construct(MovieRepositoryInterface $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    public function getMovies($search = null)
    {
        return $this->movieRepo->getAll($search);
    }

    public function getMovieById($id)
    {
        return $this->movieRepo->findById($id);
    }

    public function store($request)
    {
        $fileName = $this->uploadImage($request);

        return $this->movieRepo->create([
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
        $movie = $this->movieRepo->findById($id);

        if ($request->hasFile('foto_sampul')) {
            if (File::exists(public_path('images/' . $movie->foto_sampul))) {
                File::delete(public_path('images/' . $movie->foto_sampul));
            }

            $fileName = $this->uploadImage($request);
        } else {
            $fileName = $movie->foto_sampul;
        }

        return $this->movieRepo->update($id, [
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
        $movie = $this->movieRepo->findById($id);

        if (File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        return $this->movieRepo->delete($id);
    }

    private function uploadImage($request)
    {
        $fileName = Str::uuid() . '.' . $request->file('foto_sampul')->getClientOriginalExtension();
        $request->file('foto_sampul')->move(public_path('images'), $fileName);

        return $fileName;
    }
}