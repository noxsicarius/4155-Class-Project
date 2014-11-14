<?php
require 'core.inc.php';
require 'connect.inc.php';
$ALL_fields=' ';
$Not_working=' ';
$password_match= ' ';
$user_name_exit =' ';

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
	echo 'you are already registered.';
}

?>
<form action="register.php" method="POST">
Username:<br> <input type="text" name ="username"><br><br>
Password:<br> <input type="password" name ="password"><br><br>
Retype Password:<br> <input type="password" name ="password_again"><br><br>
Full Name:<br> <input type="text" name ="name"><br><br>
School:<br> <input type="text" name ="school"><br><br>
<input type="submit" value ="Register">

</form>