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

	$user_fullname=getfield('name');
	$StudentID=getuserid();
	$Sring_Message='<strong>Please upload text files only. </strong>';

	if(isset($_POST['submit'])){
		$name = $_FILES['file']['name'];
		$type = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		$tmp_name = $_FILES['file']['tmp_name'];
	}
	  
	  
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
					$query_run = mysql_query($query);
					$num_of_rows=mysql_num_rows($query_run);
					
					if($num_of_rows>0){
						$File_Student_ID = mysql_result($query_run, 0,'StudentID');
					}else{
						$File_Student_ID =-1;
					}
					
					//Checking if the file exists in the database
					
					//echo 'Database: '.$File_Student_ID.'<br>';
					//echo 'Current: '.$StudentID.'<br>';
					if($num_of_rows==1 && $File_Student_ID==$StudentID) {
						$Sring_Message= 'The File '.$name. ' already exists.';
					} else{
						//sql query
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
									'".mysql_real_escape_string($content)."')";

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



    <div id="body">

	  <section id="content">

	    <article>
			<h2>Upload text files</h2>
		</article>

	    <article class="expanded">
			<?php
				if($logged_in==1){
					echo '<article>';
					echo "$Sring_Message".'<br>';
					echo '</article>';
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
							
					$arrlength=count($File_names);
					echo 'My Files in DataBase'.'<br>';
					for($x=0;$x<$arrlength;$x++){
						echo $File_names[$x].'<br>';
					}
				}else{
					echo 'Please '.'<a href="register.php">Register</a>'.' or '.'<a href="login.php">Log in</a>'.' before uploading a file';
				}
				
			?>
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