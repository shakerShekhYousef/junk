<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Junk</title>
    <link rel="shortcut icon" type="{{ asset('assets/img/login/x-icon') }}" href="{{ asset('assets/img/login/logo-icon.png') }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <style>
        body{
            background:#000;
            color:#fff;
        }
        .card{
            background:#000; 
            color: #fff !important;
            box-shadow: 5PX 5PX 11PX 0PX #90d1447a;
        }
        .btn{
            background:#88c540;
            border:1px solid #88c540;
        }
        .btn:hover{
            background:#88c540;
            border:1px solid #88c540;
        }
    </style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-6" style="padding-left: 0px !important;padding-right: 0px !important;">
				<a href="index.html"><img src="{{ asset('assets/img/login/logo.png') }}" style="padding: 4%;"></a>
				<div class="container form-contain">
					<div class="row">
						<div class="col-12">
							<h1>Welcome to Junk!</h1>
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
						<a href="reset-password.html" class="link-reset" style="color:#fff">Reset Password</a>
						@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
					</div>
						</div>
					</div>
					
					
				</div>
				
			</div>
			<div class="col-12 col-lg-6" style="padding-left: 0px !important;padding-right: 0px !important;">
				<img src="{{ asset('assets/img/login/Component.jpg') }}" width="100%">
			</div>
		</div>
	</div>
	 <footer>
    <div class="footer">
      <div class="container-fluid">
        <center>
          
          <div class="row d-flex justify-content-center footer-border-1">
            <div class="col-12">
              <p><span> &copy; </span> 2021 JUNK (JUNK Fitness Ltd). All rights reserved. </p>
            </div>
            
          </div>
        </center>
      </div>
      
    </div>
  </footer>
<!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>
</html>