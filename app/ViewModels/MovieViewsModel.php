<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewsModel extends ViewModel
{
  public $movie;
  public $credits;
  public $images;
  public $videos;

  public function __construct($movie,$credits,$images,$videos)
    {
      $this->movie = $movie;
      $this->credits = $credits;
      $this->images = $images;
      $this->videos = $videos;
    }

  public function movie()
  {
    return collect($this->movie)->merge([
      'poster_path' => "https://image.tmdb.org/t/p/w500" . $this->movie['poster_path'],
      'vote_average' => $this->movie['vote_average'] * 10 . '%',
      'release_date' => \Carbon\Carbon::parse($this->movie['release_date'])->format('M d, Y'),
      'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', ')
    ])->only('id','poster_path','release_date','genres','title','vote_average','name','overview');
  }

  public function credits()
  {
    return collect($this->credits)->merge([
      'crew' => collect($this->credits['crew'])->take(2),
      'cast' => collect($this->credits['cast'])->take(5)->map(function($cast) {
        return collect($cast)->merge([
            'profile_path' => $cast['profile_path']
                ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                : 'https://via.placeholder.com/300x450',
        ]);
    }),
    ])->only('id', 'crew' , 'cast');
  }

  public function videos()
  {
    return collect($this->videos)->merge([
      'results' => collect($this->videos['results'])->take(1)
    ])->only('results', 'id');
  }

  public function images()
  {
    return collect($this->images)->merge([
      'backdrops' => collect($this->images['backdrops'])->take(9)
    ])->only('id','backdrops');
  }

}
