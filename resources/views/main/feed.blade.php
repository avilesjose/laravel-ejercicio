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
                        <button type="submit" class="btn btn-dark">Publicar</button>
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

                        @if(auth()->user()->hasRole('admin') || (auth()->user()->can('posts.trash') && $post->user_id==auth()->user()->id))

                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                            <form class="d-inline" action="{{route('posts.destroy', [$post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                            
                        @endif
                        
                        <span class="float-right text-muted">3 comments</span>
                    </div>
                    <div class="card-footer card-comments">
                        <div class="card-comment">
                            <div>
                                <span class="username">
                                    Maria Gonzales
                                    <span class="text-muted float-right">8:03 PM Today</span>
                                </span>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="#" method="post">
                            <div class="img-push">
                                <input type="text" class="form-control form-control-sm" placeholder="Presiona enter para publicar un comentario">
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}

        </div>
    </section>
@endsection