<?php

require_once ("../engine/Model.class.php");

class AtendEvento extends Model
{

	//Mapeamento da tabela do Banco de Dados
	public $table = 'AtendEvento';

	public $attribute = array();
	public $calculate = array();
	public $query     = array();	


        public function __construct($db)
        {
        	$this->db = $db;
		
		//Mapeamento dos atributos do Banco de Dados
		$this->attribute['Descricao']['Type'] 		= 'varchar2';
		$this->attribute['Descricao']['Length'] 	= 70;
		$this->attribute['Descricao']['NN'] 		= 0;
		$this->attribute['Descricao']['Label']		= "Nome do Evento";
		

		$this->attribute['Campus_Id']['Type'] 		= 'number';
		$this->attribute['Campus_Id']['Length'] 	= 15;
		$this->attribute['Campus_Id']['NN'] 		= 1;
		$this->attribute['Campus_Id']['Label']		= "Unidade";

		$this->attribute['DtInicio']['Type'] 		= 'date';
		$this->attribute['DtInicio']['NN'] 			= 1;
		$this->attribute['DtInicio']['Label']		= "Data Início";
		
		
		$this->attribute['DtTermino']['Type'] 		= 'date';
		$this->attribute['DtTermino']['NN'] 		= 1;
		$this->attribute['DtTermino']['Label']		= "Data Término";

		
		$this->index["Campus_idx"]["Cols"] = "Campus_Id";
		
		//Recognize Padrão
		$this->recognize["Recognize"] 	= "Descricao, Campus_Id";
		
	}			
		
}
?>