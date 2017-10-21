<?php

	class EtqPimaco{
	
		private $e_modelo;
		private $e_fonte 	= 'Arial';
		private $e_tamanho 	= '10px';
	
		private $e_linha 	= 1;
		private $e_coluna 	= 1;
		private $e_totalEtq 	= 0;
		
		private $e_config 	= array();
		
		private $e_celula_altura;
		private $e_celula_comprimento;
		private $e_celula_espacamento;
		private $e_linhas_pagina;
		private $e_celula_linha;
		
		
		private $e_cont = 0;
		
		private $orientacao;
		
		private $css = true;
		
		private $alturaPagina;
		private $larguraPagina;
		
			
		public function EtqPimaco($modelo,$orientacao='P'){
			
			$this->e_modelo 	= $modelo;
			$this->orientacao 	= $orientacao; 
			$this->Config();
			
		}
		
		private function Config(){
			//ALTURA E LARGUNRA CONSIDERANDO PADDING TOP DE 5PX E PADDING-LEFT DE 3PX
			
			$e_config[6180][altura] 	 	= '100';
			$e_config[6180][comprimento] 	= '256';
			$e_config[6180][espacamento] 	= '16';
			$e_config[6180][linha_page]  	= 10;
			$e_config[6180][celula_linha]  	= 3;
			
			$e_config[6181][altura] 	 	= '2.54';
			$e_config[6181][comprimento] 	= '10.16';
			$e_config[6181][espacamento] 	= '0.35';
			$e_config[6181][linha_page]  	= 10;
			$e_config[6181][celula_linha]  	= 2;
			
			/**
			TEM Q CONFIGURAR MARGENS DE CIMA E BAIXO
			$e_config[6182][altura] 	 = '95px';
			$e_config[6182][comprimento] = '249px';
			$e_config[6182][espacamento] = '13px';
			$e_config[6182][linha_page]  = 10;
			$e_config[6181][celula_linha]  	= 2;
			**/
			
			$e_config[6183][altura] 	 	= '5.08';
			$e_config[6183][comprimento] 	= '10.16';
			$e_config[6183][espacamento] 	= '0.35';
			$e_config[6183][linha_page]  	= 5;
			$e_config[6183][celula_linha]  	= 2;
			
			$e_config[6184][altura] 	 	= '322';
			$e_config[6184][comprimento] 	= '386';
			$e_config[6184][espacamento] 	= '19';
			$e_config[6184][linha_page]  	= 3;
			$e_config[6184][celula_linha]  	= 2;
			
			
			
			
			if($this->orientacao == "P")
			{
				$this->e_celula_altura 		= $e_config[$this->e_modelo][altura];
				$this->e_celula_comprimento = $e_config[$this->e_modelo][comprimento];
				$this->e_celula_espacamento = $e_config[$this->e_modelo][espacamento];
				$this->e_linhas_pagina 		= $e_config[$this->e_modelo][linha_page];
				$this->e_celula_linha 		= $e_config[$this->e_modelo][celula_linha];
				
				$this->alturaPagina = 920;
				$this->larguraPagina = 816;
			}
			
			
			
			if($this->orientacao == "L")
			{
				$this->e_celula_altura 		= $e_config[$this->e_modelo][comprimento];
				$this->e_celula_comprimento = $e_config[$this->e_modelo][altura];
				$this->e_celula_espacamento = $e_config[$this->e_modelo][espacamento];
				$this->e_linhas_pagina 		= $e_config[$this->e_modelo][celula_linha];
				$this->e_celula_linha 		= $e_config[$this->e_modelo][linha_page];
				
				$this->alturaPagina = 816;
				$this->larguraPagina = 1200;
				
			}
			
		}
		
		
		public function GetMedidas()
		{
			
			$ar[altura] 		= $this->e_celula_altura;
			$ar[comprimento] 	= $this->e_celula_comprimento;
			$ar[linhaspagina]	= $this->e_linhas_pagina;
			$ar[celulaslinha]	= $this->e_celula_linha;
			
			return $ar;
		
		}
		
		private function setCSS(){
			echo "	<style>
						*, html { padding:0;
							margin:0;
						 }
						 
					   body { 
							  margin:0;
							  padding:0;
							  font-size:".$this->e_tamanho.";
							  text-transform: uppercase;
							  font-family:".$this->e_fonte.";
							}
							
						.container{
							width:".$this->larguraPagina."px;
							height:".$this->alturaPagina."px;
							margin-top:70px;
							margin-left:15px;
							margin-right:0;
							
						}
							  		
						  		
						
						.linha {
							width:100%;
							height:".$this->e_celula_altura."px;
							
						}
															
						
						.celula{
							text-align: left;
							float:left;
							height:".$this->e_celula_altura."px;
							width:".$this->e_celula_comprimento."px;
						}
									
						
						.conteudo{
							width:100%;
							margin:6px;
							width:".($this->e_celula_comprimento)."px;
							height:".($this->e_celula_altura)."px;
						}
									
						
			
				
					</style>
			";
		
		}
		
		public function setConteudo($conteudo){
			
			
			if($this->css == true)
				$this->setCSS();
			
			$this->css = false;
			
			$marginRight = '';
			
			if($this->e_linha == 1 && $this->e_coluna == 1){
				echo "<div class='container'";
				if($this->e_cont > 0) echo "  ";
				echo ">";
			}
			
			if($this->orientacao == 'P')
			{
			
				if($this->e_coluna == 1)
					echo "<div class='linha'>";
				
				if($this->e_coluna <  $this->e_celula_linha) 
					$marginRight = "style='margin-right:".$this->e_celula_espacamento."px;'";
			}
			
			if($this->orientacao == 'L')
			{
				if($this->e_coluna == 1)
					echo "<br style='clear:both'><div class='linha' style='margin-bottom:".$this->e_celula_espacamento."px;'>";
				
				
			}
				
			echo "<div class='celula' ".$marginRight."><div class='conteudo'>".$conteudo."</div></div>";
			
			$this->e_cont = 1;
			$this->e_coluna++;
			
			if($this->e_coluna > $this->e_celula_linha){
				echo "</div>";
				$this->e_coluna = 1;
				$this->e_linha++;
			}
			
			if($this->e_linha > $this->e_linhas_pagina){
				echo "</div><br style='clear:both'></div><p style='page-break-before:always'></p>";
				$this->e_linha = 1;
			}
			
			$this->e_totalEtq++;

		}
	}

?>