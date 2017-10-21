<?php
	require_once ("../engine/Model.class.php");
	
	class Campus extends Model {
	
		public $table = 'Campus';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		
		public function __construct($db)
		{
			$this->db = $db;
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 20;
			$this->attribute['Nome']['NN'] 		= 1;
			$this->attribute['Nome']['Label'] 	= "Unidade";
			
			$this->attribute['IPClasse']['Type'] 	= 'varchar2';
			$this->attribute['IPClasse']['Length']	= 10;
			$this->attribute['IPClasse']['NN'] 		= 0;
			$this->attribute['IPClasse']['Label'] 	= "IP";

			$this->recognize['Recognize']	= 'Nome';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Campus_qGeral';
			
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "Campus_qGeral";
			$this->query['qId']		= "Campus_qId";
				
			
		}
		
	}

?>