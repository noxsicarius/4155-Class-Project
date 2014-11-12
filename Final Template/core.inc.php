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

	function searchDB($searchText,$field){
		$query = "SELECT * FROM uploadinfo WHERE ".$field." LIKE '%$searchText%'";
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
/*		echo "<div style=\"padding:3px;background-color:#FFFFFF;border:1px solid #d8d8d8;\">
				<input 
					type=\"button\" class=\"button2\" style=\"min-width:20px;\" 
					value=\"+\" onclick=\"var container=this.parentNode.getElementsByTagName('div')[0];
					if(container.style.display!='')  {
						container.style.display='';this.value='-';
					} else {
						container.style.display='none';this.value='+';}\" 
				/>
				
				<span 
					style=\"text-transform:uppercase;font-weight:bold;font-size:0.9em;\" >{$title}
						<p align=right style=\"margin-top: -25px;\">
						<input type=\"button\" class=\"button3\" style=\"min-width:10px;font-size:0.7em;\" value=\"&#x25B2\" onclick=\"\"  />{$rateUp}
						<input type=\"button\" class=\"button3\" style=\"min-width:10px;font-size:0.7em;\" value=\"&#x25BC\" onclick=\"\" />{$rateDown} 
						</p>
				</span>
				
				<div style=\"display:none;word-wrap:break-word;overflow:hidden;\">{$content}</div>
			</div>";*/

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
		$name='table_'.$id;
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
	$result=mysql_query("SELECT * FROM `keywords` WHERE `FileID` = $FileID");
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
