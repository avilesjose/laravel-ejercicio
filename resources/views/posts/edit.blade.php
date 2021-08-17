@extends("layouts.main")

@section("titles")
    <title>Editar post | Kemok</title>
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
                    <h3 class="card-title">Editar</h3>
                </div>
                <form action="{{route('posts.update',[$post->id])}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">              
                                    <small class="text-muted">* Título</small>
                                    <div class="input-group mb-3">
                                        <input name="title" type="text" class="form-control" placeholder="Ingresa el título" value="{{$post->title}}" required>
                                    </div>
                                </div>                              
                                <div class="col-12">              
                                    <small class="text-muted">* Contenido</small>
                                    <div class="input-group mb-3">
                                        <textarea name="content" type="text" class="form-control" placeholder="Ingresa el contenido" required>{{$post->content}}</textarea>
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