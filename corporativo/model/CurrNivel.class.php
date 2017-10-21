<?php
	require_once ("../engine/Model.class.php");
	
	class CurrNivel extends Model 
	{
	
		public $table = 'CurrNivel';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 35;
			$this->attribute['Nome']['NN'] 		= 1;

			$this->recognize['Recognize'] = 'Nome'; 
			
			$this->calculate['Geral'] = "CurrNivel_qGeral";
			$this->calculate['Curric'] = "CurrNivel_qCurr";
			
			$this->query["qCurr"] = "CurrNivel_qCurr";
			$this->query["qGeral"] = "CurrNivel_qGeral";
			$this->query["qId"] = "CurrNivel_qId";
				
		}
		
	}

?>