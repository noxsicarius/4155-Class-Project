<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	
	if(isset($_GET['id'])){
		$CurrentFileID=$_GET['id'];
	}else{
		$CurrentFileID=null;
	}
	
	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;							
		//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
	}else{
		$logged_in=0;
	}
	$ID=getuserid();
	$Files_Title=FilesInDataBase_ID('NotesTitle',$ID);
	$Files_Names=FilesInDataBase_ID('FileName',$ID);
	$Files_ID=FilesInDataBase_ID('FileID',$ID);
	
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
							<td><b>File Name</b></td>
							<td><b>Action</b></td>
						</tr>

						<?php
							$arrlength=count($Files_Title);

							for($x=0;$x<$arrlength;$x++){
								echo '<tr>';
								//First column
								echo '<td>'."$Files_Title[$x]".'</td>';
								//Second column 
								echo '<td>'."$Files_Names[$x]".'</td>';
								//Third Column
								$href='deletefile.php?id='.$Files_ID[$x];
								$view='myaccount.php?id='.$Files_ID[$x];
								echo '<td>';echo "<a href='".$href."'>Delete</a>";echo '   '."<a href='".$view."'>View</a>"; 
								
								echo '</td>';
								echo '</tr>';
							}
						?>
					</table>
				</article>
					<article>
					<?php
						if($CurrentFileID!=null){
							CreateSpoilerByFileID($CurrentFileID);
						}else{
							echo 'Click View to see the content of your notes.';
						}
					?>
					
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