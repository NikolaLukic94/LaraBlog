<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    // use DatabaseMigration;

    public function setUp() :void
    {
        parent::setUp();
        // since in most tests require new thread
        $this->thread = \App\Models\Thread::factory()->create();
    }

    /** @test*/
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test*/
    public function a_user_can_view_single_threads()
    {
        $response = $this->get('/threads/' . $this->thread->id)->assertSee($this->thread->title);
    }

    /** @test*/
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = \App\Models\Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
    }

    /** @test*/
    public function a_thread_can_have_a_reply()
    {
        // UNIT
        $thread = \App\Models\Thread::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }

    /** @test*/
    public function a_thread_has_a_creator()
    {
        // UNIT
        $thread = \App\Models\Thread::factory()->create();

        $this->assertInstanceOf('App\Models\User', $thread->creator);
    }

    /** @test*/
    public function a_thread_can_add_a_reply()
    {
        // UNIT
        $thread = \App\Models\Thread::factory()->create();

        $thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $thread->replies);
    }
}
