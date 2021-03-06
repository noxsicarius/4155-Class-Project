<?php
	require 'connect.inc.php';
	
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
	
	//Master is the Class StudyGuide
	
//------------------------------------------------------------Study Guide Comparing---------------------------------------------------------------------
	//Pass down a FileID just upload to check if the class already exists
	//if class exists it will compare current file sentences with the rest of sentences stored in class table
	//if class does not exists then it will create a new table for that class and store all of the sentence in that table
	//variable named like 'Master' refers to the main table of a class 
	//variable named like 'File' refers to everything related to the current file just uploaded 
	
	Function ST_CompareFileTOMaster($FileID){
		$School=FileInfo($FileID,'School');	$School=strtolower($School);		
		$Class=FileInfo($FileID,'ClassName'); $Class=strtolower($Class);
		$Search=ST_SearchClass($School,$Class);
		$Sentences=ST_GetFileSentences($FileID);
		$Keywords=ST_GetFileKeywords($FileID);
		$MasterSentences=ST_GetMasterSentences($School,$Class);

		//Check if the 
		if($Search==0){
			ST_CreateClassTable($School,$Class);
			
			for($x=0;$x<sizeof($Sentences);$x++){
				ST_WriteToClass($School,$Class,$Sentences[$x],$Keywords[$x]);				
			}
			
		}else{			
			$Master=ST_GetClassKeyWords($School,$Class);
			$size=sizeof($Master);
			$sizeFile=sizeof(ST_GetFileKeywords($FileID))+1;
			
			for($x=1;$x<$sizeFile;$x++){ //x: size of File sentences	
				$count=0;
				for($y=0;$y<$size;$y++){ //y: size of Master sentences
					
					$temp_Master=ST_GetMasterSenKeywords($School,$Class,$y);
					$temp_File=ST_GetSenKeywords($FileID,$x);
					$percentage=ST_CompareTwoSentences($temp_File,$temp_Master);

					if($percentage>60){
						$count++;
						ST_IncreaseHITbyTEN($School,$Class,$y+1); // increase hits
					}

					if($y==$size-1 && $count<1){
						ST_WriteToClass($School,$Class,$Sentences[$x-1],$Keywords[$x-1]);// Save to Databse 
					}
				}
			}
		}	
	}
	
//-----------------------------------------------------------------------HITS (Evan individually written)----------------------------------------------------	
	
    // this function takes a class and school name and returns the sentencenumber that has the highest hits
    Function ST_TOPHighestHits($School,$Class){
		$School=strtolower($School);$Class=strtolower($Class);
        $tablename='class_' .$School.'_'.$Class;
        //$query="SELECT * FROM `$tablename`";
        $query="SELECT * FROM `$tablename` ORDER BY `$tablename`.`Hits` DESC";
        if($result = mysql_query($query)){
            $num_of_rows=mysql_num_rows($result);
            $content=mysql_result($result,0,'SentenceNo');
           // echo $content;
            return $content;
        }
    }
    
	// this function takes a class and school name and returns the sentence number that has the highest hits in an array with all of the sentences 
	// from highest to the lowes 
	   Function ST_ALLHighestHits($School,$Class){
        $tablename=ST_ClassTableName($School,$Class);
        $query="SELECT * FROM `$tablename` ORDER BY `$tablename`.`Hits` DESC";

        if($result = mysql_query($query)){
            $num_of_rows=mysql_num_rows($result);
            for($i=0;$i<$num_of_rows;$i++){
            	$content=mysql_result($result,$i,'SentenceNo');
          		$File_Field[$i]= $content;
       		}
            return $File_Field;
        }
    }
	
    // pass this function a school, class name and sentence number and it will return a sentences rank
	Function ST_GetSentenceRank($School,$Class,$SentenceNo){
		$School=strtolower($School);$Class=strtolower($Class);
      	$TableName=ST_ClassTableName($School,$Class);
	  	$rowNumber=$SentenceNo-1;
        $query="SELECT * FROM `$TableName` ";

        if($result = mysql_query($query)){
          	$content=mysql_result($result,$rowNumber,'Hits');
    	}
        return $content;
    }

	Function ST_IncreaseHITbyTEN($School,$Class,$SentenceNo){
		$School=strtolower($School);$Class=strtolower($Class);
		$TableName=ST_ClassTableName($School,$Class);
        $query="SELECT * FROM `$TableName` ";

        if($result = mysql_query($query)){
				$rowNumber=$SentenceNo-1;
            	$content=mysql_result($result,$rowNumber,'Hits');
       			$content = $content+10;
       			$database=DatabaseName();
				$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
				mysql_query($query);
       		}
	}

