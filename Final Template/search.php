<?php

	require 'core.inc.php';
	require 'connect.inc.php';
	require 'rate.inc.php';
	
	// Initialize variables
	$searchTitle="";
	$searchCourse="";
	$searchInstructor="";
	$searchUniversity="";

?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>X Note Plus</title>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
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
				<br/>
				<h2>Search for Documents</h2> <br>

<!----------------------------- Normal Search ----------------------------->
				<form action="search.php" method="get">
					<div class="input-group">
					  <span class="input-group-addon">Document</span>
					  <input type="text" name="searchDoc" class="form-control" placeholder="Search document title">
					</div><br>

<!----------------------------- Advanced Search ----------------------------->
					<?php
						$spoilerContent= "
						<div class='input-group'>
						  <span class='input-group-addon'>Course</span>
						  <input type='text' name='searchCourse' class='form-control' placeholder='Search a course'>
						</div><br>
						<div class='input-group'>
						  <span class='input-group-addon'>Instructor</span>
						  <input type='text' name='searchInstructor' class='form-control' placeholder='Search an instructor'>
						</div><br>
						<div class='input-group'>
						  <span class='input-group-addon'>University</span>
						  <input type='text' name='searchUni' class='form-control' placeholder='Search a university'>
						</div><br>";
						$title="Advanced-Search";
						createSpoiler($title, $spoilerContent, $rateUp, $rateDown);
					?>
<!----------------------------- END Advanced Search ----------------------------->

					<button class="btn btn-default" type="submit">Search</button>
				</form><br>
				
				<h2><?php if(isset($_GET['searchDoc'])){echo 'Search Results: ';}?></h2>
				
				<?php
					$searchQuery = "SELECT * FROM uploadinfo WHERE ";
					$init=1;
					if(isset($_GET['searchDoc'])){
						$searchTitle = $_GET['searchDoc'];
						if($searchTitle != ""){
							$searchQuery .= "NotesTitle LIKE '%$searchTitle%' ";
							$init=($init==1)?0:$init;
						}
					}
					if(isset($_GET['searchCourse'])){
						$searchCourse = $_GET['searchCourse'];
						if($searchCourse != ""){
							if($init==1){$medium="";} else {$medium=" AND ";}
							$searchQuery .= $medium."ClassName LIKE '%$searchCourse%' ";
							$init=($init==1)?0:$init;
						}
					}
					if(isset($_GET['searchInstructor'])){
						$searchInstructor = $_GET['searchInstructor'];
						if($searchInstructor != ""){
							if($init==1){$medium="";} else {$medium=" AND ";}
							$searchQuery .= $medium."Teacher LIKE '%$searchInstructor%' ";
							$init=($init==1)?0:$init;
						}
					}
					if(isset($_GET['searchUni'])){
						$searchUniversity = $_GET['searchUni'];
						if($searchUniversity != ""){
							if($init==1){$medium="";} else {$medium=" AND ";}
							$searchQuery .= $medium."Teacher LIKE '%$searchUniversity%' ";
							$init=($init==1)?0:$init;
						}
					}

					if(($searchTitle!="")||($searchCourse!="")||($searchInstructor!="")||($searchUniversity!="")){
						$searchResults = searchDB($searchQuery);
						if((mysql_num_rows($searchResults)) > 0) {
							while($row = mysql_fetch_array($searchResults)) {
								$docTitle = $row['NotesTitle'];
								$docContent = $row['Content'];

								createSpoiler($docTitle, $docContent, $rateUp, $rateDown);
							}
						} else {
							echo "No match found.";
						}
					} else {
						echo "No search entered";
					}
				?>
				<br>
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