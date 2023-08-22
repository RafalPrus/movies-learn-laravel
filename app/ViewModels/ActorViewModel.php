<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $knownFromMovies;

    public function __construct($actor, $social, $knownFromMovies)
    {
        //
        $this->actor = $actor;
        $this->social = $social;
        $this->knownFromMovies = $knownFromMovies;
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
        return collect($this->knownFromMovies)->sortByDesc('popularity')->take(5)->map(function ($movie) {
            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500//{$movie['poster_path']}",
                'link_to_page' => "/movies/{$movie['id']}"
            ]);
        });
    }

    public function credits()
    {
        return $this->social()->sortBy('release_date');
    }

    private function actorAgeInYears($birthDate)
    {
        return Carbon::now()->diffInYears(Carbon::parse($birthDate));
    }
}
