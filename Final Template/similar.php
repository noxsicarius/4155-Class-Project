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
			echo						'<tr bgcolor="#FFFFF0">';								
			echo							'<td><b>Notes Title</b></td>';
			echo							'<td><b>Match</b></td>';
			echo							'<td><b>Class Name</b></td>';
			echo							'<td><b>School</b></td>';
			echo							'<td><b>Action</b></td>';
			echo						'</tr>';
										
										for($x=0;$x<sizeof($Array);$x++){
											$Link='similar.php?id='.$CurrentFileID.'&view='.$Array[$x][0];
											$Nname=FileInfo($Array[$x][0],'NotesTitle');$Sschool=FileInfo($Array[$x][0],'School');$Cclass=FileInfo($Array[$x][0],'ClassName');$Match=$Array[$x][1];
											$x5='hey';
												echo MakeTable($Nname,$Match,$Cclass,$Sschool,$Link);									
											
										}
									
																	
			echo				'</table>';
			echo				'</div>';
			echo			'</div>';
			echo		'</article>';

			if(isset($_GET['view'])){
				$viewsim=$_GET['view'];
				CreateSpoilerByFileID($viewsim);	
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
		
		<footer>
			<?php include 'footer.php' ?>;
		</footer>
	</div>
</body>
</html>