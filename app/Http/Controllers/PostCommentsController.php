<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\View;

class PostCommentsController extends Controller
{
    private $user;

    public function __construct(User $user) 
    {
        $this->user = $user;
        View::share('menu_active', 'feed');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request, Post $post)
    {
        Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => $this->user->getCurrent()->id,
        ]);

        return redirect()->route('feed')->with(['message_info' => 'Comentario publicado exitosamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        $checkUser = $this->user->getCurrent();

        if($checkUser->hasRole('publisher') && $checkUser->id != $comment->user_id) {
            return redirect()->route('feed')->withErrors(['El comentario con ID '.$comment->id.' no lo puedes editar, le pertenece a otro usuario.']);
        }

        return view('comments.edit', ['post' => $post, 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCommentRequest $request, Post $post, Comment $comment)
    {
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.comments.edit', ['post' => $post->id, 'comment' => $comment->id])->with(['message_info'=>'Comentario actualizado exitosamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('feed')->with(['message_info' => 'Comentario eliminado exitosamente.']);
    }
}
