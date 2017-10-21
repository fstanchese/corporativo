<?php
	require_once ("../engine/Model.class.php");
	
	class Titulo extends Model {
	
		public $table = 'Titulo';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length'] 			= 200;
			$this->attribute['Nome']['NN'] 				= 1;	
			
			$this->attribute['NomeHTML']['Type'] 	    = 'varchar2';
			$this->attribute['NomeHTML']['Length'] 		= 200;
			$this->attribute['NomeHTML']['NN'] 			= 1;

			$this->attribute['Generico']['Type'] 		= 'varchar2';
			$this->attribute['Generico']['Length'] 		= 200;
			$this->attribute['Generico']['NN'] 			= 0;

			$this->attribute['Sequencia']['Type'] 		= 'number';
			$this->attribute['Sequencia']['Length'] 	= 2;
			$this->attribute['Sequencia']['NN'] 		= 0;

			$this->attribute['TamanhoFonte']['Type'] 	= 'number';
			$this->attribute['TamanhoFonte']['Length'] 	= 2;
			$this->attribute['TamanhoFonte']['NN'] 		= 0;
				
			$this->recognize['Recognize']	= 'Nome'; 
			
			$this->calculate['Geral'] = "Titulo_qGeral";
						
			
			$this->query["qGeral"] = "Titulo_qGeral";
			$this->query["qNome"] = "Titulo_qNome";
			$this->query["qId"] = "Titulo_qId";
			
		}
		
	}
?>