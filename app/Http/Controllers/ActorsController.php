<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewsModel;
use App\ViewModels\ActorViewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
      abort_if($page > 500 ,204);
      $popularActors = Http::withQueryParameters(['api_key' => config('services.tmdb.token'),
      'page' => 1,'page' => $page])->get('https://api.themoviedb.org/3/person/popular')->json()['results'];

      $viewModel = new ActorsViewsModel($popularActors,$page);

      return view('actors.index',$viewModel);
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

      $actor = Http::withQueryParameters(['api_key' => config('services.tmdb.token')])->get('https://api.themoviedb.org/3/person/' . $id)->json();

      $social = Http::withQueryParameters(['api_key' => config('services.tmdb.token')])->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')->json();

      $credits = Http::withQueryParameters(['api_key' => config('services.tmdb.token')])->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')->json();

      $viewModel= new ActorViewsModel($actor, $social,$credits);

      return view('actors.show', $viewModel);
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
