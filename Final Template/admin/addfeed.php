<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';
	
	
	if(UserRole()!='Admin'){
		Die();
	}
	$StringMesasge='';$Success=false;
	$CurrentUserFullName=getfield('name',$_SESSION['user_id']);
	if(isset($_POST['btnsubmit'])){												
		$title = $_POST['title'];
		$content = $_POST['content'];
		if(!empty($title) && !empty($content)){
			$Success=SaveFeeds($title,$content);			
		}else{
			$StringMesasge='<div class="alert alert-danger" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Error:</span>
									ALL fields are required!
								</div>';
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

    <title>Feeds</title>

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
                    <h1 class="page-header">Main Page Feeds</h1>
                </div>
                <!-- /.col-lg-12 -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Add Feed
							</div>
							<div class="panel-body">
								<?php
									if(isset($_POST['btnsubmit']) && $Success){
								?>
										<div class="row">
											<div class="col-lg-6">
												<div class="alert alert-success" role="alert">
													<span class="sr-only">Welcome!</span>
													<h2>Feed Added</h2>
												</div>
											</div>
										</div>
								
								<?php
									}else{
								?>
										<div class="row">
											<div class="col-lg-6">
												<form role="form" method="POST" >                                        
													<div class="input-group">
														<span class="input-group-addon" style='min-width:100px;'>Title</span>
														<input type="text" style='min-width:250;' class="form-control" placeholder="Enter a Title" name="title"><br>
													</div><br>
													 <div class="input-group">
															<span class="input-group-addon" style='min-width:100px;'>Author</span>
															<input class="form-control"style='min-width:250;' id="disabledInput" type="text" placeholder="<?php echo $CurrentUserFullName; ?>" disabled>
													</div><br>										
													<div class="form-group">
														<label style='min-width:100px;'>Feed Content</label>
														<textarea class="form-control" rows="3" name="content" ></textarea>
													</div> 
													<button type="submit" class="btn btn-default" name="btnsubmit">Submit Button</button>
													<button type="reset" class="btn btn-default">Reset Button</button>
												</form>
												<br>
												
											</div>
											
											<!-- /.col-lg-6 (nested) -->
										   
										</div>
											<!-- /.col-lg-6 (nested) -->
										<div class="row">
											<div class="col-lg-4">
												<?php 
													echo  $StringMesasge;
												?>
											</div>
										</div>
							<?php
									}
							?>
							</div>
								<!-- /.row (nested) -->
						</div>
							<!-- /.panel-body -->
					</div>
                    <!-- /.panel -->
               
                <!-- /.col-lg-12 -->
				</div>
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
