<?php

    require_once ("../engine/Model.class.php");

    class WOcorr extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorr'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['NN'] 			= 1;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Pessoa';

            $this->attribute['Num']['Type'] 				= 'number';
            $this->attribute['Num']['Length'] 				= 10;
            $this->attribute['Num']['Label'] 				= 'No.ocorrência';
            $this->attribute['Num']['Recognize']			= '1';

            $this->attribute['Solicitacao']['Type']		 	= 'date';
            $this->attribute['Solicitacao']['NN'] 			= 1;
            $this->attribute['Solicitacao']['Label'] 		= 'Data da ocorrência';

            $this->attribute['WOcorrAss_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAss_Id']['NN'] 			= 1;
            $this->attribute['WOcorrAss_Id']['Label'] 		= 'Assunto';
            $this->attribute['WOcorrAss_Id']['Recognize'] 	= '2';

            $this->attribute['State_Id']['Type'] 			= 'number';
            $this->attribute['State_Id']['Length'] 			= 15;
            $this->attribute['State_Id']['NN'] 				= 1;
            $this->attribute['State_Id']['Label'] 			= 'Situação';
            $this->attribute['State_Id']['Recognize'] 		= '3';

            $this->attribute['WBoleto_Id']['Type'] 			= 'number';
            $this->attribute['WBoleto_Id']['Length'] 		= 15;

            $this->attribute['Depart_Id']['Type'] 			= 'number';
            $this->attribute['Depart_Id']['Length'] 		= 15;
            $this->attribute['Depart_Id']['Label'] 			= 'Departamento';

            $this->attribute['SAASenha_Id']['Type'] 		= 'number';
            $this->attribute['SAASenha_Id']['Length'] 		= 15;

            $this->attribute['SimNao_Defer_Id']['Type'] 	= 'number';
            $this->attribute['SimNao_Defer_Id']['Length'] 	= 15;

            $this->attribute['Boleto_Id']['Type'] 			= 'number';
            $this->attribute['Boleto_Id']['Length'] 		= 15;

            $this->attribute['Campus_Id']['Type'] 			= 'number';
            $this->attribute['Campus_Id']['Length'] 		= 15;
            $this->attribute['Campus_Id']['Label'] 			= 'Campus';

            $this->attribute['AutoAtend']['Type'] 			= 'varchar2';
            $this->attribute['AutoAtend']['Length'] 		= 3;
            $this->attribute['AutoAtend']['Label'] 			= 'Auto Atendimento';

            $this->attribute['IP']['Type'] 					= 'varchar2';
            $this->attribute['IP']['Length'] 				= 19;
            $this->attribute['IP']['Label'] 				= 'IP';

            $this->attribute['RespEmail']['Type'] 			= 'varchar2';
            $this->attribute['RespEmail']['Length'] 		= 3;
            $this->attribute['RespEmail']['Label'] 			= 'Aviso Resposta por Email';

            $this->attribute['DtUrgencia']['Type'] 			= 'date';
            $this->attribute['DtUrgencia']['Mask'] 			= 'd';
            $this->attribute['DtUrgencia']['Label'] 		= 'Se possível com urgência para';

            $this->attribute['DtAnalise']['Type'] 			= 'date';
            $this->attribute['DtAnalise']['Mask'] 			= 'd';
            $this->attribute['DtAnalise']['Label'] 			= 'Data/Hora da Análise';

            $this->recognize['Recognize']	= 'WPessoa_Id, Num, WOcorrAss_Id';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdWPessoa'] 		= 'WOcorr_qGeral';
            $this->calculate['IdSelecao'] 		= 'WOcorr_qAluno';
            $this->calculate['Usuario'] 		= 'WOcorr_qAtendente';

            //Todas as Queries da classe
            $this->query['qAltProfResp']				= 'WOcorr_qAltProfResp';
            $this->query['qAluno'] 						= 'WOcorr_qAluno';
            $this->query['qAlunoCEPA'] 					= 'WOcorr_qAlunoCEPA';
            $this->query['qAlunoNuprajur'] 				= 'WOcorr_qAlunoNuprajur';
            $this->query['qAnalisada'] 					= 'WOcorr_qAnalisada';
            $this->query['qAnalise'] 					= 'WOcorr_qAnalise';
            $this->query['qAssuntos'] 					= 'WOcorr_qAssuntos';
            $this->query['qAtendente'] 					= 'WOcorr_qAtendente';
            $this->query['qConsAutoAtende'] 			= 'WOcorr_qConsAutoAtende';
            $this->query['qConsNumero']				 	= 'WOcorr_qConsNumero';
            $this->query['qDtSolicitacao'] 				= 'WOcorr_qDtSolicitacao';
            $this->query['qEmAtraso'] 					= 'WOcorr_qEmAtraso';
            $this->query['qEncaminhada'] 				= 'WOcorr_qEncaminhada';
            $this->query['qExcluir'] 					= 'WOcorr_qExcluir';
            $this->query['qGeral'] 						= 'WOcorr_qGeral';
            $this->query['qGetInfo']					= 'WOcorr_qGetInfo';
            $this->query['qGraAssunto'] 				= 'WOcorr_qGraAssunto';
            $this->query['qGraAssuntoNaoResp'] 			= 'WOcorr_qGraAssuntoNaoResp';
            $this->query['qGraMes'] 					= 'WOcorr_qGraMes';
            $this->query['qGraMesSAA'] 					= 'WOcorr_qGraMesSAA';
            $this->query['qHistorico'] 					= 'WOcorr_qHistorico';
            $this->query['qId'] 						= 'WOcorr_qId';
            $this->query['qIdAnalise'] 					= 'WOcorr_qIdAnalise';
            $this->query['qImpOcorrencia'] 				= 'WOcorr_qImpOcorrencia';
            $this->query['qImpRevisaoNota'] 			= 'WOcorr_qImpRevisaoNota';
            $this->query['qNuprajur'] 					= 'WOcorr_qNuprajur';
            $this->query['qPagos'] 						= 'WOcorr_qPagos';
            $this->query['qPendente'] 					= 'WOcorr_qPendente';
            $this->query['qQtdePLetivo']	 			= 'WOcorr_qQtdePLetivo';
            $this->query['qQtdeSolicitada'] 			= 'WOcorr_qQtdeSolicitada';
            $this->query['qQtdeSolicitadaAssuntoMes']	= 'WOcorr_qQtdeSolicitadaAssuntoMes';
            $this->query['qQtdeSolicitadaPeriodo'] 		= 'WOcorr_qQtdeSolicitadaPeriodo';
            $this->query['qQtdeSolicitadaPLetivo'] 		= 'WOcorr_qQtdeSolicitadaPLetivo';
            $this->query['qQtdeSolicitadaTpBaixa'] 		= 'WOcorr_qQtdeSolicitadaTpBaixa';
            $this->query['qRespondida']					= 'WOcorr_qRespondida';
            $this->query['qRespSemEnc'] 				= 'WOcorr_qRespSemEnc';
            $this->query['qRevisaoNota'] 				= 'WOcorr_qRevisaoNota';
            $this->query['qRevisaoNotaCursoCount'] 		= 'WOcorr_qRevisaoNotaCursoCount';
            $this->query['qRevisaoNotaProf'] 			= 'WOcorr_qRevisaoNotaProf';
            $this->query['qRevisaoNotaQtdeProf']		= 'WOcorr_qRevisaoNotaQtdeProf';
            $this->query['qRevisoesCad'] 				= 'WOcorr_qRevisoesCad';
            $this->query['qRevisaoNotaCurso'] 			= 'WOcorr_qRevisaoNotaCurso';
            $this->query['qState'] 						= 'WOcorr_qState';
            $this->query['qTeleAtendimento'] 			= 'WOcorr_qTeleAtendimento';
            $this->query['qVencimento'] 				= 'WOcorr_qVencimento';
            $this->query['qVerRevisaoNota'] 			= 'WOcorr_qVerRevisaoNota';

                        
        }
        

        
        public function GetOcorrInfo($WOcorr_Id)
        {
        	$dbData = new DbData($this->db);
        	
        	
	        $aOcorr = $this->GetIdInfo($WOcorr_Id);
        	
        	$html  = $this->Table(array("class"=>"dataGrid","cellspacing"=>"1")).$this->Tr();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Número <strong>' . $aOcorr[DT] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . '<strong>'  . $aOcorr[DT] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . '<strong>' .  $aOcorr[WOCORRASS_NOME] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"grande")) . '<strong>' . $aOcorr[STATE_NOME] . '</strong>'.$this->CloseTd();
        	$html .= $this->CloseTr();
      		unset($dbData);
        		
        	return $html;
        		
        		
        }
        
        public function GetNumero($WOcorr_Id)
        {
        	return SubStr($WOcorr_Id,6,7) . _dacMod10(SubStr($WOcorr_Id,6,7));
        }
        
        
        public function GetOcorrPessoa($Pessoa_Id)
        {        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get("
        			SELECT 
        				id, 
        				nvl(Num,WOcorr_gnNumOcorrencia(ID)) AS num, 
        				solicitacao, 
        				state_gsRecognize(state_id) as SITUACAO, 
        				wocorrass_gsRecognize(wocorrass_id) as ASSUNTO, 
        				to_char(solicitacao,'dd/mm/yyyy') as SOLICITACAO, 
        				WOcorr_gsRecognize(id) as Recognize, 
        				WOcorr.State_Id as State_Id 
        			FROM 
        				wocorr 
        			WHERE 
        				wpessoa_id = nvl( '".$Pessoa_Id."' ,0) 
        			ORDER BY num DESC");	
        		     		       
			$cont = 0;	
			
			while($row = $dbData->Row() )
			{
				$arEnd[$cont]["ID"] 			= $row["ID"];
				$arEnd[$cont]["NUM"] 			= $row["NUM"];
				$arEnd[$cont]["SOLICITACAO"]	= $row["SOLICITACAO"];
				$arEnd[$cont]["ASSUNTO"]		= $row["ASSUNTO"];
				$arEnd[$cont]["SITUACAO"]		= $row["SITUACAO"];
				$arEnd[$cont]["STATE_ID"]		= $row["STATE_ID"];
				$arEnd[$cont]["RECOGNIZE"]		= $row["RECOGNIZE"];				
				
				$cont++;
			}
        		
        	return $arEnd;
        	
        }
}
?> 