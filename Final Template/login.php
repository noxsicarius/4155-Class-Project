<?php

	require 'core.inc.php';
	require 'connect.inc.php';

	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;							
		//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
	}else{
		$logged_in=0;
	}	
	$isMobile = (bool)preg_match('#\b(ip(hone|od)|android\b.+\bmobile|opera m(ob|in)i|windows (phone|ce)|blackberry'.
                    '|s(ymbian|eries60|amsung)|p(alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] ); 

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

<?php if($isMobile==false){ echo

    '<div id="body">'.

	  '<section id="content">';} ?>

				<article>
					<h1>Please Login</h1>
				</article>
				<br>

				<?php
					if($logged_in==0){
						include 'login.inc.php';
					}else{
						echo $user_fullname;
					}
				?>

				<article></article>
<?php if($isMobile==false){
       echo '</section>';
       
       echo '<aside class="sidebar">';	
             include 'aside.php'; 	
       echo '</aside>';
		echo '<div class="clear"></div>';

  '</div>';}
  ?>
	</div></div>
		<footer>
			<?php include 'newfooter.php' ?>;
		</footer>
	
</body>
</html>