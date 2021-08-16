@extends("layouts.main")

@section("titles")
    <title>Mi perfil | Kemok</title>
@endsection

@section("links")

@endsection

@section("content")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fa fa-user"></i> Mi perfil</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @if(session('message_info'))
                <div class="alert alert-success alert-dismissible">
                    <h5><i class="icon fas fa-check"></i> Info</h5>
                    {!!session('message_info')!!}
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
                    <h3 class="card-title">Actualizar</h3>
                </div>
                <form action="{{route('save_profile')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-4">              
                                    <small class="text-muted">Nombre completo</small>
                                    <div class="input-group mb-3">
                                        <input name="full_name" type="text" class="form-control" placeholder="Opcional" value="{{Auth::user()->full_name}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4">              
                                    <small class="text-muted">Fecha de nacimiento</small>
                                    <div class="input-group mb-3">
                                        <input name="birthday" type="date" class="form-control" placeholder="Opcional" value="{{Auth::user()->birthday}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4">              
                                    <small class="text-muted">País de nacimiento</small>
                                    <div class="input-group mb-3">
                                        <input name="nationality" id="nationality" type="text" class="form-control" placeholder="Opcional" value="{{Auth::user()->nationality}}">
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

@section("scripts")
    <script>
        $(document).ready(function() {

            $("#nationality").keyup(function () {
                getNationalities($(this).val());
            });

            function getNationalities(nationality) {

                $.get("{{route('check_nationality')}}", {
                    "nationality": nationality,
                }, function (data) {
                    $("#nationality").autocomplete({
                        source: data.response
                    });
                });

            }

        });
    </script>
@endsection