<?php 

	require_once("../engine/DataGrid.class.php");

	
	
	class Excel extends DataGrid
	{
		
		private $fileName;
		private $tableContent;

		public function __construct($filename,$debug=FALSE)
		{
			
			if(!$debug)
			{
				
				
						header('Content-type: application/vnd.ms-excel');
						header('Content-type: application/force-download');
						header('Content-Disposition: attachment; filename='.$filename.'.xls');
						header('Pragma: no-cache');
						
						
				
				
			}
			
			echo "<html><body>
					<style>
						.DATA1 {mso-number-format:'dd\/mm\/yy\;\@';	}
						.DATA2 {mso-number-format:'Short Date';}
						.MOEDARS {mso-number-format:'_\(\[$R$ -416\]* \#\,\#\#0\.00_\)\;_\(\[$R$ -416\]* \\\(\#\,\#\#0\.00\\\)\;_\(\[$R$ -416\]* \0022-\0022??_\)\;_\(\@_\)';}
						.PORCENTAGEM {	mso-number-format:Percent;	}
						.TEXTO {mso-number-format:'\@';}
						.NUMERO { mso-number-format:'0'}
						.DECPN { mso-number-format:'\#\,\#\#0\.00_ \;\[Red\]\-\#\,\#\#0\.00\ '}
						.THHEADER{ background:#30445c;color:white;padding:1px 2px 1px 2px}
						.DETAIL { background:#ccc;padding:1px 2px 1px 2px}
					</style>
					";
			

			echo $this->OpenTable();
			
		}
		
		
		public function OpenTable()
		{
			
			echo $this->Table(array("border"=>"1","cellpadding"=>3));
		}
		
		
		public function Header($arHeader,$param=null)
		{
			
			if($param['class'] == "") $param["class"] = 'THHEADER';
			
			echo $this->Tr($param);
			
			foreach($arHeader as $head)
			{

				echo $this->Td().$head.$this->CloseTd();

				$this->totCol++;
			}
			
			
			echo $this->CloseTr();
			
		}
		
		
		
		function Content ($conteudo,$params=null)
		{
			if($param['class'] == "") $param["class"] = 'TEXTO';
			if($this->count == $this->totCol)
			{
					
				echo $this->Tr().$this->contentRow.$this->CloseTr();
					
				$this->contentRow = "";
					
				$this->count = 0;
					
				$this->lineDetailControl = false;
			}
				
		
			$this->contentRow .= $this->Td($params).$conteudo.$this->CloseTd();
		
			$this->count++;
		}
		
		
		public function EndTable()
		{
			if($this->count <= $this->totCol)
			{
			
				echo $this->Tr().$this->contentRow.$this->CloseTr();
				
				
					
			}
			
			
			$this->contentRow = "";
				
			$this->count = 0;
			
			$this->totCol = 0;
			
			echo $this->CloseTable();
		}
		
		
		
		/**
		 *  Método responsável por fechar a tabela.
		 */
		function __destruct ()
		{
			
			$this->EndTable();
			
		}
		
		
	}
?>