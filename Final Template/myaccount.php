<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'drop.inc.php';

	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;							
		//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
	}else{
		$logged_in=0;
	}
	$ID=getuserid();
	$Files_Names=FilesInDataBase_ID('NotesTitle',$ID);
	
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

					<h2>Your Files</h2><br>

					<table border="1" style="width:100%">
						<tr>
							<td><b>File Title</b></td>
						</tr>

						<?php
							$arrlength=count($Files_Names);

							for($x=0;$x<$arrlength;$x++){
								echo '<tr>';
								echo '<td>'."$Files_Names[$x]".'</td>';
								echo '</tr>';
							}
						?>
					</table>
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