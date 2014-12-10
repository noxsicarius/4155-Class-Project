<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';

	if(isset($_GET['no'])){
		$NoOfUsers=$_GET['no'];
		$_SESSION['users_no']=$NoOfUsers;
	}else{
		if($_SESSION['users_no']==0){
		$_SESSION['users_no']=1;
		}
		$NoOfUsers=$_SESSION['users_no'];
	}
	
	if(UserRole()!='Admin'){
		header('Location:unarth.php');
	}

	$link='studentaccounts.php';
	$StudentsInfo=GetAllUsername();

	if (isset($_REQUEST['Addmore'])) {		
		$_SESSION['users_no']++;
		$NoOfUsers=$_SESSION['users_no'];
		header('Location:addstudent.php');
		
	}
	
	if (isset($_REQUEST['MinusOne'])) {
		if($_SESSION['users_no']>1){
			$_SESSION['users_no']--;
		}
		$NoOfUsers=$_SESSION['users_no'];
		header('Location:addstudent.php');		
	}
	
	if (isset($_REQUEST['Reset'])) {		
		$_SESSION['users_no']=1;
		$NoOfUsers=0;
		header('Location:addstudent.php');
		
	}
	
	for($x=0;$x<$_SESSION['users_no'];$x++){
		$username[$x] = '';			
		$fullname[$x] = '';
		$school[$x] = '';
		$email[$x] = '';			
	}
	
	$ALL_fields=true;$AllDone=false;
	if(isset($_POST['btnRegister'])){
		for($x=0;$x<$_SESSION['users_no'];$x++){
			$username[$x] = $_POST['username'.$x];			
			$fullname[$x] = $_POST['fullname'.$x];
			$school[$x]  = $_POST['school'.$x];
			$email[$x]  = $_POST['email'.$x];
			if(!empty($username[$x]) && !empty($fullname[$x]) && !empty($school[$x]) && !empty($email[$x])){
				$success[$x]=AddOneAdminUser($username[$x],$email[$x],$fullname[$x],$school[$x]);
				$AllDone=true;
			}else{
				$ALL_fields=false;
			}
		}
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
                <div class="col-lg-6">
					<form action="addstudent.php">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Admin
														
								<button type="submit" class="btn btn-default btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="Addmore" title="Add Row">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"> </span>
								</button>
								<button type="submit" class="btn btn-default btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="MinusOne" title="Delete Row">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"> </span>
								</button>
								<button type="submit" class="btn btn-default btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="Reset" title="Reset">
									<i class="fa fa-repeat"></i>
								</button>
							</form>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
											<th>School</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											for($x=0;$x<$NoOfUsers;$x++){
												echo '<form action="addadmin.php" method="POST">';
												echo        '<tr>';
												echo            '<td>'.($x+1).'</td>';
												echo            '<td width="300"><input class="form-control"  placeholder="Enter Name" name="fullname'.$x.'" value="'.$fullname[$x].'"></td>';
												echo            '<td width="300"><input class="form-control"  placeholder="Enter Username" name="username'.$x.'" value="'.$username[$x].'"></td>';
												echo            '<td width="400"><input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email'.$x.'" value="'.$email[$x].'"></td>';
												echo			'<td width="400"><input class="form-control"  placeholder="Enter School name" name="school'.$x.'" value="'.$school[$x].'"></td>';
												echo        '</tr>';
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                        <!-- /.panel-body -->
						<div class="panel-footer"><button class="btn btn-default pull-right" type="submit" name="btnRegister">Register</button><br><br></div>
							</form>
                    </div>
                    <!-- /.panel -->
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-info pull-right">
                        <div class="panel-heading">
                            Info and Tips
                        </div>
                        <div class="panel-body">
							<p>Password are by default password</p>
							<p>Make sure that the user name is not already created  </p>
							<p>  </p>
                        </div>
                        <div class="panel-footer">
                            For more info emails us
                        </div>
                    </div>
                </div>
			</div>
		<?php							
			if(!$ALL_fields){ ?>
				<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					ALL fields are required!
				</div>
		<?php
			}
			if(isset($_POST['btnRegister']) && $AllDone) {
				for($x=0;$x<$_SESSION['users_no'];$x++){
					if($success[$x]==true){
						echo '<div class="alert alert-success">
									<span>'.$username[$x].' Created</span>									
								</div>';
					}else if($success[$x]==false){
						echo '<div class="alert alert-danger">
									<span>'.$username[$x].' already exists </span>									
								</div>';
					}
				
				}
				$_SESSION['users_no']=1;
			}
		?>
			
            
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
