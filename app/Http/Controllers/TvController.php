<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowModel;
use App\ViewModels\TvViewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // $popularMovies = Http::withToken(config('services.tmdb.token'),'api_key')->get('https://api.themoviedb.org/3/movie/popular')
      // ->json();
      $popularTv = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/tv/popular')->json()['results'];
      
      $topRatedTv = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];

      $genres = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'];
      
      // $genres = collect($genresArray)->mapWithKeys(function ($genre) {
      //   return [$genre['id'] => $genre['name']];
      // });

      $viewModel= new TvViewsModel(
        $popularTv,
        $topRatedTv,
        $genres
      );
      return view('tv.index',$viewModel);
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
      $tvshow = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/tv/' . $id)->json();

      $credits = Http::withQueryParameters(['api_key' => config('services.tmdb.token')])->get('https://api.themoviedb.org/3/tv/' . $id . '/credits')->json();

      $images = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/tv/' . $id . '/images')->json();

      $videos = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1])->get('https://api.themoviedb.org/3/tv/' . $id . '/videos')->json();

      $viewModels = new TvShowModel(
        $tvshow,
        $credits,
        $images,
        $videos
      );
      return view('tv.show', $viewModels);
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
