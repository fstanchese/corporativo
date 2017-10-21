<?php
/**
* TCPDF Advanced Multicell - Example
* Copyright (c) 2005-2012, Andrei Bintintan, http://www.interpid.eu
*/

require_once ('tcpdf/config/lang/eng.php');
require_once ('tcpdf/tcpdf.php');

// Include the Advanced Multicell Class
require_once ("classes/tcpdfmulticell.php");

/**
 * Include my Custom PDF class This is required only to overwrite the header
 */
require_once ("mypdf-multicell.php");

// create new PDF document
$oPdf = new myPDF();

// use the default TCPDF configuration
$oPdf->SetCreator(PDF_CREATOR);
$oPdf->SetAuthor('Andrei Bintintan');
$oPdf->SetTitle('TCPDF Advanced Multicell Example');
$oPdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$oPdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$oPdf->SetFont('times', 'BI', 11);
$oPdf->SetFillColor(254, 255, 245);

// add a page
$oPdf->AddPage();

/**
 * Create the Advanced Multicell Object and pass the PDF object as a parameter to the constructor
 */
$oMulticell = new TcpdfMulticell($oPdf);

/**
 * Set the styles for the advanced multicell
 */
$oMulticell->setStyle("b", "times", "B", 11, "130,0,30");

$sTxt = "This is a demo of <b>NON BREAKING > S P>A C E EXAMPLE</b>";

//create an advanced multicell
$oMulticell->multiCell(0, 5, "Default line breaking characters:  ,.:;", 0);
$oMulticell->multiCell(100, 5, $sTxt, 1);
$oPdf->Ln(10); //new line


//create an advanced multicell
$oMulticell->multiCell(0, 5, "Setting > as line breaking character", 0);
$oMulticell->setLineBreakingCharacters(">");
$oMulticell->multiCell(100, 5, $sTxt, 1);
$oPdf->Ln(10); //new line


//create an advanced multicell
$oMulticell->multiCell(0, 5, "Reseting the line breaking characters", 0);
$oMulticell->resetLineBreakingCharacters();
$oMulticell->multiCell(100, 5, $sTxt, 1);
$oPdf->Ln(10); //new line


//send the pdf to the browser
$oPdf->Output();