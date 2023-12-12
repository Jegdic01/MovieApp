<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style1.css">
	<title>MoviesApp</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="container">
			<a class="navbar-brand" id="home-page-btn" style="color: white" href="#">MoviesApp</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto" id="main-navmenu">
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input id="search-field" class="form-control mr-sm-2 bg-dark text-white" type="search" placeholder="Search movie or TV Show" aria-label="Search">
					<a id="search-btn" onclick="Movie.findMovie();" class="btn btn-info my-2 my-sm-0" type="submit">Search</a>
					<a href="<?php print URLROOT; ?>/users/login" class="btn btn-dark ml-1" id="login-btn">Login</a>
					<a href="<?php print URLROOT; ?>/users/register" class="btn btn-dark ml-1" id="register-btn">Register</a>
					<a href="<?php print URLROOT; ?>" class="btn btn-dark ml-1" id="logout-btn">Logout</a>
				</form>
			</div>
		</div>
	</nav>


	<script>
		const ul = document.getElementById('main-navmenu');
		let li = ul.getElementsByTagName('li');
		
		if(!sessionStorage.getItem('userId')) {
			for(let el of li) {
				el.classList.add('d-none');
			}
			document.getElementById('search-field').classList.add('d-none');
			document.getElementById('search-btn').classList.add('d-none');
			document.getElementById('logout-btn').classList.add('d-none');
		}
		else {
			for(let el of li) {
				el.classList.add('d-block');
			}
			document.getElementById('login-btn').classList.add('d-none');
			document.getElementById('register-btn').classList.add('d-none');
			document.getElementById('logout-btn').classList.add('d-block');
		}
	</script>