@extends("layouts.main")

@section("titles")
    <title>Editar comentario | Kemok</title>
@endsection

@section("content")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-tachometer-alt"></i> Feed</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right ml-1 mt-1">
                        <li class="breadcrumb-item"><a class="btn btn-primary btn-sm" href="{{route('feed')}}">Volver</a></li>
                    </ol>
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

            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Editar comentario</h3>
                </div>
                <form action="{{route('posts.comments.update', [$post->id, $comment->id])}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">              
                                    <small class="text-muted">* Contenido</small>
                                    <div class="input-group mb-3">
                                        <textarea name="content" type="text" class="form-control" placeholder="Ingresa el contenido" required>{{$comment->content}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection