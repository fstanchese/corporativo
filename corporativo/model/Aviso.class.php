<?php

require_once ("../engine/Model.class.php");
 
class Aviso extends Model
{
	//Mapeamento da tabela do Banco de Dados
	public $table = 'Aviso';	
	 
	public $attribute     = array();	
	public $query        = array();	 
	
	public $rows;
	
	 
	public function __construct($db)
	{
	
		$this->db = $db;
	
		$this->rows = 5000;
	
	
		$this->attribute['Titulo']['Type'] 			= 'varchar2';
		$this->attribute['Titulo']['Length'] 		= 50;
		$this->attribute['Titulo']['NN'] 			= 1;
		$this->attribute['Titulo']['Label'] 		= 'Tнtulo';
	
		$this->attribute['Mensagem']['Type'] 		= 'varchar2';
		$this->attribute['Mensagem']['Length'] 		= 600;
		$this->attribute['Mensagem']['NN'] 			= 1;
		$this->attribute['Mensagem']['Label'] 		= 'Mensagem';
		
		$this->attribute['DtInicio']['Type']		= 'date';
		$this->attribute['DtInicio']['NN']			= 1;
		$this->attribute['DtInicio']['Label']		= 'Data de Inнcio';
	
		$this->attribute['DtTermino']['Type']		= 'date';
		$this->attribute['DtTermino']['NN']			= 1;
		$this->attribute['DtTermino']['Label']		= 'Data de Inнcio';		
				
		//Calculates para a criaзгo de querys no diretуrio SQL	
	
		//Recognizes
		$this->recognize['Recognize'] = 'Titulo, Mensagem';
	
			
		//Todas as Queries da classe
		$this->query['qId'] 	= 'Aviso_qId';
		$this->query['qGeral'] 	= 'Aviso_qGeral';
		
		 
	}
}


?>