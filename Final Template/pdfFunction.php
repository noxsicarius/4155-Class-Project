<?php
	require('WriteHTML.php');
	require 'comparison.php';
	require 'connect.inc.php';
	
	

	Function PDF_TitleContent ($title,$content) {
		$html='<p align="center">'.$title.'</p><br><hr>';
		$name=$title.date("Y-m-d h:i:sa").'.pdf';		
	
		$pdf=new PDF_HTML();
		$pdf->AddPage();	
		$pdf->SetFont('Arial');
		$pdf->WriteHTML($html);
		$pdf->Write(5,$content);
		$pdf->Output($name,'D');
	}
	Function PDF_TitleContent_ByFileID ($FileID){
		$title=FileInfoo($FileID,'NotesTitle');
		$content=FileInfoo($FileID,'content');
		PDF_TitleContent ($title,$content);
	}
	
	Function ArrayTOSentence($School,$Class){		
		$Array=ST_GetMasterSentences($School,$Class);		
		$content=implode($Array,".");
		$title=$Class.' Study Guide ';
		PDF_TitleContent ($title,$content);
	}	
	
	if(isset($_GET['id'])){
		$FileID=$_GET['id'];
		PDF_TitleContent_ByFileID ($FileID);		
	}else if(isset($_GET['class']) && isset($_GET['school'])){	
		$School=$_GET['school'];$Class=$_GET['class'];				
		ArrayTOSentence($School,$Class);		
	}else{
		$PreviousPage=$_SERVER['HTTP_REFERER'];
		header('Location:'.$PreviousPage);
	}
	
	function FileInfoo($FileID,$Column){
		$query="SELECT * FROM `uploadinfo` WHERE `FileID` = $FileID ";
		if($result = mysql_query($query)){			
			$content=mysql_result($result,0,$Column);
			$File_Field= $content;			
			return $File_Field;
		}
	}	
	

?>










