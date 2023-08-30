<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewsModel;
use App\ViewModels\MovieViewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // $popularMovies = Http::withToken(config('services.tmdb.token'),'api_key')->get('https://api.themoviedb.org/3/movie/popular')
      // ->json();
      $popularMovies = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];
      
      $nowPlayingMovies = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];

      $genres = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
      
      // $genres = collect($genresArray)->mapWithKeys(function ($genre) {
      //   return [$genre['id'] => $genre['name']];
      // });

      $viewModel= new MoviesViewsModel(
        $popularMovies,
        $nowPlayingMovies,
        $genres
      );
      return view('movies.index',$viewModel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $movie = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/movie/' . $id)->json();

      $credits = Http::withQueryParameters(['api_key' => config('services.tmdb.token')])->get('https://api.themoviedb.org/3/movie/' . $id . '/credits')->json();

      $images = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/movie/' . $id . '/images')->json();

      $videos = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')->json();

      $viewModels = new MovieViewsModel(
        $movie,
        $credits,
        $images,
        $videos
      );
      return view('movies.show', $viewModels);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
