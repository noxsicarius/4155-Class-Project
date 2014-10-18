<?php
require 'core.inc.php';
require 'connect.inc.php';
$logged_in=0;
						if(loggedin()) {
							$user_fullname =getfield('name').' ,you are logged in';
							$logged_in=1;							
							//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
														
						}else{
							//include 'login.inc.php';
							$logged_in=0;
						}	

$user_fullname=getfield('name');
$StudentID=getuserid();
$Sring_Message=' ';

if(isset($_POST['submit'])){
  $name = $_FILES['file']['name'];
  $type = $_FILES['file']['type'];
  //$size = $_FILES['file']['size'];
  $tmp_name = $_FILES['file']['tmp_name'];
  }
  
  
if(loggedin()){
	if(
	isset($_POST['title']) && isset($_POST['chapter']) && isset($_POST['classname']) && isset($_POST['teacher'])  && isset($_POST['comments']) ){
		$title = $_POST['title'];
		$chapter = $_POST['chapter'];
		$classname = $_POST['classname'];
		$teacher = $_POST['teacher'];
		$school = $_POST['school'];
		$comments = $_POST['comments'];
		
		
		if(!empty($title) && !empty($chapter) && !empty($classname) && !empty($teacher) && !empty($school) && !empty($comments)){
			
		  if(empty($name) OR $type!='text/plain'){
			$Sring_Message = 'Please choose a text file. At this time we can only process text files';
			
		  }
		  else{
			$location ='uploads/';
			$query = "SELECT 'FileName' from Uploadinfo WHERE FileName='$name'";
			$query_run = mysql_query($query);
			$num_of_rows=mysql_num_rows($query_run);
			if($num_of_rows==1) {
				$Sring_Message= 'The File '.$name. ' already exists.';
			} else{
				//sql query
				$query = "INSERT INTO Uploadinfo VALUES ('$StudentID',FileID,'".mysql_real_escape_string($name)."','".mysql_real_escape_string($location)."','".mysql_real_escape_string($school)."','".mysql_real_escape_string($classname)."','".mysql_real_escape_string($teacher)."','".mysql_real_escape_string($chapter)."','".mysql_real_escape_string($title)."','".mysql_real_escape_string($comments)."')";


				if ($query_run = mysql_query($query)){
					if(move_uploaded_file($tmp_name, $location.$name)){
						$Sring_Message= 'File Uploaded';
					}
				}else {
					$Sring_Message= 'Sorry , try again later';
				}
			}
			
			
			
		  }
		  
		}else{
		 $Sring_Message= 'All fields are required';
		}

}
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
					
				</article>
					<?php
						if($logged_in==1){
							echo '<form action="uploads.php" method="POST" enctype="multipart/form-data">

									Title:<br> <input type="text" name ="title"><br><br>
									Chapter:<br> <input type="text" name ="chapter"><br><br>
									Class Name:<br> <input type="text" name ="classname"><br><br>
									Teacher Name:<br> <input type="text" name ="teacher"><br><br>
									School:<br> <input type="text" name ="school" value="UNCC"><br><br>
									Comments:<br> <input type="text" name ="comments" value="None"><br><br>
									
									<input type="file" name="file"><br><br>
									<input type="submit" name="submit" value ="Upload">

								</form>';
							echo "$Sring_Message";
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