// pass this function a school, calls and sentence number and it will increment the hit value by one
    Function ST_IncreaseHITbyONE($School,$Class,$SentenceNo){
    	$TableName=ST_ClassTableName($School,$Class);
        $query="SELECT * FROM `$TableName` ";

        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
           	$content=mysql_result($result,$rowNumber,'Hits');
       		$content ++;
       		$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
       	}
    }

	//pass this function a school, calls and sentence number and it will Decrease the hit value by one
    //NOTE IT IS POSSIBLE TO GET A NEGATIVE NUMBER 
	Function ST_DecreaseHITbyONE($School,$Class,$SentenceNo){
		$School=strtolower($School);$Class=strtolower($Class);
    	$TableName=ST_ClassTableName($School,$Class);
        $query="SELECT * FROM `$TableName` ";

        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
           	$content=mysql_result($result,$rowNumber,'Hits');
  			$content --;
   			$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
   		}
    }

    // pass this function a school, class and a value and it will dispalay all sentences from this class that have a hit value  = or > than $val	
	Function ST_PrintMaster($School,$Class,$val){
		$School=strtolower($School);$Class=strtolower($Class);
        $tablename=ST_ClassTableName($School,$Class);
        $query="SELECT * FROM `$tablename` ORDER BY `$tablename`.`Hits` DESC";

        if($result = mysql_query($query)){
            $num_of_rows=mysql_num_rows($result);

            for($i=0;$i<$num_of_rows;$i++){
            	$content=mysql_result($result,$i,'Sentence');
          		$File_Field[$i][0]= $content;
          		$content=mysql_result($result,$i,'Hits');
          		$File_Field[$i][1] = $content;
       		}

       		$count= 0;

            for($i=0;$i<$num_of_rows;$i++){
				if ($File_Field[$i][1] >=$val){
					$Array[$count] = $File_Field[$i][0];
					$count ++;
				}
            }
            return $Array;
        }
    }

//accepts the table name and value and it will dispalay all sentences from this class that have a hit value  = or > than $val
   	Function ST_PrintMaster_tablename($tablename,$val){
		$tablename=$tablename;
		$query="SELECT * FROM `$tablename` ORDER BY `$tablename`.`Hits` DESC";

        if($result = mysql_query($query)){
            $num_of_rows=mysql_num_rows($result);
            for($i=0;$i<$num_of_rows;$i++){
            	$content=mysql_result($result,$i,'Sentence');
          		$File_Field[$i][0]= $content;
          		$content=mysql_result($result,$i,'Hits');
          		$File_Field[$i][1] = $content;
          		$content=mysql_result($result,$i,'SentenceNo');
          		$File_Field[$i][2] = $content;
       		}

       		$count= 0;

            for($i=0;$i<$num_of_rows;$i++){
				if ($File_Field[$i][1] >=$val){
					$Array[$count][0] = $File_Field[$i][0];
					$Array[$count][1] = $File_Field[$i][2];
					$count ++;
				}
            }
            return $Array;
        }
    }

     // Takes a table name and a sentencenumber and increases the hit value by 1
	Function ST_IncreaseHITbyONE_tablename($TableName,$SentenceNo){
        $query="SELECT * FROM `$TableName` ";
        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
          	$content=mysql_result($result,$rowNumber,'Hits');
   			$content ++;
   			$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
   		}
    }

    // Takes a table name and a sentencenumber and increases the hit value by 2
	Function ST_IncreaseHITbyTWO_tablename($TableName,$SentenceNo){
        $query="SELECT * FROM `$TableName` ";
        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
            $content=mysql_result($result,$rowNumber,'Hits');
       		$content =$content+2;
       		$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
       	}
    }

	// Takes a table name and a sentencenumber and decreases the hit value by -1
   	Function ST_DecreaseHITbyONE_tablename($TableName,$SentenceNo){
        $query="SELECT * FROM `$TableName` ";
        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
            $content=mysql_result($result,$rowNumber,'Hits');
       		$content --;
       		$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
   		}
    }
	
	 // Takes a table name and a sentencenumber and decreases the hit value by -2
   	Function ST_DecreaseHITbyTWO_tablename($TableName,$SentenceNo){
        $query="SELECT * FROM `$TableName` ";
        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
           	$content=mysql_result($result,$rowNumber,'Hits');
   			$content=$content-2;
   			$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
       	}
    }

    // Takes a table name and a sentencenumber and decreases the hit value by -5
    Function ST_ReportAbuse_tablename($TableName,$SentenceNo){
        $query="SELECT * FROM `$TableName` ";
        if($result = mysql_query($query)){
			$rowNumber=$SentenceNo-1;
           	$content=mysql_result($result,$rowNumber,'Hits');
   			$content =$content - 5;
   			$database=DatabaseName();
			$query="UPDATE `$database`.`$TableName` SET `Hits` = '$content' WHERE `$TableName`.`SentenceNo` = '$SentenceNo'";
			mysql_query($query);
       	}
    }

