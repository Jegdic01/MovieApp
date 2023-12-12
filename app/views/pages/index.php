<?php include_once '../app/views/inc/nav.php'; ?>
	<header class="main-header">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-md-8 left-side text-white" id="main-text">
					<h1 style="font-size: 1.5rem;">MoviesApp - Best movie app in the world</h1>
					<h1 style="font-size: 1.5rem;">Movie. Tv. Free. All in one place</h1>
					<a href="http://localhost/MovieApp/users/register" class="btn btn-danger">Sign up</a>
				</div>
				<div class="col-md-4 right-side w-100">
					<div class="row">
						<div class="col-md-6 mx-auto">
							<div id="div-register-form" class="card card-body bg-dark text-white mt-5" style="width: 300%">
								<h2>Create An Account</h2>
								<p>Please fill out this form to register with us</p>
								<form action="<?php print URLROOT; ?>/users/register" method="POST" id="register-form">
									<div class="form-group">
										<label for="name">Name: <sup>*</sup></label>
										<input type="text" name="name" class="form-control form-control-lg bg-dark text-white input-Name">
										<span class="invalid-feedback username-feedback"></span>
									</div>
									<div class="form-group">
										<label for="email">Email: <sup>*</sup></label>
										<input type="email" name="email" class="form-control form-control-lg bg-dark text-white input-Email">
										<span class="invalid-feedback email-feedback"></span>
									</div>
									<div class="form-group">
										<label for="password">Password: <sup>*</sup></label>
										<input type="password" name="password" class="form-control form-control-lg bg-dark text-white input-Pwd">
										<span class="invalid-feedback password-feedback"></span>
									</div>
									<div class="form-group">
										<label for="confirm_password">Confirm Password: <sup>*</sup></label>
										<input type="password" name="confirm_password" class="form-control form-control-lg bg-dark text-white inputConfirm-Pwd">
										<span class="invalid-feedback confirm-password-feedback"></span>
									</div>

									<div class="row">
										<div class="col">
											<input type="submit" value="Register" class="btn btn-success btn-block">
										</div>
										<div class="col">
											<a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<?php include_once '../app/views/inc/footer.php'; ?>