@props(['popularTvShows', 'topRatedTvShow', 'genres'])
@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularTvShows as $tvShow)
                    <x-tv-card :tvShow="$tvShow" :genres="$genres"/>
                @endforeach
            </div>
        </div>
        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($topRatedTvShows as $tvShow)
                    <x-tv-card :tvShow="$tvShow"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
