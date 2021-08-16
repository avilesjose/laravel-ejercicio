<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CheckInTest extends TestCase
{
    public function test_get_check_in_true()
    {
        $response = $this->get('/check_in');
        $response->assertSuccessful();
        $response->assertViewIs('home.check_in');
    }

    public function test_get_check_in_false()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/check_in');
        $response->assertRedirect('/feed');

        $user->delete();
    }

    public function test_post_check_in_true()
    {
        $this->withoutMiddleware();

        $permittedChars = config('database.test_permitted_username');
        $username = substr(str_shuffle($permittedChars), 0, 8);

        $data = [
            'username'              => $username,
            'email'                 => $username.'@gmail.com',
            'password'              => config('database.factory_user_password'),
            'password_confirmation' => config('database.factory_user_password'),
        ];

        $response = $this->post('/check_in', $data);
        $response->assertRedirect('/');

        User::where('username',$username)->delete();
    }

    public function test_post_check_in_false()
    {
        $this->withoutMiddleware();

        $permittedChars = config('database.test_permitted_username');
        $username = substr(str_shuffle($permittedChars), 0, 8);

        $data = [
            'username'              => $username,
            'email'                 => $username.'@gmail.com',
            'password'              => '12345678',
            'password_confirmation' => '12345679',
        ];

        $response = $this->post('/check_in', $data);
        $response->assertSessionHasErrors();

        User::where('username',$username)->delete();
    }
}
