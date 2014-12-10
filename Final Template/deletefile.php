<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	$File_ID=$_GET['id'];
	Drop_Table($File_ID);
	header("Location:myaccount.php");
	
?>