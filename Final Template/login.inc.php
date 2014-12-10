<?php

	require 'connect.inc.php';

	if(isset($_POST['username'])||isset($_POST['password'])){
		$username= $_POST['username'];
		$password= $_POST['password'];
		echo '<br>';
		if (!empty($username) && !empty($password)) {
			$query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
			if($query_run = mysql_query($query)){
				$query_num_rows = mysql_num_rows($query_run);
				
				if($query_num_rows==0){
					$msg = "Invalid entry";
				}else if ($query_num_rows==1){
					echo $user_id = mysql_result($query_run, 0, 'id');
					$_SESSION['user_id']=$user_id;
					header('Location: index.php');
				}
			}
		}else{
			$msg = "Invalid entry";
		}
	}else{
		$username='';
		$password='';
	}

?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>

<body>
	<!-- Form for logging in the users -->
	<!--<div class="register-form">-->
	<div>
		<?php
			if(isset($msg) & !empty($msg)){?>
				<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Invalid entry
				</div>
		<?php
			}
		 ?>

		<form action="<?php echo $current_file; ?>" method="POST">
			<div class="input-group">
				<span class="input-group-addon" style='min-width:100px;'>Username</span>
				<input type="text" style='max-width:250px;' value="<?php if(!($username == '')){print "$username";}?>" name="username" class="form-control" placeholder="Enter your username"><br>
			</div><br>
			<div class="input-group">
				<span class="input-group-addon" style='min-width:100px;'>Password</span>
				<input type="password" style='max-width:250px;' name="password" class="form-control" placeholder="Enter your password"><br>
			</div><br>
			<button class="btn btn-default" type="submit" name="btnLogin">Login</button>
		</form>
	</div>
</body>
</html>
