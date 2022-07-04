<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use App\Models\Actor;

class MovieDBTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test that the application can get a response from the MovieDB API.
     *
     * @return void
     */
    public function test_the_application_can_get_response()
    {
        $response = $this->get('/api/movies');

        $response->assertStatus(200);
    }

    /**
     * Test that the application can initialize a Movie instance from a MovieDB API response.
     *
     * @return void
     */
    public function test_the_application_can_make_model()
    {
        //Mock MovieDB API responses
        Http::fake([
            'https://api.themoviedb.org/3/search/movie' => Http::response(array(
                "page"=>1,
                "results"=>[
                    (object) array("adult"=>false,"backdrop_path"=>"/rr7E0NoGKxvbkb89eR1GwfoYjpA.jpg","genre_ids"=>[18],"id"=>550,"original_language"=>"en","original_title"=>"Fight Club","overview"=>"A ticking-time-bomb insomniac and a slippery soap salesman channel primal male aggression into a shocking new form of therapy. Their concept catches on, with underground \"fight clubs\" forming in every town, until an eccentric gets in the way and ignites an out-of-control spiral toward oblivion.","popularity"=>42.091,"poster_path"=>"/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg","release_date"=>"1999-10-15","title"=>"Fight Club","video"=>false,"vote_average"=>8.4,"vote_count"=>24316),
                    (object) array("adult"=>false,"backdrop_path"=>"/kIWWulkzc3kELHJx84l3JNeZmzz.jpg","genre_ids"=>[35],"id"=>345922,"original_language"=>"en","original_title"=>"Fist Fight","overview"=>"When one school teacher gets the other fired, he is challenged to an after-school fight.","popularity"=>21.232,"poster_path"=>"/huRhv4IZDk2ds0DIDkI6uxdmb6J.jpg","release_date"=>"2017-02-16","title"=>"Fist Fight","video"=>false,"vote_average"=>6.1,"vote_count"=>1067),
                    (object) array("adult"=>false,"backdrop_path"=>"/iHthPe72Jfb3du2MeQcQsETUBsI.jpg","genre_ids"=>[28,80,53],"id"=>629017,"original_language"=>"en","original_title"=>"Run Hide Fight","overview"=>"A 17-year-old girl uses her wits, survival skills, and compassion to fight for her life, and those of her fellow classmates, against a group of live-streaming school shooters.","popularity"=>15.934,"poster_path"=>"/wlP25H14OvKoFORIwuKomZzioA5.jpg","release_date"=>"2020-09-10","title"=>"Run Hide Fight","video"=>false,"vote_average"=>6.7,"vote_count"=>257)
                ],
                "total_pages"=>1,
                "total_results"=>2)
            ),
            'https://api.themoviedb.org/3/movie/550' => Http::response(array(
                "adult"=>false,
                "backdrop_path"=>"/rr7E0NoGKxvbkb89eR1GwfoYjpA.jpg",
                "belongs_to_collection"=>null,
                "budget"=>63000000,
                "genres"=>["id"=>18,"name"=>"Drama"],
                "homepage"=>"http://www.foxmovies.com/movies/fight-club",
                "id"=>550,
                "imdb_id"=>"tt0137523",
                "original_language"=>"en",
                "original_title"=>"Fight Club",
                "overview"=>"A ticking-time-bomb insomniac and a slippery soap salesman channel primal male aggression into a shocking new form of therapy. Their concept catches on, with underground \"fight clubs\" forming in every town, until an eccentric gets in the way and ignites an out-of-control spiral toward oblivion.","popularity"=>42.091,"poster_path"=>"/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg",
                "production_companies"=>[
                    (object) array("id"=>508,"logo_path"=>"/7PzJdsLGlR7oW4J0J5Xcd0pHGRg.png","name"=>"Regency Enterprises","origin_country"=>"US")
                ],
                "production_countries"=>[(object) array("iso_3166_1"=>"DE","name"=>"Germany")],
                "release_date"=>"1999-10-15",
                "revenue"=>100853753,
                "runtime"=>139,
                "spoken_languages"=>[(object) array("english_name"=>"English","iso_639_1"=>"en","name"=>"English")],
                "status"=>"Released",
                "tagline"=>"Mischief. Mayhem. Soap.",
                "title"=>"Fight Club",
                "video"=>false,
                "vote_average"=>8.4,
                "vote_count"=>24320)
            ),
            'https://api.themoviedb.org/3/movie/550/credits' => Http::response(array(
                    "id"=> 550,
                    "cast"=> (object) array(
                        (object) array(
                    "adult"=> false,
                    "gender"=> 2,
                    "id"=> 819,
                    "known_for_department"=> "Acting",
                    "name"=> "Edward Norton",
                    "original_name"=> "Edward Norton",
                    "popularity"=> 19.153,
                    "profile_path"=> "/5XBzD5WuTyVQZeS4VI25z2moMeY.jpg",
                    "cast_id"=> 4,
                    "character"=> "The Narrator",
                    "credit_id"=> "52fe4250c3a36847f80149f3",
                    "order"=> 0
                        ),
                        (object) array(
                    "adult"=> false,
                    "gender"=> 2,
                    "id"=> 287,
                    "known_for_department"=> "Acting",
                    "name"=> "Brad Pitt",
                    "original_name"=> "Brad Pitt",
                    "popularity"=> 53.52,
                    "profile_path"=> "/tJiSUYst4ddIaz1zge2LqCtu9tw.jpg",
                    "cast_id"=> 5,
                    "character"=> "Tyler Durden",
                    "credit_id"=> "52fe4250c3a36847f80149f7",
                    "order"=> 1
                        ),
                        (object) array(
                    "adult"=> false,
                    "gender"=> 0,
                    "id"=> 1327146,
                    "known_for_department"=> "Costume & Make-Up",
                    "name"=> "Wendy M. Craig",
                    "original_name"=> "Wendy M. Craig",
                    "popularity"=> 0.694,
                    "profile_path"=> null,
                    "credit_id"=> "595513299251412b2304f78e",
                    "department"=> "Costume & Make-Up",
                    "job"=> "Set Costumer"
                        ),
                        (object) array(
                    "adult"=> false,
                    "gender"=> 1,
                    "id"=> 1283,
                    "known_for_department"=> "Acting",
                    "name"=> "Helena Bonham Carter",
                    "original_name"=> "Helena Bonham Carter",
                    "popularity"=> 16.753,
                    "profile_path"=> "/DDeITcCpnBd0CkAIRPhggy9bt5.jpg",
                    "cast_id"=> 6,
                    "character"=> "Marla Singer",
                    "credit_id"=> "52fe4250c3a36847f80149fb",
                    "order"=> 2
                        )
                    )
                )
            )
        ]);
        //First request for finding the movie doesn't give us all the data we need, so we need to round up what we need
        $movies = json_decode(Http::get('https://api.themoviedb.org/3/search/movie')->body());
        $id = $movies->results[0]->id;
        //We have the movie ID, now we can get everything except for the cast
        $movie = collect(json_decode(Http::get("https://api.themoviedb.org/3/movie/{$id}")->body(),true));
        //This will get us the credits, but we need to filter for just the actors
        $credits = json_decode(Http::get("https://api.themoviedb.org/3/movie/{$id}/credits")->body(),true);
        $cast = collect($credits['cast'])->filter(function($c) {return $c['known_for_department'] == 'Acting';})->mapInto(Actor::class);

        /*
        * Eloquent can fill our model, but if we fill the array of Actors, 
        * each Actor becomes an array, so instead we fill the primitive types, 
        * and then populate the cast afterwards
        */
        $movie = new Movie($movie->toArray());
        
        $movie->cast = $cast;
        
        $this->assertTrue($movie->title == 'Fight Club');
        $this->assertTrue($movie->overview == 'A ticking-time-bomb insomniac and a slippery soap salesman channel primal male aggression into a shocking new form of therapy. Their concept catches on, with underground "fight clubs" forming in every town, until an eccentric gets in the way and ignites an out-of-control spiral toward oblivion.');
        $this->assertTrue($movie->runtime == 139);
        $this->assertTrue($movie->release_date == '1999-10-15');
        $this->assertTrue($movie->cast[0]->name == 'Edward Norton');
        $this->assertFalse(collect($movie->cast)->contains(function($c) {return $c->name == 'Wendy M. Craig';}));
    }
}
