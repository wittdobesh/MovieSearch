<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Models\Movie;
use App\Models\Actor;

class MovieTest extends TestCase
{
    protected Movie $movie;
    /**
     * Test movie can be initialized from array
     *
     * @return void
     */
    public function test_that_movie_can_initialize()
    {
        $cast = array(new Actor(['name' => 'John','character' => 'JohnCharacter']), new Actor(['name' => 'Jane','character' => 'JaneCharacter']));
        $movie = array('title' => 'test title', 'overview' => 'test overview', 'release_date' => '2008/12/22', 'runtime' => '291');
        $this->movie = new Movie($movie);
        $this->movie->cast = $cast;
        $this->assertTrue($this->movie->title == 'test title');
        $this->assertTrue($this->movie->overview == 'test overview');
        $this->assertTrue($this->movie->release_date == '2008/12/22');
        $this->assertTrue($this->movie->runtime == '291');
        $this->assertTrue($this->movie->cast[0]->name == 'John');
        $this->assertTrue($this->movie->cast[0]->character == 'JohnCharacter');        
        $this->assertTrue($this->movie->cast[1]->name == 'Jane');
        $this->assertTrue($this->movie->cast[1]->character == 'JaneCharacter');
    }
}
