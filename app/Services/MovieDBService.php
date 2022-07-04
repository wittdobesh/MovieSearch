<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\Actor;

class MovieDBService {
    private $api_key;
    private $uri;

    public function __construct($uri, $api_key) {
        try {
            if($api_key == null) {
                abort(401, 'Please set a valid API key in the configuration');
            }
            $this->api_key = $api_key;
            $this->uri = $uri;
        }
        catch (\UnexpectedValueException $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Search for the movie, get the details and cast
     *
     * @param  string $search
     * @return Movie
     */
    public function searchMovie($search) {
        $response = Http::get($this->uri.'/search/movie', [
            'api_key' => $this->api_key,
            'query' => $search,
        ]);
        if($response->successful()) {
            $movies = json_decode($response->body());
            if(count($movies->results) <= 0) {
                abort(404, 'MovieDBService failed to find any movies for string provided');
            }
            $id = $movies->results[0]->id;
            try {
                $movie = $this->getMovie($id);
            }
            catch (\Exception $e) {
                error_log($e->getMessage());
            }
            try {
                $movie->cast = $this->getActors($id);
            }
            catch (\Exception $e){
                error_log($e->getMessage());
            }
            return $movie;
        }
        abort(404, 'MovieDBService failed to find requested movie');
        return new Movie();
    }

     /**
     * Get the movie
     *
     * @param  int $id
     * @return Movie
     */
    public function getMovie($id) {
        $response = Http::get($this->uri."/movie/{$id}", [
            'api_key' => $this->api_key,
        ]);
        if($response->successful()) {
            /*
            * Eloquent can fill our model, but if we fill the array of Actors, 
            * each Actor becomes an array, so instead we fill the primitive types, 
            * and then populate the cast afterwards
            */
            return new Movie(json_decode($response->body(),true));
        }
        abort(404, 'MovieDBService failed to retrieve movie details');
        return new Movie();
    }
    
    /**
     * Get the top 10 actors from movie credits
     *
     * @param  int $id
     * @return array
     */
    public function getActors($id) {
        $response = Http::get($this->uri."/movie/{$id}/credits", [
            'api_key' => $this->api_key,
        ]);
        if($response->successful()) {
            $credits = json_decode($response->body(),true);
            $cast = collect($credits['cast'])->filter(function($c) {return $c['known_for_department'] == 'Acting';})->take(10)->mapInto(Actor::class);
            return $cast->toArray();
        }
        abort(404, 'MovieDBService failed to retrieve credits');
        return array();
    }
}