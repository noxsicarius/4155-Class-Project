<?php

	require 'core.inc.php';
	require 'connect.inc.php';

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