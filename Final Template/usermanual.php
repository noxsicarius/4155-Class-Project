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
	$AllFeeds=GetVisibleFeed();
	
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
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
</head>

<body>
	<div id="container">
		<header>
			<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
			<h2>Upload, Share, and compare notes</h2>
		</header>
		
		
		<?php include 'menu.php'; ?>
		
		
		<img class="header-image" src="images/image.jpg" alt="Buildings" style="width:100%;height:auto;"/>
	<?php 
	     if($isMobile==false){
		echo '<div id="body">
	   
			<section id="content">';  }
	  ?>
				<article>
					<h1>Welcome to NotePlus</h1>
					<h2>&nbsp;</h2>
					<p>You can find the note you need here!</p>
					<p>NotePlus is a free website for everyone.</p>
					<p>You may find any notes to any courses.</p>
					<p>You can also upload your note by becoming a member of NotePlus.</p>
					<p>&nbsp;</p>
				</article>
	<?php
			for($x=0;$x<sizeof($AllFeeds);$x++){			
				echo '<div class="panel panel-default">
						  <div class="panel-heading"> Title: '.$AllFeeds[$x][1].'</div>
						  <div class="panel-body">'.$AllFeeds[$x][4].' </div>
						  <div class="panel-footer"><p style="text-align:left;">Author: '.$AllFeeds[$x][2].'<span style="float:right;">Date: '.$AllFeeds[$x][3].'</span></p></div>
					  </div>';
				
			}
			
	?>
			</section>
		


			
				<?php 
				if($isMobile==false){
					echo '<aside class="sidebar">';
					include 'aside.php'; 
					echo '</aside>';
				}
				
				
				?>
			

			<div class="clear"></div>
	    <?php 
	       if($isMobile==false){	
		echo '</div>';
		}
	      ?>
		<footer>
			<?php include 'footer.php' ?>;
		</footer>
	</div>
</body>
</html>