//accepts a user ID and returns all classes and school's that the user is enrolled in 
    Function ST_Student_Classes($ID){
		$query="SELECT DISTINCT `School`,`ClassName` FROM `uploadinfo` WHERE `StudentID` = $ID";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i, 'School');
				$File_Field[$i][0]= $content;
				$content=mysql_result($result,$i, 'ClassName');
				$File_Field[$i][1]= $content;
			}
			return $File_Field;
		}
	}
	
	Function ST_PrintMaster_tablename_calcval($tablename){
        $tablename=strtolower($tablename);
        $query="SELECT * FROM `$tablename` ORDER BY `$tablename`.`Hits` DESC";
        if($result = mysql_query($query)){
            $num_of_rows=mysql_num_rows($result);
            for($i=0;$i<$num_of_rows;$i++){
            	$content=mysql_result($result,$i,'Sentence');
          		$File_Field[$i][0]= $content;
          		$content=mysql_result($result,$i,'Hits');
          		$File_Field[$i][1] = $content;
          		$content=mysql_result($result,$i,'SentenceNo');
          		$File_Field[$i][2] = $content;
       		}
       		$max = $File_Field[0][1];
       		$val = $max-40;
       		$count= 0;
            for($i=0;$i<$num_of_rows;$i++){
				if ($File_Field[$i][1] >=$val){
					$Array[$count][0] = $File_Field[$i][0];
					$Array[$count][1] = $File_Field[$i][2];
					$count ++;
				}
            }
            return $Array;
        }
    }

	
