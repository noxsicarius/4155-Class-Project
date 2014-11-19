<?php
	require 'connect.inc.php';
	require 'core.inc.php';	
	
	
	createSpoilerbutton(81);

	
	
?>
<head>
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
</head>
<?php
function createSpoilerbutton($FileID){
		$currentfile=basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		if($currentfile=='myaccount.php'){
			$link=$currentfile.'?id='.$FileID;
		}
		$title=FileInfo($FileID,'NotesTitle');
		$content=FileInfo($FileID,'content');
		$rateUp=File_VoteUp_UploadInfo_Get($FileID);		
		$rateDown=File_VoteDown_UploadInfo_Get($FileID);
		if (isset($_REQUEST['down'])) {												
			File_VoteDown_UploadInfo_Save($FileID);
			header('Location:myaccount.php?id='.$FileID);
		}
		if (isset($_REQUEST['Up'])) {												
			File_VoteUp_UploadInfo_Save($FileID);
		}



?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href='#<?php echo"$title";?>' aria-expanded="true" aria-controls='<?php echo"$title";?>'>
							<?php echo 	'<form action="'.$link.'" method="Post">'; 
							echo"$title";?>
						</a>
							<?php	
								
								echo 	'<button type="submit" class="btn btn-default btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="down" title="Click to vote down">
											<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> '.$rateDown.'</span>
										</button>'; 
								echo 	'<button type="submit" class="btn btn-default btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="Up" title="Click to vote Up">
											<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> '.$rateUp.'</span>
										</button>'; 
								
								echo 	'</Form>';
							?>
					</h4>
				</div>
				<div id='<?php echo"$title";?>' class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<?php echo"$content";?>
					</div>
				</div>
			</div>
		</div>
<?php } ?>
