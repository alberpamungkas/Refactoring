<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getMovies(request('search'));
        return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = $this->movieService->getMovieById($id);
        return view('detail', compact('movie'));
    }

    public function store(Request $request)
    {
        $this->movieService->store($request);
        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $this->movieService->update($request, $id);
        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->movieService->delete($id);
        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }
    public function data()
    {
        $movies = $this->movieService->getMovies();
        return view('data-movies', compact('movies'));
    }
}
