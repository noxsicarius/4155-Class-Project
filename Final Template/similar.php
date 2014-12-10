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
	
	if(isset($_GET['id'])){
		$CurrentFileID=$_GET['id'];
		$FileTitle=FileInfo($CurrentFileID,'NotesTitle');
		$Array=(GetMatchTo($CurrentFileID));
		for($x=0;$x<sizeof($Array);$x++){
			$Nname=FileInfo($Array[$x][0],'NotesTitle');$Sschool=FileInfo($Array[$x][0],'School');$Cclass=FileInfo($Array[$x][0],'ClassName');$Match=$Array[$x][1];			
				
		}
	}else{
		$CurrentFileID=null;
	}
	
	
	
	function MakeTable($Name,$Match,$Class,$School,$Link){
		 
		$String ="<tr><td>$Name </td><td>$Match %</td><td>$Class</td><td>$School</td><td><a href=".$Link.">View</a></td></tr>";
		return $String;
	}
	
?>

<!doctype html>
<html>
<head>
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
	<title>Similar Files</title>
</head>

<body>
	<div id="container">
		<header>
			<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
			<h2>Upload, Share, and compare notes</h2>
		</header>
		
		
		<?php include 'menu.php'; ?>
		
		
		

		<div id="body">

			<section id="content">
	<?php	
		if(isset($_GET['id'])){
			echo		'<article>';
			echo		'<br><br>';
					
			echo		'<div class="panel panel-default">';
			echo		  '<!-- Default panel contents -->';
			echo		  '<div class="panel-heading">Similar Notes to <b>'.$FileTitle. '</b></div>';				  
			echo			  '<div class="panel-body">';
			echo			  '<table class="table">';												
			echo						'<tr>';								
			echo							'<td><b>Notes Title</b></td>';
			echo							'<td><b>Match</b></td>';
			echo							'<td><b>Class Name</b></td>';
			echo							'<td><b>School</b></td>';
			echo							'<td><b>Action</b></td>';
			echo						'</tr>';
										
										for($x=0;$x<sizeof($Array);$x++){
											$Link='similar.php?id='.$CurrentFileID.'&view='.$Array[$x][0];
											$Name=FileInfo($Array[$x][0],'NotesTitle');$School=FileInfo($Array[$x][0],'School');$Class=FileInfo($Array[$x][0],'ClassName');$Match=$Array[$x][1];
											$x5='hey';
											if ($Match>69){
												if($Match>100){
													$Match=100;												
												}
												$forml=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
												
												echo "<tr><td>$Name </td><td>$Match %</td><td>$Class</td><td>$School</td>";
												echo '<td>';$Link='similar.php?id='.$CurrentFileID;
												echo '<form action="'.$forml.'" method="Post">';
												echo '<button type="submit" class="btn btn-default" aria-label="Left Align" name="show'.$x.'" title="Display this file">
														  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
													</button>';
												echo '</Form>';												
												echo '</td></tr>';
												
											}
											
											if (isset($_REQUEST['show'.$x])) {
												$Link='similar.php?id='.$CurrentFileID.'&view='.$Array[$x][0];
												header('Location:'.$Link);
												}
											
											
											
										}
									
																	
			echo				'</table>';
			echo				'</div>';
			echo			'</div>';
			echo		'</article>';

			if(isset($_GET['view'])){
				$viewsim=$_GET['view'];
				createSpoilerbutton($viewsim);	
			}
		}else{
			echo '<article>';
					include '/comparefiles/yourfiles.php';
			
			
			

			echo '</article>';	
		}
	?>		

				
			</section>
			
			<aside class="sidebar">
				<?php include 'aside.php'; ?>
			</aside>

			<div class="clear"></div>
		</div>
	</div>
       <footer>
			 <?php include 'newfooter.php'; ?> 
		</footer>
</body>
</html>