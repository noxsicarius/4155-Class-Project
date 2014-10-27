
<?php
require 'connect.inc.php';

$wordstoignore=array("is","was","are","they","can");
$filetostring = 'what is my name?.   what is your name....';
//$name='text1.txt';
$queryx="SELECT * FROM `uploadinfo` WHERE `FileName` = '$name'";
if($query_runx = mysql_query($queryx)){
		$filetostring=mysql_result($query_runx,0,"content");
		//echo $filetostring;
			
		}
$sentencesarray = preg_split('/[.?]/', $filetostring );
$numberofsentences=sizeof($sentencesarray);
$fp = fopen("tem_files/myText.txt","wb");
$keywords_file= fopen("tem_files/keywords.txt","wb");
$keywordstowrite=null;




for($x=0;$x<$numberofsentences;$x++){
$sentencesarray[$x]=trim($sentencesarray[$x]);
//echo $x.' '.$sentencesarray[$x].'  '.Strlen($sentencesarray[$x]).'  <br>';
	if(Strlen($sentencesarray[$x])>0){
		fwrite($fp,($sentencesarray[$x].PHP_EOL));
		$string_to_array = str_word_count($sentencesarray[$x], 1);
		for($j=0;$j<sizeof($string_to_array);$j++){
			for ($k=0;$k<sizeof($wordstoignore);$k++){
				$count=0;
				if($string_to_array[$j]==$wordstoignore[$k]){
					$count++;
					break;
					//echo "$string_to_array[$j]".' '."$wordstoignore[$k]".' Count:'."$count".' <br>';
									
				}
				
			}
			if($count==0){					
					if(strlen($keywordstowrite)>0){
						$keywordstowrite=$keywordstowrite.','.$string_to_array[$j];
					}else{
						$keywordstowrite=$string_to_array[$j];
					}
				}
			
		}
		fwrite($keywords_file,($keywordstowrite.PHP_EOL));
		$keywordstowrite=null;
		
	}
}

fclose($fp);
fclose($keywords_file);




?>