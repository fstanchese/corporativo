<?php
	require_once ("../engine/Model.class.php");
	
	class Depart extends Model
	{
	
		public $table = 'Depart';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;	

			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length'] 			= 50;
			$this->attribute['Nome']['NN'] 				= 1;

			$this->attribute['NomeReduz']['Type'] 	= 'varchar2';
			$this->attribute['NomeReduz']['Length'] 	= 50;
			$this->attribute['NomeReduz']['NN'] 		= 1;
			
			$this->attribute['WPessoa_Id']['Type'] 		= 'number';
			$this->attribute['WPessoa_Id']['Length']	= 15;
			$this->attribute['WPessoa_Id']['NN'] 		= 0;

			$this->attribute['Depart_Pai_Id']['Type'] 	= 'number';
			$this->attribute['Depart_Pai_Id']['Length']	= 15;
			$this->attribute['Depart_Pai_Id']['NN'] 	= 0;
				
			$this->attribute['Email']['Type'] 			= 'varchar2';
			$this->attribute['Email']['Length'] 		= 200;
			$this->attribute['Email']['NN'] 			= 0;

			$this->recognize['Recognize']				= 'Depart_Pai_Id,Nome';
			
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "Depart_qGeral";
			$this->query['qId'] 	= "Depart_qId";
				
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Depart_qGeral';
				
		}
	}
?>