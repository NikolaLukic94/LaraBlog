<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipatesInForumTest extends TestCase
{
    /** @test*/
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/thread/1/replies', []);

    }

    /** @test*/
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = \App\Models\User::factory()->create());

        $thread = \App\Models\Thread::factory()->create();

        $reply = \App\Models\Reply::factory()->create();

        $this->post('/threads/' . $thread->id . '/replies/' . $reply->toArray());

        // confim that is visible to the user
        $this->get($thread->path())->assertSee($reply->body);

    }
}
