<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<?php

	ob_start();
	session_start();
	$current_file = $_SERVER['SCRIPT_NAME'];
	
	if(isset($_SERVER['HTTP_REFERER'])) {
		$http_referer=$_SERVER['HTTP_REFERER'];
	}else{
	   $http_referer='index.php';
	}
	
	Function Backpage(){
		if(isset($_SERVER['HTTP_REFERER'])) {
		$http_referer=$_SERVER['HTTP_REFERER'];
		}else{
	   $http_referer='index.php';
		}
		return $http_referer;
	}

	function loggedin() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
			return true;
		}else{
			return false;
		}
	}
    // return name of current user
	function getfield($field){
		$query = "SELECT * FROM `users` WHERE Id=". $_SESSION['user_id'];		

		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, $field)){
				return $query_result;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}
	//return any value from upload table by passing FileID and column name
	function FileInfo($FileID,$Column){
		$query="SELECT * FROM `uploadinfo` WHERE `FileID` = $FileID ";
		if($result = mysql_query($query)){			
			$content=mysql_result($result,0,$Column);
			$File_Field= $content;			
			return $File_Field;
		}
	}

	function searchDB($query){
		$searchResults=mysql_query($query);
		
		return $searchResults;
	}
		
	function getbackpage(){
		return $http_referer;
	}

	function getuserid(){
		$id=$_SESSION['user_id'];
		return $id;
	}
	
	function createSpoiler($title, $content, $rateUp, $rateDown){ ?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href='#<?php echo"$title";?>' aria-expanded="true" aria-controls='<?php echo"$title";?>'>
							<?php echo"$title";?>
						</a>
					</h4>
				</div>
				<div id='<?php echo"$title";?>' class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<?php echo"$content";?>
					</div>
				</div>
			</div>
		</div>
<?php
	}
	//Does it exactly the thing as createSpoiler just by using FileID
	function CreateSpoilerByFileID($FileID){
		$title=FileInfo($FileID,'NotesTitle');
		$content=FileInfo($FileID,'content');
		$rateDown=0;
		$rateUp=5;
		createSpoiler($title, $content, $rateUp, $rateDown);
	}
	
	//---------------------------------------------------------------------------------------------------------------------------------
	// this function will delete a File and also drop the table of sentences and keywords
	function Drop_Table($id){
		$database=DatabaseName();
		$name='table_'.$id;$StudentID=getuserid();
		mysql_query("DELETE FROM `$database`.`filerating` WHERE `filerating`.`FileID` = $id AND `filerating`.`StudentID` = $StudentID");
		mysql_query("DROP TABLE IF EXISTS `$database`.`$name`");		
		mysql_query("DELETE FROM `$database`.`keywords` WHERE `keywords`.`FileID` =  $id");
		mysql_query("DELETE FROM `$database`.`uploadinfo` WHERE `uploadinfo`.`FileID` = $id");
	}
	
	
	
//---------------------------------------------------------------------------------------------------------------------------------	
	
	//This function will return an array of files in the databse
	//Pass the column name to get the data, for example: id,FileName, etc.
	function FilesInDataBase($Field){
		$query="SELECT * FROM `uploadinfo`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
			$content=mysql_result($result,$i,$Field);
			$File_Field[$i]= $content;		
			}
			return $File_Field;		
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------
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
//---------------------------------------------------------------------------------------------------------------------------------
	//This function will give an Array of all the tables in the database 
	function Table_Names(){
		$database=DatabaseName();
		$tables = array();
		$list_tables_sql = "SHOW TABLES FROM {$database};";
		$result = mysql_query($list_tables_sql);
		if($result){
			while($table = mysql_fetch_row($result))
			{
				$tables[] = $table[0];
			}
		}
		return $tables;
	}
