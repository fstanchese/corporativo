<?php

	require_once ("../engine/Model.class.php");

	class CCobTiXBolTi extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobTiXBolTi';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 100;
		
			$this->attribute['CCobCartaTi_Id']['Type'] 		= 'number';
			$this->attribute['CCobCartaTi_Id']['Length'] 	= 15;
			$this->attribute['CCobCartaTi_Id']['NN'] 		= 1;
			$this->attribute['CCobCartaTi_Id']['Label'] 	= 'Tipo de Carta de Cobrança';
			
			$this->attribute['BoletoTi_Id']['Type'] 		= 'number';
			$this->attribute['BoletoTi_Id']['Length'] 		= 15;
			$this->attribute['BoletoTi_Id']['NN'] 			= 1;
			$this->attribute['BoletoTi_Id']['Label'] 		= 'Tipo de Boleto';
			
		
			$this->recognize["Recognize"] = "CCobCartaTi_Id, BoletoTi_Id";
			
			$this->index["CartaTi"]["Cols"]		= "CCobCartaTi_Id";
			$this->index["BoletoTi"]["Cols"]	= "BoletoTi_Id";
				
		}

		
		public function GetBoletoTi($vCCobCartaTi,$vNome=FALSE)
		{
			$dbData = new DbData($this->db);

			$dbData->Get("select BoletoTi_Id,BoletoTi_gsRecognize(BoletoTi_Id) as Nome from CCobTiXBolTi where CCobCartaTi_Id = '".$vCCobCartaTi."'");
			
			while ($row = $dbData->Row())
			{
				if ($vNome)
					$aBoletoTi[] = $row[NOME];
				else
					$aBoletoTi[] = $row[BOLETOTI_ID];
			}
				
			return $aBoletoTi;
		}
			
	}
	
	
?>