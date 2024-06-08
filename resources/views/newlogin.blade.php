<!DOCTYPE html>
<html>
<head>
	<title>Log In - IGH</title>
    <meta content="Codembeded" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-1.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="{{ asset('assets/img/wave.png') }}">
	<div class="container">
		<div class="img">
			<img src="../assets/img/bg.svg">
		</div>
		<div class="login-content">
            <form method="POST" action="{{ route('login') }}" class="user">
                @csrf

                	<img src="../assets/img/avatar.svg">
				<h2 class="title">Welcome to IGH</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		{{-- <input id="email" type="email" class="input " name="email" value="" required autocomplete="email" autofocus> --}}
                        <input id="email" type="text" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
           		   </div>
           		</div>
                   @error('email')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                           <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
           		    	{{-- <input id="password" type="password" class="input " name="password" required autocomplete="current-password"> --}}
            	   </div>
            	</div>
                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                <button type="submit" class="btn btn-success account-btn" id="btn">Login</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/login.js') }}"></script>
</body>
</html>
