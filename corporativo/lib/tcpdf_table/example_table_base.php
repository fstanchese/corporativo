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
$aBgColor1 = array(234, 255, 218);
$aBgColor2 = array(165, 250, 220);
$aBgColor3 = array(255, 252, 249);

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
$oTable->setStyle("h1", "times", "", 10, "0,151,200");
$oTable->setStyle("bi", "times", "BI", 12, "0,0,120");

$sTxt1 = "<p>All table cells are fully functional <bi href='http://www.interpid.eu/tcpdf-addons/tcpdf-multicell'>TCPDF Advanced Multicells</bi>\nDetails about Advanced Multicell can be found <h1 href='http://www.interpid.eu/tcpdf-addons/tcpdf-multicell'>here</h1></p>";

//Initialize the table class, 5 columns with the specified widths
$oTable->initialize(array(20, 30, 40, 40, 20));

$aHeader = array(array('TEXT' => 'Header 1'), array('TEXT' => 'Header 2'), array('TEXT' => 'Header 3'), array('TEXT' => 'Header 4'), array('TEXT' => 'Header 5'));

//add the header line
$oTable->addHeader($aHeader);

//do some adjustments in the header
$aHeader[2]['TEXT'] = 'Header Colspan/Rowspan';
$aHeader[2]['COLSPAN'] = 2;
$aHeader[2]['ROWSPAN'] = 2;
$aHeader[2]['TEXT_COLOR'] = array(10, 20, 100);
$aHeader[2]['BACKGROUND_COLOR'] = $aBgColor2;

$oTable->addHeader($aHeader);

//add an empty header line
$oTable->addHeader();

$fsize = 5;
$colspan = 2;
$rowspan = 2;

$rgb_r = 255;
$rgb_g = 255;
$rgb_b = 255;

for ($j = 0; $j < 45; $j ++) {
    $aRow = Array();
    $aRow[0]['TEXT'] = "Row No - $j";
    $aRow[0]['TEXT_SIZE'] = $fsize;
    $aRow[1]['TEXT'] = "Test Text Column 1- $j";
    $aRow[1]['TEXT_SIZE'] = 13 - $fsize;
    $aRow[2]['TEXT'] = "Test Text Column 2- $j";
    $aRow[3]['TEXT'] = "Longer text, this will split sometimes...";
    $aRow[3]['TEXT_SIZE'] = 15 - $fsize;
    $aRow[4]['TEXT'] = "Short 4- $j";
    $aRow[4]['TEXT_SIZE'] = 7;
    
    if ($j == 0) {
        $aRow[1]['TEXT'] = $sTxt1;
        $aRow[1]['COLSPAN'] = 4;
        $aRow[1]['TEXT_ALIGN'] = "C";
        $aRow[1]['LINE_SIZE'] = 5;
    } elseif ($j == 1) {
        
        $aRow[0]['TEXT'] = "Top Right Align <p>Align Top</p> Right Right Align";
        $aRow[0]['TEXT_ALIGN'] = "R";
        $aRow[0]['VERTICAL_ALIGN'] = "T";
        
        $aRow[1]['TEXT'] = "Middle Center Align Bold Italic";
        $aRow[1]['TEXT_ALIGN'] = "C";
        $aRow[1]['TEXT_TYPE'] = "BI";
        $aRow[1]['VERTICAL_ALIGN'] = "M";
        
        $aRow[2]['TEXT'] = "\n\n\n\n\nBottom Left Align";
        $aRow[2]['TEXT_ALIGN'] = "L";
        $aRow[2]['VERTICAL_ALIGN'] = "B";
        
        $aRow[3]['TEXT'] = "Middle Justified Align Longer text";
        $aRow[3]['TEXT_ALIGN'] = "J";
        $aRow[3]['VERTICAL_ALIGN'] = "M";
        
        $aRow[4]['TEXT'] = "TOP RIGHT Align with top padding(5)";
        $aRow[4]['TEXT_ALIGN'] = "R";
        $aRow[4]['VERTICAL_ALIGN'] = "T";
        $aRow[4]['PADDING_TOP'] = 5;
    }
    
    if ($j > 0) {
        $aRow[0]['BACKGROUND_COLOR'] = array(255 - $rgb_b, $rgb_g, $rgb_r);
        $aRow[1]['BACKGROUND_COLOR'] = array($rgb_r, $rgb_g, $rgb_b);
        $aRow[2]['BACKGROUND_COLOR'] = array($rgb_b, $rgb_g, 220);
        $aRow[2]['TEXT_COLOR'] = array(80, 20, $rgb_g);
    }
    
    if ($j > 3 && $j < 7) {
        $aRow[1]['TEXT'] = "Colspan Example - Center Align";
        $aRow[1]['COLSPAN'] = $colspan;
        $aRow[1]['BACKGROUND_COLOR'] = array($rgb_b, 50, 50);
        $aRow[1]['TEXT_COLOR'] = array(255, 255, $rgb_g);
        $aRow[1]['TEXT_ALIGN'] = "C";
        $colspan ++;
        if ($colspan > 4) $colspan = 2;
    }
    
    if ($j == 7) {
        $aRow[3]['TEXT'] = "Rowspan Example";
        $aRow[3]['BACKGROUND_COLOR'] = array($rgb_b, $rgb_b, 250);
        $aRow[3]['ROWSPAN'] = 4;
    
    }
    
    if ($j == 8) {
        $aRow[1]['TEXT'] = "Rowspan Example";
        $aRow[1]['BACKGROUND_COLOR'] = array($rgb_b, 50, 50);
        $aRow[1]['ROWSPAN'] = 6;
    }
    
    if ($j == 9) {
        $aRow[2]['TEXT'] = "Rowspan Example";
        $aRow[2]['BACKGROUND_COLOR'] = array($rgb_r, $rgb_r, $rgb_r);
        $aRow[2]['ROWSPAN'] = 3;
    }
    
    if ($j == 12) {
        $aRow[2]['TEXT'] = "Rowspan && Colspan Example\n\nCenter/Middle Allignment";
        $aRow[2]['TEXT_ALIGN'] = 'C';
        $aRow[2]['VERTICAL_ALIGN'] = 'M';
        $aRow[2]['BACKGROUND_COLOR'] = array(234, 255, 218);
        $aRow[2]['ROWSPAN'] = 5;
        $aRow[2]['COLSPAN'] = 2;
    }
    
    if ($j == 17) {
        $aRow[0]['TEXT'] = $sTxt1;
        $aRow[0]['TEXT_ALIGN'] = 'C';
        $aRow[0]['VERTICAL_ALIGN'] = 'M';
        $aRow[0]['BACKGROUND_COLOR'] = array(234, 255, 218);
        $aRow[0]['ROWSPAN'] = 5;
        $aRow[0]['COLSPAN'] = 4;
    }
    
    $fsize += 0.5;
    
    if ($fsize > 10) $fsize = 5;
    
    $rgb_b -= 10;
    $rgb_g -= 5;
    $rgb_b -= 20;
    
    if ($rgb_b < 150) $rgb_b = 255;
    if ($rgb_g < 150) $rgb_g = 255;
    if ($rgb_b < 150) $rgb_b = 255;
    
    $oTable->addRow($aRow);
}

//close the table
$oTable->close();

//send the pdf to the browser
$oPdf->Output();
