@extends("layouts.home")

@section("titles")
    <title>Iniciar sesión | Kemok</title>
@endsection

@section("content")
  	<div class="login-logo">
		<a href="{{route('login')}}"><img class="rounded" src="{{asset('kemok.png')}}" alt="Kemok" width="250"></a>
  	</div>
  	<div class="card">
	    <div class="card-body login-card-body rounded">
	      	<p class="login-box-msg">Ingresa tus credenciales para iniciar sesión</p>
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
			<form action="{{route('post_login')}}" method="post">
				@csrf
				<small class="text-muted">* Correo electrónico</small>
		        <div class="input-group mb-3">
		          	<input name="email" type="email" class="form-control" placeholder="Ingresa tu correo electrónico" value="{{old('email')}}" required>
		          	<div class="input-group-append">
		            	<div class="input-group-text">
		              		<span class="fas fa-envelope"></span>
		            	</div>
		          	</div>
		        </div>
		        <small class="text-muted">* Contraseña</small>
		        <div class="input-group mb-3">
		          	<input name="password" type="password" class="form-control" placeholder="Ingresa tu contraseña" required>
		          	<div class="input-group-append">
			            <div class="input-group-text">
			              	<span class="fas fa-lock"></span>
			            </div>
		          	</div>
		        </div>
		        <div class="row">
		          	<div class="col-12">
			            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
		          	</div>
		        </div>
                <p class="text-center mt-2 mb-0">
                    <a href="{{route('get_check_in')}}" class="text-center color-master"><b>¡Regístrate aquí!</b></a>
                </p>
	      	</form>
	    </div>
  	</div>
@endsection