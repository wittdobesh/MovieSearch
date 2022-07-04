<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Models\Movie;
use App\Models\Actor;

class ActorTest extends TestCase
{
    protected Actor $actor;
    /**
     * Test movie can be initialized from array
     *
     * @return void
     */
    public function test_that_movie_can_initialize()
    {
        $this->actor = new Actor(['name' => 'John','character' => 'JohnCharacter']);
        $this->assertTrue($this->actor->name == 'John');
        $this->assertTrue($this->actor->character == 'JohnCharacter');      
    }
}
