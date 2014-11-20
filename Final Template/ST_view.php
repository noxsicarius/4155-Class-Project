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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
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

					<br><br>
					<div class="panel panel-default">
					<div class="panel-heading" style=><font size="6"><b>Your Study Guide</b></font></div>
			  		<table class="table">
										
						<tr>
							<td><b>Sentence</b></td>
							<td class="col-md-3" ><b>Action</b></td>
						</tr>

						<?php
							$array = ST_PrintMaster_tablename_calcval($TableName);
							$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
							$arrlength=sizeof($array);
							for($x=0;$x<$arrlength;$x++){
								echo '<tr>';
								//First column
								echo '<td>'.$array[$x][0].'</td>';
								//Second column 
								
								$Like='LikeSentence.php?id='.$TableName.','.$array[$x][1];
								$DisLike='DisLikeSentence.php?id='.$TableName.','.$array[$x][1];
								$Abuse ='Abuse.php?id='.$TableName.','.$array[$x][1];
								echo '<td><form action="'.$link.'" method="Post">';
								
								echo 	'<button type="submit" class="btn btn-default btn-sm  pull-right" aria-label="Left Align" name="Down'.$x.'" title="Click to vote down">
											<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> </span>
										</button>'; 
								echo 	'<button type="submit" class="btn btn-default btn-sm  pull-right" aria-label="Left Align" name="Up'.$x.'" title="Click to vote Up">
											<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> </span>
										</button>'; 
								echo 	'<button type="submit" class="btn btn-default btn-sm  pull-right" aria-label="Left Align" name="abuse'.$x.'" title="Click to report abuse">
											<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"> </span>
										</button>';
								
								echo 	'</Form>';
								
								if (isset($_REQUEST['abuse'.$x])) {												
									header('Location:'.$Abuse);
								}
								if (isset($_REQUEST['Up'.$x])) {												
									header('Location:'.$Like);
								}
								if (isset($_REQUEST['Down'.$x])) {												
									header('Location:'.$DisLike);
								}
								
								//echo "<a href='".$Like."'>Like</a>".'<br>'; 
								//echo "<a href='".$DisLike."'>DisLike</a>".'<br>'; 
								//echo "<a href='".$Abuse."'>Abuse</a>".'<br>';
								
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
