<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'comparison.php';
	require('WriteHTML.php');
	
	
	
	
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
	
		$isMobile = (bool)preg_match('#\b(ip(hone|od)|android\b.+\bmobile|opera m(ob|in)i|windows (phone|ce)|blackberry'.
                    '|s(ymbian|eries60|amsung)|p(alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] ); 
	
	
?>

<!doctype html>
<html>

<head>
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
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

		<?php if($isMobile==false){ echo

    '<div id="body">'.

	  '<section id="content">';} ?>
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
											echo '<td>'."$Files_Names[$x]".'</td>'.'<td>';
											echo '<form action="myaccount.php">';
											echo '<button type="submit" class="btn btn-default" aria-label="Left Align" name="view'.$x.'" title="Display this file">
														  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
													</button>'; echo '   ';
											echo ' <button type="submit" class="btn btn-default" aria-label="Left Align" name="download'.$x.'" title="Download this file as PDF">
														  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
													</button>'; echo '   ';
											echo '<button type="submit" class="btn btn-default" aria-label="Left Align" name="delete'.$x.'" title="Delete this file">
														  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
													</button>'; echo '   ';
											
											echo '<button type="submit" class="btn btn-default" aria-label="Left Align" name="similar'.$x.'" title="view similar Notes to this File">
														  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
													</button>';
											echo '</Form>';
											echo '</td>';
											if (isset($_REQUEST['download'.$x])) {												
												header('Location:pdfFunction.php?id='.$Files_ID[$x]);
											}
											if (isset($_REQUEST['delete'.$x])) {												
												header('Location:deletefile.php?id='.$Files_ID[$x]);
											}
											if (isset($_REQUEST['view'.$x])) {												
												header('Location:myaccount.php?id='.$Files_ID[$x]);
											}
											if (isset($_REQUEST['similar'.$x])) {												
												header('Location:similar.php?id='.$Files_ID[$x]);
											}
											//Third Column
											$href='deletefile.php?id='.$Files_ID[$x];
											$view='myaccount.php?id='.$Files_ID[$x];
											$similarfile='similar.php?id='.$Files_ID[$x];
											//echo '<td>';echo "<a href='".$view."'>View</a>";echo '<br> ';echo "<a href='".$similarfile."'>Similar Notes</a>"; 
											
											echo '</td>';
											echo '</tr>';
										}
										
										
										
																	
										
									?>
								</table>
							</div>
							<br>
							

							<article>
								<?php
									if($CurrentFileID!=null){
										createSpoilerbuttonmyaccount($CurrentFileID);										
									}
								?>
							</article>
						</div>

<!------------------------------- Profile tab ------------------------------->
						<?php
	
							$OldUsername='value='.getfield("username");
							$oldname=getfield('name');$OldFullname='value='."'$oldname'";
							$Schooll=getfield('school');$OldSchool='value='."'$Schooll'";
							$OldPassword='value='.getfield("password");
							$StringMessage=' ';
							
							if(loggedin()){
								if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['name']) && isset($_POST['school']) ){
									$username = $_POST['username'];
									$password = $_POST['password'];
									$password_again = $_POST['password_again'];
									$name = $_POST['name'];
									$school = $_POST['school'];
									$database=DatabaseName();
									$StudentID=$_SESSION['user_id'];
									
									
									
									if(!empty($username) && !empty($password) && !empty($password_again) && !empty($name) && !empty($school)){
										if($password!=$password_again){
											$StringMessage= 'Password do not match.';
										}else{
												
											$query="UPDATE `$database`.`users` SET `username` = '$username', `password` = '$password', `name` = '$name', `school` = '$school' WHERE `users`.`Id` = $StudentID";
											if($query_run = mysql_query($query)){
												$StringMessage='Profile Updated';
											}
										}
									}else{
										$StringMessage= 'All fields are required';
									}
								}
							} else if(!loggedin()){
								$StringMessage= 'Log in Before updating your profile';								
								
							}
							

						?>
						<div class="tab-pane" id="profile">
							<article><br>
									<form action="myaccount.php" method="POST">
									Username:<br> <input type="text" name ="username" <?php echo $OldUsername; ?> ><br><br>
									Password:<br> <input type="password" name ="password" <?php echo $OldPassword; ?> ><br><br>
									Retype Password:<br> <input type="password" name ="password_again" <?php echo $OldPassword; ?> ><br><br>
									Full Name:<br> <input type="text" name ="name" <?php echo $OldFullname; ?> ><br><br>
									School:<br> <input type="text" name ="school" <?php echo $OldSchool; ?> ><br><br>
									<input type="submit" value ="Update">
								</form>
								<br>
								<?php echo $StringMessage ?>
								
								
							</article>
						</div>
						
<!------------------------------- Study Guide tab ------------------------------->						
						<div class="tab-pane" id="studyGuide">
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
												
												echo '<button type="submit" class="btn btn-default" aria-label="Left Align" name="ST_view'.$x.'" title="View Study Guide">
														  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
													</button>'; echo '   ';
												echo ' <button type="submit" class="btn btn-default" aria-label="Left Align" name="download'.$x.'" title="Download this file as PDF">
														  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
													</button>'; echo '   ';

												if (isset($_REQUEST['ST_view'.$x])) {												
													header('Location:ST_view.php?Name='.$table[$x]);
												}
												if (isset($_REQUEST['download'.$x])) {
													$Class=strtolower($Student_Classes[$x][1]);
													$School=strtolower($Student_Classes[$x][0]);
													header('Location:pdfFunction.php?class='.$Class.'&school='.$School);
												}
												
												
												echo '</td>';
												echo '</tr>';
											}
										?>
									</table>
								</div>
							</article>
							</article>
						</div>
					</div>
				</form>
				
			<?php if($isMobile==false){
       echo '</section>';
       
       echo '<aside class="sidebar">';	
             include 'aside.php'; 	
       echo '</aside>';
		echo '<div class="clear"></div>';

  '</div>';}
  ?>
	</div></div></div>
       <footer>
			 <?php include 'newfooter.php'; ?> 
		</footer>

	</div>
</body>
</html>