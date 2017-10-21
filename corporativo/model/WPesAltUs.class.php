<?php

require_once ("../engine/Model.class.php");

class WPesAltUs extends Model
{

	//Mapeamento da tabela do Banco de Dados
	public $table = 'WPesAltUs';

	public $attribute = array();
	public $calculate = array();	
	
	public function __construct($db)
	{
		$this->db = $db;
		
		//Mapeamento dos atributos do Banco de Dados
        $this->attribute['WPessoa_Id']['Type'] = 'number';
		$this->attribute['WPessoa_Id']['Length'] = 15;
		$this->attribute['WPessoa_Id']['NN'] = 1;

        $this->attribute['UsOld']['Type'] = 'varchar2';
		$this->attribute['UsOld']['Length'] = 30;
		$this->attribute['UsOld']['NN'] = 1;
  
        $this->attribute['UsNew']['Type'] = 'varchar2';
		$this->attribute['UsNew']['Length'] = 30;
		$this->attribute['UsNew']['NN'] = 1;

        $this->attribute['Obs']['Type'] = 'varchar2';
		$this->attribute['Obs']['Length'] = 100;
		$this->attribute['Obs']['NN'] = 0;


		$this->recognize['Recognize']	= 'WPessoa_Id, UsOld, UsNew'; 
		
		//Calculates para a criaзгo de querys no diretуrio SQL
		$this->calculate['Modulo'] = 'WPesAltUs_qGeral';

		
		//Todas as Querys da classe
		$this->query['qGeral'] 	= "WPesAltUs_qGeral";
		$this->query['qId'] 	= "WPesAltUs_qId";
	}
			
}

?>