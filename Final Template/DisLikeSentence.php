<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	require 'comparison.php';
	
	$page=$_GET['id'];
	//echo $page;
	$pages =explode(',', $page);	
	
		$TableName = $pages[0];
		$Sentence = $pages[1];
		echo $Sentence;
		ST_DecreaseHITbyONE_tablename($TableName,$Sentence);


	$redirect = 'Location:ST_view.php?Name='.$TableName;
	echo $redirect;
	header($redirect);
	
	  
	
?>

  