<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isset($_GET['id'])){
		$CurrentFileID=$_GET['id'];
	}else{
		$CurrentFileID=null;
	}
	
	$Array=( GetMatchTo($CurrentFileID));
	echo 'Similar Notes to '.$CurrentFileID.'<br>';
	for($x=0;$x<sizeof($Array);$x++){
		echo 'File ID: '.$Array[$x][0]. ' '.$Array[$x][1].' % Match<br>';
	}	
	//returns multi dim array with two columns first with fileID and SENCOUND with match
	//pass file id of the file you want matches to
	
?>