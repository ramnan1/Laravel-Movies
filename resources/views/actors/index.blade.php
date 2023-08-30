@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
      <div class="popular-actors">
        <h2 class="tracking-wider uppercase text-orange-500 text-lg font-semibold">
          Popular Actors
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
          @foreach ($popularActors as $actor)
            <div class="actor mt-8">
              <a href="{{ route('actors.show',$actor['id']) }}">
                <img  class="hover:opacity-75 transition ease-in-out duration-150" src="{{ $actor['profile_path'] }}" alt="profile=image">
              </a>
              <div class="mt-2">
                <a href="{{ route('actors.show',$actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      
      {{-- <div class="flex justify-between mt-8">
        @if ($previous)
          <a href="/actors/page/{{ $previous }}">Previous</a> 
          <div class=""></div>
        @endif
        @if ($next)
        <div class=""></div>
          <a href="/actors/page/{{ $next }}">Next</a>
        @endif
      </div> --}}

      <div class="page-load-status">
        <div class="flex justify-center">
          <p class="infinite-scroll-request spinner my-8 text-4xl mx-auto">&nbsp;</p>

        </div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error mt-8">Error..</p>
      </div>

    </div>
@endsection

@section('infinite')
  <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
  <script>
    let elem = document.querySelector('.grid');
    let infScroll = new InfiniteScroll( elem, {
      // options
      path: '/actors/page/@{{#}}',
      append: '.actor',
      status: '.page-load-status'
      // history: false,
    });
  </script>
@endsection