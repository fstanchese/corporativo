<?php


/**
 * Custom PDF class extention for Header and Footer Definitions
 * 
 * @author andy@interpid.eu
 *
 */
class myPDF extends TCPDF {


    /**
     * Custom Header 
     *
     * @access public
     * @see TCPDF::Header()
     */
    public function Header () {
        $this->SetY(10);
        
        
    }


    /**
     * Custom Footer 
     *
     * @access public
     * @see TCPDF::Footer()
     */
    public function Footer () {
        $this->SetY(- 10);
        $this->SetFont('helvetica', 'I', 7);
        $this->SetTextColor(170, 170, 170);
        $this->MultiCell(0, 4, "Page {$this->PageNo()} / {$this->getNumPages()}", 0, 'C');
    }
}

