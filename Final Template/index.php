<?php

	require 'core.inc.php';
	require 'connect.inc.php';
	
	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;							
		//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
	}else{
		//include 'login.inc.php';
		$logged_in=0;
	}

?>

<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>X Note Plus</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />
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

		<img class="header-image" src="images/image.jpg" alt="Buildings" />

		<div id="body">

			<section id="content">
				<article>
					<h1>Welcome to NotePlus</h1>
					<h2>&nbsp;</h2>
					<p>You can find the note you need here!</p>
					<p>NotePlus is a free website for everyone.</p>
					<p>You may find any notes to any courses.</p>
					<p>You can also upload your note by becoming a member of NotePlus.</p>
					<p>&nbsp;</p>
				</article>

				<article class="expanded">
					<h2>&nbsp;</h2>
				</article>
			</section>
			
			<aside class="sidebar">
				<?php include 'aside.php'; ?>
			</aside>

			<div class="clear"></div>
		</div>
		
		<footer>
			<?php include 'footer.php' ?>;
		</footer>
	</div>
</body>
</html>