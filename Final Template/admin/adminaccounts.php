<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';
	
	if(UserRole()!='Admin'){
		header('Location:unarth.php');	
	}
	//$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
	$link='adminaccounts.php';
	$StudentsInfo=GetAllAdminusers();
	//
	for($x=0;$x<sizeof($StudentsInfo);$x++){
		//echo $StudentsInfo[$x][0];
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This page shows admin students records">
    <meta name="author" content="Asif Subhan">
	<link rel="shortcut icon" href="http://faviconist.com/icons/2651b49d7a0290b4dea7941fae50d25e/favicon.ico" />

    <title>Admin Records</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'navg.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Records</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Admin Accounts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>UserName</th>
                                            <th>Email</th>
                                            <th>School</th>											
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										for($x=0;$x<sizeof($StudentsInfo);$x++){
											echo	'<tr class="odd gradeX">';
                                            echo		'<td >'.$StudentsInfo[$x][0].'</td>';
                                            echo		'<td>'.$StudentsInfo[$x][1].'</td>';
                                            echo		'<td>'.$StudentsInfo[$x][2].'</td>';
                                            echo		'<td class="center">'.$StudentsInfo[$x][3].'</td>';
											echo 		'<form action="'.$link.'">';
                                            echo		'<td width="300">';											
											echo 		'<button type="submit" class="btn btn-default" aria-label="Left Align" name="delete'.$x.'" title="Delete this file">
															  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
														</button>'; echo '   ';
											echo 		'<button type="submit" class="btn btn-default" aria-label="Left Align" name="edit'.$x.'" title="Edit this user Profile">
															  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
														</button>'; echo '   ';						
											echo 		'</Form>';
											echo        '</td>';
											echo	'</tr>';
											
											if (isset($_REQUEST['delete'.$x])) {
												DeleteUser($StudentsInfo[$x][4]);
												header('Location:'.$link);
											}
											if (isset($_REQUEST['edit'.$x])) {												
												header('Location:adminaccounts.php?id='.$StudentsInfo[$x][4]);
											}
											
										}
									?>                                        
                                       
                                        
                                    </tbody>
                                </table>
								
                            </div>
                            <!-- /.table-responsive -->                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<!-- Update table-->
			<div class="row">
                <div class="col-lg-12">
				<?php
					$StringMessage= '';
					if(isset($_GET['id'])){						
							$UserRole=UserRole();							
							if ($UserRole=='Admin') {
								$access=1;
							} else {
								$access=0;
							}
							
					}
					
					if(isset($_GET['id']) && $access==1){
						$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];	
						$CurrentFileID=$_GET['id'];
						$OldUsername=getfield("username",$CurrentFileID);
						$OldEmail=getfield("email",$CurrentFileID);
						$OldName=getfield('name',$CurrentFileID);
						$OldSchool=getfield('school',$CurrentFileID);
						$OldPassword=getfield("password",$CurrentFileID);	
						$OldRole=getfield("role",$CurrentFileID);						
						
						
						
						
						if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['name']) && isset($_POST['school']) && isset($_POST['email']) ){
									$username = $_POST['username'];
									$password = $_POST['password'];
									$password_again = $_POST['password_again'];
									$name = $_POST['name'];
									$school = $_POST['school'];
									$email = $_POST['email'];
									$role = $_POST['role'];
									$database=DatabaseName();
									$StudentID=$_GET['id'];
									
									
									
									if(!empty($username) && !empty($password) && !empty($password_again) && !empty($name) && !empty($school) && !empty($email)){
										if($password!=$password_again){
											$StringMessage= 'Password do not match.';
										}else{
												
											$query="UPDATE `$database`.`users` SET `username` = '$username', `password` = '$password', `name` = '$name', `school` = '$school', `email` = '$email', `role` = '$role' WHERE `users`.`Id` = $StudentID";
											if($query_run = mysql_query($query)){
												if(isset($_POST['btnUpdate'])){
													header('Location:'.$link);
												}
											}
										}
									}else{
										$StringMessage= 'All fields are required';
									}
						}
						
				?>
					<form action="<?php echo $link; ?>" method="POST">
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Username</span>
							<input type="text" style='max-width:250px;' value="<?php echo $OldUsername;?>" name="username" class="form-control" placeholder="Choose a username"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Email</span>
							<input type="text" style='max-width:250px;' value="<?php echo $OldEmail;?>" name="email" class="form-control" placeholder="Enter your Email"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Password</span>
							<input type="password" style='max-width:250px;'value="<?php echo $OldPassword;?>" name="password" class="form-control" placeholder="Create a password"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Password</span>
							<input type="password" style='max-width:250px;' value="<?php echo $OldPassword;?>" name="password_again" class="form-control" placeholder="Retype password"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Full Name</span>
							<input type="text" style='max-width:250px;' value="<?php echo $OldName;?>" name="name" class="form-control" placeholder="Enter your full name"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>University</span>
							<input type="text" style='max-width:250px;' value="<?php echo $OldSchool;?>" name="school" class="form-control" placeholder="University you attend"><br>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon" style='min-width:100px;'>Role</span>
							<select class="form-control" style='max-width:250px;' name="role">
							  <?php 
									echo '<option>'.$OldRole.'</option>';
									if($OldRole!='Student'){echo '<option>Student</option>';}
									if($OldRole!='Admin'){echo '<option>Admin</option>';}
									if($OldRole!='Teacher'){echo '<option>Teacher</option>';}							  
							 ?>						  
							</select>
						</div><br>
						<button class="btn btn-default" type="submit" name="btnhide">Hide</button>
						<button class="btn btn-default" type="submit" name="btnUpdate">Update</button>
					</form>						
										
											
											
				<?php	
					}
					if (isset($_REQUEST['btnhide'])) {												
						header('Location:adminaccounts.php');
					}
					echo $StringMessage;
				?> 									
										
				
				</div>
			</div>
			
            
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
