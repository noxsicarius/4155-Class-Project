<?php
	require 'connect.inc.php';
	
	ob_start();
	session_start();
?>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<?php
	function loggedin() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
			return true;
		}else{
			return false;
		}
	}
	
	// return name of current user
	function getfield($field,$StudentID){
		$query = "SELECT * FROM `users` WHERE Id=". $StudentID;		

		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, $field)){
				return $query_result;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}
	
	
	function UserRole(){
		$ID=getuserid();
		$query="SELECT * FROM `users` WHERE `Id` = $ID";
		if($result = mysql_query($query)){			
			$content=mysql_result($result,0,'role');
			$File_Field= $content;			
			return $File_Field;
		}
	}
	
	function getuserid(){
		$id=$_SESSION['user_id'];
		return $id;
	}
	// Returns an array of FileID who are flagged as abuse 
	Function GetTotalFileAbuse(){
		$query="SELECT * FROM `filerating` WHERE `Rate` = -10";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,'FileID');
				$File_Field[$i]= $content;
			}
			return $File_Field;
		}
	}
	// Returns the total number of files been marked as abuse 
	Function GetNOFileAbuse(){
		$query="SELECT * FROM `filerating` WHERE `Rate` = -10";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			return $num_of_rows;
		}
	}
	
	// Returns the total number of files with rating less than 0
	Function GetNoFileLowRating(){
		$query="SELECT * FROM `uploadinfo` WHERE `VoteDown` > 0 ORDER BY `FileName`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			return $num_of_rows;
		}
	}
	
	//Returns an array of students records 
	//Username, Email, School, FullName
	
	Function GetAllUsername(){
		//$File_Field=array();
		$query="SELECT * FROM `users` WHERE `role` = 'Student'";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$File_Field[$i][0]=mysql_result($result,$i,'username');
				$File_Field[$i][1]=mysql_result($result,$i,'email');
				$File_Field[$i][2]=mysql_result($result,$i,'school');
				$File_Field[$i][3]=mysql_result($result,$i,'name');
				$File_Field[$i][4]=mysql_result($result,$i,'id');					
				
			}
			return $File_Field;
		}	
	}
	
	//Returns an array of Admin records 
	//Username, Email, School, FullName
	
	Function GetAllAdminusers(){
		//$File_Field=array();
		$query="SELECT * FROM `users` WHERE `role` = 'Admin'";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$File_Field[$i][0]=mysql_result($result,$i,'username');
				$File_Field[$i][1]=mysql_result($result,$i,'email');
				$File_Field[$i][2]=mysql_result($result,$i,'school');
				$File_Field[$i][3]=mysql_result($result,$i,'name');
				$File_Field[$i][4]=mysql_result($result,$i,'id');					
				
			}
			return $File_Field;
		}	
	}
	
	
	
	
	
	
	
	//DeleteUser();
	//This function will delete a user 
	Function DeleteUser($StudentID){
		$database=DatabaseName();
		
		//Dropping the table
		$Files=FilesInDataBase_ID('FileID',$StudentID);
		for($x=0;$x<sizeof($Files);$x++){
			$name[$x]='table_'.$Files[$x];
			//echo $name[$x];
			mysql_query("DROP TABLE IF EXISTS `$database`.`$name[$x]`");
		}
	
	
		
		$query="DELETE FROM `$database`.`filerating` WHERE `filerating`.`FileID` = (SELECT FileID FROM `uploadinfo` WHERE `StudentID` = $StudentID ORDER BY `FileName`)";
		mysql_query($query);			
		
		$query0="DELETE FROM `$database`.`filerating` WHERE `filerating`.`StudentID` =  $StudentID";
		mysql_query($query0);
		
		$query00="DELETE FROM `$database`.`keywords` WHERE `keywords`.`FileID` IN (SELECT FileID FROM `uploadinfo` WHERE `StudentID` = $StudentID ORDER BY `FileName`)";
		mysql_query($query00);
		
		$query1="DELETE FROM `$database`.`sentencerating` WHERE `sentencerating`.`StudentID` =  $StudentID";
		mysql_query($query1);
		
		$query2="DELETE FROM `$database`.`uploadinfo` WHERE `uploadinfo`.`StudentID` = $StudentID";
		mysql_query($query2);
		
		$query3="DELETE FROM `$database`.`users` WHERE `users`.`Id` = $StudentID";
		mysql_query($query3);	
		
		
		
		
		//echo $query.'<br>'.$query0.'<br>'.$query00.'<br>'.$query1.'<br>'.$query2.'<br>';
		
		
		
	
	}
	
	//This function will create one Student user 
	Function AddOneStudentUser($username,$email,$fullname,$school){
		$successful=false;
		$password='password';
		$query = "INSERT INTO users VALUES (id,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($fullname)."','".mysql_real_escape_string($school)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string('0')."','".mysql_real_escape_string('Student')."')";
		if ($query_run = mysql_query($query)){
			$successful = true;
		}	
		return $successful;
	}
	
	//This function will create one Admin user 
	Function AddOneAdminUser($username,$email,$fullname,$school){
		$successful=false;
		$password='password';
		$query = "INSERT INTO users VALUES (id,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($fullname)."','".mysql_real_escape_string($school)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string('0')."','".mysql_real_escape_string('Admin')."')";
		if ($query_run = mysql_query($query)){
			$successful = true;
		}	
		return $successful;
	}
	
	//This function will create one Teacher user 
	Function AddOneTeacherUser($username,$email,$fullname,$school){
		$successful=false;
		$password='password';
		$query = "INSERT INTO users VALUES (id,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($fullname)."','".mysql_real_escape_string($school)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string('0')."','".mysql_real_escape_string('Teacher')."')";
		if ($query_run = mysql_query($query)){
			$successful = true;
		}	
		return $successful;
	}
	
	
	//This function will return an array of files in the database for the current user
	//Pass the column name to get the data, for example: id,FileName, etc.
	function FilesInDataBase_ID($Field,$ID){
		$query="SELECT * FROM `uploadinfo` WHERE `StudentID` = $ID ORDER BY `FileID` DESC";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,$Field);
				$File_Field[$i]= $content;
			}
			return $File_Field;
		}
	}
	
	
		
	//This function will save feeds to database	
	Function SaveFeeds($Title,$Content){
		$Success=false;
		$StudentID=$_SESSION['user_id'];
		$Author=getfield('name',$StudentID);
		$database=DatabaseName();
		$query="INSERT INTO `$database`.`feeds` VALUES (NULL, CURRENT_TIMESTAMP, '$Title', '$Author', '$Content', '1')";
		if(mysql_query($query)){
			$Success=true;
		}		
		return $Success;
	}
		
	//This function will update a feed given the variables 
	Function UpdateFeed($FeedID,$Title,$Content,$Author){
		$Success=false;
		$database=DatabaseName();
		$query="UPDATE `$database`.`feeds` SET `FeedAuthor` = '$Author', `FeedTitle` = '$Title', `FeedContant` = '$Content' WHERE `feeds`.`FeedID` = $FeedID";
		if(mysql_query($query)){
			$Success=true;
		}
		return $Success;
	}
	
	//This function will hide the feed from the main index page
	//Pass the feed ID	
	Function HideFeed($FeedID){
		$database=DatabaseName();
		$query="UPDATE `$database`.`feeds` SET `FeedShow` = '0' WHERE `feeds`.`FeedID` = $FeedID";
		mysql_query($query);	
	}
	
	//This function will show the feed on the main index page if hidden
	Function ShowFeeD($FeedID){
		$database=DatabaseName();
		$query="UPDATE `$database`.`feeds` SET `FeedShow` = '1' WHERE `feeds`.`FeedID` = $FeedID";
		mysql_query($query);	
	}
	
	//This function will delete a feed 
	Function DeleteFeed($FeedID){
		$database=DatabaseName();
		$query="DELETE FROM `$database`.`feeds` WHERE `feeds`.`FeedID` = $FeedID";
		mysql_query($query);	
	}
	
	//This function will return an array of three columns(FeedID, Title, Author, Date, content)	
	//This function only returns the visible feeds 
	Function GetVisibleFeed(){
		$database=DatabaseName();
		$query="SELECT * FROM `feeds` WHERE `FeedShow` = 1 ORDER BY `FeedID` DESC";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$Feeds[$i][0]=mysql_result($result,$i,'FeedID');
				$Feeds[$i][1]=mysql_result($result,$i,'FeedTitle');
				$Feeds[$i][2]=mysql_result($result,$i,'FeedAuthor');
				$Feeds[$i][3]=mysql_result($result,$i,'FeedDate');
				$Feeds[$i][4]=mysql_result($result,$i,'FeedContant');					
				
			}
			return $Feeds;
		}	
	}
	
	//This function will return an array of three columns(FeedID, Title, Author, Date, content)	
	//This function returns all the feeds
	Function GetAllFeed(){
		$database=DatabaseName();
		$query="SELECT * FROM `feeds` ORDER BY `FeedID` DESC";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$Feeds[$i][0]=mysql_result($result,$i,'FeedID');
				$Feeds[$i][1]=mysql_result($result,$i,'FeedTitle');
				$Feeds[$i][2]=mysql_result($result,$i,'FeedAuthor');
				$Feeds[$i][3]=mysql_result($result,$i,'FeedDate');
				$Feeds[$i][4]=mysql_result($result,$i,'FeedContant');					
				
			}
			return $Feeds;
		}	
	}
	
	//This function will return an array of three columns(FeedID, Title, Author, Date, content)	
	//This function returns only one feed
	Function GetOneFeed($FeedID){
		$database=DatabaseName();
		$query="SELECT * FROM `feeds` WHERE `FeedID` = $FeedID ORDER BY `FeedID` DESC";
		if($result = mysql_query($query)){
			$Feeds[0]=mysql_result($result,0,'FeedID');
			$Feeds[1]=mysql_result($result,0,'FeedTitle');
			$Feeds[2]=mysql_result($result,0,'FeedAuthor');
			$Feeds[3]=mysql_result($result,0,'FeedDate');
			$Feeds[4]=mysql_result($result,0,'FeedContant');
		}
			return $Feeds;
			
	}
	
	//This function will return an array of files in the databse
	//Pass the column name to get the data, for example: id,FileName, etc.
	function FilesInDataBase(){
		$query="SELECT * FROM `uploadinfo`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
			$File_Field[$i][0]=mysql_result($result,$i,'FileID');
			$File_Field[$i][1]=mysql_result($result,$i,'NotesTitle');
			$File_Field[$i][2]=mysql_result($result,$i,'StudentID');
			$File_Field[$i][3]=mysql_result($result,$i,'ClassName');
			$File_Field[$i][4]=mysql_result($result,$i,'School');					
			}
			return $File_Field;		
		}
	}


	Function DatabaseName(){
		$database='a_database';
		return $database;
	}
	

