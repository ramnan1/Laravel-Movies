@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
      <div class="popular-movies">
        <h2 class="tracking-wider uppercase text-orange-500 text-lg font-semibold">
          Popular Movies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
          @foreach ($popularMovies as $movies)
            <x-movie-card :movies="$movies" />
          @endforeach
          
        </div>
      </div>
      <div class="now-playing-movies py-24">
        <h2 class="tracking-wider uppercase text-orange-500 text-lg font-semibold">
          Now Playing
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
          @foreach ($nowPlayingMovies as $movies)
          <x-movie-card :movies="$movies" />
              
          @endforeach
          
        </div>
      </div>
    </div>
@endsection