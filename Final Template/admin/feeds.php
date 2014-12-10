<?php
	require 'connect.inc.php';
	require 'admin.core.inc.php';
	
	if(UserRole()=='Admin' OR UserRole()=='Teacher'){
		
	}else {
		header('Location:unarth.php');	
	}
	
	$Feeds=GetAllFeed();
	$link='feeds.php';
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

        <div id="page-wrapper">
			<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Main Page Feeds</h1>
					</div>
					<!-- /.col-lg-12 -->
			</div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Feeds
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Author</th>											
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php				
										for($x=0;$x<sizeof($Feeds);$x++){
											echo	'<tr class="odd gradeX">';
											echo		'<td >'.($x+1).'</td>';
                                            echo		'<td >'.$Feeds[$x][1].'</td>';
                                            echo		'<td>'.$Feeds[$x][4].'</td>';
                                            echo		'<td>'.$Feeds[$x][2].'</td>';
                                            echo		'<td class="center">'.$Feeds[$x][3].'</td>';
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
												DeleteFeed($Feeds[$x][0]);
												header('Location:'.$link);
											}
											if (isset($_REQUEST['edit'.$x])) {												
												header('Location:feeds.php?view='.$Feeds[$x][0]);
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
	<?php		
            if(isset($_GET['view'])){
				$CurrentFeedID=$_GET['view'];
				$FeedSuccess=false;
				$StringMessage='';
				if(isset($_POST['btnsubmit'])){							
					$Title = $_POST['title'];
					$Content = $_POST['content'];
					$Author = $_POST['author'];				
					if(!empty($Title) && !empty($Content) && !empty($Author)){
						$FeedSuccess=UpdateFeed($CurrentFeedID,$Title,$Content,$Author);
						$StringMessage=	'<div class="row"><div class="col-lg-6"><div class="alert alert-success" role="alert"><span class="sr-only">Welcome!</span><h2>Feed Updated</h2></div></div></div>';
						header('Refresh: 5; URL=feeds.php');					
					}else{
						$StringMessage= '<div class="alert alert-danger" role="alert">
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
											<span class="sr-only">Error:</span>
											ALL fields are required!
											</div>';
					}
				}
				if($FeedSuccess){
					echo $StringMessage;		
				}else{				
						$CurrentFeedID=$_GET['view'];
						$CurrentFeed=GetOneFeed($CurrentFeedID);
						$Title=$CurrentFeed[1];$Content=$CurrentFeed[4];$Author=$CurrentFeed[2];$Date=$CurrentFeed[3];
	?>  
						<div class="row">
							<div class="col-lg-12">
								<form role="form" method="POST" >                                        
									<div class="input-group">
										<span class="input-group-addon" style='min-width:100px;'>Title</span>
										<input type="text" style='max-width:400;' value="<?php echo $Title; ?>" class="form-control" placeholder="Enter a Title" name="title"><br>
									</div><br>
									<div class="input-group">
										<span class="input-group-addon" style='min-width:100px;'>Author</span>
										<input type="text" style='max-width:400;' value="<?php echo $Author; ?>" class="form-control" placeholder="Enter Author's Name" name="author"><br>
									</div><br>						
									<div class="form-group">
										<label style='min-width:100px;'>Feed Content</label>
										<textarea class="form-control" rows="3" name="content" style='max-width:500;'><?php echo $Content; ?></textarea>
									</div> 
									<button type="submit" class="btn btn-default" name="btnsubmit">Submit Button</button>						
								</form>
							</div>
						</div>

	<?php
			echo $StringMessage;		
				
						
					}
			}			
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
