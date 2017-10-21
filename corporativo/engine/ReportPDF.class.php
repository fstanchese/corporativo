<?php
	require_once ('../lib/tcpdf_table/tcpdf/config/lang/bra.php');
	require_once ('../lib/tcpdf_table/tcpdf/tcpdf.php');
	
	
	
	class ReportPDFConfig extends TCPDF {
	
		private $titleReport = "";
		private $subtitleReport = "";
		public  $sizePageName = 100;
		
		public function Title($title,$subtitle){
			
			$this->titleReport = $title;
			$this->subtitleReport = $subtitle;
			
		}
		
		
		private function GetData(){
			setlocale(LC_ALL, "pt_BR", "ptb");
			return strftime("%A, %d de %B de %Y ", strtotime('now'))." ".date("H:i");
		}
		
		public function Header () {
			$this->SetY(10);
			
			$this->SetY(1);
			$this->SetX(3);
			
			$this->SetFont('helvetica','',8);
			$this->Cell($this->sizePageName,10,"USJT - ".end(explode("/",$_SERVER[PHP_SELF])),0,0,'L');
			$this->Cell(100,10,"Pag: ".$this->PageNo(),0,1,'R');
			
			$this->SetY(8);
			$this->SetX(3);
			$this->SetFont('helvetica','',10);
			
			$this->SetFillColor(211,211,211);
			$this->Cell(0,5,utf8_encode ($this->titleReport),0,1,'C',true);
			$this->SetY(13.2);
			$this->SetX(3);
			$this->Cell(0,5,$this->subtitleReport,0,1,'C',true);
			
			
			$this->SetX(3);
			$this->Cell(0,5,"",0,1,'C');
			$this->SetX(3);
	
		}
	
	
		/**
		 * Custom Footer
		 *
		 * @access public
		 * @see TCPDF::Footer()
		 */
		public function Footer () {
			// Position at 1.5 cm from bottom
			$this->SetY(-10);
			// Arial italic 8
			$this->SetFont('helvetica','I',8);
			// Page number
			$this->Cell(0,10,$this->GetData(),"T",0,'C');
		}
	}
	
	
	
	class ReportPDF 
	{
		
		public $pageName;
				
		private $pdf;
		private $vpConfig;
		private $aContent = array();
		private $qteCols;
		private $pdfType; 
		
		private $titlePDF;
		private $subtitlePDF;
		
		public function __construct($title,$subtitle="",$type = 'G',$orientation="P")
		{
			
			
			$this->titlePDF 	= $title;
			$this->subtitlePDF 	= $subtitle;
			
			//
			//$type -> G : GRID | P : PAGE
			//
			
			$this->pdfType = $type;
			
			$this->vpConfig = new ReportPDFConfig();
			
			if($orientation == 'P') $this->vpConfig->sizePageName =100;
			if($orientation == 'L') $this->vpConfig->sizePageName =185;
			
			$this->vpConfig->Title( ($title),utf8_encode ($subtitle));
			
			$this->vpConfig->SetMargins(0.1, 21, 0.1);
			$this->vpConfig->SetAutoPageBreak(TRUE, 11);
			$this->vpConfig->SetFont('helvetica', '', 11);
			$this->vpConfig->AddPage($orientation);
			
			$this->Type();
			
		}
		
		
		private function Type()
		{
			
			if($this->pdfType == 'G')
			{
				require_once ("../lib/tcpdf_table/classes/tcpdftable.php");
				$this->pdf = new TcpdfTable($this->vpConfig); //para tabelas
			}
			
			
			if($this->pdfType == 'P')
			{
				require_once ("../lib/tcpdf_table/classes/tcpdfmulticell.php");
				$this->pdf = new TcpdfMulticell($this->vpConfig); //para texto livre
			}
			
		}
		
		
		public function GridHeader($arHeader,$size)
		{
			
			$rowspan = 0;
			
			$this->pdf->initialize($size);
			
			foreach($arHeader as $key => $array)
			{
					 
				$array["TEXT"] = ($array["TEXT"]);
			
				if($array[ROWSPAN] != "" && $array[ROWSPAN] > $rowspan)
					$rowspan = $array[ROWSPAN];
			
			}
				
						
			$this->pdf->addHeader($arHeader);
			
			
			
			
			for($x=1;$x<$rowspan;$x++)
				$this->pdf->addHeader();
			
			
			$this->qteCols = count($size);
			
			
			//add an empty header line
			//$this->pdf->addHeader();
			
		}
		
		
		public function GridContent($arrayC)
		{
			//print_r($arrayC);~
			
			$arrayC["TEXT"] = utf8_encode($arrayC["TEXT"]);
			
			if($arrayC["TEXT_ALIGN"] == "")
				$arrayC["TEXT_ALIGN"] = "L";
			
			
			
			$this->aContent[] = $arrayC;

			if(count($this->aContent) == $this->qteCols)
			{
				$this->pdf->addRow($this->aContent);
				unset($this->aContent);
			}
			
		}
		
		
		public function __destruct()
		{
			if($this->pdfType == 'G')
			{
				$this->pdf->close(); //close the table
			}
				
			//send the pdf to the browser
			$this->vpConfig->Output(_fTrataNome($this->titlePDF));
			
		}
		
		
		public function Style($tag,$textStyle='',$fontSize=11,$cor='000000',$font="helvetica")
		{
			
			$this->pdf->SetStyle($tag,$font,$textStyle,$fontSize,$this->Hex2RGB($cor));
			
		}
		
		
		
		public function Line($text,$param="")
		{
			
			$text = str_replace("<br>","\n",$text);
			$text = str_replace("<BR>","\n",$text);
			$text = str_replace("<br />","\n",$text);
			
			$this->vpConfig->SetX(5);
			
			$config[w] 				= $param[width] != "" ? $param[width] : 0;
			$config[h] 				= $param[height] != "" ? $param[height] : 5;
			$config[b] 				= $param[border] != "" ? $param[border] : 0;
			$config[align] 			= $param[align] != "" ? $param[align] : 'J';
			$config[fill] 			= $param[fill] != "" ? $param[fill] : 0;
			$config[paddingTop]		= $param[paddingTop] != "" ? $param[paddingTop] : 0;
			$config[paddingLeft]	= $param[paddingLeft] != "" ? $param[paddingLeft] : 0;
			$config[paddingRight]	= $param[Right] != "" ? $param[Right] : 0;
			$config[paddingBottom]	= $param[paddingBottom] != "" ? $param[paddingBottom] : 0;
			
			 
		
			
			$this->pdf->multiCell($config[w],$config[h],utf8_encode ($text),$config[b],$config[align],$config[fill],$config[paddingLeft],$config[paddingTop],$config[paddingRight],$config[paddingBottom],true);
			
			
		}
		
		public function CloseTable()
		{
			
			$this->pdf->close(); //close the table
			
		}
		
		
		public function Br($size=5)
		{
			$this->vpConfig->Ln($size);
			
		}
		
		public function NewPage()
		{
			
			$this->vpConfig->AddPage();
			
		}
		
		
		
		
		
		public function Hex2RGB($hex) {
		   $hex = str_replace("#", "", $hex);
		
		   if(strlen($hex) == 3) {
		      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
		      $r = hexdec(substr($hex,0,2));
		      $g = hexdec(substr($hex,2,2));
		      $b = hexdec(substr($hex,4,2));
		   }
		   $rgb = array($r, $g, $b);
		   return $rgb;
		   
		}
		
	
		
	
		
		private function geraData(){
			setlocale(LC_ALL, "pt_BR", "ptb");
			return strtolower(strftime("%A, %d de %B de %Y ", strtotime('now'))." ".date("H:i"));
		}
		
	
	
	}

?>