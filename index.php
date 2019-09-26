<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="./css/src.ed250a2d.css">

	<title>Login</title>
</head>
<?php 
	include_once 'connect.php';
	session_start();
 ?>
<body>
	<div class="content">
		<div class="login">
			<div class="content">
				<form action="connect.php" method="GET">
					<h1>Hello !</h1>
					<p>Sign in your account</p>
					<?php
						switch($_SESSION["vandera"]){
							case 5: 
								echo  $_SESSION["messageErrorEmpty"];
								session_destroy();
							break;
							case 6: 
								echo  $_SESSION["errorLogin"];
								session_destroy();
							break;
							case 7: 
								echo  $_SESSION["errorPassword"];
								session_destroy();
							break;
						}
					?>
					<div class="form-group">
						<input type="emai" name="email" id="email" placeholder="Your E-mail">
					</div>
					<div class="form-group">
						<input type="password" name="password" id="password" placeholder="Your password">
					</div>
					<div class="form-group">
						<a href="#">Forgot password?</a>
						<a href="create_account.php">Do not you have an account yet?</a>
					</div>
					<input type="submit" value="Login" class="btn">
				</form>
				<div class="right">
					<div class="content-right">
						<h1>Welcome Back!</h1>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
							Ipsum molestias eaque ducimus, minima laudantium iure fugiat illo odio eum 
							omnis quam deserunt fugit dolore incidunt labore perspiciatis quasi dignissimos dolor?
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./js/src.a7ee34a4.js"></script>
</body>

</html>