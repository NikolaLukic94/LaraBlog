<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    /** @test*/
    public function it_has_an_owner()
    {
        // this should be unit test but factory won't work
        $reply = \App\Models\Reply::factory()->create();

        $this->assertInstanceOf('App\Models\User', $reply->owner);
    }
}
