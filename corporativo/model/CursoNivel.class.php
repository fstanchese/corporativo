<?php
	require_once ("../engine/Model.class.php");
	
	class CursoNivel extends Model
	{
	
		public $table = 'CursoNivel';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Codigo']['Type'] 			= 'varchar2';
			$this->attribute['Codigo']['Length']	 	= 20;
			$this->attribute['Codigo']['NN'] 			= 1;
			
			$this->attribute['NomeCompleto']['Type'] 	= 'varchar2';
			$this->attribute['NomeCompleto']['Length'] 	= 30;
			$this->attribute['NomeCompleto']['NN'] 		= 1;

			$this->attribute['Acad']['Type'] 			= 'varchar2';
			$this->attribute['Acad']['Length'] 			= 3;
			$this->attribute['Acad']['NN'] 				= 0;
				
			$this->attribute['Sequencia']['Type'] 		= 'number';
			$this->attribute['Sequencia']['Length']		= 3;
			$this->attribute['Sequencia']['NN'] 		= 0;

			$this->recognize['Recognize']	= 'NomeCompleto';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'CursoNivel_qGeral';
				
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "CursoNivel_qGeral";
				
		}
		
	}

?>