//--------------------------------------------------------------------------------------------------------------------------------
	// Return FileID of note that has keywords and sentences in the database
	function Tables_FileID(){
		$File_ID = array();
		$count=0;
		$tables=Table_Names();
		$arrlength=count($tables);
		for($x=0;$x<$arrlength;$x++){
			if($tables[$x]!='uploadinfo' && $tables[$x]!='users'){
				$File_ID[$count]= substr("$tables[$x]", -1);
				$count++;
			}
		}
	  return $File_ID;
	}
//---------------------------------------------------------------------------------------------------------------------------------
	// This function will make sure that sentences and keywords table is deleted when the file is deleted from uploadinfo
	// to chech this code run the code on 
	function Sync_tables(){
		$tables_id=Tables_FileID();
		$tables_length=count($tables_id);//x
		$file_id=FilesInDataBase('FileID');
		$file_length=count($file_id);//y
		for($x=0;$x<$tables_length;$x++){
			$count=0;
			for($y=0;$y<$file_length;$y++){
				if($tables_id[$x]==$file_id[$y]){
					$count++;
				}				
			}
			if ($count>0){
				break;
			}else{
				$id=$tables_id[$x];
				Drop_Table($id);
			}
		}
	}
//--------------------------------------------------------------------------------------------------------------------------------	
// Return Number of Rows for a table
	// Pass the name of the table 
	function NumberofRows($table){		
		$query = "SELECT * FROM `$table`";
		if($result  = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			return $num_of_rows;
		}else{
			$String='Table '.$table.' not found!';
			return $String;
		}
	}
//-------------------------------Compare Functions----------------------------------------------------------------------
	// this function will save a keyword string to the keywords table for each file.
	function Save_FileKeywords($FileID,$Array){
		$Keyword=ArrayToString($Array);
		$Keyword=strtolower($Keyword);
		$database=DatabaseName();
		$query="INSERT INTO `$database`.`keywords` (`FileID`, `Keyword`, `ComparedTO`, `MatchedTO`) VALUES ('$FileID', '$Keyword', '', '')";		
		mysql_query($query);
	}
	
	//---Return a String made from an array separated by coma 
	Function ArrayToString($array){
		$array=array_values($array);
		$String=null;
		
		for($x=0;$x<sizeof($array);$x++){			
			if(Strlen($array[$x])>0){
				if(Strlen($String)>0){
					$String=$String.','.$array[$x];
				}else{
				    $String=$array[$x];
				}
			}
		}
	  return $String;
	}
	
	
	//saves an id to keep record of all the files compared to
	function Save_FileComparedTo($FileID,$ComparedToID){
		$database=DatabaseName();
		$query="UPDATE `$database`.`keywords` SET `ComparedTO` = CONCAT(ComparedTO,',','$ComparedToID') WHERE `keywords`.`FileID` = $FileID";
		mysql_query($query);
	}
	
	function Save_FileMatchTo($FileID,$MatchToID,$Percent){
		$String=$MatchToID.'-'.$Percent;
		$database=DatabaseName();
		$query="UPDATE `$database`.`keywords` SET `MatchedTO` = CONCAT(MatchedTO,',','$String') WHERE `keywords`.`FileID` = $FileID";
		mysql_query($query);
	}
	
	// This Function will return an Array of all the keywords of a file
	function GetFileKeywords($FileID){
	$query="SELECT * FROM `keywords` WHERE `FileID` = $FileID";
	$result=mysql_query($query);
	;
	$content=mysql_result($result,0,'Keyword');
	$contentArray=preg_split('/,/', $content );	
	return $contentArray;
	}
	
	// This Function will return an array of the sentences of a File
	function GetFileSentences($FileID){
		$tablename='table_'.$FileID;
		$query="SELECT * FROM `$tablename`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,'Sentence');
				$File_Field[$i]= $content.'.';
			}
			return $File_Field;
		}
	}
	
	// This function compares two files
	// This Function is called by CompareFileToAll
	function CompareTwoFiles($FirstFile,$SecountFile){
		$KeyFirstFile=GetFileKeywords($FirstFile);//Array of keywords of first file --no doubles 
		$KeySecountFile=GetFileKeywords($SecountFile);//Array of second File keywords
		$AverageKeyWord=(sizeof($KeyFirstFile)+sizeof($KeySecountFile))/2;//average number of keywords in both file. 
		$count=0;
		//compare 
		for($x=0;$x<sizeof($KeyFirstFile);$x++){
			for($y=0;$y<sizeof($KeySecountFile);$y++){
				if($KeySecountFile[$y]==$KeyFirstFile[$x]){
					$count++;
				}
			}	
		}
		//count is number of similar keywords 
		
		$OverAllSimilitry=($count/$AverageKeyWord)*100;   
		$First_TO_Secound=($count/sizeof($KeyFirstFile))*100; //percent of FirstFile keywords found in Second File
		$Secound_To_First=($count/sizeof($KeySecountFile))*100;//percent of SecoundFile keywords found in First File
		$Similitry=array($First_TO_Secound,$Secound_To_First,$OverAllSimilitry);
		return $Similitry;
	}
	//Pass FileID and it will compare that file to the rest of files in the database.
	function CompareFileToAll($FileID){
		$CurrentFile=$FileID;
		$AllFiles=FilesInDataBase('FileID');
		for($x=0;$x<sizeof($AllFiles);$x++){
			if($AllFiles[$x]!=$CurrentFile){
				Save_FileComparedTo($CurrentFile,$AllFiles[$x]);
				Save_FileComparedTo($AllFiles[$x],$CurrentFile);
				$Result=CompareTwoFiles($CurrentFile,$AllFiles[$x]);
				Save_FileMatchTo($CurrentFile,$AllFiles[$x],intval($Result[0]));
				Save_FileMatchTo($AllFiles[$x],$CurrentFile,intval($Result[1]));			
				
			}
		}
	}
	
	function GetMatchTo($FileID){
		$Array=array();
		$AllFilesID=FilesInDataBase('FileID');
		$Result=mysql_query("SELECT `MatchedTO` FROM `keywords` WHERE `FileID` = $FileID");
		$content=mysql_result($Result,0);
		$contentArray=preg_split('/,/', $content );
		$count=0;
		for($x=0;$x<sizeof($contentArray);$x++){
			if(strlen($contentArray[$x])>0){
				$temp=preg_split('/-/',$contentArray[$x]);
				if (in_array($temp[0], $AllFilesID)) {
					for($y=0;$y<2;$y++){
						$Array[$count][$y]=$temp[$y];						
					}
					$count++;
				}
				
			}
		}
		return $Array;
	}
