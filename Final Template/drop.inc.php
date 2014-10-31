<?php
    include 'connect.inc.php';
		
	
	
	
	
	
	
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
	
	//This function will give an Array of all the tables in the database 
	function Table_Names(){
		$database=DatabaseName();
		$tables = array();
		$list_tables_sql = "SHOW TABLES FROM {$database};";
		$result = mysql_query($list_tables_sql);
		if($result)
		while($table = mysql_fetch_row($result))
		{
			$tables[] = $table[0];
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
	
	
	
	
	
	
	