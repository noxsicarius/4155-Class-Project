<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'comparison.php';

	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;
		$user_fullname=getfield('name');
		$StudentID=getuserid();
	}else{
		$logged_in=0;
	}	
	
	$Sring_Message='<strong>Please upload text files only. </strong>';

	if(isset($_POST['submit'])){
		$name = $_FILES['file']['name'];
		$type = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		$tmp_name = $_FILES['file']['tmp_name'];
	}
	$isMobile = (bool)preg_match('#\b(ip(hone|od)|android\b.+\bmobile|opera m(ob|in)i|windows (phone|ce)|blackberry'.
                    '|s(ymbian|eries60|amsung)|p(alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] ); 
	  
	if(loggedin()){
		if(isset($_POST['title']) && isset($_POST['chapter']) && isset($_POST['classname']) && isset($_POST['teacher'])  && isset($_POST['comments']) ){
			$title = $_POST['title'];
			$chapter = $_POST['chapter'];
			$classname = $_POST['classname'];
			$teacher = $_POST['teacher'];
			$school = $_POST['school'];
			$comments = $_POST['comments'];		
			
			if(!empty($title) && !empty($chapter) && !empty($classname) && !empty($teacher) && !empty($school) && !empty($comments)){
				
				if(empty($name) OR $type!='text/plain'){
					$Sring_Message = 'Please choose a text file. At this time we can only process text files';			
				}else{
					if($size>0){
						$extract = fopen($tmp_name, 'r'); 
						$content = fread($extract, $size); 
						$content = addslashes($content); 
						fclose($extract);
					} else {
						die('Cannot Upload an empty File '.'<a href="uploads.php">Go Back</a>');
					}
					
					$location ='uploads/';
					$query = "SELECT * from uploadinfo WHERE FileName='$name' AND StudentID=$StudentID";
					$query="SELECT * FROM `uploadinfo` WHERE `StudentID` = $StudentID AND `FileName` LIKE '$name'";
					
					$query_run = mysql_query($query);
					$num_of_rows=mysql_num_rows($query_run);
					
					if($num_of_rows>0){
						$File_Student_ID = mysql_result($query_run, 0,'StudentID');
					}else{
						$File_Student_ID =-1;
					}
					
					//Checking if the file exists in the database
					
					if($num_of_rows==1 && $File_Student_ID==$StudentID) {
						$Sring_Message= 'The File '.$name. ' already !!exists.345435345345  '.$StudentID;
						
					} else{
						$query = "INSERT INTO uploadinfo VALUES ('$StudentID',
									FileID,
									'".mysql_real_escape_string($name)."',
									'".mysql_real_escape_string($location)."',
									'".mysql_real_escape_string($school)."',
									'".mysql_real_escape_string($classname)."',
									'".mysql_real_escape_string($teacher)."',
									'".mysql_real_escape_string($chapter)."',
									'".mysql_real_escape_string($title)."',
									'".mysql_real_escape_string($comments)."',
									'".mysql_real_escape_string($content)."',
									0,0,0,0)";

						if ($query_run = mysql_query($query)){
							if(move_uploaded_file($tmp_name, $location.$name)){
								$Sring_Message= "$name".' Uploaded';
								include 'filetokeywords.php';
							}
						}else {
							$Sring_Message= mysql_error();
						}
					}
				}
			}else{
			 $Sring_Message= 'All fields are required';
			}

		}

		$query = "SELECT * FROM uploadinfo WHERE  StudentID = '$StudentID'";

		if($resulta  = mysql_query($query)){

			$num_of_rows=mysql_num_rows($resulta);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($resulta,$i,"FileName");
				$File_names[$i]= $content;
			}
		}else{
			echo 'File in database not working';
		}
	}

?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Notes to X Note Plus</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
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

<?php if($isMobile==false){ echo

    '<div id="body">'.

	  '<section id="content">';} ?>

	    <article>
			<h2>Upload text files</h2>
		</article>

	    <article class="expanded"></b>
		<?php
			if($Sring_Message=='All fields are required'){
				echo '<div class="alert alert-danger" role="alert">'.$Sring_Message.'</div>';
			}else if($Sring_Message=="<strong>Please upload text files only. </strong>"){
				echo '<div class="alert alert-info" role="alert">'.$Sring_Message.'<br></div>';
			}else if($Sring_Message== "$name".' Uploaded'){
				echo '<div class="alert alert-success" role="alert">'.$Sring_Message.'<br></div>';
			}else if($Sring_Message== 'The File '.$name. ' already exists.'){
				echo '<div class="alert alert-warning" role="alert">'.$Sring_Message.'<br></div>';
			}else if(empty($name) OR $type!='text/plain'){
				echo '<div class="alert alert-warning" role="alert">'.$Sring_Message.'<br></div>';
			}else{
				echo '<div class="alert alert-danger" role="alert">'.$Sring_Message.'</div>';
			}
			
		?>
		
		<?php
			if($logged_in==1){
				echo '<form action="uploads.php" method="POST" enctype="multipart/form-data">
						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">Title</span>
							<input type="text" style="max-width:500px;" class="form-control" placeholder="Enter Title for your notes" name ="title">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">Chapter</span>
						    <input type="text" style="max-width:500px;" class="form-control" placeholder="Enter Chapter for your notes" name ="chapter">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">Class Name</span>
						    <input type="text" style="max-width:500px;" class="form-control" placeholder="Enter Class Name for your notes" name ="classname">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">Teacher Name</span>
						    <input type="text" style="max-width:500px;" class="form-control" placeholder="Enter Teacher Name for your notes" name ="teacher">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">School</span>
						  	<input type="text" style="max-width:500px;" class="form-control" placeholder="Enter School Name for your notes" name ="school" value="UNCC">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon" style="min-width:120px;">Comments</span>
						  	<input type="text" style="max-width:500px;" class="form-control" placeholder="Enter comments for your notes" name ="comments" value="None">
						</div><br>

						<input type="file" name="file"><br><br>
						
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-default" name="submit" >Upload</button>
						</div>
					  </div>
					</form>';
						
				$arrlength=count($File_names);
			}else{
				echo 'Please '.'<a href="register.php">Register</a>'.' or '.'<a href="login.php">Log in</a>'.' before uploading a file';
			}
				
		?>
		  <h2>&nbsp;</h2>
		</article>
<?php if($isMobile==false){
		echo '</section>';
		echo '<aside class="sidebar">';	
			include 'aside.php'; 	
		echo '</aside>';
		echo '<div class="clear"></div>';
		echo '</div>';}
  ?>
</div></div>
       <footer>
			 <?php include 'newfooter.php'; ?> 
		</footer>
</body>
</html>