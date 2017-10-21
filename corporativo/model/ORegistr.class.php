<?php
	require_once ("../engine/Sql.class.php");
	
	class ORegistr extends Sql 
	{
	
		public $table = 'ORegistr';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		
		public function __construct($db)
		{	

				
			//Todas as Queries da classe
			$this->query['qGeral'] 	= "ORegistr_qGeral";
				
		}
		
	}
?>