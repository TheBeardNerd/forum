<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_threads()
    {
        // Given we have a thread
        $this->get('/threads')
        // Then we should see the threads.
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        // Given we have a single thread
        $this->get($this->thread->path())
            // Then we should see the single thread.
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a thread which includes replies
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        // When we visit a thread page
        $this->get($this->thread->path())
            // Then we should see the replies.
            ->assertSee($reply->body);

    }
}
