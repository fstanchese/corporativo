<?php

require_once ("../engine/Model.class.php");
 
class BolsaSol extends Model
{
	 
	//Mapeamento da tabela do Banco de Dados
	public $table = 'BolsaSol';

	 
	public $attribute     = array();
	public $calculate     = array();
	public $query        = array();
	 

	public $rows;

	 
	public function __construct($db)
	{

		$this->db = $db;

		$this->rows = 10000;


		$this->attribute['PLetivo_Id']['Type'] 				= 'number';
		$this->attribute['PLetivo_Id']['Length'] 			= 15;
		$this->attribute['PLetivo_Id']['Label'] 			= 'Perнodo Letivo';
		$this->attribute['PLetivo_Id']['NN'] 				= 1;

		$this->attribute['State_Id']['Type'] 				= 'number';
		$this->attribute['State_Id']['Length'] 				= 15;
		$this->attribute['State_Id']['NN'] 					= 1;
		$this->attribute['State_Id']['Label'] 				= 'Situaзгo';

		$this->attribute['WPessoa_Id']['Type'] 				= 'number';
		$this->attribute['WPessoa_Id']['Length'] 			= 15;
		$this->attribute['WPessoa_Id']['Label'] 			= 'Aluno';
		$this->attribute['WPessoa_Id']['NN'] 				= 1;

		$this->attribute['SimNao_MoraPais_Id']['Type'] 		= 'number';
		$this->attribute['SimNao_MoraPais_Id']['Length'] 	= 15;
		$this->attribute['SimNao_MoraPais_Id']['Label'] 	= 'Mora Com os Pais?';

		$this->attribute['SimNao_CursoSup_Id']['Type'] 		= 'number';
		$this->attribute['SimNao_CursoSup_Id']['Length'] 	= 15;
		$this->attribute['SimNao_CursoSup_Id']['Label'] 	= 'Possui Curso Superior?';

		$this->attribute['SimNao_Automovel_Id']['Type'] 	= 'number';
		$this->attribute['SimNao_Automovel_Id']['Length'] 	= 15;
		$this->attribute['SimNao_Automovel_Id']['Label'] 	= 'Possui Automуvel?';

		$this->attribute['Aluguel']['Type'] 				= 'number';
		$this->attribute['Aluguel']['Length'] 				= 15.2;
		$this->attribute['Aluguel']['Label'] 				= 'Aluguel ou Financiamento';
		$this->attribute['Aluguel']['Mask'] 				= '9,';

		$this->attribute['Parentesco_Outro_Id']['Type'] 	= 'number';
		$this->attribute['Parentesco_Outro_Id']['Length'] 	= 15;
		$this->attribute['Parentesco_Outro_Id']['Label'] 	= 'Hб outro membro do grupo familiar que estuda na USJT?';

		$this->attribute['Doenca_Id']['Type'] 				= 'number';
		$this->attribute['Doenca_Id']['Length'] 			= 15;
		$this->attribute['Doenca_Id']['Label'] 				= 'Doenca cronica';

		$this->attribute['OutraDoenca']['Type'] 			= 'varchar2';
		$this->attribute['OutraDoenca']['Length'] 			= 70;
		$this->attribute['OutraDoenca']['Label'] 			= 'Outra Doenca';

		$this->attribute['OutraDoencaDespesa']['Type'] 		= 'number';
		$this->attribute['OutraDoencaDespesa']['Length'] 	= 15.2;
		$this->attribute['OutraDoencaDespesa']['Label'] 	= 'Despesa Mensal - Outra doenca cronica';
		$this->attribute['OutraDoencaDespesa']['Mask'] 		= '9';

		$this->attribute['Parentesco_Falec_Id']['Type'] 	= 'number';
		$this->attribute['Parentesco_Falec_Id']['Length'] 	= 15;
		$this->attribute['Parentesco_Falec_Id']['Label'] 	= 'Falecimento de membro do grupo familiar';

		$this->attribute['DtFalecimento']['Type'] 			= 'date';
		$this->attribute['DtFalecimento']['Label'] 			= 'Data Falecimento de membro do grupo familiar';
		$this->attribute['DtFalecimento']['Mask'] 			= 'd';

		$this->attribute['RendaTi_Pri_Id']['Type'] 			= 'number';
		$this->attribute['RendaTi_Pri_Id']['Length'] 		= 15;
		$this->attribute['RendaTi_Pri_Id']['Label'] 		= 'Tipo de Renda Principal';

		$this->attribute['RendaPriMes']['Type'] 			= 'number';
		$this->attribute['RendaPriMes']['Length'] 			= 15.2;
		$this->attribute['RendaPriMes']['Label'] 			= 'Renda Principal - Mensal';
		$this->attribute['RendaPriMes']['Mask'] 			= '9';

		$this->attribute['RendaTi_Out_Id']['Type'] 			= 'number';
		$this->attribute['RendaTi_Out_Id']['Length'] 		= 15;
		$this->attribute['RendaTi_Out_Id']['Label'] 		= 'Tipo de Outras Rendas';

		$this->attribute['RendaOutMes']['Type'] 			= 'number';
		$this->attribute['RendaOutMes']['Length'] 			= 15.2;
		$this->attribute['RendaOutMes']['Label'] 			= 'Outras Rendas - Mensal';
		$this->attribute['RendaOutMes']['Mask'] 			= '9';

		$this->attribute['Texto']['Type'] 					= 'varchar2';
		$this->attribute['Texto']['Length'] 				= 1400;
		$this->attribute['Texto']['Label'] 					= 'Texto';

		$this->attribute['DtSolicitacao']['Type'] 			= 'date';
		$this->attribute['DtSolicitacao']['Label'] 			= 'Data da Solicitaзгo';

		$this->attribute['Pontos']['Type'] 					= 'number';
		$this->attribute['Pontos']['Length'] 				= 15.4;
		$this->attribute['Pontos']['Label'] 				= 'Pontos';
		$this->attribute['Pontos']['Mask'] 					= '9';

		$this->attribute['Classificacao']['Type'] 			= 'number';
		$this->attribute['Classificacao']['Length'] 		= 15;
		$this->attribute['Classificacao']['Label'] 			= 'Classificaзгo';

		$this->attribute['ClassPreview']['Type'] 			= 'number';
		$this->attribute['ClassPreview']['Length'] 			= 14;
		$this->attribute['ClassPreview']['Label'] 			= 'Preview de Classificaзгo';

		$this->attribute['DtClassificacao']['Type'] 		= 'date';
		$this->attribute['DtClassificacao']['Label'] 		= 'Data da classficacao';
		$this->attribute['DtClassificacao']['Mask'] 		= 'd';

		$this->attribute['BolsaSolM_Id']['Type'] 			= 'number';
		$this->attribute['BolsaSolM_Id']['Length'] 			= 15;
		$this->attribute['BolsaSolM_Id']['Label'] 			= 'Motivo';

		$this->attribute['FIESTi_Id']['Type'] 				= 'number';
		$this->attribute['FIESTi_Id']['Length'] 			= 15;
		$this->attribute['FIESTi_Id']['Label'] 				= 'Tipo';

		$this->attribute['WPessoa_Parente_Id']['Type'] 		= 'number';
		$this->attribute['WPessoa_Parente_Id']['Length'] 	= 15;
		$this->attribute['WPessoa_Parente_Id']['Label'] 	= 'Parente';

		$this->attribute['CESJProcSel_Id']['Type'] 			= 'number';
		$this->attribute['CESJProcSel_Id']['Length'] 		= 15;
		$this->attribute['CESJProcSel_Id']['Label'] 		= 'Processo Seletivo';

		$this->attribute['CurrOfe_Id']['Type'] 				= 'number';
		$this->attribute['CurrOfe_Id']['Length'] 			= 15;
		$this->attribute['CurrOfe_Id']['Label'] 			= 'Curriculo Desejado';

		$this->attribute['ENEMOBJ']['Type'] 				= 'number';
		$this->attribute['ENEMOBJ']['Length'] 				= 12.2;
		$this->attribute['ENEMOBJ']['Label'] 				= 'ENEM - Parte Objetiva';

		$this->attribute['ENEMRED']['Type'] 				= 'number';
		$this->attribute['ENEMRED']['Length'] 				= 12.2;
		$this->attribute['ENEMRED']['Label'] 				= 'ENEM - Parte Redaзгo';

		$this->attribute['DesclassMot']['Type'] 			= 'number';
		$this->attribute['DesclassMot']['Length'] 			= 2;
		$this->attribute['DesclassMot']['Label'] 			= 'Motivo da Desclassificaзгo';

		$this->attribute['WPleito_Id']['Type'] 				= 'number';
		$this->attribute['WPleito_Id']['Length'] 			= 15;
		$this->attribute['WPleito_Id']['Label'] 			= 'Pleito';

		$this->attribute['DtEntregaDoc']['Type'] 			= 'date';
		$this->attribute['DtEntregaDoc']['Label'] 			= 'Data de Entrega da Solicitaзгo';
		$this->attribute['DtEntregaDoc']['Mask'] 			= 'd';

		$this->attribute['PercBolsa']['Type'] 				= 'number';
		$this->attribute['PercBolsa']['Length'] 			= 3;
		$this->attribute['PercBolsa']['Label'] 				= 'Percentual de Bolsa';
		$this->attribute['PercBolsa']['Mask'] 				= '9';

		$this->attribute['FIESInt']['Type'] 				= 'varchar2';
		$this->attribute['FIESInt']['Length'] 				= 3;
		$this->attribute['FIESInt']['Label'] 				= 'Pretende contratar o FIES';

		//Calculates para a criaзгo de querys no diretуrio SQL
		$this->calculate['Selecao_Id'] = 'BolsaSol_qPessoa';


		//Recognizes

		//Нndices
		$this->index['PLetivo attributes=PLetivo_Id']['Cols'];            
		$this->index['State  attributes=State_Id']['Cols'];        
		$this->index['FIESTi  attributes=FIESTI_Id']['Cols'];
		
		//Todas as Queries da classe
		$this->query['qPontosNull'] 				= 'BolsaSol_qPontosNull';
		$this->query['qTodosCESJ'] 					= 'BolsaSol_qTodosCESJ';
		$this->query['qRPCM'] 						= 'BolsaSol_qRPCM';
		$this->query['qIncentivoCurso'] 			= 'BolsaSol_qIncentivoCurso';
		$this->query['qRFM'] 						= 'BolsaSol_qRFM';
		$this->query['qConsultaPROUNIUSJT'] 		= 'BolsaSol_qConsultaPROUNIUSJT';
		$this->query['qMediaPontos'] 				= 'BolsaSol_qMediaPontos';
		$this->query['qId'] 						= 'BolsaSol_qId';
		$this->query['qClassPROUNISJ'] 				= 'BolsaSol_qClassPROUNISJ';
		$this->query['qIncentivoGerencial'] 		= 'BolsaSol_qIncentivoGerencial';
		$this->query['qRPCMTodos'] 					= 'BolsaSol_qRPCMTodos';
		$this->query['qGeral'] 						= 'BolsaSol_qGeral';
		$this->query['qPontosGrafico'] 				= 'BolsaSol_qPontosGrafico';
		$this->query['qPreviewClassificacaoCESJ'] 	= 'BolsaSol_qPreviewClassificacaoCESJ';
		$this->query['qPontosCorteCount'] 			= 'BolsaSol_qPontosCorteCount';
		$this->query['qTodosPROUNIUSJT'] 			= 'BolsaSol_qTodosPROUNIUSJT';
		$this->query['qBolsaCurrOfe'] 				= 'BolsaSol_qBolsaCurrOfe';
		$this->query['qMediaPontosTodos'] 			= 'BolsaSol_qMediaPontosTodos';
		$this->query['qClassificarPROUNIUSJT'] 		= 'BolsaSol_qClassificarPROUNIUSJT';
		$this->query['qPessoa'] 					= 'BolsaSol_qPessoa';
		$this->query['qTodosImp'] 					= 'BolsaSol_qTodosImp';
		$this->query['qCount'] 						= 'BolsaSol_qCount';
		$this->query['qRFMFatTodos'] 				= 'BolsaSol_qRFMFatTodos';
		$this->query['qRFMFat'] 					= 'BolsaSol_qRFMFat';
		$this->query['qTotalOutFatores'] 			= 'BolsaSol_qTotalOutFatores';
		$this->query['qPontos'] 					= 'BolsaSol_qPontos';
		$this->query['qTotalPriFatores'] 			= 'BolsaSol_qTotalPriFatores';
		$this->query['qEnviaEmail'] 				= 'BolsaSol_qEnviaEmail';
		$this->query['qPontosGraficoTodos'] 		= 'BolsaSol_qPontosGraficoTodos';
		$this->query['qDesclassificadasCorteCount']	= 'BolsaSol_qDesclassificadasCorteCount';
		$this->query['qMatriculado'] 				= 'BolsaSol_qMatriculado';
		$this->query['qWPessoaPLetivo'] 			= 'BolsaSol_qWPessoaPLetivo';
		$this->query['qRPCMFatTodos'] 				= 'BolsaSol_qRPCMFatTodos';
		$this->query['qSolicitada'] 				= 'BolsaSol_qSolicitada';
		$this->query['qRFMTodos'] 					= 'BolsaSol_qRFMTodos';
		$this->query['qBoletoPago'] 				= 'BolsaSol_qBoletoPago';
		$this->query['qSolicitadaCurrOfe'] 			= 'BolsaSol_qSolicitadaCurrOfe';
		$this->query['qClassificar'] 				= 'BolsaSol_qClassificar';
		$this->query['qRPCMFat'] 					= 'BolsaSol_qRPCMFat';
		$this->query['qTodos'] 						= 'BolsaSol_qTodos';
		$this->query['qClassificarCESJ'] 			= 'BolsaSol_qClassificarCESJ';
		$this->query['qPreSelecionado'] 			= 'BolsaSol_qPreSelecionado';
		$this->query['qConsultaIncentivo'] 			= 'BolsaSol_qConsultaIncentivo';
		$this->query['qImpPROUNIUSJT'] 				= 'BolsaSol_qImpPROUNIUSJT';
		$this->query['qSituacao'] 					= 'BolsaSol_qSituacao';
		$this->query['qConsultaCESJ'] 				= 'BolsaSol_qConsultaCESJ';
		$this->query['qTodosIncentivo'] 			= 'BolsaSol_qTodosIncentivo';

		 
	}
}

?>