<?php
	require_once ("../engine/Model.class.php");
	
	class Modalidade extends Model 
	{
	
		public $table = 'Modalidade';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 35;
			$this->attribute['Nome']['NN'] 		= 1;
			
			$this->recognize['Recognize']	= 'Nome';
			
			$this->calculate['Geral'] = "Modalidade_qGeral";
				
				
			$this->query["qGeral"] = "Modalidade_qGeral";
			$this->query["qId"] = "Modalidade_qId";
				
		}
		
	}

?>