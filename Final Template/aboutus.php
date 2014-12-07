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
	
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Credits </title>
	<link rel="stylesheet" href="styles.css" type="text/css" />
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Asif Subhan">    

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   
</head>

<body>
	<div id="container">
		<header>
			<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
			<h2>Upload, Share, and compare notes</h2>
		</header>		
		
		<?php include 'menu.php'; ?>
		
		
    <!-- Page Content -->
    

        <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
					<h2 class="page-header">About Us</h2>
					<p> We are a group of students of University of North Carolina at Charlotte. This website is designed for our senior capstone class. As a group we decided to make a website where students from around the word could use it to upload notes, share notes, and compare notes. This website provide students opportunities to look up similar notes, get study guide and see other peoples rating. <p/>
				</div>
            </div>
        </div>

        <!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            <div class="col-lg-3 col-sm-3 text-center">
                <img class="img-circle img-responsive img-center" src="TeamPictures/asif.jpg" alt="">
                <h3>Asif Subhan</h3>
                <p>Student of Computer Science college</p>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="TeamPictures/ricky.jpg" alt="">
                <a href="https://github.com/noxsicarius" target="_blank"><h3>Ricky Sanders</h3></a>
                <p>Student of Computer Science college</p>
            </div> 
            <div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Evan Simmons
                </h3>
                <p>Student of Computer Science college</p>
            </div> 
			<div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Meng Qi
                </h3>
                <p>Student of Computer Science college</p>
            </div>
			
			 			
        </div>	

        <hr>

        <!-- Footer -->
	</div>
       <footer>
			 <?php include 'newfooter.php'; ?> 
		</footer>

    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>