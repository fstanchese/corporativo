<?php

	require_once ("../engine/Model.class.php");

	class CCobCartaTi extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobCartaTi';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['Nome']['Type'] 				= 'varchar';
			$this->attribute['Nome']['Length'] 				= 100;
			$this->attribute['Nome']['NN'] 					= 1;
			$this->attribute['Nome']['Label'] 				= 'Nome';
				
			$this->attribute['Layout']['Type'] 				= 'clob';
			$this->attribute['Layout']['NN'] 				= 1;
			$this->attribute['Layout']['Label'] 			= 'Layout';
			
			$this->attribute['Exibir']['Type'] 				= 'varchar';
			$this->attribute['Exibir']['Length'] 			= 3;
			$this->attribute['Exibir']['NN'] 				= 0;
			$this->attribute['Exibir']['Label'] 			= 'Nome';


			$this->calculate['Geral']		= "CCobCartaTi_qGeral";
			$this->calculate['Exibir']		= "CCobCartaTi_qExibir";
			
			$this->recognize["Recognize"] 	= "Nome";
				
		}
		
		
		
	}
	
	
?>