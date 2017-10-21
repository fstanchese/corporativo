<?php
	require_once ("../engine/Model.class.php");
	
	class TurmaTi extends Model {
	
		public $table = 'TurmaTi';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	


			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 20;
			$this->attribute['Nome']['NN'] 		= 1;

			$this->recognize['Recognize']	= 'Nome';
			
		}
			
	}
			
?>