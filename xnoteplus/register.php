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
	if(
	isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['name']) && isset($_POST['school']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_again = $_POST['password_again'];
		$name = $_POST['name'];
		$school = $_POST['school'];
		
		
		if(!empty($username) && !empty($password) && !empty($password_again) && !empty($name) && !empty($school)){
		  if($password!=$password_again){
			$password_match= 'Password do not match.';
		  }
		  else{
			$query = "SELECT 'Id' from users WHERE username='$username'";
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
}

else if(loggedin()){
	$aleady_register= 'you are already logged in, log out to register for another account';
	$logged_in=1;
	
	
}

?>


<!DOCTYPE html>
<head>
	<title>X Note Plus</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body>
	<div class="templatemo-logo visible-xs-block">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg logo-left-container">
			<h1 class="logo-left">Note</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg logo-right-container">
			<h1 class="logo-right">Plus</h1>
		</div>			
	</div>
	<div class="templatemo-container">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg left-container">
			<h1 class="logo-left hidden-xs margin-bottom-60">Note</h1>			
			<div class="tm-left-inner-container">
				<ul class="nav nav-stacked templatemo-nav">
				  <li><a href="index.php" class="active"><i class="fa fa-home fa-medium"></i>Homepage</a></li>
				  <li><a href="login.php"><i class="fa fa-shopping-cart fa-medium"></i>Log in</a></li>
				  <li><a href="uploads.php"><i class="fa fa-send-o fa-medium"></i>upload</a></li>				  
				  <li><a href="about.php"><i class="fa fa-gears fa-medium"></i>About Us</a></li>
					<?php
						if($logged_in==1){
							echo '<li><a href="logout.php"><i class="fa fa-gears fa-medium"></i>Log out</a></li>';
						}
				  ?>				  
				  
				</ul>
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">Plus</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Welcome to NotePlus</h1>
				
				<img src="images/wooden-desk.jpg" alt="Wooden Desk" class="img-thumbnail">
				<article>
					<p>You can find the note you need here! </p>
					<p>NotePlus is a free website for everyone. </p>
					<p>You may find any notes to any courses. </p>
					<p>You can also upload your note by becoming a member of NotePlus.</p>
				</article>
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
				<article>
		   </div>
					
				</article>
				
		</div> <!-- right section -->
	</div>	
</body>
</html>