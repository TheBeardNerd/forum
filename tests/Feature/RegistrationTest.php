<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    // /** @test */
    public function a_confirmaition_email_is_sent_upon_registration()
    {
        Mail::fake();

        $this->post('/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar'
        ]);

        Mail::assertQueued(VerifyEmail::class);
    }

    /** @test */
    public function user_can_fully_confirm_their_email_addresses()
    {
        $user = create('App\User', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar'
        ]);
        $user = User::whereName('John')->first();

        $this->assertNotNull($user->email_verified_at);
    }
}
