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
$oMulticell->SetStyle("p", "times", "", 11, "130,0,30");
$oMulticell->SetStyle("b", "times", "B", 11, "130,0,30");
$oMulticell->setStyle("i", "times", "I", 11, "80,80,260");
$oMulticell->setStyle("u", "times", "U", 11, "80,80,260");
$oMulticell->SetStyle("h1", "times", "", 11, "80,80,260");
$oMulticell->SetStyle("h3", "times", "B", 12, "203,0,48");
$oMulticell->SetStyle("h4", "times", "BI", 11, "0,151,200");
$oMulticell->SetStyle("hh", "times", "B", 11, "255,189,12");
$oMulticell->SetStyle("ss", "times", "", 7, "203,0,48");
$oMulticell->SetStyle("font", "times", "", 10, "0,0,255");
$oMulticell->SetStyle("style", "times", "BI", 10, "0,0,220");
$oMulticell->SetStyle("size", "times", "BI", 12, "0,0,120");
$oMulticell->SetStyle("color", "times", "BI", 12, "0,255,255");

//TAG Based Formatted text
$sTxt1 = file_get_contents('content/createdby.txt');

$txt2 = '<p>';
for ($i = 0; $i < 100; $i ++)
    $txt2 .= "Line <b>$i</b>\n";

$txt2 .= '</p>';

//create an advanced multicell
$oMulticell->multiCell(0, 5, $txt2, 1, "J", 1, 0, 0, 0, 0);
$oPdf->Ln(10); // new line


// send the pdf to the browser
$oPdf->Output();
