<?php
	require_once ('../lib/tcpdf_table/tcpdf/config/lang/bra.php');
	require_once ('../lib/tcpdf_table/tcpdf/tcpdf.php');
	
	class HtmlPDF extends TCPDF
	{
		private $pdf;
		
		public function __construct ($orientation = PDF_PAGE_ORIENTATION, $unit = PDF_UNIT, $format = PDF_PAGE_FORMAT)
		{
				$this->pdf = new TCPDF($orientation, $unit, $format, 'UTF-8');
				
				$this->pdf->SetCreator("Universidade São Judas Tadeu");
				$this->pdf->SetAuthor("Universidade São Judas Tadeu");

				$this->pdf->setPrintHeader(false);
				$this->pdf->setPrintFooter(false);

				$this->pdf->SetFont("helvetica", '', 10);
		}
		
		public function Title($title)
		{
			$this->pdf->SetSubject($title);
		}
		
		public function Font($font, $style = "", $size = "")
		{
			$this->pdf->SetFont($font, $style, $size);
		} 
		
		public function __destruct()
		{
			$this->pdf->Output();
			$this->pdf->Close();
		}

		public function Html($html)
		{
			$this->pdf->AddPage();
			$this->pdf->writeHTML($html, true, 0, true, 0);
		}
		
	}
?>