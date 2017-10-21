<?php
 
require_once ("../engine/Model.class.php");
 
class DebCred extends Model
{
	 
	//Mapeamento da tabela do Banco de Dados
	public $table = 'DebCred';

	 
	public $attribute     = array();
	public $calculate     = array();
	public $query        = array();
	 

	public $rows;

	 
	public function __construct($db)
	{

		$this->db = $db;

		$this->rows = 1000000;


		$this->attribute['WPessoa_Id']['Type'] = 'number';
		$this->attribute['WPessoa_Id']['Length'] = 15;
		$this->attribute['WPessoa_Id']['Label'] = 'Pessoa';

		$this->attribute['Matric_Origem_Id']['Type'] = 'number';
		$this->attribute['Matric_Origem_Id']['Length'] = 15;
		$this->attribute['Matric_Origem_Id']['Label'] = 'Matrícula origem do credito';

		$this->attribute['WOcorr_Origem_Id']['Type'] = 'number';
		$this->attribute['WOcorr_Origem_Id']['Length'] = 15;
		$this->attribute['WOcorr_Origem_Id']['Label'] = 'Solicitação de Ocorrencia origem do credito';

		$this->attribute['CNABLog_Origem_Id']['Type'] = 'number';
		$this->attribute['CNABLog_Origem_Id']['Length'] = 15;
		$this->attribute['CNABLog_Origem_Id']['Label'] = 'Diferenca de Baixa';

		$this->attribute['PagtoP_Id']['Type'] = 'number';
		$this->attribute['PagtoP_Id']['Length'] = 15;
		$this->attribute['PagtoP_Id']['Label'] = 'Parcela';

		$this->attribute['Boleto_Destino_Id']['Type'] = 'number';
		$this->attribute['Boleto_Destino_Id']['Length'] = 15;
		$this->attribute['Boleto_Destino_Id']['Label'] = 'Boleto';

		$this->attribute['State_Id']['Type'] = 'number';
		$this->attribute['State_Id']['Length'] = 15;
		$this->attribute['State_Id']['Label'] = 'Situação';

		$this->attribute['Valor']['Type'] = 'number';
		$this->attribute['Valor']['Length'] = 12.2;
		$this->attribute['Valor']['Label'] = 'Valor';

		$this->attribute['DtPrevisao']['Type'] = 'date';
		$this->attribute['DtPrevisao']['Label'] = 'Previsão';

		$this->attribute['Bolsa_Origem_Id']['Type'] = 'number';
		$this->attribute['Bolsa_Origem_Id']['Length'] = 15;
		$this->attribute['Bolsa_Origem_Id']['Label'] = 'Bolsa origem do debito';

		$this->attribute['DebCred_CredBolsa_Id']['Type'] = 'number';
		$this->attribute['DebCred_CredBolsa_Id']['Length'] = 15;
		$this->attribute['DebCred_CredBolsa_Id']['Label'] = 'Bolsa aplicada ao credito';

		$this->attribute['Vest_Origem_Id']['Type'] = 'number';
		$this->attribute['Vest_Origem_Id']['Length'] = 15;
		$this->attribute['Vest_Origem_Id']['Label'] = 'Inscrição de Vestibular origem do credito';

		$this->attribute['VeicXEstac_Origem_Id']['Type'] = 'number';
		$this->attribute['VeicXEstac_Origem_Id']['Length'] = 15;
		$this->attribute['VeicXEstac_Origem_Id']['Label'] = 'Estacionamento origem do credito';

		$this->attribute['Parcel_Origem_Id']['Type'] = 'number';
		$this->attribute['Parcel_Origem_Id']['Length'] = 15;
		$this->attribute['Parcel_Origem_Id']['Label'] = 'Parcelamento origem do credito';

		$this->attribute['Ativo']['Type'] = 'number';
		$this->attribute['Ativo']['Length'] = 1;

		$this->attribute['Boleto_Origem_Id']['Type'] = 'number';
		$this->attribute['Boleto_Origem_Id']['Length'] = 15;
		$this->attribute['Boleto_Origem_Id']['Label'] = 'Boleto de Origem de um Boleto de Resíduo';

		$this->attribute['MatricExt_Origem_Id']['Type'] = 'number';
		$this->attribute['MatricExt_Origem_Id']['Length'] = 15;
		$this->attribute['MatricExt_Origem_Id']['Label'] = 'Matrícula DCEx origem do credito';

		$this->attribute['TempStrito_Origem_Id']['Type'] = 'number';
		$this->attribute['TempStrito_Origem_Id']['Length'] = 15;
		$this->attribute['TempStrito_Origem_Id']['Label'] = 'Matrícula Stricto origem do credito';

		$this->attribute['MatricEstDir_Or_Id']['Type'] = 'number';
		$this->attribute['MatricEstDir_Or_Id']['Length'] = 15;
		$this->attribute['MatricEstDir_Or_Id']['Label'] = 'Matrícula CEPA origem do credito';

		$this->attribute['BancoFolhaComp_Or_Id']['Type'] = 'number';
		$this->attribute['BancoFolhaComp_Or_Id']['Length'] = 15;
		$this->attribute['BancoFolhaComp_Or_Id']['Label'] = 'Banco de Folhas origem do credito';

		$this->attribute['DebCred_Or_Id']['Type'] = 'number';
		$this->attribute['DebCred_Or_Id']['Length'] = 15;
		$this->attribute['DebCred_Or_Id']['Label'] = 'DebCred origem ID, poder ser bolsa indevida ou item cobrado indevido.';

		$this->attribute['Quantidade']['Type'] = 'number';
		$this->attribute['Quantidade']['Length'] = 2;
		$this->attribute['Quantidade']['Label'] = 'Quantidade';

		$this->attribute['GradAluTi_Id']['Type'] = 'number';
		$this->attribute['GradAluTi_Id']['Length'] = 15;
		$this->attribute['GradAluTi_Id']['Label'] = 'Tipo de Disciplina.';

		$this->attribute['ReembComp_Id']['Type'] = 'number';
		$this->attribute['ReembComp_Id']['Length'] = 15;
		$this->attribute['ReembComp_Id']['Label'] = 'Composiçao do Reembolso';

		$this->attribute['Pendente']['Type'] = 'varchar2';
		$this->attribute['Pendente']['Length'] = 3;
		$this->attribute['Pendente']['Label'] = 'Usada para Recalculo de boleto';
		
		$this->attribute['VlrUsado']['Type'] = 'number';
		$this->attribute['VlrUsado']['Length'] = 12.2;
		$this->attribute['VlrUsado']['Label'] = 'Valor em Uso';
		

		//Calculates para a criação de querys no diretório SQL


		//Recognizes

		//Índices
		$this->index['WPessoa_Id']['Cols'] = "WPESSOA_ID";
		$this->index['Bolsa_Origem_Id']['Cols'] = "BOLSA_ORIGEM_ID";
		$this->index['Boleto_Destino_Id']['Cols'] = "BOLETO_DESTINO_ID";
		$this->index['Matric_Origem_Id']['Cols'] = "MATRIC_ORIGEM_ID";
		$this->index['DebCred_CredBolsa']['Cols'] = "DebCred_CredBolsa_Id";

		 
	}
}

?>