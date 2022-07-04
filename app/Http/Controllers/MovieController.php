<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MovieDBService;

class MovieController extends Controller
{
    protected $movieDBService;
    public function __construct(MovieDBService $movieDBService)
    {
        $this->movieDBService = $movieDBService;
    }
    /**
     * Get the movie
     *
     * @param  string $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
        try {
            $movie = $this->movieDBService->searchMovie($request->get('search'));
        }
        catch (\Exception $e) {
            error_log($e->getMessage());
            return new Response(null,404);
        }
        //var_dump($movie);
        $response = new Response($movie->toJson());
        return $response;
    }
}
