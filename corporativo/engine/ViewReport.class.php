<?php 
require_once ("../engine/View.class.php");
	class ViewReport extends View
	{
		public $pageName;
		public $subtitle;
		public $page = 1;
		
		private $formato 	= "retrato";
		private $breakLike 	= array("retrato"=>40,"paisagem"=>26);
		private $colsTab 	= array();
		
		private $contentRow;
		private $count;
		
		private $line;
		private $totCol;
		private $totPaginas;
		
	
		function __construct ($title, $subtitle="", $arCols='', $formato='', $linCustom='')
		{
			$this->pageName = $title;
			$this->subtitle = $subtitle;

				
			if($formato != '')   $this->formato = $formato;
			if($linCustom != '') $this->breakLike[$this->formato] = $linCustom;
		
			//header('Content-Type: text/html; charset=utf-8');

			echo "<!DOCTYPE HTML>\n";
			echo "<html>\n";
			echo "<head>\n";

			echo "<title>$title</title>\n";
			
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";

			echo "<link href=\"../css/default.css\" rel=\"stylesheet\" type=\"text/css\" /> \n";		
			echo "<link href=\"../css/report.css\" rel=\"stylesheet\" type=\"text/css\" /> \n";		

			echo "</head>\n";
			
			echo "<body>\n";
			
			//if(is_array($arCols))
			//	$this->Header($arCols);
		}
		
		
		public function Footer(){
		
			if($this->count <= $this->totCol)
			{
			
				echo "<tr>".$this->contentRow."</tr>";
					
					
			}
			
			echo "</table>\n 
				  </section>\n 
				  <div class='footer footer_".$this->formato."'>".$this->geraData()."</div>\n
				  <p style='page-break-after:always'></p>\n";
		}
		
		
		function __destruct (){
			
			if($this->count <= $this->totCol)
			{
			
				echo "<tr>".$this->contentRow."</tr>";
					
					
			}
			
			echo "
				</table>\n
				</section>\n
				<div class='final footer footer_".$this->formato."'>*****<br />".$this->geraData()."</div>\n
			</body>\n</html>";
		}
		
		public function Header ($arCols='',$html=''){
							
			if($arCols != '')
				$this->colsTab = $arCols;			
			
			$totPag = $this->GetTotalPag();
			
			if( $totPag != '')
				$tpag = $this->page.'/'.$totPag;
			else 
				$tpag = $this->page;
			
			$this->totCol = count($this->colsTab);	
				
			echo "<div class='header_".$this->formato." headerReport' >\n
					<div class='pageName'>USJT - ".end(explode("/",$_SERVER[PHP_SELF]))."</div>
					<div class='pageNumber'>Pag: ".$tpag."</div>
			
					<div class='firstLine'>".$this->pageName."</div>\n
					<div class='secondLine'>".$this->subtitle."</div>\n
			
			</div>\n
			<section class='".$this->formato."'>";
			
			if ($html != '')
				echo $html;
				
			if(is_array($this->colsTab))
			{
				echo "<table cellpadding=1 cellspacing=1 border=0 width=100%>";
			
			
				foreach($this->colsTab as $coluna)
					echo "<th>".$coluna."</th>";
					
				//echo "\n<tr>\n";
			}
			
			$this->page++;
			
			$this->line = 0;
		
		}		
	
		
		function Content ($conteudo, $params=null)
		{
		
			if($this->count == $this->totCol && $this->count > 0)
			{
					
				echo "<tr>".$this->contentRow."</tr>";
					
				$this->contentRow = "";
					
				$this->count = 0;
				
				$this->line++;
				
				if($this->line >= $this->breakLike[$this->formato])
				{
					
					$this->Footer();
					$this->Header();
					
				}
		
			}
			
		
			$this->contentRow .= "<td ".$this->SetAttr($params)." ".$attrDetailLine.">".$conteudo."</td>";
		
			$this->count++;
		}		
		
		function GetTotalPag()
		{
			return $this->totPaginas;
		}

		function SetTotalPag($tPag=null)
		{
 			$this->totPaginas = $tPag;
		}
		
		function reiniciarPaginacao()
		{
			$this->contentRow = '';
			$this->count = 0;
			$this->page = 1;
		}		
	
		private function geraData(){
			setlocale(LC_ALL, "pt_BR", "ptb");
			return ucwords(strftime("%A, %d de %B de %Y ", strtotime('now'))." ".date("H:i"));
		}
}
		
?>