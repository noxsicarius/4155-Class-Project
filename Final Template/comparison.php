<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	//print_r(ST_GetFileKeywords(4));
	//echo ST_NoOfSentences(4);
	//print_r(ST_GetSenKeywords(4,1));
	//$First=ST_GetSenKeywords(5,1);
	//$Second=ST_GetSenKeywords(4,1);
	//echo ST_CompareTwoSentences($First,$Second);
	//ST_CreateClassTable('uncg','1604'); ST_CreateClassTable('uncp','1904');
	
	//Get the number of sentences in a file.
	Function  ST_NoOfSentences($FileID){
		$Number=sizeof(ST_GetFileKeywords($FileID));
		return $Number;
	}
	
	//Pass the FileID and Returns the Array of File Keywords as a String per sentence 
	Function  ST_GetFileKeywords($FileID){
		$tablename='table_'.$FileID;
		$query="SELECT * FROM `$tablename`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,'Keywords');
				$File_Field[$i]= $content;
			}
			return $File_Field;
		}
		
	}
	
	function ST_GetFileSentences($FileID){
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
	// Return an Array of keywords of a specific sentence
	//Pass FIleID and Sentence Number
	Function ST_GetSenKeywords($FileID,$SentenceNo){
		$ALlFileKeywords=ST_GetFileKeywords($FileID);
		$NoSen=ST_NoOfSentences($FileID);
		if($SentenceNo>!$NoSen){
			$SentenceNo--;
			$SentenceKeywords=preg_split('/,/',$ALlFileKeywords[$SentenceNo]);
		}
		return $SentenceKeywords;
	}
	// Pass two array and it will return the percentage of how many elements matched 
	//Pass arrays of sentence keywords
	Function ST_CompareTwoSentences($First,$Second){
		$count=0;
		for($x=0;$x<sizeof($First);$x++){
			for($y=0;$y<sizeof($Second);$y++){
				if($First[$x]==$Second[$y]){
					$count++;
					break;
				}
				
			}	
		}
		if($count>0){
			$average=(sizeof($First)+sizeof($Second))/2;
			$percentage=($count/$average)*100;
			$percentage=round($percentage,2);
			return $percentage;
		}else{
			return 0;
		}		
	}
	
	//ST_CompareFileTOMaster(4);
	//Master is the Class StudyGuide
	ST_CompareFileTOMaster(58);
	
	
	
	Function ST_CompareFileTOMaster($FileID){
		$School=FileInfo($FileID,'School');	$School=strtolower($School);		
		$Class=FileInfo($FileID,'ClassName'); $Class=strtolower($Class);
		$Search=ST_SearchClass($School,$Class);
		$Sentences=ST_GetFileSentences($FileID);
		$Keywords=ST_GetFileKeywords($FileID);
		//Check if the 
		if($Search==0){
			echo 'Inside If ';
			ST_CreateClassTable($School,$Class);
			
			for($x=0;$x<sizeof($Sentences);$x++){
				ST_WriteToClass($School,$Class,$Sentences[$x],$Keywords[$x]);				
			}
			
		}else{			
			$Master=ST_GetClassKeyWords($School,$Class);
			$size=sizeof($Master);
			$sizeFile=sizeof(ST_GetFileKeywords($FileID))+1;
			
			//echo $size.' '.	$sizeFile;
			for($x=0;$x<$size;$x++){ //x: size of master sentences				
				for($y=1;$y<$sizeFile;$y++){ //y: size of File sentences
					$temp_Master=ST_GetMasterSenKeywords($School,$Class,$x);
					$temp_File=ST_GetSenKeywords($FileID,$y);
					echo 'Comparing Master sentence '.$x.' to File Sentence '.$y.'<br>';
					$percentage=ST_CompareTwoSentences($temp_File,$temp_Master);
					echo $percentage.'<br> ';
				}
			}
		}	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	//-----------------------------------------------Working with Tables------------------------------------------------------------------------------
	Function ST_CreateClassTable($university,$class){
		$String='class_'.$university.'_'.$class;
		$query="CREATE TABLE IF NOT EXISTS `$String` (
				  `SentenceNo` int(11) NOT NULL AUTO_INCREMENT,
				  `Keywords` text NOT NULL,
				  `Sentence` text NOT NULL,
				  `Hits` int(11) NOT NULL,
				  PRIMARY KEY (`SentenceNo`)
				)";
		mysql_query($query);
	}


	//return two dim array of all the classes in the database
	//Array has two columns first school name and second class name
	//Array has multiple rows depends on the number of the classes
	Function ST_AllCLasses(){
		$Array=array();$count=0;
		$AllTables=Table_Names();
		for($x=0;$x<sizeof($AllTables);$x++){
			$result = substr($AllTables[$x], 0, 5);
			if($result == 'class'){
				$temp=preg_split('/_/',$AllTables[$x]);
					for($y=0;$y<2;$y++){
						$Array[$count][$y]=$temp[$y+1];
												
					}
					$count++;
				
			}
		}
		return $Array;		
		
	}
	
	//This Function searches for a class and school 
	//if found returns 1 else returns 0
	
	Function ST_SearchClass($School,$class){
		//echo $School. ' '.$class;
		$Array=ST_AllCLasses();
		for($x=0;$x<sizeof($Array);$x++){
			if($School==$Array[$x][0] && $class==$Array[$x][1]){
				return 1;break;
			}
		}
		return 0; 
	}
	
	//Returns table name for a class and school
	Function ST_ClassTableName($School,$Class){
		$String='class_'.$School.'_'.$Class;
		return $String;	
	}
	
	//Writes to Class table
	Function ST_WriteToClass($School,$class,$sentence,$keywords){
		$TableName=ST_ClassTableName($School,$class);
		$database=DatabaseName();
		$query="INSERT INTO `$database`.`$TableName` VALUES (NULL, '$keywords', '$sentence', '0')";
		mysql_query($query);
	
	}
	
	//Pulls keywords from Class table
	Function ST_GetClassKeyWords($School,$Class){
		$tablename=$String='class_'.$School.'_'.$Class;
		$query="SELECT * FROM `$tablename`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,'Keywords');
				$File_Field[$i]= $content;
			}
			return $File_Field;
		}
	}
	//pulls keywords from each sentence in the class table
	
	Function ST_GetMasterSenKeywords($School,$Class,$SentenceNo){
		$ALlFileKeywords=ST_GetClassKeyWords($School,$Class);
		$NoSen=sizeof($ALlFileKeywords);
		if($SentenceNo<$NoSen){
			$SentenceKeywords=preg_split('/,/',$ALlFileKeywords[$SentenceNo]);
			return $SentenceKeywords;
		}
		
	}
	
	
?>