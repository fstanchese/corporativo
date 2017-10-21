<?php

	require_once ("../engine/Model.class.php");

	class CCobFollow extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobFollow';
		
		
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
			
			
			$this->attribute['Texto']['Type'] 		= 'varchar';
			$this->attribute['Texto']['Length'] 	= 500;
			$this->attribute['Texto']['NN'] 		= 1;
			$this->attribute['Texto']['Label'] 	= 'Texto';
			

			$this->attribute['DtPrevisao']['Type'] 		= 'date';
			$this->attribute['DtPrevisao']['NN'] 		= 1;
			$this->attribute['DtPrevisao']['Label'] 	= 'Data Previsão';

			
			$this->recognize["Recognize"] = "CCobCarta_Id, DtPrevisao";
			
			$this->index["CCobCarta"]["Cols"] 	= "CCobCarta_Id";
				
		}
		
		
		
	}
	
	
?>

