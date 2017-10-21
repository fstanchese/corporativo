<?php
	require_once ("../engine/Model.class.php");
	
	class SisMenuRel extends Model {
	
		public $table = 'SisMenuRel';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	
			
			$this->rows = 20000;
		
 			$this->attribute['IndexGUI_Id']['Type'] 	= 'number';
			$this->attribute['IndexGUI_Id']['Length'] 	= 15;
			$this->attribute['IndexGUI_Id']['NN'] 		= 1;
			
			
			$this->attribute['IndexGUI_Link_Id']['Type'] 	= 'number';
			$this->attribute['IndexGUI_Link_Id']['Length']	= 15;
			$this->attribute['IndexGUI_Link_Id']['NN'] 		= 1;
			
			$this->recognize['Recognize']	= 'IndexGUI_Id, IndexGUI_Link_Id'; 
				
			$this->index["IndexGUI_Idx"] 		= "IndexGUI_Id";
			$this->index["IndexGUI_Link_Idx"] 	= "IndexGUI_Link_Id";
			
			$this->query["qGeral"] 	= "SisMenuRel_qGeral";
			$this->query["qId"] 	= "SisMenuRel_qId";
			 
		}
		
	}

?>