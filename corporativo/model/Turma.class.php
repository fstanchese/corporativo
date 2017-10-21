<?php
	require_once ("../engine/Model.class.php");
	
	class Turma extends Model {
	
		public $table = 'Turma';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Codigo']['Type'] 	= 'varchar2';
			$this->attribute['Codigo']['Length'] 	= 25;
			$this->attribute['Codigo']['NN'] 		= 1;

			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 50;
			$this->attribute['Nome']['NN'] 		= 0;
				
			$this->attribute['TurmaTi_Id']['Type'] 		= 'number';
			$this->attribute['TurmaTi_Id']['Length'] 	= 15;
			$this->attribute['TurmaTi_Id']['NN'] 		= 1;
			
			$this->attribute['Periodo_Id']['Type'] 		= 'number';
			$this->attribute['Periodo_Id']['Length'] 	= 15;
			$this->attribute['Periodo_Id']['NN'] 		= 0;

			$this->attribute['Campus_Id']['Type'] 		= 'number';
			$this->attribute['Campus_Id']['Length'] 	= 15;
			$this->attribute['Campus_Id']['NN'] 		= 1;
				
			$this->attribute['DuracXCi_Id']['Type'] 	= 'number';
			$this->attribute['DuracXCi_Id']['Length'] 	= 15;
			$this->attribute['DuracXCi_Id']['NN'] 		= 0;

			$this->attribute['Curso_Id']['Type'] 	= 'number';
			$this->attribute['Curso_Id']['Length'] 	= 15;
			$this->attribute['Curso_Id']['NN'] 		= 1;
				
			$this->attribute['DuracXCi_New_Id']['Type'] 	= 'number';
			$this->attribute['DuracXCi_New_Id']['Length'] 	= 15;
			$this->attribute['DuracXCi_New_Id']['NN'] 		= 0;
				
			$this->attribute['CodINEP']['Type'] 	= 'varchar2';
			$this->attribute['CodINEP']['Length'] 	= 14;
			$this->attribute['CodINEP']['NN'] 		= 0;
			
			$this->recognize['Recognize']	= 'Codigo';
		}
		
	}

?>