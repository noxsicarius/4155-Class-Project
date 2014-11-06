<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="styles.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
	</script>
</head>
<body>
<nav class = "clearfix">
	<ul class = "clearfix">
		<?php
//			$currentPage = $_SERVER['REQUEST_URI'];
			$currentPage = currentPage();
			
			// Index
			if($currentPage == "index.php"){
				echo '<li class="start selected"><a href="index.php">Home</a></li>';
			} else {
				echo '<li class=""><a href="index.php">Home</a></li>';
			}

			// Uploads page
			if($currentPage == "uploads.php"){
				echo '<li class="start selected"><a href="Uploads.php">upload</a></li>';
			} else {
				echo '<li class=""><a href="uploads.php">Upload</a></li>';
			}

			if(!loggedin()){
			// Register page
				if($currentPage == "register.php"){
					echo '<li class="start selected"><a href="register.php">Register</a></li>';
				} else {
					echo '<li class=""><a href="register.php">Register</a></li>';
				}

				// login page
				if($currentPage == "login.php"){
					echo '<li class="start selected"><a href="login.php">Log In</a></li>';
				} else {
					echo '<li class=""><a href="login.php">Log In</a></li>';
				}

			}else{


				// myaccount page
				if($currentPage == "myaccount.php"){
					echo '<li class="start selected"><a href="myaccount.php">My Account</a></li>';
				} else {
					echo '<li class=""><a href="myaccount.php">My Account</a></li>';
				}

				// logout page
				if($currentPage == "logout.php"){
					echo '<li class="start selected"><a href="logout.php">Log Out</a></li>';
				} else {
					echo '<li class=""><a href="logout.php">Log Out</a></li>';
				}
			}

			// search page
			if($currentPage == "search.php"){
				echo '<li class="start selected"><a href="search.php">Search</a></li>';
			} else {
				echo '<li class=""><a href="search.php">Search</a></li>';
			}

			// contact page
			if($currentPage == "contact.php"){
				echo '<li class="start selected"><a href="index.php">upload</a></li>';
			} else {
				echo '<li class=""><a href="index.php">Contact</a></li>';
			}
		?>
	</ul>
	<a href="#" id="pull">Menu</a>
</nav>
</body>
</html>