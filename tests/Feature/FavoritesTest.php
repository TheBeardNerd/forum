<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_may_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_may_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->withoutExceptionHandling()
            ->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    function an_authenticated_user_may_unfavorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $reply->favorite();

        $this->withoutExceptionHandling()
            ->delete('replies/' . $reply->id . '/favorites');

        $this->assertCount(0, $reply->favorites);
    }

    /** @test */
    function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create('App\Reply');

        try {
            $this->withoutExceptionHandling();
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Womp Womp.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
