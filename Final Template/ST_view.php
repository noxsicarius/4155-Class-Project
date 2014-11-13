<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'comparison.php';
	
	if(isset($_GET['Name'])){
	$TableName=$_GET['Name'];
	}else{
		$TableName=null;
	}
	
	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;							
		//echo ', you are logged in  '.'<a href="logout.php">Log out</a><br>';							
	}else{
		$logged_in=0;
	}
	$ID=getuserid();
	
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

					<h2>Your Study Guide</h2><br>
					<div class="panel-body">
			  		<table class="table">
										
						<tr bgcolor="#FFFFF0">
							<td><b>Sentence</b></td>
							<td><b>Action</b></td>
						</tr>

						<?php
							$array = ST_PrintMaster_tablename_calcval($TableName);
							$arrlength=sizeof($array);
							for($x=0;$x<$arrlength;$x++){
								echo '<tr>';
								//First column
								echo '<td>'.$array[$x][0].'</td>';
								//Second column 

								$Like='LikeSentence.php?id='.$TableName.','.$array[$x][1];
								$DisLike='DisLikeSentence.php?id='.$TableName.','.$array[$x][1];
								$Abuse ='Abuse.php?id='.$TableName.','.$array[$x][1];
								echo '<td>';
								echo "<a href='".$Like."'>Like</a>".'<br>'; 
								echo "<a href='".$DisLike."'>DisLike</a>".'<br>'; 
								echo "<a href='".$Abuse."'>Abuse</a>".'<br>';
								
								echo '</tr>';
							}
						?>
					</table>
				</article>
					<article>

					<?php
						if($TableName!=null){
						
						}else{
							echo 'Click View to see the content of your notes.';
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

---------------------------------------------------------
