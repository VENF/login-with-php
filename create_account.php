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
				<form action="connect.php" method="POST">
					<h1>Hello !</h1>
					<p>Sign in your account</p>
					<?php
						switch($_SESSION["vandera"]){
							case 1: 
								echo  $_SESSION["messageError"];
								session_destroy();
							break;
							case 2:
								echo $_SESSION["messageNamesError"];
								session_destroy();
							break;
							case 3:
								echo $_SESSION["messagePasswordError"];
								session_destroy();
							break;
							case 4:
								echo $_SESSION["operationSuccesfully"];
								session_destroy();
							break;
							case 8:
								echo $_SESSION["DuplicateUser"];
								session_destroy();
							break;
						}
					?>
                    <div class="form-group">
						<input type="text" name="name" id="name" placeholder="Your name">
					</div>
                    <div class="form-group">
						<input type="text" name="lastname" id="lastname" placeholder="Your last name">
					</div>
					<div class="form-group">
						<input type="email" name="email" id="email" placeholder="Your E-mail">
					</div>
					<div class="form-group">
						<input type="password" name="password" id="password" placeholder="Your password">
					</div>
                    <div class="form-group">
						<a href="index.php">Do you already have an account?</a>
					</div>
					<input type="submit" value="Sign in" class="btn">
				</form>
				<div class="right">
					<div class="content-right">
						<h1>OK lets start</h1>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit.  
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./js/src.a7ee34a4.js"></script>
</body>

</html>