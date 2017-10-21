<?php
	require_once ("../engine/Model.class.php");
	
	class Ano extends Model {
	
		public $table = 'Ano';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		
		public function __construct($db)
		{
			$this->db = $db;
		
 			$this->attribute['Ano']['Type'] 			= 'varchar2';
			$this->attribute['Ano']['Length'] 			= 4;
			$this->attribute['Ano']['NN'] 				= 1;
			
			$this->attribute['PLetivo_Id']['Type'] 		= 'number';
			$this->attribute['PLetivo_Id']['Length']	= 15;
			$this->attribute['PLetivo_Id']['NN'] 		= 0;			
			
			$this->recognize['Recognize']				= 'Ano';
			
			$this->calculate['Geral'] = "Ano_qGeral";
						
			
			$this->query["qGeral"] = "Ano_qGeral";
			$this->query["qId"] = "Ano_qId";
			
		}
		
	}
?>