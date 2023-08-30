<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvViewsModel extends ViewModel
{
  public $popularTv;
  public $topRatedTv;
  public $genres;
    public function __construct($popularTv,$topRatedTv,$genres)
    {
      $this->popularTv = $popularTv;
      $this->topRatedTv = $topRatedTv;
      $this->genres = $genres;
    }

    public function popularTv()
    {
      return $this->formatMovies($this->popularTv);
    }

    public function topRatedTv()
    {
      return $this->formatMovies($this->topRatedTv);
    }

    public function genres()
    {
      return collect($this->genres)->mapWithKeys(function ($genre) {
        return [$genre['id'] => $genre['name']];
      });
    }

    private function formatMovies($tvShows)
    {
      // @foreach ($tvShows['genre_ids'] as $genre) {{ $genres[$genre] }}@if (!$loop->last) , @endif @endforeach
      return collect($tvShows)->map(function($tvShow) {
        $genresformated = collect($tvShow['genre_ids'])->mapWithKeys(function($value) {
          return [$value => $this->genres()->get($value)];
        })->implode(', ');
        return collect($tvShow)->merge([
          'poster_path' => "https://image.tmdb.org/t/p/w500" . $tvShow['poster_path'],
          'vote_average' => $tvShow['vote_average'] * 10 . '%',
          'first_air_date' => \Carbon\Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
          'genres' => $genresformated
        ])->only('id','poster_path','first_air_date','genres','overview','vote_average','name');
      });
    }
}
