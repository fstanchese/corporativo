<?php
	require_once ("../engine/Model.class.php");
	
	class Bairro extends Model {
	
		public $table = 'Bairro';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
	
		public function __construct($db)
		{
			$this->db = $db;
		
			$this->attribute['Cidade_Id']['Type'] 		= 'int';
			$this->attribute['Cidade_Id']['Length']		= 15;
			$this->attribute['Cidade_Id']['NN'] 		= 1;
		
			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length']			= 40;
			$this->attribute['Nome']['NN'] 				= 1;
				
			$this->attribute['CodExterno']['Type'] 		= 'number';
			$this->attribute['CodExterno']['Length']	= 10;
			$this->attribute['CodExterno']['NN'] 		= 0;
				
			$this->attribute['CodExtCid']['Type'] 		= 'number';
			$this->attribute['CodExtCid']['Length']		= 10;
			$this->attribute['CodExtCid']['NN'] 		= 0;
							
			$this->recognize['Recognize']	= 'Nome';
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->query['qId'] 			= "Bairro_qId";
			$this->query['qCEP'] 			= "Bairro_qCEP";
			$this->query['qSelecao']		= "Bairro_qSelecao";
			$this->query['qSelecaoCount']	= "Bairro_qSelecaoCount";
						
		}
		
	}

?>