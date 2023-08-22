<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        //
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'profile_path' => $this->actor['profile_path']
                ? "https://image.tmdb.org/t/p/w500//{$this->actor['profile_path']}"
                : "https://ui-avatars.com/api/?size=500&name={$this->actor['name']}",
            'age' => $this->actorAgeInYears($this->actor['birthday'])
        ]);
    }



    public function social()
    {
        return collect($this->social)->merge([
            'facebook' => $this->social['facebook_id']
                ? "https://www.facebook.com/{$this->social['facebook_id']}"
                : null,
            'twitter' => $this->social['twitter_id']
                ? "https://twitter.com/{$this->social['twitter_id']}"
                : null,
            'instagram' => $this->social['instagram_id']
                ? "https://www.instagram.com/{$this->social['instagram_id']}"
                : null,
        ]);
    }

    public function knownFromMovies()
    {
        return collect($this->credits)->sortByDesc('popularity')->take(5)->map(function ($movie) {
            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500//{$movie['poster_path']}",
                'link_to_page' => "/movies/{$movie['id']}"
            ]);
        });
    }

    public function credits()
    {
        return collect($this->credits)->map(function ($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }


            return collect($movie)->merge([
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'future',
                'title' => $title,
                'character' => $movie['character'] ?? '',
                'link_to_page' => "/movies/{$movie['id']}"

            ]);
        })->sortBy('release_year');
    }

    private function actorAgeInYears($birthDate)
    {
        return Carbon::now()->diffInYears(Carbon::parse($birthDate));
    }
}
