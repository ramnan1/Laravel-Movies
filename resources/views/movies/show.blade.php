@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
      <div class="container mx-auto px4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
          <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-64 lg:w-96" style="width: 24rem">
          
        </div>
        <div class="ml-3 md:ml-24">
          <h2 class="font-semibold text-4xl">
            {{ $movie['title'] }}
          </h2>
          <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"></path></g></svg>
            <span class="ml-1">{{ $movie['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span>{{ ($movie['release_date']) }}</span>
            <span class="mx-2">|</span>
            <span class="">
                {{ $movie['genres'] }}
            </span>
          </div>
          <p class="text-gray-300 mt-8">
            {{ $movie['overview'] }}
          </p>
          <div class="mt-12">
            <h4 class="text-white font-semibold">
              Fetured Crew
            </h4>
            <div class="flex mt-4">
              @foreach ($credits['crew'] as $crew)
                  <div class="mr-8">
                    <div class="">{{ $crew['name'] }}</div>
                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                  </div>
              @endforeach
            </div>
          </div>

          <div x-data="{ isOpen: false }">
            @if (count($videos['results'])> 0)
              <div class="mt-12">
                <button
                @click="isOpen = true"
                class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                  <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                  <span class="ml-2">Play Trailer</span>
                </button>
              </div>
              <template x-if="isOpen">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $videos['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </template> 
            @endif

          </div>
        </div>
      </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
      <div class="container mx-auto py-6 px-4">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
          @foreach ($credits['cast'] as $cast)
                <div class="mt-8">
                  <a href="{{ route('actors.show',$cast['id']) }}">
                    <img src="{{ $cast['profile_path'] }}" class="hover:opacity-75 transition ease-in-out duration-150" alt="">
                  </a>
                  <div class="mt-2">
                    <a href="{{ route('actors.show',$cast['id']) }}" class="mt-2 text-lg hover:text-gray-300">{{ $cast['name'] }}</a>
                    <div class=" text-gray-400 text-sm ">
                      {{ $cast['character'] }}
                    </div>
                  </div>
                </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="movie-images border-b border-gray-800" x-data="{isOpen: false,image: ''}">
      <div class="container mx-auto py-6 px-4">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
          @foreach ($images['backdrops'] as $backdrops)
            <div class="mt-8">
              <button @click="isOpen = true,image = 'https://image.tmdb.org/t/p/original/{{ $backdrops['file_path'] }}'">
                <img src="https://image.tmdb.org/t/p/w500/{{ $backdrops['file_path'] }}" class="hover:opacity-75 transition ease-in-out duration-150" alt="">
              </button>
            </div>
          @endforeach
        </div>
        <div
        x-show="isOpen"
            style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button
                            @click="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                        <img :src="image" alt="poster">
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection