<?php

require_once ("../engine/Model.class.php");
 
class Rateio extends Model
{
	 
	//Mapeamento da tabela do Banco de Dados
	public $table = 'Rateio';

	 
	public $attribute     = array();
	public $calculate     = array();
	public $query        = array();
	 

	public $rows;

	 
	public function __construct($db)
	{

		$this->db = $db;

		$this->rows = 10000;


		$this->attribute['WPessoa_Id']['Type'] = 'number';
		$this->attribute['WPessoa_Id']['Length'] = 15;
		$this->attribute['WPessoa_Id']['NN'] = 1;
		$this->attribute['WPessoa_Id']['Label'] = 'Aluno';

		$this->attribute['Empresa_Id']['Type'] = 'number';
		$this->attribute['Empresa_Id']['Length'] = 15;
		$this->attribute['Empresa_Id']['NN'] = 1;
		$this->attribute['Empresa_Id']['Label'] = 'Empresa';

		$this->attribute['DtInicio']['Type'] = 'date';
		$this->attribute['DtInicio']['NN'] = 1;
		$this->attribute['DtInicio']['Mask'] = 'd';
		$this->attribute['DtInicio']['Label'] = 'Inнcio';

		$this->attribute['DtTermino']['Type'] = 'date';
		$this->attribute['DtTermino']['NN'] = 1;
		$this->attribute['DtTermino']['Mask'] = 'd';
		$this->attribute['DtTermino']['Label'] = 'Tйrmino';

		$this->attribute['Percentual']['Type'] = 'number';
		$this->attribute['Percentual']['Length'] = 7.4;
		$this->attribute['Percentual']['Label'] = 'Percentual';

		$this->attribute['Valor']['Type'] = 'number';
		$this->attribute['Valor']['Length'] = 12.2;
		$this->attribute['Valor']['Label'] = 'Valor';

		$this->attribute['State_Id']['Type'] = 'number';
		$this->attribute['State_Id']['Length'] = 15;
		$this->attribute['State_Id']['NN'] = 1;
		$this->attribute['State_Id']['Label'] = 'Situaзгo';

		$this->attribute['Mensalidade']['Type'] = 'varchar2';
		$this->attribute['Mensalidade']['Length'] = 3;
		$this->attribute['Mensalidade']['Label'] = 'Mensalidade';

		$this->attribute['MoraMulta']['Type'] = 'varchar2';
		$this->attribute['MoraMulta']['Length'] = 3;
		$this->attribute['MoraMulta']['Label'] = 'Mora e Multa';

		$this->attribute['DPAdap']['Type'] = 'varchar2';
		$this->attribute['DPAdap']['Length'] = 3;
		$this->attribute['DPAdap']['Label'] = 'Dependкncia e Adaptaзгo';

		$this->attribute['RateioTi_Id']['Type'] = 'number';
		$this->attribute['RateioTi_Id']['Length'] = 15;
		$this->attribute['RateioTi_Id']['Label'] = 'Tipo de Rateio';

		//Calculates para a criaзгo de querys no diretуrio SQL
		$this->calculate['Empresa_DistinctId'] = 'Rateio_qEmpresaDistinct';


		//Recognizes
		$this->recognize['Recognize'] = 'WPessoa_Id,DtInicio,DtTermino';

		//Нndices

		//Todas as Queries da classe
		$this->query['qAno'] = 'Rateio_qAno';
		$this->query['qGeraArqSolidare'] = 'Rateio_qGeraArqSolidare';
		$this->query['qGeral'] = 'Rateio_qGeral';
		$this->query['qId'] = 'Rateio_qId';
		$this->query['qEmpresaCompetencia'] = 'Rateio_qEmpresaCompetencia';
		$this->query['qPessoa'] = 'Rateio_qPessoa';

		
	}
}

?>