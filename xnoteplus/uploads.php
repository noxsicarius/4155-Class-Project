<?php
						require 'core.inc.php';
						require 'connect.inc.php';
						$logged_in=0;
						$file_uploaded=false;
						if(loggedin()) {
							$user_fullname =getfield('name').' you are logged in';
							$logged_in=1;							
							//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
														
						}else{
							//include 'login.inc.php';
							$logged_in=0;
						}
						if(isset($_POST['Submit'])){
						  $name = $_FILES['file']['name'];
						  $type = $_FILES['file']['type'];
						  //$size = $_FILES['file']['size'];
						  $tmp_name = $_FILES['file']['tmp_name'];
						  }

						 if (isset($name)){
							if (!empty($name)){
							  $location ='uploads/';

							  if (move_uploaded_file($tmp_name, $location.$name)){
								 $file_uploaded=true;
								 if($type=='text/plain'){
								   $String_text= file_get_contents($location.$name);
								 }
								 
								}


							  }

							}else{
							  $String_text= 'Please choose a file.';
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
				  <?php include 'menu.php'; ?>
				  
				</ul>
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">Plus</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Welcome to NotePlus</h1>
				
				<img src="images/wooden-desk.jpg" alt="Wooden Desk" class="img-thumbnail">
				<article>
					<p>Upload you notes here</p>
					<?php
						if($file_uploaded==true){
							$file_uploaded=false;
							echo '<p><strong>File uploaded</strong><p>';							
							
						}
					?>
				</article>
					<?php
						if($logged_in==1){
							echo '<form action="uploads.php" method="POST" enctype="multipart/form-data">
								  <input type="file" name="file"><br><br>
								  <input type="submit" name = "Submit" value ="Submit">
								</form><br>';
							echo $String_text;
						}
						else{
							echo 'Log in before uploading a file';
						}
					
					?>
				<article>
		   </div>
					
				</article>
				
		</div> <!-- right section -->
	</div>	
</body>
</html>




