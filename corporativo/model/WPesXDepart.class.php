<?php
	require_once ("../engine/Model.class.php");
	
	class WPesXDepart extends Model{
	
		public $table = 'WPesXDepart';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		public function __construct($db)
		{
			$this->db = $db;
		
			$this->attribute['WPessoa_Id']['Type'] 		= 'number';
			$this->attribute['WPessoa_Id']['Length'] 	= 15;
			$this->attribute['WPessoa_Id']['NN'] 		= 1;

			$this->attribute['Depart_Id']['Type'] 	= 'number';
			$this->attribute['Depart_Id']['Length'] = 15;
			$this->attribute['Depart_Id']['NN'] 	= 1;			
		
			$this->attribute['DtInicio']['Type'] 	= 'date';
			$this->attribute['DtTermino']['Type'] 	= 'date';
			
			$this->attribute['Teste_CPD']['Type']	= 'varchar2';
			$this->attribute['Teste_CPD']['Length'] = 3;
			$this->attribute['Teste_CPD']['NN'] 	= 0;
			
			$this->recognize['Recognize']	= 'WPessoa_Id, Depart_Id, DtInicio';
			
			$this->calculate["Depart_Id"] 			= 'Andar_qGeralSS';			
			
		}
		
	}
?>