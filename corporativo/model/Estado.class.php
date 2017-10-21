<?php
	require_once ("../engine/Model.class.php");
	
	class Estado extends Model 
	{
	
		public $table = 'Estado';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

        public function __construct($db)
        {
        	$this->db = $db;	
		
			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length'] 			= 30;
			$this->attribute['Nome']['NN'] 				= 1;
		
			$this->attribute['Sigla']['Type'] 			= 'varchar2';
			$this->attribute['Sigla']['Length']			= 2;
			$this->attribute['Sigla']['NN'] 			= 1;
				
			$this->attribute['Preposicao']['Type'] 		= 'varchar2';
			$this->attribute['Preposicao']['Length']	= 2;
			$this->attribute['Preposicao']['NN'] 		= 0;
				
			$this->attribute['CodCenso']['Type'] 		= 'varchar2';
			$this->attribute['CodCenso']['Length']		= 2;
			$this->attribute['CodCenso']['NN'] 			= 0;

			$this->recognize['Recognize']	= 'Nome';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Estado_qGeral';
			
			$this->query["qGeral"]		= "Estado_qGeral";
			$this->query["qId"]			= "Estado_qId";
			$this->query["qProvao"]		= "Estado_qProvao";
			
		}
		
		
		public function GetSigla($Estado_Id)
		{
			$aReturn = $this->GetInfo($Estado_Id);
		
			return $aReturn['Sigla'];
		
		}
		
		
	}

?>