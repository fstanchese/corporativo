<?php

	require_once ("../engine/Model.class.php");

	class LoteProc extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'LoteProc';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 50;
		
			$this->attribute['Nome']['Type']	= 'varchar2';
			$this->attribute['Nome']['Length']	= 100;
			$this->attribute['Nome']['NN']	 	= 0;
			$this->attribute['Nome']['Label'] 	= 'Tipo de Processo de Lote';
			
			$this->calculate['Geral']		= 'LoteProc_qGeral';
		
			$this->recognize['Recognize'] 	= 'Nome';

			$this->index['Nome']['Cols'] 	= 'Nome';
			
			$this->query['Geral']			= 'LoteProc_qGeral';
			$this->query['Id']				= 'LoteProc_qId';
			
		}
		
		
		
		
	}
	
	
?>