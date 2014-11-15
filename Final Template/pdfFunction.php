<?php
	require('WriteHTML.php');
	 require 'comparison.php';
	require 'connect.inc.php';
	require 'core.inc.php';
	

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
		$title=FileInfo($FileID,'NotesTitle');
		$content=FileInfo($FileID,'content');
		PDF_TitleContent ($title,$content);
	}
	Function ArrayTOSentence($School,$Class){		
		$Array=ST_GetMasterSentences($School,$Class);		
		$content=implode($Array,". ");
		$title=$Class.' Study Guide ';
		PDF_TitleContent ($title,$content);
	}
	$PreviousPage=Backpage();
	if(isset($_GET['id'])){
		$FileID=$_GET['id'];
		PDF_TitleContent_ByFileID ($FileID);		
	}else if(isset($_GET['class'])){
		$Class=$_GET['id'];
	}else{
		header('Location:'.$PreviousPage);
	}
	
	

?>










