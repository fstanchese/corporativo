<?php 
	require_once("../engine/Model.class.php");
	
	
	class CAItem extends Model{
		public $table = 'CAItem';
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query		= array();
		public $rows;
		
		public function __construct($db){
			$this->db = $db;
			
			$this->rows = 50;
			
			$this->attribute['CA_Id']['Type'] 		= 'number';
			$this->attribute['CA_Id']['Length'] 	= 15;
			$this->attribute['CA_Id']['NN'] 		= 1;
			$this->attribute['CA_Id']['Label'] 		= 'CA';
			
			$this->attribute['Item']['Type'] 		= 'number';
			$this->attribute['Item']['Length'] 		= 12;
			$this->attribute['Item']['NN'] 			= 1;
			$this->attribute['Item']['Label'] 		= 'Item';
			
			$this->attribute['Valor']['Type'] 		= 'number';
			$this->attribute['Valor']['Length'] 	= 12.2;
			$this->attribute['Valor']['NN'] 		= 1;
			$this->attribute['Valor']['Label'] 		= 'Valor';
			
			$this->attribute['Descricao']['Type'] 	= 'varchar2';
			$this->attribute['Descricao']['Length'] = 150;
			$this->attribute['Descricao']['NN'] 	= 1;
			$this->attribute['Descricao']['Label'] 	= 'Descriчуo';
			
			$this->attribute['Cancelado']['Type'] 	= 'varchar2';
			$this->attribute['Cancelado']['Length'] 	= 3;
			$this->attribute['Cancelado']['NN'] 		= 1;
			$this->attribute['Cancelado']['Label'] 	= 'Excluir Item';
			
			$this->recognize["Recognize"] 	= "CA_Id, Item, Descricao, Valor";

			$this->query["qGeral"] 			= "CAItem_qGeral";
			$this->query["qId"] 			= "CAItem_qId";
				
			$this->calculate["Geral"] 		= "CAItem_qGeral";
			
		}
	}
?>