<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Login &mdash; {{ config('app.name') }}</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.css') }}">

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
	
	<style>
		.form-control:focus {
			border-color: #667eea !important;
			box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
			transform: translateY(-2px);
		}
		
		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
		}
		
		.logo-container:hover {
			transform: scale(1.05);
			transition: transform 0.3s ease;
		}
		
		.form-group label {
			transition: all 0.3s ease;
		}
		
		.form-group:hover label {
			color: #667eea !important;
		}
	</style>
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="d-flex flex-wrap align-items-stretch">
				<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
					<div class="p-4 m-3">
						<div class="text-center mb-4">
							<div class="logo-container mb-4" style="border-radius: 50%; width: 100px; height: 100px; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
								<img src="{{ asset('assets/img/unsplash/logo.png') }}" alt="Logo Sekolah" class="img-fluid" style="max-width: 80px; height: auto;">
							</div>
							<h3 class="text-primary font-weight-bold mb-2" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">INVENTARIS SEKOLAH</h3>
							<p class="text-muted mb-0" style="font-size: 14px;">Sistem Manajemen Inventaris Barang Sekolah</p>
							<div class="mt-3" style="height: 3px; width: 60px; background: linear-gradient(45deg, #667eea, #764ba2); margin: 0 auto; border-radius: 2px;"></div>
						</div>
						@include('utilities.alert')
						<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
							@csrf
							<div class="form-group">
								<label for="email" class="font-weight-bold text-dark mb-2">
									<i class="fas fa-envelope text-primary mr-2"></i>Email
								</label>
								<input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
									tabindex="1" placeholder="Masukkan alamat email..." required autofocus style="border-radius: 10px; border: 2px solid #e4e6fc; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="password" class="font-weight-bold text-dark mb-2">
									<i class="fas fa-lock text-primary mr-2"></i>Password
								</label>
								<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
									tabindex="2" placeholder="Masukkan kata sandi..." required style="border-radius: 10px; border: 2px solid #e4e6fc; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm" tabindex="4" 
									style="border-radius: 25px; padding: 15px; font-size: 16px; font-weight: 600; background: linear-gradient(45deg, #667eea 0%, #764ba2 100%); border: none;">
									<i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
								</button>
							</div>
						</form>
					</div>
				</div>
				<div
					class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
					data-background="../assets/img/unsplash/login-bg.jpg">
					<div class="absolute-bottom-left index-2">
						<div class="text-light p-5 pb-2">
							<div class="mb-5 pb-3">
								<h1 class="mb-2 display-4 font-weight-bold" id="greetings"></h1>
								<h5 class="font-weight-normal text-muted-transparent">MIN 3 Klaten, Jawa Tengah, Indonesia</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ url('assets/js/popper.min.js') }}"></script>
	<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ url('assets/js/moment.min.js') }}"></script>
	<script src="{{ url('assets/js/stisla.js') }}"></script>

	<!-- Template JS File -->
	<script src="{{ url('assets/js/scripts.js') }}"></script>
	<script src="{{ url('assets/js/custom.js') }}"></script>

	<!-- Page Specific JS File -->
	@include('layouts.partials.greetings')

	<script>
		$(document).ready(function() {
            $("#greetings").html(greetings());
        });
	</script>
</body>

</html>
