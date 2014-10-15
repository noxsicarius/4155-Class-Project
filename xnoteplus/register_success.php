<?php
						require 'core.inc.php';
						require 'connect.inc.php';
						$logged_in=0;
						if(loggedin()) {
							$user_fullname =getfield('name').' you are logged in';
							$logged_in=1;							
							//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
														
						}else{
							//include 'login.inc.php';
							$logged_in=0;
						}	
					?>


<!DOCTYPE html>
<head>
	<title>X Note Plus</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body>
	<div class="templatemo-logo visible-xs-block">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg logo-left-container">
			<h1 class="logo-left">Note</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg logo-right-container">
			<h1 class="logo-right">Plus</h1>
		</div>			
	</div>
	<div class="templatemo-container">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg left-container">
			<h1 class="logo-left hidden-xs margin-bottom-60">Note</h1>			
			<div class="tm-left-inner-container">
				<ul class="nav nav-stacked templatemo-nav">
				  <li><a href="index.php" class="active"><i class="fa fa-home fa-medium"></i>Homepage</a></li>
				  <li><a href="login.php"><i class="fa fa-shopping-cart fa-medium"></i>Log in</a></li>
				  <li><a href="register.php"><i class="fa fa-gears fa-medium"></i>Register</a></li>
				  <li><a href="uploads.php"><i class="fa fa-send-o fa-medium"></i>upload</a></li>				  
				  <li><a href="about.php"><i class="fa fa-gears fa-medium"></i>About Us</a></li>				  
				  <?php
					if($logged_in==1){
						echo '<li><a href="logout.php"><i class="fa fa-gears fa-medium"></i>Log out</a></li>';
					}
				  ?>
				  
				</ul>
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">Plus</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Welcome to NotePlus</h1>
				
				<img src="images/wooden-desk.jpg" alt="Wooden Desk" class="img-thumbnail">
				<article>
					<p>You can find the note you need here! </p>
					<p>NotePlus is a free website for everyone. </p>
					<p>You may find any notes to any courses. </p>
					<p>You can also upload your note NOW.</p>
					<h2> Registration Successful!</h2>
				</article>
					
				<article>
		   </div>
					
				</article>
				
		</div> <!-- right section -->
	</div>	
</body>
</html>




