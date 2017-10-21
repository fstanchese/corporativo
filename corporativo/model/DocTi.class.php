<?php

	require_once ("../engine/Model.class.php");

	class DocTi extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'DocTi';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 50;
		
			$this->attribute['Nome']['Type']	 	= 'varchar2';
			$this->attribute['Nome']['Length']		= 100;
			$this->attribute['Nome']['NN']	 		= 0;
			$this->attribute['Nome']['Label'] 		= 'Tipo de Documento';
			
			$this->calculate['Geral']		= 'DocTi_qGeral';
		
			$this->recognize['Recognize'] 	= 'Nome';

			$this->index['Nome']['Cols'] 	= 'Nome';
			
			$this->query['Geral']			= 'DocTi_qGeral';
			$this->query['Id']				= 'DocTi_qId';
			
		}
		
		
		
	}
	
	
?>