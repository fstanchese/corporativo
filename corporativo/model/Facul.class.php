<?php
	require_once ("../engine/Model.class.php");
	
	class Facul extends Model 
	{
	
		public $table = 'Facul';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();


        public function __construct($db)
        {
        	$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 					= 'varchar2';
			$this->attribute['Nome']['Length'] 					= 20;
			$this->attribute['Nome']['NN'] 						= 1;		
		
			$this->attribute['AreaAcad_Id']['Type'] 			= 'number';
			$this->attribute['AreaAcad_Id']['Length']			= 15;
			$this->attribute['AreaAcad_Id']['NN'] 				= 1;
			
			$this->attribute['NomeCompleto']['Type'] 			= 'varchar2';
			$this->attribute['NomeCompleto']['Length'] 			= 200;
			$this->attribute['NomeCompleto']['NN'] 				= 1;
				
			$this->attribute['Depart_Id']['Type'] 				= 'number';
			$this->attribute['Depart_Id']['Length'] 			= 15;
			$this->attribute['Depart_Id']['NN'] 				= 0;
				
			$this->attribute['WPessoa_Diretor_Id']['Type']	 	= 'number';
			$this->attribute['WPessoa_Diretor_Id']['Length'] 	= 15;
			$this->attribute['WPessoa_Diretor_Id']['NN'] 		= 0;

			$this->recognize['Recognize']	= 'Nome'; 
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "Facul_qGeral";
				
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral']	= 'Facul_qGeral';
				
		}
		
	}

?>