?>
<!---My account spoiler----->
<?php
function createSpoilerbuttonmyaccount($FileID){ 
		$title=FileInfo($FileID,'NotesTitle');
		$content=FileInfo($FileID,'content');
		$rateUp=File_VoteUp_UploadInfo_Get($FileID);		
		$rateDown=File_VoteDown_UploadInfo_Get($FileID);		
		$currentfile=basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		
		if($currentfile=='userfiles.php'){
			$link=$currentfile.'?id='.$FileID;
			if (isset($_REQUEST['down'])) {												
			File_VoteDown_UploadInfo_Save($FileID);
			header('Location:userfiles.php?id='.$FileID);
			}
			if (isset($_REQUEST['Up'])) {												
				File_VoteUp_UploadInfo_Save($FileID);
				header('Location:userfiles.php?id='.$FileID);
			}
		}else if($currentfile=='similar.php'){
			$link=basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
			if (isset($_REQUEST['down'])) {												
			File_VoteDown_UploadInfo_Save($FileID);
			header('Location:'.$link);
			}
			if (isset($_REQUEST['Up'])) {												
				File_VoteUp_UploadInfo_Save($FileID);
				header('Location:'.$link);
			}
		}
		$UserRate=File_Check_Userrate($FileID);
		if($UserRate=='no'){
			$voteupcolor='default';
			$votedowncolor='default';
		}else if($UserRate=='-1'){
			$voteupcolor='default';
			$votedowncolor='danger';		
		}else if($UserRate=='1'){
			$voteupcolor='success';
			$votedowncolor='default';		
		}else if ($UserRate=='0'){
			$voteupcolor='default';
			$votedowncolor='default';
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
								if($rateDown==0){
									$rateDown=0;
								}
								if($rateUp==0){
									$rateUp=0;
								}
								
								echo 	'<button type="submit" class="btn btn-'.$votedowncolor.' btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="down" title="Click to vote down">
											<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> '.$rateDown.'</span>
										</button>'; 
								echo 	'<button type="submit" class="btn btn-'.$voteupcolor.' btn-sm spoiler-trigger pull-right" aria-label="Left Align" name="Up" title="Click to vote Up">
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