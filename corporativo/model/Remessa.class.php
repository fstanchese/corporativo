<?php

	require_once ("../engine/Model.class.php");
	
	class Remessa extends Model {
	
		public $table = 'Remessa';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db; 
			
			$this->rows = 200;
			
 			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 70;
			$this->attribute['Nome']['NN'] 			= 1;
			$this->attribute['Nome']['Label']		= 'Nome';
			
			$this->attribute['DtEnvio']['Type'] 	= 'date';
			$this->attribute['DtEnvio']['Label']	= 'Data de Envio';
			$this->attribute['DtEnvio']['Mask']		= 'd';
			
			$this->recognize['Recognize']			= 'Nome';
			
			//Todas as Queries da classe
			$this->query["qGeral"] = "Remessa_qGeral";
			$this->query["qId"] = "Remessa_qId";
			$this->query["qNaoEnviada"] = "Remessa_qNaoEnviada";
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate["NaoEnviada"] = "Remessa_qNaoEnviada";			
						
		}
		
	}

?>