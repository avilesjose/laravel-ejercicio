<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProfileTest extends TestCase
{
    public function test_get_profile()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/profile');
        $response->assertSuccessful();
        $response->assertViewIs('user.profile');

        $user->delete();
    }

    public function test_post_profile_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $data = [
            'user_id'     => $user->id,
            'full_name'   => 'Test Test',
            'birthday'    => '1966-10-13',
            'nationality' => 'Venezuela',
        ];

        $response = $this->post('/profile/save', $data);
        $response->assertRedirect('/profile');

        $user->delete();
    }

    public function test_post_profile_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $data = [
            'user_id'     => $user->id,
            'full_name'   => null,
            'birthday'    => '19666-10-13',
            'nationality' => null,
        ];

        $response = $this->post('/profile/save', $data);
        $response->assertSessionHasErrors();

        $user->delete();
    }

    public function test_get_nationality_profile()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/profile/check_nationality', [
            'nationality' => 'Vene',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'response'
            ]);

        $user->delete();
    }
}
