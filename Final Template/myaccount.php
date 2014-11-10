<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'comparison.php';
	
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
	$Student_Classes=ST_Student_Classes($ID);
	

?>

<!doctype html>
<html>

<head>
	
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

			<section id="content">
				<br><br>
				<ul class="nav nav-tabs">
				<!-- Tabs go here -->
					<li class="active"><a href="#myFiles" data-toggle="tab">My Files<i class="fa"></i></a></li>
					<li><a href="#profile" data-toggle="tab">Profile<i class="fa"></i></a></li>
					<li><a href="#studyGuide" data-toggle="tab">Study Guide<i class="fa"></i></a></li>
				</ul>
				<form id="accountForm" method="post" class="form-horizontal">
					<div class="tab-content">
					
<!------------------------------- My files tab ------------------------------->
						<div class="tab-pane active" id="myFiles">
							<article><br>
							<div class="panel panel-default">
								<!-- Default panel contents -->
								<!--<div class="panel-heading">Your Files</div>-->
								<div class="panel-heading" style=><font size="6"><b>Your Files</b></font></div>
								<table class="table">
									<tr>
										<td><font size="4"><b>File Title</b></font></td>
										<td><font size="4"><b>File Name</b></font></td>
										<td><font size="4"><b>Action</b></font></td>
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
											$similarfile='similar.php?id='.$Files_ID[$x];
											echo '<td>';echo "<a href='".$href."'>Delete</a>";echo '   '."<a href='".$view."'>View</a>";echo '<br> ';echo "<a href='".$similarfile."'>Similar Notes</a>"; 
											
											echo '</td>';
											echo '</tr>';
										}
									?>
								</table>
							</div>
							<br>
							<article><br>
								<div class="panel panel-default">
									<!-- Default panel contents -->
									<!--<div class="panel-heading">Your Files</div>-->
									<div class="panel-heading"><font size="6"><b>Your Classes</b></font></div>
									<table class="table">
										<tr>
											<td><font size="4"><b>School</b></font></td>
											<td><font size="4"><b>Class</b></font></td>
											<td><font size="4"><b>Action</b></font></td>
										</tr>
										<?php
											$arrlength=count($Student_Classes);
											for($x=0;$x<$arrlength;$x++){
												echo '<tr>';
												//First column
												echo '<td>'.$Student_Classes[$x][0].'</td>';
												//Second column 
												echo '<td>'.$Student_Classes[$x][1].'</td>';
												$table[$x] = ST_ClassTableName($Student_Classes[$x][0],$Student_Classes[$x][1]);
												$view='ST_view.php?Name='.$table[$x];
												//$view=ST_PrintMaster('$Student_Classes[$x][0]','$Student_Classes[$x][1]','0');
												echo '<td>';
												//echo "<a href='".$href."'>Delete</a>";
												echo '   '."<a href='".$view."'>View study guide</a>"; 
												
												echo '</td>';
												echo '</tr>';
											}
										?>
									</table>
								</div>
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
						</div>

<!------------------------------- Profile tab ------------------------------->
						<div class="tab-pane" id="profile">
							<article><br>
								<h2> PROFILE <h2>
							</article>
						</div>
						
<!------------------------------- Study Guide tab ------------------------------->						
						<div class="tab-pane" id="studyGuide">
							<article><br>
								<h2> Study Guide <h2>
							</article>
						</div>
					</div>
				</form>
				
			</section>

			<aside class="sidebar">
				<?php include 'aside.php'; ?>		
			</aside>
			
			<div class="clear"></div>
		
		<footer>
			<?php include 'footer.php' ?>;
		</footer>

	</div>
</body>
</html>