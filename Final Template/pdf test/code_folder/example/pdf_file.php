<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
//function


//function titleSentences($title, $sentences){

//}


//--------------------------------------------
// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();

// Function set some text to print
function titleContent($title, $content){
	$GLOBALS['txt'] = $title."\n\n".$content;
}

function arraySentences(){
	$array[0] = "This";
	$array[1] = "is";
	$array[2] = "where";
	$array[3] = "the";
	$array[4] = "array";
	$array[5] = "sentences";
	$array[6] = "is";
	$array[7] = "!";
	return $array;
}
$arrayBeforeImplode = arraySentences();
titleContent("This is the title!", "This is the content!\n");
$arrayImplode = implode(" ", $arrayBeforeImplode);
$txtTe = $arrayImplode;


// print a block of text using Write()
$pdf->Write(0, $txt,  '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, $txtTe,   '', 0, 'C', true, 0, false, false, 0);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
