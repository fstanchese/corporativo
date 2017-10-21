<?php
	require_once ("../engine/Sql.class.php");
	
	class DTexto extends Sql 
	{
	
		public $table = 'DTexto';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		
		public function __construct($db)
		{	
			
			$this->db = $db;

			$this->query['qTexto'] 	= "DTexto_qTexto";
				
		}
		
	}
?>