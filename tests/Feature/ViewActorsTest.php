<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Random;
use Tests\TestCase;

class ViewActorsTest extends TestCase
{
    public function testTheIndexPageShowsCorrectInfo()
    {
        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=1' => $this->fakePopularActors()
        ]);

        $response = $this->get(route('actors.index'));

        $response->assertSuccessful();

        $response->assertSeeText('Popular Actors');
        $response->assertSeeText('Will Smith');
        $response->assertSeeText('Robert Downey Jr');
        $response->assertSeeTextInOrder(['Independence Day', 'Suicide Squad']);
        $response->assertSeeTextInOrder(['Will Smith', 'Robert Downey Jr']);
    }

    public function testPage2ShowsCorrectInfo()
    {
        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=2' => $this->fakePopularActorsPage2()
        ]);

        $response = $this->get('/actors/page/2');

        $response->assertSuccessful();

        $response->assertSeeText('Popular Actors');
        $response->assertSeeText('Will Smith 2');
        $response->assertSeeText('Robert Downey Jr. 2');
        $response->assertSeeTextInOrder(['Independence Day 2', 'Suicide Squad 2']);
        $response->assertSeeTextInOrder(['Will Smith 2', 'Robert Downey Jr. 2']);
    }

    public function testActorPageShowsCorrectInfo()
    {
        Http::fake([
            'https://api.themoviedb.org/3/person/3101' => $this->fakeActor(),
            'https://api.themoviedb.org/3/person/3101/external_ids' => $this->fakeSocial(),
            'https://api.themoviedb.org/3/person/3101/combined_credits' => $this->fakeCredits(),
        ]);

        $response = $this->get(route('actors.show', 3101));
        $response->assertSuccessful();

        $response->assertSeeText('Will Smith');
        $response->assertSeeText('Philadelphia, Pennsylvania, U.S.A.');
        $response->assertSeeText('54 years old'); // may change in the future, it is dynamic
        $response->assertSeeText('film producer and pop rapper');
        $response->assertSeeText('Captain Steven Hiller');
        $response->assertSeeText('The Pursuit of Happyness');
        $response->assertSee('https://www.instagram.com/willsmith');


    }

    private function fakePopularActors()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 18.03,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 2888,
                    "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "Independence Day",
                            "id" => "602",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Suicide Squad",
                            "id" => "297761",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "I am Legend",
                            "id" => "6479",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Will Smith"
                ],
                [
                    "popularity" => 18.491,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 3223,
                    "profile_path" => "/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "The Avengers",
                            "id" => "24428",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Iron Man",
                            "id" => "1726",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Avengers: Infinity War",
                            "id" => "299536",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Robert Downey Jr."
                ],
            ]
        ], 200);
    }

    private function fakePopularActorsPage2()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 18.03,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 2888,
                    "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "Independence Day 2",
                            "id" => "602",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Suicide Squad 2",
                            "id" => "297761",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "I am Legend 2",
                            "id" => "6479",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Will Smith 2"
                ],
                [
                    "popularity" => 18.491,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 3223,
                    "profile_path" => "/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "The Avengers 2",
                            "id" => "24428",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Iron Man 2",
                            "id" => "1726",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Avengers: Infinity War 2",
                            "id" => "299536",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Robert Downey Jr. 2"
                ],
            ]
        ], 200);
    }
    private function fakeActor()
    {
        return Http::response([
            "birthday" => "1968-09-25",
            "known_for_department" => "Acting",
            "deathday" => null,
            "id" => 2888,
            "name" => "Will Smith",
            "gender" => 2,
            "biography" => "Willard Christopher Smith is an American actor, film producer and pop rapper. He has enjoyed success in music",
            "popularity" => 18.03,
            "place_of_birth" => "Philadelphia, Pennsylvania, U.S.A.",
            "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
            "adult" => false,
            "homepage" => "http://www.willsmith.com",
        ], 200);
    }

    private function fakeSocial()
    {
        return Http::response([

            "id" => 2888,
            "twitter_id" => null,
            "facebook_id" => "WillSmith",
            "tvrage_id" => 9542,
            "instagram_id" => "willsmith",
            "freebase_mid" => "/m/0147dk",
            "imdb_id" => "nm0000226",
            "freebase_id" => "/en/will_smith",

        ], 200);
    }

    private function fakeCredits()
    {
        return Http::response([
            'cast' => [
                [
                    "id" => 602,
                    "character" => "Captain Steven Hiller",
                    "original_title" => "Independence Day",
                    "overview" => "On July 2, a giant alien mothership enters orbit around Earth and deploys several dozen saucer-shaped 'destroyer' spacecraft that quickly lay waste to major city",
                    "vote_count" => 6189,
                    "video" => false,
                    "media_type" => "movie",
                    "release_date" => "1996-06-25",
                    "vote_average" => 6.8,
                    "title" => "Independence Day",
                    "popularity" => 23.016,
                    "original_language" => "en",
                    "backdrop_path" => "/4E2xKGrU2qcqUE2S3Nl27hwZdqy.jpg",
                    "adult" => false,
                    "poster_path" => "/bqLlWZJdhrS0knfEJRkquW7L8z2.jpg",
                    "credit_id" => "52fe425bc3a36847f8017f8b",
                ],
                [
                    "id" => 1402,
                    "character" => "Chris Gardner",
                    "original_title" => "The Pursuit of Happyness",
                    "overview" => "A struggling salesman takes custody of his son as he's poised to begin a life-changing professional career.",
                    "vote_count" => 6072,
                    "video" => false,
                    "media_type" => "movie",
                    "poster_path" => "/iMNp6gTeDBXbzjKRNYtorxZ76G2.jpg",
                    "backdrop_path" => "/yFQg8nKzAWGNNBg277bvHyWSCJu.jpg",
                    "popularity" => 18.202,
                    "title" => "The Pursuit of Happyness",
                    "original_language" => "en",
                    "vote_average" => 7.9,
                    "adult" => false,
                    "release_date" => "2006-12-14",
                    "credit_id" => "52fe42f3c3a36847f802f1eb",
                ]
            ]
        ], 200);
    }
}
