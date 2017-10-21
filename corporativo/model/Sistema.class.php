<?php 
	require_once("../engine/Model.class.php");
	
	Class Sistema extends Model{
		public $table = 'Sistema';
		
		public $attribute     = array();
		public $query        = array();
		
		public $rows;
		
		public function __construct($db){
			$this->db = $db;

			$this->attribute['Id']['Type'] 		= 'integer';
			$this->attribute['Id']['Length'] 	= '15';
			$this->attribute['Id']['NN'] 		= '1';
			$this->attribute['Id']['Label'] 	= 'Sistema';

			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length']	= 50;
			$this->attribute['Nome']['NN'] 		= 1;
			$this->attribute['Nome']['Label'] 	= 'Nome do Sistema';
			
			$this->recognize['Recognize'] = "Nome";
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Recognize'] = "Nome";
		}
	
	}
?>