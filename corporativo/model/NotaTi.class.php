<?php
	require_once ("../engine/Sql.class.php");
	
	class NotaTi extends Model 
	{
	
		public $table = 'NotaTi';
		
		public $attribute	= array();
		public $calculate	= array();
		public $index		= array();
		
		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 	= 'varchar2';
			$this->attribute['Nome']['Length'] 	= 20;
			$this->attribute['Nome']['NN'] 		= 1;

			$this->attribute['Valor']['Type'] 	= 'number';
			$this->attribute['Valor']['Length']	= 3.1;
			$this->attribute['Valor']['NN'] 	= 1;
			$this->attribute['Valor']['Label'] 	= 'Valor';
			
			$this->recognize['Recognize']	= 'Nome';
			
			$this->calculate['Geral'] = "NotaTi_qGeral";
				
			
			$this->query["qGeral"]		= "NotaTi_qGeral";
			$this->query["qId"] 		= "NotaTi_qId";
			$this->query["qCurrXDisc"] 	= "NotaTi_qCurrXDisc";
				
		}
		
	}
?>