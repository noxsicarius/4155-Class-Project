<?php
	require 'connect.inc.php';
	require 'core.inc.php';	
		
	
	$id=009;
	echo 	'"myaccount.php?id='."$id".'" "POST">';

	
	
?>
<?php
						
	$FileID=81;
	
	echo 	'<form action="testing_code.php">';
	echo	'<button type="submit" class="btn btn-default" aria-label="Left Align" name="Down" title="Vote Down">
				<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
			</button>'; echo '   ';
	echo ' <button type="submit" class="btn btn-default" aria-label="Left Align" name="Up" title="Vote Up">
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			</button>'; echo '   ';
	echo '</form>';
							
							if (isset($_REQUEST['Down'])) {												
								File_VoteDown_UploadInfo_Save($FileID);								
							}
							if (isset($_REQUEST['Up'])) {												
								File_VoteUp_UploadInfo_Save($FileID);
							}
?>

<head>
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
</head>
