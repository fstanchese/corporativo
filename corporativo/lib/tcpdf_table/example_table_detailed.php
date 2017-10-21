<?php
/**
* TCPDF Advanced Table - Example
* Copyright (c) 2005-2012, Andrei Bintintan, http://www.interpid.eu
*/

require_once ('tcpdf/config/lang/eng.php');
require_once ('tcpdf/tcpdf.php');

// Include the Advanced Table Class
require_once ("classes/tcpdftable.php");

//define some background colors
//define some background colors
$aBgColor1 = array(234, 255, 218);
$aBgColor2 = array(165, 250, 220);
$aBgColor3 = array(255, 252, 249);
$aBgColor4 = array(86, 155, 225);
$aBgColor5 = array(207, 247, 239);
$aBgColor6 = array(246, 211, 207);
$bg_color7 = array(216, 243, 228);

/**
 * Include my Custom TCPDF class This is required only to overwrite the header
 */
require_once ("mypdf-table.php");

// create new PDF document
$oPdf = new myPDF();

// use the default TCPDF configuration
$oPdf->SetCreator(PDF_CREATOR);
$oPdf->SetAuthor('Andrei Bintintan');
$oPdf->SetTitle('TCPDF Advanced Table Example');
$oPdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$oPdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$oPdf->SetFont('times', 'BI', 11);
$oPdf->SetFillColor(254, 255, 245);

// add a page
$oPdf->AddPage();

/**
 * Create the Advanced Table object Alternative you can use the Singleton Instance
 * @example : $oTable = TcpdfTable::getInstance($oPdf);
 */
$oTable = new TcpdfTable($oPdf);

/**
 * Set the tag styles
 */
$oTable->setStyle("p", "times", "", 10, "130,0,30");
$oTable->setStyle("b", "times", "", 9, "80,80,260");
$oTable->setStyle("t1", "times", "", 10, "0,151,200");
$oTable->setStyle("bi", "times", "BI", 12, "0,0,120");

//default text color
$oPdf->SetTextColor(118, 0, 3);

//create an advanced multicell    
$oMulticell = TcpdfMulticell::getInstance($oPdf);
$oMulticell->SetStyle("s1", "times", "", 8, "118,0,3");
$oMulticell->SetStyle("s2", "times", "", 6, "0,49,159");

$oMulticell->multiCell(100, 4, "<s1>Example 1 - Very Simple Table</s1>", 0);
$oPdf->Ln(1);

require ('table_example1.inc');

$oPdf->Ln(10);

$sTxt = "<s1>Example 2 - More detailed Table</s1>\n<s2>\t- Table Align = Center\n\t- The header has multiple lines\n\t- Colspanning Example\n\t- Rowspanning Example\n\t- Text Alignments\n\t- Properties overwriting</s2>";

$oPdf->SetX(60);
$oMulticell->multiCell(100, 3, $sTxt, 0);
$oPdf->Ln(1);
require ('table_example2.inc');

$oPdf->AddPage();

$sTxt = "<s1>Example 3 - Table split end of the page</s1>\n<s2>\t- This is the table from Example 2 at the end of the page\n\t- Splitting mode = ON, you can see that the cells are splitted</s2>";

$oPdf->SetXY(60, 190);
$oMulticell->multiCell(100, 3, $sTxt, 0);
$oPdf->Ln(1);
$bTableSplitMode = true;
require ('table_example2.inc');

$oPdf->SetXY(60, 190);

$sTxt = "<s1>Example 4 - Table split end of the page</s1>\n<s2>\t- This is the table from Example 2 at the end of the page\n\t- Splitting mode = OFF. In this case the cells are NOT splitted</s2>";

$oMulticell->multiCell(100, 3, $sTxt, 0);
$oPdf->Ln(1);
$bTableSplitMode = false;
require ('table_example2.inc');

//send the pdf to the browser
$oPdf->Output();
