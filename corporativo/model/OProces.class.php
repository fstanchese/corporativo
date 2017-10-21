<?php
	require_once ("../engine/Sql.class.php");
	
	class OProces extends Sql 
	{
	
		public $table = 'OProces';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		
		public function __construct()
		{	

			//Todas as Queries da classe
			$this->query['qProcesso'] 	= "OProces_qProcesso";
			$this->query['qProntua'] 	= "OProces_qProntua";
			$this->query['qGeral'] 		= "OProces_qGeral";
				
		}
		
	}
?>