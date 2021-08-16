<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginTest extends TestCase
{
    public function test_get_login_true()
    {
        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('home.login');
    }

    public function test_get_login_false()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/');
        $response->assertRedirect('/feed');

        $user->delete();
    }

    public function test_post_login_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $credential = [
            'email'    => $user->email,
            'password' => config('database.factory_user_password'),
        ];

        $response = $this->post('/login', $credential);
        $response->assertRedirect('/feed');

        $user->delete();
    }

    public function test_post_login_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $credential = [
            'email'    => $user->email,
            'password' => 'incorrectpass',
        ];

        $response = $this->post('/login', $credential);
        $response->assertSessionHasErrors();

        $user->delete();
    }

    public function test_logout()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/logout');
        $response->assertRedirect('/');

        $user->delete();
    }
}
