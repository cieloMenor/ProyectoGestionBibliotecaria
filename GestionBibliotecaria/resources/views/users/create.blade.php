<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
	<title>Registro Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/login.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<br><br>
		<div class="d-flex justify-content-center h-100 ">
			<div class="user_card" style="width: 70%; height:90%">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container row">
                    <form class="col-12" method="POST" action="{{route('usuario.store')}}">
                        @csrf
						<br>
                        <div class="row">
                            <div class="col1"></div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-md-12"> <center><label style="color: white">Biblioteca del Perú</label></center>
                                    </div>
                                </div>
                            </div>
                            <div class="col1"></div>
							<div class="col1"></div><br><br>
						</div><br>
						<div class="row">
							<div class="input-group mb-3 col-6">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="Apellidosusuario" class="form-control input_user @error('Apellidosusuario') is-invalid @enderror" value="{{old('Apellidosusuario')}}" placeholder="apellidos" required>
								@error('Apellidosusuario') 
									<span class="invalid-feedback" role="alert">
										<strong>{{$message}}</strong>
									</span>
								@enderror
							</div>
							<div class="input-group mb-3 col-6">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="Nombresusuario" class="form-control input_user @error('Nombresusuario') is-invalid @enderror" value="{{old('Nombresusuario')}}" placeholder="nombres" required>
								@error('Nombresusuario') 
									<span class="invalid-feedback" role="alert">
										<strong>{{$message}}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="input-group mb-3 col-6">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="Celularusuario" class="form-control input_user @error('Celularusuario') is-invalid @enderror" value="{{old('Celularusuario')}}" placeholder="celular" required>
								@error('Celularusuario') 
									<span class="invalid-feedback" role="alert">
										<strong>{{$message}}</strong>
									</span>
								@enderror
							</div>
							<div class="input-group mb-3 col-6">
								<div class="row">
									<div class="input-group-append col-3">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<select name="RolID" id="RolID" class="form-select input_user col-9">
										<option value="2" selected>ROLE_USER</option>
									</select>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="Usuario" class="form-control input_user @error('Usuario') is-invalid @enderror" value="{{old('Usuario')}}" placeholder="username" required>
							@error('Usuario') 
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
                    		@enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="Correousuario" class="form-control input_user @error('Correousuario') is-invalid @enderror" value="{{old('Correousuario')}}" placeholder="email" required>
							@error('Correousuario') 
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
                    		@enderror
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" value="{{old('password')}}" placeholder="password" required>
							@error('password') 
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
							@enderror
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
				 			<button class="btn login_btn">Guardar</button>
					
				   		</div>
					</form>
					<div class="col-12">
						<center>
						<a href="{{route('usuario.salir')}}"><button class="btn btn-warning col-9">Salir</button></a>
					</center>
					</div>
					
				</div>

				{{-- <div class="mt-4">
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>


