<?php 
	$hostname_localhost = "localhost";
	$database_localhost= "noteplus";
	$username_localhost = "noteplus";
	$password_localhost = "root";
	$localhost=mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error
	(mysql_error(),E_USER_ERROR);
	mysql_select_db($database_localhost, $localhost);
	
?>