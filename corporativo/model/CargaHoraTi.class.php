<?php
	require_once ("../engine/Model.class.php");
	
	class CargaHoraTi extends Model {
	
		public $table = 'CargaHoraTi';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		public function __construct($db)
		{
			$this->db = $db;
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 20;
			$this->attribute['Nome']['NN'] 		= 1;

			$this->attribute['Nick']['Type'] 	= 'varchar2';
			$this->attribute['Nick']['Length'] 	= 6;
			$this->attribute['Nick']['NN'] 		= 0;
				
			$this->recognize['Recognize']	= 'Nome';
			
			$this->calculate['Geral'] = "CargaHoraTi_qGeral";
				
				
			$this->query["qGeral"]	= "CargaHoraTi_qGeral";
			$this->query["qId"] 	= "CargaHoraTi_qId";
				
		}
		
	}
?>