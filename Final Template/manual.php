<?php

	require 'core.inc.php';
	require 'connect.inc.php';

	$searchQuery = "SELECT * FROM uploadinfo WHERE ";
	$init=1;
	
/************	Check if variables are set 	*************/
	if(isset($_GET['searchDoc'])){
		$searchTitle = $_GET['searchDoc'];
		if($searchTitle != ""){
			$searchQuery .= "NotesTitle LIKE '%$searchTitle%' ";
			$init=($init==1)?0:$init;
		}
	} else {
		$searchTitle="";
	}

	if(isset($_GET['searchCourse'])){
		$searchCourse = $_GET['searchCourse'];
		if($searchCourse != ""){
			if($init==1){$medium="";} else {$medium=" AND ";}
			$searchQuery .= $medium."ClassName LIKE '%$searchCourse%' ";
			$init=($init==1)?0:$init;
		}
	} else {
		$searchCourse="";
	}

	if(isset($_GET['searchInstructor'])){
		$searchInstructor = $_GET['searchInstructor'];
		if($searchInstructor != ""){
			if($init==1){$medium="";} else {$medium=" AND ";}
			$searchQuery .= $medium."Teacher LIKE '%$searchInstructor%' ";
			$init=($init==1)?0:$init;
		}
	} else {
		$searchInstructor="";
	}

	if(isset($_GET['searchUni'])){
		$searchUniversity = $_GET['searchUni'];
		if($searchUniversity != ""){
			if($init==1){$medium="";} else {$medium=" AND ";}
			$searchQuery .= $medium."Teacher LIKE '%$searchUniversity%' ";
			$init=($init==1)?0:$init;
		}
	} else {
		$searchUniversity="";
	}

?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Files - X Note Plus</title>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
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

			<embed src="pdflibrary/ourPDF/userManual.pdf" width = 100% height = 100% max-width=940px max-height=2100px>
	
			<div class="clear"></div>
		</div>
	</div>
       <footer>
			 <?php include 'newfooter.php'; ?> 
		</footer>
	</div>
</body>
</html>