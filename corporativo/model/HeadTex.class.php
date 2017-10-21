<?php
	require_once ("../engine/Sql.class.php");
	
	class HeadTex extends Sql 
	{
	
		public $table = 'HeadTex';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		
		public function __construct($db)
		{	
			
			$this->db = $db;

			$this->query['qRegistro'] 	= "HeadTex_qRegistro";
			$this->query['qProcesso'] 	= "HeadTex_qProcesso";
				
		}
		
	}
?>