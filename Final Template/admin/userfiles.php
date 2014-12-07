<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';
	
	if(UserRole()!='Admin'){
		Die();
	}
	//$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
	$link='userfiles.php';
	$AllFiles=FilesInDataBase();
	if(isset($_GET['id'])){
		$CurrentFileID=$_GET['id'];
	}else{
		$CurrentFileID=null;
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

    <title>Users Files</title>

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
                    <h1 class="page-header">User Files</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Files in Database
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Student</th>
                                            <th>Class</th>											
                                            <th>School</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										for($x=0;$x<sizeof($AllFiles);$x++){
											echo	'<tr class="odd gradeX">';
                                            echo		'<td >'.$AllFiles[$x][1].'</td>';
                                            echo		'<td>'.$AllFiles[$x][2].'</td>';
                                            echo		'<td>'.$AllFiles[$x][3].'</td>';
                                            echo		'<td class="center">'.$AllFiles[$x][4].'</td>';
											echo 		'<form action="'.$link.'">';
                                            echo		'<td width="300">';											
											echo 		'<button type="submit" class="btn btn-default" aria-label="Left Align" name="delete'.$x.'" title="Delete this file">
															  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
														</button>'; echo '   ';
											echo 		'<button type="submit" class="btn btn-default" aria-label="Left Align" name="edit'.$x.'" title="Edit this user Profile">
															  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
														</button>'; echo '   ';						
											echo 		'</Form>';
											echo        '</td>';
											echo	'</tr>';
											
											if (isset($_REQUEST['delete'.$x])) {												
												header('Location:'.$link);
											}
											if (isset($_REQUEST['edit'.$x])) {												
												header('Location:userfiles.php?id='.$AllFiles[$x][0]);
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
