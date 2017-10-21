<?php
	require_once ("../engine/Model.class.php");
	
	class Banco extends Model {
	
		public $table = 'Banco';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
   
        public function __construct($db)
        {
        	$this->db = $db;
			$this->attribute['Numero']['Type'] 	= 'varchar2';
			$this->attribute['Numero']['Length']	= 4;
			$this->attribute['Numero']['NN'] 		= 0;
				
			
			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 50;
			$this->attribute['Nome']['NN'] 		= 1;
		
			$this->attribute['Ativo']['Type'] 	= 'varchar2';
			$this->attribute['Ativo']['Length']	= 3;
				
			$this->recognize['Recognize']	= 'Numero, Nome';
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Banco_qGeral';
			
			//Todas as Queries da classe
			$this->query['qGeral'] 	= 'Banco_qGeral';
			$this->query['qId']		= 'Banco_qId';
			$this->query['qAtivo']	= 'Banco_qAtivo';
		
			
		}
		
	}

?>