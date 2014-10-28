<?php
	require 'connect.inc.php';
	//header("Location:testing_code.php?fid=$name");
	//echo "The file id is: " . $_GET['fid'];
	

	
function make_table($File_ID){
$sql="CREATE TABLE table_$File_ID ( SentenceNO int NOT NULL AUTO_INCREMENT, Sentence text NOT NULL, Keywords text NOT NULL, PRIMARY KEY (SentenceNO) )";
	if(mysql_query($sql)){	
		echo 'table '.$File_ID.' created'; 
	}
}

function write_table($sentence,$keywords,$FileID){
$sql="INSERT INTO `a_database`.`table_$FileID` VALUES (NULL, '$sentence', '$keywords')";
echo $sql;
}

	
?>