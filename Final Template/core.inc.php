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

	function getfield($field){
		$query = "SELECT name FROM `users` WHERE Id=". $_SESSION['user_id'];		

		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, $field)){
				return $query_result;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}

	function searchDB($searchText){
		$query = "SELECT * FROM uploadinfo WHERE NotesTitle LIKE '%$searchText%'";
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
	
	function createSpoiler($title, $content, $rateUp, $rateDown){
		echo "<div style=\"padding:3px;background-color:#FFFFFF;border:1px solid #d8d8d8;\">
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
			</div>";
	}
	
	//---------------------------------------------------------------------------------------------------------------------------------
	// this function will delete a File and also drop the table of sentences and keywords
	function Drop_Table($id){
		$database=DatabaseName();
		$name='table_'.$id;
		mysql_query("DROP TABLE IF EXISTS `$database`.`$name`");
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
//---------------------------------------------------------------------------------------------------------------------------------	
	function DatabaseName(){
		$database='a_database';
		return $database;
	}
//---------------------------------------------------------------------------------------------------------------------------------   
?>
