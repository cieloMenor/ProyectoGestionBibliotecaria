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
		<div class="d-flex justify-content-center h-100 ">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container row">
                    <form class="col-12" method="POST" action="{{route('usuario.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col1"></div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-md-12"> <center><label style="color: white">Biblioteca del Perú</label></center>
                                    </div>
                                </div>
                            </div>
                            <div class="col1"></div>
						</div><br>

						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="name" class="form-control input_user @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="username" required>
							@error('name') 
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
                    		@enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="email" required>
							@error('email') 
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
</html>