//---------------------------------------------------Hits Function ends here-----------------------------------------------------------------------------	
	
	
	//-----------------------------------------------Working with Tables------------------------------------------------------------------------------
	Function ST_Add_ClassNames($Class,$School,$TableName){
		$database=DatabaseName();
		$query="INSERT INTO `$database`.`st_class_names`  VALUES (NULL, '$Class', '$School', '$TableName', '-1')";
		mysql_query($query);
	}
	
	Function ST_CreateClassTable($university,$class){
		$university=strtolower($university);$class=strtolower($class);
		$String='class_'.$university.'_'.$class;
		ST_Add_ClassNames($class,$university,$String);		
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
	
	Function ST_SearchClass($School,$Class){
		$School=strtolower($School);$Class=strtolower($Class);
		//echo $School. ' '.$class;
		$Array=ST_AllCLasses();
		for($x=0;$x<sizeof($Array);$x++){
			if($School==$Array[$x][0] && $Class==$Array[$x][1]){
				return 1;break;
			}
		}
		return 0; 
	}
	
	//Returns table name for a class and school
	Function ST_ClassTableName($School,$Class){
		$School=strtolower($School);$Class=strtolower($Class);
		$String='class_'.$School.'_'.$Class;
		return $String;	
	}
	
	//Writes to Class table
	Function ST_WriteToClass($School,$class,$sentence,$keywords){
		$School=strtolower($School);$class=strtolower($class);
		$TableName=ST_ClassTableName($School,$class);
		$database=DatabaseName();
		$query="INSERT INTO `$database`.`$TableName` VALUES (NULL, '$keywords', '$sentence', '0')";
		mysql_query($query);
	}
	
	//Pulls keywords from Class table
	Function ST_GetClassKeyWords($School,$Class){
		$School=strtolower($School);$Class=strtolower($Class);
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

	function ST_GetMasterSentences($School,$Class){
		$School=strtolower($School);$Class=strtolower($Class);
		$tablename=$String='class_'.$School.'_'.$Class;
		$query="SELECT * FROM `$tablename`";
		if($result = mysql_query($query)){
			$num_of_rows=mysql_num_rows($result);
			for($i=0;$i<$num_of_rows;$i++){
				$content=mysql_result($result,$i,'Sentence');
				$File_Field[$i]= $content;
			}
			return $File_Field;
		}
	}
	
	//--------------------Study Guide View Functions------------------------------------------------------------
	
	//This function returns class id by passing the class table name
	
	Function ST_Get_ClassID_ByTableName($TableName){
		$query="SELECT * FROM `st_class_names` WHERE `TableName` = '$TableName'";
		$result=mysql_query($query);
		$content=mysql_result($result,0,'ClassID');
		return $content;	
	}
	
	Function ST_Get_Sentence_Rating($ClassID,$SentenceID){
		$StudentID=getuserid();
		$query="SELECT * FROM `sentencerating` WHERE `ClassID` = $ClassID AND `SentenceID` = $SentenceID AND `StudentID` = $StudentID";
		$query_run = mysql_query($query);
		$num_of_rows=mysql_num_rows($query_run);
		if($num_of_rows==0){
			return 'no';
		}else{
			$query_result=mysql_result($query_run, 0, 'Rate');
			return $query_result;
		}
	}
	
	Function ST_Set_Sentence_Rating_Up($ClassID,$SentenceID){
		$StudentID=getuserid();
		$database=DatabaseName();
		$CurrentRate=ST_Get_Sentence_Rating($ClassID,$SentenceID);
		if($CurrentRate=='no'){		
			$query="INSERT INTO `$database`.`sentencerating` (`ClassID`, `SentenceID`, `StudentID`, `Rate`) VALUES ('$ClassID', '$SentenceID', '$StudentID', '1')";
			mysql_query($query);
		}else if ($CurrentRate==-1){
			$query="UPDATE `$database`.`sentencerating` SET `Rate` = '1' WHERE `sentencerating`.`ClassID` = $ClassID AND `sentencerating`.`SentenceID` = $SentenceID AND `sentencerating`.`StudentID` = $StudentID";
			mysql_query($query);
		}	
	}
	
	Function ST_Set_Sentence_Rating_Down($ClassID,$SentenceID){
		$StudentID=getuserid();
		$database=DatabaseName();
		$CurrentRate=ST_Get_Sentence_Rating($ClassID,$SentenceID);
		if($CurrentRate=='no'){		
			$query="INSERT INTO `$database`.`sentencerating` (`ClassID`, `SentenceID`, `StudentID`, `Rate`) VALUES ('$ClassID', '$SentenceID', '$StudentID', '-1')";
			mysql_query($query);
		}else if ($CurrentRate==1){
			$query="UPDATE `$database`.`sentencerating` SET `Rate` = '-1' WHERE `sentencerating`.`ClassID` = $ClassID AND `sentencerating`.`SentenceID` = $SentenceID AND `sentencerating`.`StudentID` = $StudentID";
			mysql_query($query);
		}	
	}
	
	Function ST_Set_Sentence_Rating_Abuse($ClassID,$SentenceID){
		$StudentID=getuserid();
		$database=DatabaseName();
		$CurrentRate=ST_Get_Sentence_Rating($ClassID,$SentenceID);
		if($CurrentRate=='no'){		
			$query="INSERT INTO `$database`.`sentencerating` (`ClassID`, `SentenceID`, `StudentID`, `Rate`) VALUES ('$ClassID', '$SentenceID', '$StudentID', '-10')";
			mysql_query($query);
		}else if ($CurrentRate==1){
			$query="UPDATE `$database`.`sentencerating` SET `Rate` = '-10' WHERE `sentencerating`.`ClassID` = $ClassID AND `sentencerating`.`SentenceID` = $SentenceID AND `sentencerating`.`StudentID` = $StudentID";
			mysql_query($query);
		}	
	}
	
?>
