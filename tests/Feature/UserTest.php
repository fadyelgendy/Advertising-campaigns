<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * Test User login.
     *
     * @return void
     */
    public function test_user_login()
    {
        // create user
        $user = User::Factory()->make();

        $response = $this->call("POST", "/api/login", [
            'email' => $user->email,
            'password' => $user->password,
            '_token' => csrf_token()
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_user_login_with_wrong_credentials()
    {
        $response = $this->call("POST", "/api/login", [
            'email' => "fady_gendy@test.com",
            'password' => "12345678",
            '_token' => csrf_token()
        ]);

        $response->assertStatus(200)
        ->assertJson(["errors" => "Not Authenticated!"]);
    }

    /**
     * Test create user
     *
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->call("POST", "/api/register", [
            'name' => 'user one',
            'email' => "test@test.com",
            'password' => "123456",
            'password_confirmation' => '123456'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }
}
