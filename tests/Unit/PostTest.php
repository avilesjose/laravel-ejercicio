<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    public function test_get_feed()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $response = $this->actingAs($user)->get('/feed');
        $response->assertSuccessful();
        $response->assertViewIs('main.feed');
        $response->assertViewHas(['menu_active', 'posts']);

        $user->delete();
    }

    public function test_store_post_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $data = [
            'title'   => 'Esto es un test',
            'content' => 'Contenido del test...',
        ];

        $response = $this->actingAs($user)->post('/posts', $data);
        $response->assertRedirect('/feed');

        $user->delete();

    }

    public function test_store_post_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $data = [
            'title'   => NULL,
            'content' => 'Contenido del test...',
        ];

        $response = $this->actingAs($user)->post('/posts', $data);
        $response->assertSessionHasErrors();

        $user->delete();

    }

    public function test_edit_post_true()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get('/posts/'.$post->id.'/edit');
        $response->assertSuccessful();
        $response->assertViewIs('posts.edit');
        $response->assertViewHas(['post']);

        $user->delete();

    }

    public function test_edit_post_false()
    {
        $firstUser = User::factory()->create();
        $firstUser->assignRole('publisher');

        $secondUser = User::factory()->create();
        $secondUser->assignRole('publisher');

        $post = Post::factory()->create([
            'user_id' => $firstUser->id
        ]);

        $response = $this->actingAs($secondUser)->get('/posts/'.$post->id.'/edit');
        $response->assertSessionHasErrors();

        $firstUser->delete();
        $secondUser->delete();

    }

    public function test_update_post_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $data = [
            'title'   => 'Esto es un test',
            'content' => 'Contenido del test...',
        ];

        $response = $this->actingAs($user)->put('/posts/'.$post->id, $data);
        $response->assertSessionHasNoErrors();

        $user->delete();

    }

    public function test_update_post_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $data = [
            'title'   => 'Esto es un test',
            'content' => NULL,
        ];

        $response = $this->actingAs($user)->put('/posts/'.$post->id, $data);
        $response->assertSessionHasErrors();

        $user->delete();

    }

    public function test_destroy_post()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->delete('/posts/'.$post->id);
        $response->assertSessionHasNoErrors();

        $user->delete();

    }
}
