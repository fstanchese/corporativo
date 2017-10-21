<?php

require_once ("../engine/Model.class.php");

class TempCheck extends Model
{

	//Mapeamento da tabela do Banco de Dados
	public $table = 'TempCheck';

	public $attribute = array();
	public $calculate = array();
	public $query     = array();	


        public function __construct($db)
        {
        	$this->db = $db;
		
		//Mapeamento dos atributos do Banco de Dados
		$this->attribute['Nome']['Type'] 		= 'varchar2';
		$this->attribute['Nome']['Length'] 		= 50;
		$this->attribute['Nome']['NN'] 			= 1;
		$this->attribute['Nome']['Label']		= "Nome";
		

		$this->attribute['Descricao']['Type'] 	= 'varchar2';
		$this->attribute['Descricao']['Length'] = 400;
		$this->attribute['Descricao']['NN'] 	= 0;
		$this->attribute['Descricao']['Label']	= "Descriзгo";

		$this->attribute['Prioridade_Id']['Type'] 	= 'number';
		$this->attribute['Prioridade_Id']['Length'] = 15;
		$this->attribute['Prioridade_Id']['NN'] 	= 1;
		$this->attribute['Prioridade_Id']['Label']	= "Prioridade";

		$this->attribute['Ciclo_Id']['Type'] 	= 'number';
		$this->attribute['Ciclo_Id']['Length']	= 15;
		$this->attribute['Ciclo_Id']['NN'] 		= 1;
		$this->attribute['Ciclo_Id']['Label']	= "Ciclo";

		$this->attribute['Depart_Id']['Type'] 	= 'number';
		$this->attribute['Depart_Id']['Length']	= 15;
		$this->attribute['Depart_Id']['NN'] 	= 0;
		$this->attribute['Depart_Id']['Label'] 	= "Departamento";

		$this->attribute['Confirmado']['Type'] 		= 'varchar2';
		$this->attribute['Confirmado']['Length']	= 3;
		$this->attribute['Confirmado']['NN'] 		= 0;
		$this->attribute['Confirmado']['Label']		= "Confirmado?";

		$this->attribute['TempCheck_Pai_Id']['Type'] 	= 'number';
		$this->attribute['TempCheck_Pai_Id']['Length']	= 15;
		$this->attribute['TempCheck_Pai_Id']['NN'] 		= 0;
		$this->attribute['TempCheck_Pai_Id']['Label']	= "Relacionado com o Mуdulo";

		$this->attribute['TempCheckEv_Id']['Type'] 		= 'number';
		$this->attribute['TempCheckEv_Id']['Length']	= 15;
		$this->attribute['TempCheckEv_Id']['NN'] 		= 0;
		$this->attribute['TempCheckEv_Id']['Label']		= "Evento";
		
		$this->attribute['WPessoa_Resp_Id']['Type'] 		= 'number';
		$this->attribute['WPessoa_Resp_Id']['Length']	= 15;
		$this->attribute['WPessoa_Resp_Id']['NN'] 		= 0;
		$this->attribute['WPessoa_Resp_Id']['Label']	= "Responsбvel";
		
		
		$this->index["idx1"]["Cols"] = "Nome";
		$this->index["idx1"]["Unique"] = 0;
		
		$this->index["idx2"]["Cols"] = "TempCheck_Pai_Id, TempCheckEv_Id";
		$this->index["idx2"]["Unique"] = 1;
		
		
		//Recognize Padrгo
		$this->recognize["Recognize"] = "TempCheck_Pai_Id, TempCheckEv_Id";
		
		
		//tabela_gsNOMEDORECOGNIZE
		$this->recognize["idx2"] = "TempCheck_Pai_Id";
		
		
		

		

		//Calculates para a criaзгo de querys no diretуrio SQL
		$this->calculate['Modulo']			= 'TempCheck_qGeral';
		$this->calculate['Prioridade']		= 'Prioridade_qGeral';
		$this->calculate['Evento'] 			= 'TempCheckEv_qGeral';
		$this->calculate['Periodicidade'] 	= 'Ciclo_qGeral';
		$this->calculate['Departamento'] 	= 'Depart_qGeral';
		$this->calculate['Usuario']		 	= 'TempCheck_qFunc';

		
		//Todas as Queries da classe
		$this->query['qGeral'] 	= "TempCheck_qGeral";
		$this->query['qId'] 	= "TempCheck_qId";
		$this->query['qLista'] 	= "TempCheck_qLista";
		
	}			
		
}
?>