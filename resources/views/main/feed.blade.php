@extends("layouts.main")

@section("titles")
    <title>Feed | Kemok</title>
@endsection

@section("content")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-tachometer-alt"></i> Feed</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @if(session('message_info'))
                <div class="alert alert-success alert-dismissible">
                    <h5><i class="icon fas fa-check"></i> Info</h5>
                    {{session('message_info')}}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="container-fluid">

            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">¡Publica aquí un post!</h3>
                </div>
                <form action="{{route('posts.store')}}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">              
                                    <small class="text-muted">* Título</small>
                                    <div class="input-group mb-3">
                                        <input name="title" type="text" class="form-control" placeholder="Ingresa el título" required>
                                    </div>
                                </div>                              
                                <div class="col-12">              
                                    <small class="text-muted">* Contenido</small>
                                    <div class="input-group mb-3">
                                        <textarea name="content" type="text" class="form-control" placeholder="Ingresa el contenido" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark" value="toPost">Publicar</button>
                    </div>
                </form>
            </div>

            <hr>

            @foreach($posts as $post)
                <div class="card card-widget mb-5 border">
                    <div class="card-header">
                        <span class="username"><a href="#"><b>{{$post->user->username}}</b></a></span>
                        <span class="description">| Publicado: {{$post->created_at->format('h:i:s a d/m/Y')}}</span>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>{{$post->title}}</h3>
                        <p>{{$post->content}}</p>

                        @if(auth()->user()->hasRole('admin') || (auth()->user()->can('posts.edit') && $post->user_id==auth()->user()->id))
                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        @endif

                        @if(auth()->user()->hasRole('admin') || (auth()->user()->can('posts.trash') && $post->user_id==auth()->user()->id))

                            <form class="d-inline" action="{{route('posts.destroy', [$post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                            
                        @endif
                        
                        <span class="float-right text-muted">{{$post->comments->count()}} {{$post->comments->count() == 1 ? 'comentario' : 'comentarios'}}</span>
                    </div>
                    <div class="card-footer card-comments">
                        @foreach($post->comments->sortBy('created_at') as $comment)
                        <div class="card-comment">
                            <div>
                                <span class="username">
                                    {{$comment->user->username}}
                                    <span class="text-muted float-right">
                                        {{$comment->created_at->format('h:i:s a d/m/Y')}}

                                        @if(auth()->user()->hasRole('admin') || (auth()->user()->can('comments.edit') && $comment->user_id==auth()->user()->id))
                                            <a href="{{route('posts.comments.edit', [$post->id, $comment->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        @endif

                                        @if(auth()->user()->hasRole('admin') || (auth()->user()->can('comments.trash') && $comment->user_id==auth()->user()->id))
                                            
                                            <form class="d-inline" action="{{route('posts.comments.destroy', [$post->id, $comment->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>

                                        @endif

                                    </span>
                                </span>
                                {{$comment->content}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <form action="{{route('posts.comments.store', [$post->id])}}" method="POST">
                            @csrf
                            @method("POST")
                            <div class="img-push">
                                <textarea name="content" type="text" class="form-control form-control-sm" placeholder="Ingresa tu comentario..."></textarea>
                            </div>
                            <button class="btn btn-success btn-sm mt-1">Comentar</button>
                        </form>
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}

        </div>
    </section>
@endsection