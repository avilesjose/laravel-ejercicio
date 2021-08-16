<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreatePostRequest;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    private $user;
    private $postRepository;

    public function __construct(User $user, PostRepositoryInterface $postRepository) 
    {
        $this->user = $user;
        $this->postRepository = $postRepository;
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
    public function store(CreatePostRequest $request)
    {
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => $this->user->getCurrent()->id,
        ];

        $this->postRepository->create($data);
        return redirect()->route('feed')->with(['message_info'=>'Post publicado exitosamente.']);
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
    public function edit($id)
    {
        return view('posts.edit', ['post'=>$this->postRepository->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
        ];

        $this->postRepository->update($data, $id);
        return redirect()->back()->with(['message_info'=>'Post actualizado exitosamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect()->back()->with(['message_info'=>'Post eliminado exitosamente.']);
    }
}
