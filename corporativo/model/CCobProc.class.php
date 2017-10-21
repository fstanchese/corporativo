<?php

	require_once ("../engine/Model.class.php");

	class CCobProc extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobProc';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['DtInicio']['Type'] 		= 'date';
			$this->attribute['DtInicio']['NN'] 			= 1;
			$this->attribute['DtInicio']['Label'] 		= 'Mês Início';
			
			$this->attribute['DtTermino']['Type'] 		= 'date';
			$this->attribute['DtTermino']['NN'] 		= 1;
			$this->attribute['DtTermino']['Label'] 		= 'Mês Fim';
			
			$this->recognize["Recognize"] = "DtInicio, DtTermino";
				
		}
		
		
		
	}
	
	
?>

