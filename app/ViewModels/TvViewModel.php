<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTvShows;
    public $topRatedTvShows;
    public $genres;

    public function __construct($popularTvShows, $topRatedTvShows, $genres)
    {
        $this->popularTvShows = $popularTvShows;
        $this->topRatedTvShows = $topRatedTvShows;
        $this->genres = $genres;
    }

    public function popularTvShows()
    {
        return $this->formatTv($this->popularTvShows);
    }

    public function topRatedTvShows()
    {
        return $this->formatTv($this->topRatedTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function (array $genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatTv($tvShows)
    {
        return collect($tvShows)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500/{$tvshow['poster_path']}",
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }




}
