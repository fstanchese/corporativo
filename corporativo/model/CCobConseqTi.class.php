<?php

	require_once ("../engine/Model.class.php");

	class CCobConseqTi extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobConseqTi';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['Nome']['Type'] 		= 'varchar';
			$this->attribute['Nome']['Length'] 		= 80;
			$this->attribute['Nome']['NN'] 			= 1;
			$this->attribute['Nome']['Label'] 		= 'Nome';
			
			
			$this->recognize["Recognize"] = "Nome";
				
		}
		
		
		
	}
	
	
?>

