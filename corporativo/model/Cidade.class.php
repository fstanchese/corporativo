<?php
	require_once ("../engine/Model.class.php");
	
	class Cidade extends Model 
	{
	
		public $table = 'Cidade';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		
		public function __construct($db)
		{
			$this->db = $db;	
		
			$this->attribute['Estado_Id']['Type'] 		= 'int';
			$this->attribute['Estado_Id']['Length']		= 15;
			$this->attribute['Estado_Id']['NN'] 		= 1;
		
			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length']			= 30;
			$this->attribute['Nome']['NN'] 				= 1;
				
			$this->attribute['CodExterno']['Type'] 		= 'number';
			$this->attribute['CodExterno']['Length']	= 10;
			$this->attribute['CodExterno']['NN'] 		= 0;
				
			$this->attribute['Capital']['Type'] 		= 'number';
			$this->attribute['Capital']['Length']		= 1;
			$this->attribute['Capital']['NN'] 			= 0;

			$this->attribute['CodCenso']['Type'] 		= 'varchar2';
			$this->attribute['CodCenso']['Length']		= 7;
			$this->attribute['CodCenso']['NN'] 			= 0;

			$this->recognize['Recognize']	= 'Nome';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Cidade_qGeral';
			$this->calculate['Estado']	= 'Cidade_qEstado';
			
			$this->query["qEstado"] 		= "Cidade_qEstado";
			$this->query["qGeral"] 			= "Cidade_qGeral";
			$this->query["qId"] 			= "Cidade_qId";
			$this->query["qLetraInicio"] 	= "Cidade_qLetraInicio";
			$this->query["qProvao"] 		= "Cidade_qProvao";
			
		}
		
	}

?>