//------------------------------------------------------File Rating-----------------------------------------------------------------------------
//This Will Increase the Rate of a file by one
	Function File_VoteUp_UploadInfo_Save($FileID){
		$database=DatabaseName();$StudentID=getuserid();
		$Vote=File_VoteUp_UploadInfo_Get($FileID);
		$Vote++;
		$query="UPDATE `$database`.`uploadinfo` SET `VoteUp` = '$Vote' WHERE `uploadinfo`.`FileID` = $FileID";		
		mysql_query($query);
		$CurrentRate=File_Check_Userrate($FileID); 
		if($CurrentRate=='no'){			
			$query1="INSERT INTO `$database`.`filerating` (`FileID`, `StudentID`, `Rate`) VALUES ('$FileID', '$StudentID', '1')";
			mysql_query($query1);
		}else{
			if($CurrentRate<1 ){
				$CurrentRate++;
				$query1="UPDATE `$database`.`filerating` SET `Rate` = '$CurrentRate' WHERE `filerating`.`FileID` = $FileID AND `filerating`.`StudentID` = $StudentID";
				mysql_query($query1);
			}
		}
		
		
	
	}
	//This Function will Decrease the file rating by one
	Function File_VoteDown_UploadInfo_Save($FileID){
		$database=DatabaseName();$StudentID=getuserid();
		$Vote=File_VoteDown_UploadInfo_Get($FileID);$Vote++;
		$query="UPDATE `$database`.`uploadinfo` SET `VoteDown` = '$Vote' WHERE `uploadinfo`.`FileID` = $FileID";
		mysql_query($query);
		$CurrentRate=File_Check_Userrate($FileID); 
		
		if($CurrentRate=='no'){			
			$query1="INSERT INTO `$database`.`filerating` (`FileID`, `StudentID`, `Rate`) VALUES ('$FileID', '$StudentID', '-1')";
			mysql_query($query1);
		}else{
			if($CurrentRate>-1 ){
				$CurrentRate--;
				$query1="UPDATE `$database`.`filerating` SET `Rate` = '$CurrentRate' WHERE `filerating`.`FileID` = $FileID AND `filerating`.`StudentID` = $StudentID";
				mysql_query($query1);
			}
		}
	}
	//returns the Total vote up for a file
	Function File_VoteUp_UploadInfo_Get($FileID){
		$query="SELECT * FROM `uploadinfo` WHERE `FileID` = $FileID ";		
		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, 'VoteUp')){
				$temp=intval($query_result);
				return $temp;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	
	}
	//returns the Total vote down for a file
	Function File_VoteDown_UploadInfo_Get($FileID){
		$query="SELECT * FROM `uploadinfo` WHERE `FileID` = $FileID ";		
		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, 'VoteDown')){
				$temp=intval($query_result);
				return $temp;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}
	//returns average rating of a file
	Function File_SetAverage($FileID){		
		$VoteUp  =File_VoteUp_UploadInfo_Get($FileID);
		$VoteDown=File_VoteDown_UploadInfo_Get($FileID);		
		$sum=($VoteUp+$VoteDown);
		if($sum==0){
			$sum=1;
		}
		$Average=($VoteUp/$sum)*10;
		$Average=round($Average,2);
		
		echo $VoteUp.' - '.$VoteDown.' = '.$sum.'<br>';
		
		$query="UPDATE `a_database`.`uploadinfo` SET `VoteAverage` = '$Average' WHERE `uploadinfo`.`FileID` = $FileID";
		mysql_query($query);
		Return $Average;
	}
	
	Function File_GetAverage($FileID){
			$query="SELECT * FROM `uploadinfo` WHERE `FileID` = $FileID ";		
		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, 'VoteAverage')){
				$temp=intval($query_result);
				return $temp;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}
	
	//Pass File ID 
	//Returns a 'no' if there is no record of current student for the file id passed
	//Reruns the value of rate if there is data for the user	
	Function File_Check_Userrate($FileID){
		$StudentID=getuserid();
		$query="SELECT * FROM `filerating` WHERE `FileID` = $FileID AND `StudentID` = $StudentID";
		$query_run = mysql_query($query);
		$num_of_rows=mysql_num_rows($query_run);
		if($num_of_rows==0){
			return 'no';
		}else{
			$query_result=mysql_result($query_run, 0, 'Rate');
			return $query_result;
		}
		
	}



//------------------------------------------------------File Rating End--------------------------------------------------------------------------	
	
	
	
//---------------------------------------------------------------------------------------------------------------------------------	
	function DatabaseName(){
		$database='a_database';
		return $database;
	}
//---------------------------------------------------------------------------------------------------------------------------------   

	function currentPage() {
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}

?>

<!-------->
<?php
function createSpoilerbutton($FileID){ 
		$title=FileInfo($FileID,'NotesTitle');
		$content=FileInfo($FileID,'content');
		$rateUp=File_VoteUp_UploadInfo_Get($FileID);		
		$rateDown=File_VoteDown_UploadInfo_Get($FileID);
		
		$currentfile=basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		
		if($currentfile=='myaccount.php'){
			$link=$currentfile.'?id='.$FileID;
			if (isset($_REQUEST['down'])) {												
			File_VoteDown_UploadInfo_Save($FileID);
			header('Location:myaccount.php?id='.$FileID);
			}
			if (isset($_REQUEST['Up'])) {												
				File_VoteUp_UploadInfo_Save($FileID);
				header('Location:myaccount.php?id='.$FileID);
			}
		}else if($currentfile=='search.php'){
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




