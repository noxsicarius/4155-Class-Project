
<?php

require 'connect.inc.php';
if(isset($_POST['username'])&&isset($_POST['password'])){
	$username= $_POST['username'];
	$password= $_POST['password'];
	$temp_message=" ";
	echo '<br>';
	if (!empty($username) && !empty($password)) {
		$query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
		if($query_run = mysql_query($query)){
			$query_num_rows = mysql_num_rows($query_run);
			
			if($query_num_rows==0){
				echo "Invalid entry";
			}else if ($query_num_rows==1){
				
				echo $user_id = mysql_result($query_run, 0, 'id');
				$_SESSION['user_id']=$user_id;
				header('Location: index.php');
			}
		}
		
		}
	}else{
		$temp_message = 'Enter username and password';
	}
    function person_name(){
	   $abc = mysql_result($query_run, 0, 'name');	
		return $abc;
	}
	
?>
 
<!DOCTYPE html>
 <head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<!-- Form for logging in the users -->
<!--<div class="register-form">-->
<div>
<?php
	if(isset($msg) & !empty($msg)){
		echo $msg;
	}
 ?>

<b><?php echo $temp_message ?></b>
<form action="<?php echo $current_file; ?>" method="POST">
	Username: <input type="text" name="username"><br><br>
	Password : <input type="password" name="password"><br>	
	<input type="submit" value="Log in">
</form>
</div>

</body>
</html>
