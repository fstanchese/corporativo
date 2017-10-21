<?php

require_once '../engine/View.class.php';

/**
 * Classe DataGrid 
 * Respons�vel por criar o HTML da tabula��o de resultados de uma determinada consulta.
 *
 */

class DataGrid extends View
{	
	private $totCol = 0; //@var Int Quantidade de Colunas da tabela
	private $count = 0; //@var Int Controla a quebra de linha da tabela </tr><tr>
	private $lineDetail = ''; //@var string Recebe o conte�do de detalhes da linha
	private $lineDetailControl = false; // @var bool Controla os detalhes da linha para mostrar apenas na 1� coluna
	private $contentRow = "";
	
	
	/**
	 * 	M�todo construtor respons�vel por criar uma tabela e a label de cada coluna	.
	 *  @echo  escreve na tela o cabe�alho da tabela. 
	 *	@param array $colunas = array com o Label de cada
	 *	@param string $caption = o caption da tabela  ** OPC **	
	 *  
	 */
	function __construct ($colunas, $caption = '',$jsPagination = TRUE,$orderBy=null)
	{
		$id = "";
		
		if($jsPagination)
		{ 
			if(isset($orderBy))
			{
				foreach($orderBy as $key => $value)
				{
					$ordenacao[] = "[ ".$key.", '".strtolower($value)."' ]";
				}
				
				$ordenacao = "'aaSorting': [".implode(",",$ordenacao)."], ";
				
			}
			
			$id = "dataTable";
			
			echo $this->JS("
					
				$('.dataTable').dataTable( {
					".$ordenacao."	
					'sPaginationType': 'full_numbers'
				} );
						
			");
			
			
			
			
		}
		
		echo $this->Table(array("class"=>"dataGrid dataTable","cellpadding"=>"0", "cellspacing"=>"0","border"=>"0","id"=>$id))."\n";
	
		if($caption != '')
		{
			echo $this->Caption($caption);
		}
		
		
		echo "<thead>";
		
		echo $this->Tr();
		
		
		
		foreach($colunas as $key=>$coluna)
		{
			if($coluna != ""){
				echo $this->Th($coluna)."\n";
			}
			$this->totCol++;
		}
		
		echo $this->CloseTr()."</head><tbody>";
		
	
	}

	/**
	 *  M�todo respons�vel por fechar a tabela.		 
	 */
	function __destruct ()
	{
		
		if($this->count <= $this->totCol)
		{
				
			echo $this->Tr().$this->contentRow.$this->CloseTr();
			
			
		}
		
		echo "</tbody><tfoot></tfoot>".$this->CloseTable();
	}

	

	/**
	 * 	M�todo respons�vel por distribuir o conte�do de cada elemento html <td> da tabela.	
	 *  @echo  mostra na tela a tabula��o do resultado.
	 *	@param string $conteudo = valor de cada c�lula
	 *	@param array $params = par�metros de cada c�lula. Ex: array("align"=>"left","class"=>"teste")	 
	 */
	function Content ($conteudo, $params=null)
	{	

		if($this->count == $this->totCol)
		{
			
			echo $this->Tr().$this->contentRow.$this->CloseTr();
			
			$this->contentRow = "";
			
			$this->count = 0;
			
			$this->lineDetailControl = false;
		}			
			
		$attrDetailLine = '';
			
		if(is_array($this->lineDetail) && !$this->lineDetailControl)
		{

			$this->lineDetailControl = true;
			//Verificar se foi passado algum parametro Class.
			//Se foi, adicionar a class tbDetail. Se n�o foi, adicionar no array a Class

			if(is_array($params))
			{
				
				if($params["class"] != "") $params["class"] .= " tbDetail";
				
				else $params["class"] = "tbDetail";
				
			}
			
			
			foreach ($this->lineDetail as $key => $value)
			{
				$params["tddetails"] .= $this->Span().$key.": ".$this->Strong($value).$this->CloseSpan().$this->Br();
			}


		}		

		
		$this->contentRow .= $this->Td($params).$conteudo.$this->CloseTd();
		
		$this->count++;
	}


	/**
	 * 	M�todo respons�vel por exibir o texto quando passar o mouse em cima da primeira c�lula de cada linha da tabela.	 
	 *	@param string $data	  =  texto HTML
	 */
	function Detail ($data)
	{
		$this->lineDetail = $data;
	}

}
?>