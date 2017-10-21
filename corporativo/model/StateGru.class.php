<?php 
require_once ("../engine/Model.class.php");

class StateGru extends Model{
	public $table = 'StateGru';
	
	 
	public $attribute     = array();
	public $calculate     = array();
	public $query        = array();
	
	public function __construct($db){
		$this->db = $db;
		
		$this->rows = 100;
	
		$this->attribute['Nome']['Type'] 	= 'varchar2';
		$this->attribute['Nome']['Length']	= 50;
		$this->attribute['Nome']['NN'] 		= 1;
		$this->attribute['Nome']['Label'] 	= 'Grupo de Situaчѕes';
	
		$this->recognize['Recognize'] = 'Nome';
		
		//Calculates para a criaчуo de querys no diretѓrio SQL
		$this->calculate['Recognize'] = "Nome";		
		$this->calculate['Sistema'] = "StateGru_qSistema";
	
		 
	}
	
	public function GetState($vStateGru_Id){
		$dbData = new DbData($this->db);
		$dbData->Get("SELECT State_Id FROM statexstategru WHERE stategru_id = ".$vStateGru_Id);
		
		while($row = $dbData->Row()){
			$aRet[] = $row[STATE_ID];
		}
		
		return $aRet;
	}

}
?>