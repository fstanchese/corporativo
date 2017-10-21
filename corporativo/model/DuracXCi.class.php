<?php
	require_once ("../engine/Model.class.php");
	
	class DuracXCi extends Model
	 {
	
		public $table = 'DuracXCi';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 30;
			$this->attribute['Nome']['NN'] 		= 1;
			
			$this->attribute['Sequencia']['Type'] 	= 'number';
			$this->attribute['Sequencia']['Length']	= 4;
			$this->attribute['Sequencia']['NN'] 	= 1;
			
			$this->attribute['Durac_Id']['Type'] 	= 'number';
			$this->attribute['Durac_Id']['Length'] 	= 15;
			$this->attribute['Durac_Id']['NN'] 		= 1;
				
			$this->attribute['NomeHTML']['Type'] 	= 'varchar2';
			$this->attribute['NomeHTML']['Length']	= 30;
			$this->attribute['NomeHTML']['NN'] 		= 0;

			$this->recognize['Recognize']	= 'Nome';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Curr']	= 'DuracXCi_qCurr';

			//Todas as Queries da classe
			$this->query['qCurr']		= "DuracXCi_qCurr";				
				
		}
		
	}

?>