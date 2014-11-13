<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	$ALL_fields=' ';
	$Not_working=' ';
	$password_match= ' ';
	$user_name_exit =' ';
	$aleady_register=' ';
	$logged_in=0;



	if(!loggedin()){
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['name']) && isset($_POST['school']) ){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password_again = $_POST['password_again'];
			$name = $_POST['name'];
			$school = $_POST['school'];
			
			
			if(!empty($username) && !empty($password) && !empty($password_again) && !empty($name) && !empty($school)){
				if($password!=$password_again){
					$password_match= 'Password do not match.';
				}else{
					$query = "SELECT `users`.`username` FROM users WHERE (`users`.`username` = '$username')";
					$query_run = mysql_query($query);
					$num_of_rows=mysql_num_rows($query_run);
					if($num_of_rows==1) {
						$user_name_exit=  'The username '.$username. ' already exists.';
					} else{
						$query = "INSERT INTO users VALUES (id,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($school)."')";
						//$query="INSERT INTO 'users' VALUES ('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($school)."')";
						if ($query_run = mysql_query($query)){
							header('Location: register_success.php');
						}else {
							$Not_working= 'Sorry , try again later';
						}
					}
				}
			}else{
				$ALL_fields= 'All fields are required';
			}
		}
	} else if(loggedin()){
		$aleady_register= 'you are already logged in, log out to register for another account';
		$logged_in=1;
	}

?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>X Note Plus</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />
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

				<article>
					<h1>Welcome to NotePlus</h1>
				</article>
				<br>
				<?php
					if($logged_in==1){
						echo 'You are already logged in.';
					}else {
						echo '<form action="register.php" method="POST">
								Username:<br> <input type="text" name ="username"><br><br>
								Password:<br> <input type="password" name ="password"><br><br>
								Retype Password:<br> <input type="password" name ="password_again"><br><br>
								Full Name:<br> <input type="text" name ="name"><br><br>
								School:<br> <input type="text" name ="school"><br><br>
								<input type="submit" value ="Register">

								</form>';
					
					
						echo $ALL_fields;
						echo $Not_working;
						echo $password_match;
						echo $user_name_exit;
						echo $aleady_register;
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