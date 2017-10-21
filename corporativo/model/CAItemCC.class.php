<?php 

	require_once("../engine/Model.class.php");
	 
	class CAItemCC extends Model
	{ 
		public $table = 'CAItemCC';
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query		= array();
		public $rows;
		
		public function __construct($db){
			$this->db = $db;
			
			$this->rows = 10000;
			
			$this->attribute['CAItem_Id']['Type'] 		= 'number';
			$this->attribute['CAItem_Id']['Length'] 	= 15;
			$this->attribute['CAItem_Id']['NN'] 		= 1;
			$this->attribute['CAItem_Id']['Label'] 		= 'Item';
			
			$this->attribute['Percentual']['Type'] 		= 'number';
			$this->attribute['Percentual']['Length'] 	= 4.2;
			$this->attribute['Percentual']['NN'] 		= 1;
			$this->attribute['Percentual']['Label'] 	= 'Percentual';
			
			$this->attribute['CCusto_Id']['Type'] 		= 'number';
			$this->attribute['CCusto_Id']['Length'] 	= 15;
			$this->attribute['CCusto_Id']['NN'] 		= 1;
			$this->attribute['CCusto_Id']['Label'] 		= 'Custo';

			
			$this->recognize["Recognize"] 	= "CAItem_Id, Percentual, CCusto_Id";

			$this->query["qGeral"] 			= "CAItemCC_qGeral";
			$this->query["qId"] 			= "CAItemCC_qId";
				
			$this->calculate["Geral"] 		= "CAItemCC_qGeral";
			
		}
	}
?>