<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';
	
	if(UserRole()=='Admin' OR UserRole()=='Teacher'){
		
	}else {
		header('Location:unarth.php');	
	}
	$AllClasses=GetAllClasses();
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

    <title>Students Records</title>

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

        <!-- Page Content -->
        <div id="page-wrapper">	
			<?php if(isset($_GET['sen'])&& isset($_GET['name'])){ 
			$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
			$value=GetSentence($_GET['name'],$_GET['sen']);
			?>
					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">Edit Sentence<h2>
							<form action="<?php echo $link ?>" method="POST">
							<input class="form-control"  placeholder="Enter Username" name="editsen" value="<?php echo $value ?>"><br>
							<button class="btn btn-default pull-left" type="submit" name="btnsenupdate">Update</button>
							</form>
						</div>
					</div>
			<?php }
				if (isset($_REQUEST['btnsenupdate'])) {	
					$String = $_POST['editsen'];
					if(UpdateSentence($_GET['name'],$_GET['sen'],$String)){
						header('Location:studygudie.php?name='.$_GET['name']);
					}
					
				}
			?>
                <!-- /.col-lg-12 -->
            
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Study Guides</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
	<?php			if(!isset($_GET['name'])){ ?>
	
						<div class="panel panel-default">
							<div class="panel-heading">
								Courses
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered ">
										<thead>
											<tr>
												<th>#</th>
												<th>Class</th>
												<th>School</th>
												<th>Action</th>
											</tr>
										</thead>
														<tbody>
										<?php
											for($x=0;$x<sizeof($AllClasses);$x++){
												echo        '<tr>';
												echo            '<td>'.($x+1).'</td>';
												echo            '<td width="300">'.$AllClasses[$x][1].'</td>';
												echo            '<td width="300">'.$AllClasses[$x][2].'</td>';
												echo 			'<form action="studygudie.php" method="POST">';
												echo			'<td width="300">';
												echo 				'<button type="submit" class="btn btn-default" aria-label="Left Align" name="view'.$x.'" title="Edit this user Profile">
																  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
																	</button>'; echo '   ';	
												echo 			'</Form>';												
												echo			'</td>';                    
												echo        '</tr></form>';
												
												if (isset($_REQUEST['view'.$x])) {
													header('Location:studygudie.php?name='.$AllClasses[$x][3]);
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
	<?php			}else if (isset($_GET['name'])) {
						$Sentences=GetALlSentences($_GET['name']);
	?>
						<div class="panel panel-default">
							<div class="panel-heading">
								Current Study Guide
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Sen #</th>
												<th >Sentence</th>
												<th>Hits</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											for($x=0;$x<sizeof($Sentences);$x++){
												$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];											
												echo        '<tr class="odd gradeX">';
												echo            '<td width="70">'.($Sentences[$x][0]).'</td>';
												echo            '<td width="900">'.$Sentences[$x][1].'</td>';
												echo            '<td width="50">'.$Sentences[$x][2].'</td>';
												echo 			'<form action="'.$link.'" method="POST">';
												echo			'<td width="300">';											
												echo 				'<button type="submit" class="btn btn-default" aria-label="Left Align" name="delete'.$x.'" title="Delete this user">
																  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
																	</button>'; echo '   ';
												echo 				'<button type="submit" class="btn btn-default" aria-label="Left Align" name="edit'.$x.'" title="Edit this user Profile">
																  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
																	</button>'; echo '   ';	
												echo 			'</Form>';
												echo			'</td>';                    
												echo        '</tr>';												
												if (isset($_REQUEST['edit'.$x])) {
													header('Location:'.$link.'&sen='.$Sentences[$x][0]);
												}
												if (isset($_REQUEST['delete'.$x])) {
													DeleteSentence($_GET['name'],$Sentences[$x][0]);
													header('Location:'.$link);
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
	
	<?php			}		?>
                    <!-- /.panel -->
                </div>				
			</div>
		</div>
            
                
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
