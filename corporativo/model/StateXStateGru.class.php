<?php 
	require_once ("../engine/Model.class.php");
	
	class StateXStateGru extends Model
	{
		public $table = 'StateXStateGru';
		
		 
		public $attribute     = array();
		public $calculate     = array();
		public $query         = array();
		
		public function __construct($db)
		{
			$this->db = $db;
			
			$this->rows = 1000;
		
			$this->attribute['State_Id']['Type'] 		= 'number';
			$this->attribute['State_Id']['Length']		= 15;
			$this->attribute['State_Id']['NN'] 			= 1;
			$this->attribute['State_Id']['Label'] 		= 'Grupo de Situaчѕes';
			
			$this->attribute['StateGru_Id']['Type'] 	= 'number';
			$this->attribute['StateGru_Id']['Length']	= 15;
			$this->attribute['StateGru_Id']['NN'] 		= 1;
			$this->attribute['StateGru_Id']['Label'] 	= 'Id do Grupo de Situaчѕes';
			
			$this->attribute['Sistema_Id']['Type'] 		= 'number';
			$this->attribute['Sistema_Id']['Length']	= 15;
			$this->attribute['Sistema_Id']['NN'] 		= 1;
			$this->attribute['Sistema_Id']['Label'] 	= 'Id do Sistema';
		
			$this->recognize['Recognize'] = 'StateGru_Id, State_Id, Sistema_Id';
			//Calculates para a criaчуo de querys no diretѓrio SQL		 
		}
	}
?>