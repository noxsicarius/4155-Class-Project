<?php
	require 'core.inc.php';
	require 'connect.inc.php';

	$logged_in=0;
	$user_name_exists = false;
	$password_match = true;
	$ALL_fields = true;
	$successful = false;
	$username = '';
	$password = '';
	$password_again = '';
	$name = '';
	$school = '';

	if(!loggedin()){
		$already_register = false;
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['name']) && isset($_POST['school'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password_again = $_POST['password_again'];
			$name = $_POST['name'];
			$school = $_POST['school'];
			$email = $_POST['email'];
			
			if(!empty($username) && !empty($password) && !empty($password_again) && !empty($name) && !empty($school) && !empty($email)){
				$ALL_fields = true;

				if($password!=$password_again){
					$password_match = false;
				} else {
					$password_match = true;
				}
				
				$query = "SELECT `users`.`username` FROM users WHERE (`users`.`username` = '$username')";
				$query_run = mysql_query($query);
				$num_of_rows = mysql_num_rows($query_run);
				
				if($num_of_rows==1) {
					$user_name_exists = true;
					$successful = false;
				} else {
					$user_name_exists = false;
					if($password_match){
						$query = "INSERT INTO users VALUES (id,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($school)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string('')."')";
						if ($query_run = mysql_query($query)){
							$successful = true;
						}
					}
				}
			}else{
				$ALL_fields = false;
			}
		}
	} else if(loggedin()){
		$already_register=true;
		$logged_in=1;
	}

?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>X Note Plus</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>
	<div id="container">
		<header>
			<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
			<h2>Upload, Share, and compare notes</h2>
		</header>

		<nav>
			<?php include 'menu.php'; ?>
		</nav>

		<div id="body">
			<section id="content">

				<br>
				<?php
					if($already_register){ ?>
						<div class="alert alert-warning" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							You are logged in, Log out to register for another account
						</div>
				<?php
					}else {
						if(isset($_POST['btnRegister']) && $successful) {
							?>
							<article class="expanded">
								<div class="alert alert-success" role="alert">
									<span class="sr-only">Welcome!</span>
									<h2>Registration successful</h2>
								</div>
							</article>
					<?php 
						} else { 
						?>
							<article>
								<h2>Registration Form</h2>
							</article>
						<?php
							if($user_name_exists){ ?>
								<div class="alert alert-danger" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Error:</span>
									The username <?php print "$username";?> already exists
								</div>
							<?php
							}
							if(!$ALL_fields){ ?>
								<div class="alert alert-danger" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Error:</span>
									ALL fields are required!
								</div>
							<?php
							}
							if(!$password_match){ ?>
								<div class="alert alert-danger" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Error:</span>
									Passwords do not match
								</div>
					<?php	} ?>

							<form action="register.php" method="POST">
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>Username</span>
								  <input type="text" style='max-width:250px;' value="<?php if(!($username == '')){print "$username";}?>" name="username" class="form-control" placeholder="Choose a username"><br>
								</div><br>
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>Email</span>
								  <input type="text" style='max-width:250px;' value="<?php if(!($username == '')){print "$username";}?>" name="email" class="form-control" placeholder="Enter your Email"><br>
								</div><br>
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>Password</span>
								  <input type="password" style='max-width:250px;' name="password" class="form-control" placeholder="Create a password"><br>
								</div><br>
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>Password</span>
								  <input type="password" style='max-width:250px;' name="password_again" class="form-control" placeholder="Retype password"><br>
								</div><br>
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>Full Name</span>
								  <input type="text" style='max-width:250px;' value="<?php if(!($name == '')){print "$name";}?>" name="name" class="form-control" placeholder="Enter your full name"><br>
								</div><br>
								<div class="input-group">
								  <span class="input-group-addon" style='min-width:100px;'>University</span>
								  <input type="text" style='max-width:250px;' value="<?php if(!($school == '')){print "$school";}?>" name="school" class="form-control" placeholder="University you attend"><br>
								</div><br>
								<button class="btn btn-default" type="submit" name="btnRegister">Register</button>
							</form>
						<?php
						}
					}
				?>
			
			<article></article>

			</section>
			
			<aside class="sidebar">		
				<?php include 'aside.php'; ?>
			</aside>
			
			<div class="clear"></div>
		</div>
		
		<footer>
			<?php include 'footer.php'; ?>
		</footer>
	</div>
</body>
</html>