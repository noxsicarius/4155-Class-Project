<?php

	require 'core.inc.php';
	require 'connect.inc.php';
	require 'rate.inc.php';

	if(isset($_GET['searchparams'])){
		$searchText = $_GET['searchparams'];
		$searchResults=searchDB($searchText);
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
				<br/>
				<h2>Search By Document Title</h2>
					<form action="search.php" method="get">
						<label>Document Title:
							<input type="text" name="searchparams" />
						</label>
						<input type="submit" value="Search" />
					</form>
				<br/><br/><br/>

				<h2><?php if(isset($_GET['searchparams'])){echo 'Search Results: ';}?></h2>
				
				<?php
					if(isset($_GET['searchparams'])){
						if((mysql_num_rows($searchResults)) >= 1) {
							while($row = mysql_fetch_array($searchResults)) {
								$docTitle = $row['NotesTitle'];
								$docContent = $row['Content'];

								createSpoiler($docTitle, $docContent, $rateUp, $rateDown);
							}
						} else {
							if($searchText == "") {
								echo "No search entered";
							} else {
								echo "No match found for ".$searchText;
							}
						}
					}
				?>

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