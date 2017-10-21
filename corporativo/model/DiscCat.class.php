<?php
	require_once ("../engine/Model.class.php");
	
	class DiscCat extends Model 
	{
	
		public $table = 'DiscCat';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;

			$this->attribute['Nome']['Type'] 					= 'varchar2';
			$this->attribute['Nome']['Length'] 					= 80;
			$this->attribute['Nome']['NN'] 						= 1;

			$this->attribute['Estagio']['Type'] 				= 'varchar2';
			$this->attribute['Estagio']['Length'] 				= 3;
			$this->attribute['Estagio']['NN'] 					= 0;

			$this->attribute['Sigla']['Type'] 					= 'varchar2';
			$this->attribute['Sigla']['Length'] 				= 30;
			$this->attribute['Sigla']['NN'] 					= 0;
				
			$this->attribute['SimNao_Id']['Type'] 				= 'number';
			$this->attribute['SimNao_Id']['Length'] 			= 15;
			$this->attribute['SimNao_Id']['NN'] 				= 0;		

			$this->recognize['Recognize']	= 'Nome'; 
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'DiscCat_qGeral';
			
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "DiscCat_qGeral";
			$this->query['qId'] 	= "DiscCat_qId";
				
		}
	}
?>