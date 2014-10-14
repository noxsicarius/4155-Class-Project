<?php 
//Connecting to the database 
	/*
	 *Localhost
	 */
	$hostname_localhost = "localhost";
	$database_localhost= "noteplus";
	$username_localhost = "noteplus";
	$password_localhost = "root";
	$localhost=mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error
	(mysql_error(),E_USER_ERROR);
	mysql_select_db($database_localhost, $localhost);
	
	/*
	 *Main Server
	 */
	/* $hostname_localhost = "noteplus.x10host.com";
	 $database_localhost= "noteplu2_noteUser";
	 $username_localhost="noteplu2_note";
	 $password_localhost="april24";
	 $localhost=mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error
	(mysql_error(),E_USER_ERROR);
	 mysql_select_db($database_localhost, $localhost);*/
	
?>