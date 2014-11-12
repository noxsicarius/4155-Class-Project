<?php
	require 'connect.inc.php';
	require 'core.inc.php';	
	
?>

<head>
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
</head>
	

<form action="uploads.php" method="POST" enctype="multipart/form-data">
	<div class="input-group">
	  <span class="input-group-addon">Title</span>
	  <input type="text" class="form-control" placeholder="Enter Title for your notes" name ="title">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon">Chapter</span>
	  <input type="text" class="form-control" placeholder="Enter Chapter for your notes" name ="chapter">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon">Class Name</span>
	  <input type="text" class="form-control" placeholder="Enter Class Name for your notes" name ="classname">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon">Teacher Name</span>
	  <input type="text" class="form-control" placeholder="Enter Teacher Name for your notes" name ="teacher">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon">School</span>
	  <input type="text" class="form-control" placeholder="Enter School Name for your notes" name ="school" value="UNCC">
	</div>
	<br>
	<div class="input-group">
	  <span class="input-group-addon">Comments</span>
	  <input type="text" class="form-control" placeholder="Enter comments for your notes" name ="comments" value="None">
	</div>
	<br>
	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="submit" >Upload</button>
    </div>
  </div>
</form>