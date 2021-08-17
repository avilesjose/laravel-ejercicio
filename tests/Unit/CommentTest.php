<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CommentTest extends TestCase
{
    public function test_store_comment_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create();

        $data = [
            'content' => 'Contenido del test...',
        ];

        $response = $this->actingAs($user)->post('/posts/'.$post->id.'/comments', $data);
        $response->assertSessionHasNoErrors();

        $post->delete();
        $user->delete();
    }

    public function test_store_comment_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $post = Post::factory()->create();

        $data = [
            'content' => NULL,
        ];

        $response = $this->actingAs($user)->post('/posts/'.$post->id.'/comments', $data);
        $response->assertSessionHasErrors();

        $post->delete();
        $user->delete();
    }    

    public function test_edit_comment_true()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get('/posts/'.$comment->post_id.'/comments/'.$comment->id.'/edit');
        $response->assertSuccessful();
        $response->assertViewIs('comments.edit');
        $response->assertViewHas(['post', 'comment']);

        $user->delete();
    }    

    public function test_edit_comment_false()
    {
        $firstUser = User::factory()->create();
        $firstUser->assignRole('publisher');

        $secondUser = User::factory()->create();
        $secondUser->assignRole('publisher');

        $comment = Comment::factory()->create([
            'user_id' => $firstUser->id
        ]);

        $response = $this->actingAs($secondUser)->get('/posts/'.$comment->post_id.'/comments/'.$comment->id.'/edit');
        $response->assertSessionHasErrors();

        $firstUser->delete();
        $secondUser->delete();
    }


    public function test_update_comment_true()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        $data = [
            'content' => 'Contenido del test...',
        ];

        $response = $this->actingAs($user)->put('/posts/'.$comment->post_id.'/comments/'.$comment->id, $data);
        $response->assertSessionHasNoErrors();

        $user->delete();
    }


    public function test_update_comment_false()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $user->assignRole('publisher');

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        $data = [
            'content' => NULL,
        ];

        $response = $this->actingAs($user)->put('/posts/'.$comment->post_id.'/comments/'.$comment->id, $data);
        $response->assertSessionHasErrors();

        $user->delete();
    }

    public function test_destroy_comment()
    {
        $user = User::factory()->create();
        $user->assignRole('publisher');

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)->delete('/posts/'.$comment->post_id.'/comments/'.$comment->id);
        $response->assertSessionHasNoErrors();

        $user->delete();
    }
}
