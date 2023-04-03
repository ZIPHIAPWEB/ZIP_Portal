<?php

namespace Tests\Feature;

use App\Mail\verifyEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use WithFaker;

    public function setUp() : void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    public function test_user_can_register()
    {
        Mail::fake();

        $email = $this->faker->email;

        $response = $this->postJson('api/register', [
            'username' => $this->faker->userName,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(201);
        Mail::assertSent(verifyEmail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    public function test_user_cannot_register_if_username_already_used()
    {
        $user = User::factory()->create();

        $response = $this->postJson('api/register', [
            'username' => $user->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(422);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create(['password' => bcrypt('password'), 'verified' => true]);

        $response = $this->postJson('api/login', [
            'username' => $user->name,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    public function test_user_cannot_login_if_not_registered()
    {        
        $response = $this->postJson('api/login', [
            'username' => 'dsadasdsa',
            'password' => 'sadasd'
        ]);

        $response->assertStatus(401);
    }

    public function test_user_cannot_login_if_not_verified()
    {
        $response = $this->postJson('api/login', [
            'username' => 'john_doe',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
    }

    public function test_user_can_resend_email_verification()
    {
        Mail::fake();

        $user = User::factory()->create(['password' => bcrypt('password'), 'verified' => false]);

        $this->actingAs($user);

        $response = $this->postJson('api/verify/resend-email');

        $response->assertStatus(200);
        Mail::assertSent(verifyEmail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_user_cannot_resend_email_verification_if_already_verified()
    {
        $user = User::factory()->create(['password' => bcrypt('password'), 'verified' => true]);

        $this->actingAs($user);

        $response = $this->postJson('api/verify/resend-email');

        $response->assertStatus(403);
    }

    public function test_user_cannot_resend_email_if_not_logged_in()
    {
        $response = $this->postJson('api/verify/resend-email');

        $response->assertStatus(401);
    }
}
