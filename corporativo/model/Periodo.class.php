<?php
	require_once ("../engine/Model.class.php");
	
	class Periodo extends Model 
	{
	
		public $table = 'Periodo';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
        public function __construct($db)
        {
        	$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 20;
			$this->attribute['Nome']['NN'] 			= 1;
			
			$this->attribute['Sequencia']['Type'] 	= 'number';
			$this->attribute['Sequencia']['Length']	= 2;
			$this->attribute['Sequencia']['NN'] 	= 0;

			$this->recognize['Recognize']	= 'Nome';
			
            $this->calculate['Geral']	= 'Periodo_qGeral';
						
			$this->query["qCurso"]		= "Periodo_qCurso";
			$this->query["qGeral"]		= "Periodo_qGeral"; 
			$this->query["qId"]			= "Periodo_qId";
			$this->query["qSequencia"]	= "Periodo_qSequencia";			
			
		}
		
	}
	

?>