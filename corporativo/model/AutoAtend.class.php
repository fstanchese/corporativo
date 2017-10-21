<?php 
	require_once("../engine/Model.class.php");
	
	
	class AutoAtend extends Model{
		public $table = 'AutoAtend';
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query		= array();
		public $rows;
		
		public function __construct($db){
			$this->db = $db;
			
			$this->rows = 50;
			
			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 50;
			$this->attribute['Nome']['NN'] 			= 1;
			$this->attribute['Nome']['Label'] 		= 'Nome';
			
			$this->attribute['Icone']['Type'] 		= 'varchar2';
			$this->attribute['Icone']['Length'] 	= 50;
			$this->attribute['Icone']['NN'] 		= 1;
			$this->attribute['Icone']['Label'] 		= 'Ícone';
			
			$this->attribute['Acao']['Type'] 		= 'varchar2';
			$this->attribute['Acao']['Length'] 		= 30;
			$this->attribute['Acao']['NN'] 			= 1;
			$this->attribute['Acao']['Label'] 		= 'Acao';
			
			$this->attribute['Descricao']['Type'] 	= 'varchar2';
			$this->attribute['Descricao']['Length']	= 100;
			$this->attribute['Descricao']['NN'] 	= 0;
			$this->attribute['Descricao']['Label'] 	= 'Acao';
				

			
			$this->recognize["Recognize"] 	= "Nome, Icone, Acao";

			$this->query["qGeral"] 			= "AutoAtend_qGeral";
			$this->query["qId"] 			= "AutoAtend_qId";
				
			$this->calculate["Geral"] 		= "AutoAtend_qGeral";
			
		}
	}
?>