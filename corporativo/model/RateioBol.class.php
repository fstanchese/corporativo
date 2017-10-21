<?php
 
require_once ("../engine/Model.class.php");
 
class RateioBol extends Model
{
	 
	//Mapeamento da tabela do Banco de Dados
	public $table = 'RateioBol';

	 
	public $attribute     = array();
	public $calculate     = array();
	public $query        = array();
	 

	public $rows;

	 
	public function __construct($db)
	{

		$this->db = $db;

		$this->rows = 30000;


		$this->attribute['Rateio_Id']['Type'] = 'number';
		$this->attribute['Rateio_Id']['Length'] = 15;
		$this->attribute['Rateio_Id']['NN'] = 1;
		$this->attribute['Rateio_Id']['Label'] = 'Rateio';

		$this->attribute['Valor']['Type'] = 'number';
		$this->attribute['Valor']['Length'] = '12,2';
		$this->attribute['Valor']['Label'] = 'Valor';
		$this->attribute['Valor']['NN'] = 1;

		$this->attribute['Data']['Type'] = 'date';
		$this->attribute['Data']['Label'] = 'Data do Lançamento do Crédito';
		$this->attribute['Data']['NN'] = 1;
		$this->attribute['Data']['Mask'] = 'd';

		$this->attribute['Boleto_Orig_Id']['Type'] = 'number';
		$this->attribute['Boleto_Orig_Id']['Length'] = 15;
		$this->attribute['Boleto_Orig_Id']['NN'] = 1;
		$this->attribute['Boleto_Orig_Id']['Label'] = 'Boleto Origem';

		$this->attribute['Boleto_Dest_Id']['Type'] = 'number';
		$this->attribute['Boleto_Dest_Id']['Length'] = 15;
		$this->attribute['Boleto_Dest_Id']['Label'] = 'Boleto Destino';

		$this->attribute['ValorAluno']['Type'] = 'number';
		$this->attribute['ValorAluno']['Length'] = '12,2';
		$this->attribute['ValorAluno']['Label'] = 'Valor restante gerado para o Aluno';
		$this->attribute['ValorAluno']['NN'] = 1;

		//Calculates para a criação de querys no diretório SQL


		//Recognizes

		//Índices

		//Todas as Queries da classe
		$this->query['qBoletoDestino'] = 'RateioBol_qBoletoDestino';
		$this->query['qPeriodo'] = 'RateioBol_qPeriodo';
		$this->query['qGeral'] = 'RateioBol_qGeral';
		$this->query['qAlfabetizacao'] = 'RateioBol_qAlfabetizacao';
		$this->query['qContabilidade'] = 'RateioBol_qContabilidade';
		$this->query['qId'] = 'RateioBol_qId';

		 
	}
	
	
	
	//Retorna valor que foi rateado para outro boleto.
	function GetValorDestino($Boleto_Id,$dBase = '')
	{
		
		if ($dBase == '')
			$dBase = date('d/m/Y');
				
	
		$sql = "select
			replace(rateiobol.valor,',','.') 	as Valor
		from
			rateiobol
		where
			to_Date(dt) <= to_Date( '" . $dBase . "')
		and
			rateiobol.boleto_orig_id = '". $Boleto_Id ."'";
		 
		 
		$dbData = new DbData($this->db);
	
		$nReturn = 0;
	
		$dbData->Get($sql);
	
		while ($row = $dbData->Row())
		{			
			$nReturn += $row['Valor'];
		}
		
		unset($dbData);
		
		return $nReturn;
	}
	
	
	//Retorna informações do rateio através do boleto_destino_Id.
	function GetRateio($Boleto_Destino_Id,$dBase)
	{
	
		if ($dBase == '')
			$dBase = date('d/m/Y');
	
	
		$sql = "select
			boleto_orig_id as boleto_id,
			replace(rateiobol.valor,',','.') 	as Valor
		from
			rateiobol
		where
			to_Date(dt) <= to_Date( '" . $dBase . "')
		and
			rateiobol.boleto_dest_id = '". $Boleto_Destino_Id ."'";			
			
		$dbData = new DbData($this->db);
	
		$dbData->Get($sql);
	
		$row = $dbData->Row();

		unset($dbData);
				
		return $row;
	}	
}

?>