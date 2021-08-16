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

            Hi!

        </div>
    </section>
@endsection