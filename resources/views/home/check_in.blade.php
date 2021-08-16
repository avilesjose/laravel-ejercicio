@extends("layouts.home")

@section("titles")
    <title>Registrarse | Kemok</title>
@endsection

@section("content")
  	<div class="login-logo">
		<a href="{{route('login')}}"><img class="rounded" src="{{asset('kemok.png')}}" alt="Kemok" width="250"></a>
  	</div>
  	<div class="card">
	    <div class="card-body login-card-body rounded">
	      	<p class="login-box-msg">Ingresa tus credenciales para registrarte</p>
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
			<form action="{{route('post_check_in')}}" method="post">
				@csrf
				<small class="text-muted">* Username</small>
		        <div class="input-group mb-3">
		          	<input name="username" type="text" class="form-control" placeholder="Ingresa tu username" value="{{old('username')}}" required>
		          	<div class="input-group-append">
		            	<div class="input-group-text">
		              		<span class="fas fa-envelope"></span>
		            	</div>
		          	</div>
		        </div>

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
		        <small class="text-muted">* Confirmación de contraseña</small>
		        <div class="input-group mb-3">
		          	<input name="password_confirmation" type="password" class="form-control" placeholder="Ingresa tu confirmación de contraseña" required>
		          	<div class="input-group-append">
			            <div class="input-group-text">
			              	<span class="fas fa-lock"></span>
			            </div>
		          	</div>
		        </div>
		        <div class="row">
		          	<div class="col-12">
			            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
		          	</div>
		        </div>
                <p class="text-center mt-2 mb-0">
                    <a href="{{route('login')}}" class="text-center color-master"><b>Volver</b></a>
                </p>
	      	</form>
	    </div>
  	</div>
@endsection