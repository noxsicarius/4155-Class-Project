<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	require 'comparison.php';
	require('WriteHTML.php');
	
	// Get file id
	if(isset($_GET['id'])){
		$CurrentFileID=$_GET['id'];
	}else{
		$CurrentFileID=null;
	}
	
	// check for user login
	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;					
	}else{
		$logged_in=0;
	}

	// Initialize all variables needed
	$ID=getuserid();
	$Files_Title=FilesInDataBase_ID('NotesTitle',$ID);
	$Files_Names=FilesInDataBase_ID('FileName',$ID);
	$Files_ID=FilesInDataBase_ID('FileID',$ID);
	$Student_Classes=ST_Student_Classes($ID);
	
	// Check for mobile device
	$isMobile = (bool)preg_match('#\b(ip(hone|od)|android\b.+\bmobile|opera m(ob|in)i|windows (phone|ce)|blackberry'.
                '|s(ymbian|eries60|amsung)|p(alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                '|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] ); 
?>

<!doctype html>
<html>

<head>
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />
	<link rel="stylesheet" href="css/bootstrap.css">
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

	<?php 
		if($isMobile==false){
			echo '<div id="body">';
			echo '<section id="content">';
		}
	?>
		<br><br>
			
			<!-- tab system for my account page -->
			<ul id="accountTabs" class="nav nav-tabs" data-tabs="accountTabs">
			<!-- Tabs go here -->
				<li class="active"><a href="#myFiles" data-toggle="tab">My Files<i class="fa"></i></a></li>
				<li><a href="#profile" data-toggle="tab">Profile<i class="fa"></i></a></li>
				<li><a href="#studyGuide" data-toggle="tab">Study Guide<i class="fa"></i></a></li>
			</ul>
			
		<!-- Content for the tabs above -->
			<div id="accountTabContent" class="tab-content">

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
									
									// Buttons for file manipulation
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
									
									// File manipulation requests
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
					
					<!-- form for account information change -->
						<form action="myaccount.php" method="POST">
							<div class="input-group">
							  <span class="input-group-addon" style="min-width:134px">Username</span>
							  <input type="text" name ="username" class="form-control" <?php echo $OldUsername ?>>
							</div><br>
							<div class="input-group">
							  <span class="input-group-addon" style="min-width:134px">Password</span>
							  <input type="password" name ="password" class="form-control" <?php echo $OldPassword ?>>
							</div><br>
							<div class="input-group">
							  <span class="input-group-addon" style="min-width:134px">Retype Password</span>
							  <input type="password" name ="password_again" class="form-control" <?php echo $OldPassword ?>>
							</div><br>
							<div class="input-group">
							  <span class="input-group-addon" style="min-width:134px">Full Name</span>
							  <input type="text" name ="name" class="form-control" <?php echo $OldFullname ?>>
							</div><br>
							<div class="input-group">
							  <span class="input-group-addon" style="min-width:134px">School</span>
							  <input type="text" name ="school" class="form-control" <?php echo $OldSchool ?>>
							</div><br>

							<button class="btn btn-default" type="submit" name="btnSubmit">Update</button>
						</form><br>
						
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
										echo '<td>';
										echo '   '."<a href='".$view."'>View study guide</a>"; 
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

		<?php 
			if($isMobile==false){
				echo '</section>';
				echo '<aside class="sidebar">';	
				include 'aside.php'; 	
				echo '</aside>';
				echo '<div class="clear"></div>';
				echo '</div>';
			}
		?>
		
		<footer>
			<?php include 'footer.php' ?>;
		</footer>

	</div>
</body>
</html>