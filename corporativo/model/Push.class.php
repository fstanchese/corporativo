<?php

require_once ("../engine/Model.class.php");

class Push extends Model
{
	//Mapeamento da tabela do Banco de Dados
	public $table = 'Push';
	
	public $attribute     = array();
	public $query        = array();
	
	public $rows;
	
	public function __construct($db)
	{	
		$this->db = $db;
	
		$this->rows = 50000;	
	
		$this->attribute['WPessoa_Id']['Type'] 		= 'number';
		$this->attribute['WPessoa_Id']['Length'] 	= 15;
		$this->attribute['WPessoa_Id']['NN'] 		= 1;
		$this->attribute['WPessoa_Id']['Label'] 	= 'Pessoa ID';
	
		$this->attribute['GcmKey']['Type'] 			= 'varchar2';
		$this->attribute['GcmKey']['Length'] 		= 600;
		$this->attribute['GcmKey']['NN'] 			= 1;
		$this->attribute['GcmKey']['Label'] 		= 'GCM Key';

		$this->attribute['DtAcesso']['Type']		= 'date';
		$this->attribute['DtAcesso']['NN']			= 1;
		$this->attribute['DtAcesso']['Label']		= 'Data Acesso';
	
		//Calculates para a criaзгo de querys no diretуrio SQL	

		//Recognizes
		$this->recognize['Recognize'] = 'WPessoa_Id, GCMKey, DtAcesso';
			
		//Index
		$this->index['WPessoa'] = 'WPessoa_Id';
		
		
		//Todas as Queries da classe
		$this->query['qId'] 		= 'Push_qId';
		$this->query['qGeral'] 		= 'Push_qGeral';
		$this->query['qWPessoa'] 	= 'Push_qWPessoa';
			
	}
}


?>