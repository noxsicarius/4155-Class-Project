<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	require('WriteHTML.php');
	
	
	

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
	
	
	
	if (isset($_REQUEST['download'])) {
		$content='This is the content of the demo. This is the content of the demo. This is the content of the demo. This is the content of the demo. This is the content of the demo. This is the content of the demo. This is the content of the demo. This is the content of the demo.';
		PDF_TitleContent ('Demo',$content);
	}

?>
<html>

<head>
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="js/bootstrap.js"></script>
</head>

<body>
	<form action="pdfFunction.php">
		<button type="submit" class="btn btn-default" aria-label="Left Align" name="download">
			  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
		</button>
	</form>
	
	
		
		
		
	
</body>







