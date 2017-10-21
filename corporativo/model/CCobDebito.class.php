<?php

	require_once ("../engine/Model.class.php");

	class CCobDebito extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobDebito';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['CCobCarta_Id']['Type'] 		= 'number';
			$this->attribute['CCobCarta_Id']['Length'] 		= 15;
			$this->attribute['CCobCarta_Id']['NN'] 			= 1;
			$this->attribute['CCobCarta_Id']['Label'] 		= 'Carta';
			
			
			$this->attribute['Boleto_Id']['Type'] 		= 'number';
			$this->attribute['Boleto_Id']['Length'] 	= 15;
			$this->attribute['Boleto_Id']['NN'] 		= 1;
			$this->attribute['Boleto_Id']['Label'] 	= 'Boleto';
					
			$this->recognize["Recognize"] = "CCobCarta_Id, Boleto_Id";
			
			$this->index["CCobCarta"]["Cols"]	= "CCobCarta_Id";
			$this->index["Boleto"]["Cols"]		= "Boleto_Id";
				
		}
		
		
		
		public function GetBoletoReferencia($p_CCobCarta_Id)
		{
			
			$dbData = new DbData($this->db);
			 
			$dbData->Get("SELECT referencia, valor FROM boleto WHERE id IN ( SELECT boleto_id FROM ccobdebito WHERE ccobcarta_id = '".$p_CCobCarta_Id."' ) ");
			
			while($lista = $dbData->Row())
			{
				
				$arRef[REFERENCIA][] 	= $lista[REFERENCIA];
				$arRef[VALOR][] 		= _FormatValor($lista[VALOR]);
				
			}
			
			
			return $arRef;
			
			
		}
		
		public function GetValorAtual($p_CCobCarta_Id)
		{
			
			$dbData = new DbData($this->db);
			
			$aRet = $dbData->Row($dbData->Get("SELECT sum(valor) as valor FROM CCobDebito, Boleto WHERE Boleto.State_Base_Id = 3000000000006 and CCobDebito.Boleto_Id = Boleto.Id and CCobDebito.CCobCarta_Id = '".$p_CCobCarta_Id."'"));

			return $aRet[VALOR];
			
		}
		
		public function GetValor($p_CCobCarta_Id)
		{
			
			$dbData = new DbData($this->db);
				
			$aRet = $dbData->Row($dbData->Get("SELECT sum(valor) as valor FROM CCobDebito, Boleto WHERE CCobDebito.Boleto_Id = Boleto.Id and CCobDebito.CCobCarta_Id = '".$p_CCobCarta_Id."'"));
			
			return $aRet[VALOR];
				
		}


		public function GetMenorVencto($p_CCobCarta_Id)
		{
				
			$dbData = new DbData($this->db);
		
			$aRet = $dbData->Row($dbData->Get("SELECT min(dtvencto) as dtvencto FROM CCobDebito, Boleto WHERE Boleto.State_Base_Id = 3000000000006 and CCobDebito.Boleto_Id = Boleto.Id and CCobDebito.CCobCarta_Id = '".$p_CCobCarta_Id."'"));
				
			return $aRet[DTVENCTO];
		
		}
		
	}
	
	
?>