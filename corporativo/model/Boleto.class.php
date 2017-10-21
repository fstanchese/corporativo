<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Boleto extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Boleto'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500000;


            $this->attribute['WPessoa_Sacado_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Sacado_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Sacado_Id']['NN'] 		= 1;
            $this->attribute['WPessoa_Sacado_Id']['Label'] 		= 'Sacado';

            $this->attribute['Empresa_Cedente_Id']['Type'] 		= 'number';
            $this->attribute['Empresa_Cedente_Id']['Length'] 	= 15;
            $this->attribute['Empresa_Cedente_Id']['NN'] 		= 1;
            $this->attribute['Empresa_Cedente_Id']['Label'] 	= 'Empresa';

            $this->attribute['DtVencto']['Type'] 				= 'date';
            $this->attribute['DtVencto']['NN'] 					= 1;
            $this->attribute['DtVencto']['Label'] 				= 'Vencimento';
            $this->attribute['DtVencto']['Mask'] 				= 'd';

            $this->attribute['BoletoTi_Id']['Type'] 			= 'number';
            $this->attribute['BoletoTi_Id']['Length'] 			= 15;
            $this->attribute['BoletoTi_Id']['NN'] 				= 1;
            $this->attribute['BoletoTi_Id']['Label'] 			= 'Tipo do Boleto';

            $this->attribute['Referencia']['Type'] 				= 'varchar2';
            $this->attribute['Referencia']['Length'] 			= 20;
            $this->attribute['Referencia']['NN'] 				= 1;
            $this->attribute['Referencia']['Label'] 			= 'Tipo de Referencia';

            $this->attribute['Valor']['Type'] 					= 'number';
            $this->attribute['Valor']['Length'] 				= '12,2';
            $this->attribute['Valor']['NN'] 					= 1;
            $this->attribute['Valor']['Label'] 					= 'Valor';

            $this->attribute['NossoNum']['Type'] 				= 'number';
            $this->attribute['NossoNum']['Length'] 				= 13;
            $this->attribute['NossoNum']['NN'] 					= 1;
            $this->attribute['NossoNum']['Label'] 				= 'Nosso Número';

            $this->attribute['NumDoc']['Type'] 					= 'number';
            $this->attribute['NumDoc']['Length'] 				= 13;
            $this->attribute['NumDoc']['NN'] 					= 1;
            $this->attribute['NumDoc']['Label'] 				= 'Número do Documento';

            $this->attribute['NumDocAntigo']['Type'] 			= 'number';
            $this->attribute['NumDocAntigo']['Length'] 			= 13;
            $this->attribute['NumDocAntigo']['Label'] 			= 'Número do Documento Antigo';
            $this->attribute['NumDocAntigo']['NN']				= 0;

            $this->attribute['EspecieDoc_Id']['Type'] 			= 'number';
            $this->attribute['EspecieDoc_Id']['Length'] 		= 15;
            $this->attribute['EspecieDoc_Id']['NN'] 			= 1;
            $this->attribute['EspecieDoc_Id']['Label'] 			= 'Espécie';

            $this->attribute['Aceite_Id']['Type'] 				= 'number';
            $this->attribute['Aceite_Id']['Length'] 			= 15;
            $this->attribute['Aceite_Id']['Label'] 				= 'Aceite';
            $this->attribute['Aceite_Id']['NN']					= 0;

            $this->attribute['Moeda_Id']['Type'] 				= 'number';
            $this->attribute['Moeda_Id']['Length'] 				= 15;
            $this->attribute['Moeda_Id']['NN'] 					= 1;
            $this->attribute['Moeda_Id']['Label'] 				= 'Moeda';

            $this->attribute['Mensagem_Remessa_Id']['Type'] 	= 'number';
            $this->attribute['Mensagem_Remessa_Id']['Length'] 	= 15;
            $this->attribute['Mensagem_Remessa_Id']['Label'] 	= 'Mensagem Remessa';
            $this->attribute['Mensagem_Remessa_Id']['NN']		= 0;

            $this->attribute['Carteira_Id']['Type'] 			= 'number';
            $this->attribute['Carteira_Id']['Length'] 			= 15;
            $this->attribute['Carteira_Id']['Label'] 			= 'Carteira';
            $this->attribute['Carteira_Id']['NN']				= 0;

            $this->attribute['Instrucao_Recibo_Id']['Type'] 	= 'number';
            $this->attribute['Instrucao_Recibo_Id']['Length'] 	= 15;
            $this->attribute['Instrucao_Recibo_Id']['Label'] 	= 'Instruções';
            $this->attribute['Instrucao_Recibo_Id']['NN']		= 0;

            $this->attribute['Instrucao_LocPag_Id']['Type'] 	= 'number';
            $this->attribute['Instrucao_LocPag_Id']['Length'] 	= 15;
            $this->attribute['Instrucao_LocPag_Id']['Label'] 	= 'Instruções local Pagamento';
            $this->attribute['Instrucao_LocPag_Id']['NN']		= 0;

            $this->attribute['Instrucao_Comp_Id']['Type'] 		= 'number';
            $this->attribute['Instrucao_Comp_Id']['Length'] 	= 15;
            $this->attribute['Instrucao_Comp_Id']['Label'] 		= 'Instruções Compensacao';
            $this->attribute['Instrucao_Comp_Id']['NN']			= 0;

            $this->attribute['Competencia']['Type'] 			= 'varchar2';
            $this->attribute['Competencia']['Length'] 			= 6;
            $this->attribute['Competencia']['Label'] 			= 'Ano Mes';
            $this->attribute['Competencia']['NN']				= 0;

            $this->attribute['CCorrente_Id']['Type'] 			= 'number';
            $this->attribute['CCorrente_Id']['Length'] 			= 15;
            $this->attribute['CCorrente_Id']['NN'] 				= 1;
            $this->attribute['CCorrente_Id']['Label'] 			= 'Conta Corrente';

            $this->attribute['OrdemRef']['Type'] 				= 'number';
            $this->attribute['OrdemRef']['Length'] 				= 15;
            $this->attribute['OrdemRef']['Label'] 				= 'Ordem de Referência';
            $this->attribute['OrdemRef']['NN']					= 0;

            $this->attribute['Inc_Id']['Type'] 					= 'number';
            $this->attribute['Inc_Id']['Length'] 				= 15;
            $this->attribute['Inc_Id']['Label'] 				= 'Incremento';
            $this->attribute['Inc_Id']['NN'] 					= 1;

            $this->attribute['State_Base_Id']['Type'] 			= 'number';
            $this->attribute['State_Base_Id']['Length'] 		= 15;
            $this->attribute['State_Base_Id']['NN'] 			= 1;
            $this->attribute['State_Base_Id']['Label'] 			= 'State Base utilizado pela função State_Id';

            $this->attribute['Empresa_Sacado_Id']['Type'] 		= 'number';
            $this->attribute['Empresa_Sacado_Id']['Length'] 	= 15;
            $this->attribute['Empresa_Sacado_Id']['Label'] 		= 'Empresa';
            $this->attribute['Empresa_Sacado_Id']['NN']			= 0;

            $this->attribute['Campus_Id']['Type'] 				= 'number';
            $this->attribute['Campus_Id']['Length'] 			= 15;
            $this->attribute['Campus_Id']['Label'] 				= 'Campus';
            $this->attribute['Campus_Id']['NN']					= 0;

            $this->attribute['WPessoa_Confessor_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Confessor_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Confessor_Id']['Label'] 	= 'Confessor';
            $this->attribute['WPessoa_Confessor_Id']['NN']		= 0;

            $this->attribute['Mensagem_Recibo_Id']['Type'] 		= 'number';
            $this->attribute['Mensagem_Recibo_Id']['Length'] 	= 15;
            $this->attribute['Mensagem_Recibo_Id']['Label'] 	= 'Mensagem Recibo';
            $this->attribute['Mensagem_Recibo_Id']['NN']		= 0;

            $this->attribute['DtValidade']['Type'] 				= 'date';
            $this->attribute['DtValidade']['Label'] 			= 'Validade';
            $this->attribute['DtValidade']['Mask'] 				= 'd';
            $this->attribute['DtValidade']['NN']				= 0;

            $this->attribute['Remessa_Id']['Type'] 				= 'number';
            $this->attribute['Remessa_Id']['Length'] 			= 15;
            $this->attribute['Remessa_Id']['Label'] 			= 'Lote de Remessa de Envio ao Banco';
            $this->attribute['Remessa_Id']['NN']				= 0;

            $this->attribute['Curso_Id']['Type'] 				= 'number';
            $this->attribute['Curso_Id']['Length'] 				= 15;
            $this->attribute['Curso_Id']['Label'] 				= 'Curso';
            $this->attribute['Curso_Id']['NN']					= 0;

            $this->attribute['NFeRPS']['Type'] 					= 'number';
            $this->attribute['NFeRPS']['Length'] 				= 12;
            $this->attribute['NFeRPS']['Label'] 				= 'RPS da Nota Fiscal Eletrônica';
            $this->attribute['NFeRPS']['NN']					= 0;

            $this->attribute['NFe']['Type'] 					= 'number';
            $this->attribute['NFe']['Length'] 					= 12;
            $this->attribute['NFe']['Label'] 					= 'Número da NF-e';
            $this->attribute['NFe']['NN']						= 0;

            $this->attribute['NFeCodVerif']['Type'] 			= 'varchar2';
            $this->attribute['NFeCodVerif']['Length'] 			= 8;
            $this->attribute['NFeCodVerif']['Label'] 			= 'Código Verificacao NF-e';
            $this->attribute['NFeCodVerif']['NN']				= 0;

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['EmAberto'] 			= 'Boleto_qEmAberto';
            $this->calculate['IdPagos'] 			= 'Boleto_qPagos';
            $this->calculate['IdPagosTipo'] 		= 'Boleto_qPagosTipo';
            $this->calculate['MultaBib'] 			= 'Boleto_qMulta';
            $this->calculate['TodosEmAberto'] 		= 'Boleto_qTodosEmAberto';
            $this->calculate['ResVagaEmAberto'] 	= 'Boleto_qResVagaEmAberto';
            $this->calculate['EmAbertoTipo'] 		= 'Boleto_qEmAbertoTipo';
            $this->calculate['Boleto_Id'] 			= 'Boleto_qMatric';
            $this->calculate['ParcMatricula'] 		= 'Boleto_qDiluido';


            //Recognizes			
            $this->recognize['Recognize'] 			= "NossoNum";
            $this->recognize['RecValor'] 			= "Valor";
            
            //Índices
            $this->index['pessoa']['Cols'] 			= "wpessoa_sacado_id";
            $this->index['referencia']['Cols'] 		= "referencia";
            $this->index['boletoti_id']['Cols'] 	= "boletoti_id";
            $this->index['NFeRPS']['Cols'] 			= "NFeRPS";
            $this->index['Competencia']['Cols'] 	= "Competencia";

            //Todas as Queries da classe
            $this->query['qAltAposFechamentoComp'] 		= 'Boleto_qAltAposFechamentoComp';
            $this->query['qAlteradoAposBaixado'] 		= 'Boleto_qAlteradoAposBaixado';
            $this->query['qAlteradoAposFechamento'] 	= 'Boleto_qAlteradoAposFechamento';            
            $this->query['qAnoCompDiluido'] 			= 'Boleto_qAnoCompDiluido';
            $this->query['qAnoCurDiluDe'] 				= 'Boleto_qAnoCurDiluDe';
            $this->query['qAnoCursoDiluido'] 			= 'Boleto_qAnoCursoDiluido';
            $this->query['qBoleto'] 					= 'Boleto_qBoleto';
            $this->query['qBoletoNumero'] 				= 'Boleto_qBoletoNumero';
            $this->query['qCompetencia'] 				= 'Boleto_qCompetencia';
            $this->query['qConsulta'] 					= 'Boleto_qConsulta';
            $this->query['qCountAnoPendente'] 			= 'Boleto_qCountAnoPendente';
            $this->query['qCountPendente'] 				= 'Boleto_qCountPendente';
            $this->query['qDiluido'] 					= 'Boleto_qDiluido';
            $this->query['qEmAberto'] 					= 'Boleto_qEmAberto';
            $this->query['qEmAbertoTipo'] 				= 'Boleto_qEmAbertoTipo';
            $this->query['qEstacionamento'] 			= 'Boleto_qEstacionamento';
            $this->query['qFiesNAditado'] 				= 'Boleto_qFiesNAditado';
            $this->query['qFiesNAditadoCount'] 			= 'Boleto_qFiesNAditadoCount';
            $this->query['qGeracao'] 					= 'Boleto_qGeracao';
            $this->query['qGeral'] 						= 'Boleto_qGeral';                        
            $this->query['qGeraLicen'] 					= 'Boleto_qGeraLicen';
            $this->query['qGeraTempStrito'] 			= 'Boleto_qGeraTempStrito';
            $this->query['qHi'] 						= 'Boleto_qHi';            
            $this->query['qHiConsulta'] 				= 'Boleto_qHiConsulta';
            $this->query['qId'] 						= 'Boleto_qId';            
            $this->query['qIdPadrao'] 					= 'Boleto_qIdPadrao';
            $this->query['qInc'] 						= 'Boleto_qInc';            
            $this->query['qMatric'] 					= 'Boleto_qMatric';
            $this->query['qMatricExt'] 					= 'Boleto_qMatricExt';
            $this->query['qMaxDtPagtoAno'] 				= 'Boleto_qMaxDtPagtoAno';
            $this->query['qMulta'] 						= 'Boleto_qMulta';
            $this->query['qNFeComp'] 					= 'Boleto_qNFeComp';
            $this->query['qNFeCompPago'] 				= 'Boleto_qNFeCompPago';
            $this->query['qNossoNum'] 					= 'Boleto_qNossoNum';            
            $this->query['qNossoNumCount'] 				= 'Boleto_qNossoNumCount';
            $this->query['qNumDoc'] 					= 'Boleto_qNumDoc';
            $this->query['qNumDocAntigo'] 				= 'Boleto_qNumDocAntigo';
            $this->query['qNumDocCount'] 				= 'Boleto_qNumDocCount';
            $this->query['qNumDocServico'] 				= 'Boleto_qNumDocServico';            
            $this->query['qPagos'] 						= 'Boleto_qPagos';            
            $this->query['qPagosTipo'] 					= 'Boleto_qPagosTipo';
            $this->query['qPagtoamenor'] 				= 'Boleto_qPagtoamenor';
            $this->query['qPendente'] 					= 'Boleto_qPendente';
            $this->query['qPesRef'] 					= 'Boleto_qPesRef';
            $this->query['qPesRefLike'] 				= 'Boleto_qPesRefLike';            
            $this->query['qPessoa'] 					= 'Boleto_qPessoa';
            $this->query['qPessoaAno'] 					= 'Boleto_qPessoaAno';
            $this->query['qPessoaAnoTermo'] 			= 'Boleto_qPessoaAnoTermo';
            $this->query['qPessoaComp'] 				= 'Boleto_qPessoaComp';
            $this->query['qPessoaDistinctAno'] 			= 'Boleto_qPessoaDistinctAno';
            $this->query['qPessoaDistinctAnoCount'] 	= 'Boleto_qPessoaDistinctAnoCount';
            $this->query['qPessoaDt'] 					= 'Boleto_qPessoaDt';
            $this->query['qPessoaDtPagto'] 				= 'Boleto_qPessoaDtPagto';
            $this->query['qPessoaOrdem'] 				= 'Boleto_qPessoaOrdem';
            $this->query['qPessoaOrdemRef'] 			= 'Boleto_qPessoaOrdemRef';
            $this->query['qPessoaRefCount'] 			= 'Boleto_qPessoaRefCount';
            $this->query['qPessoaReferencia'] 			= 'Boleto_qPessoaReferencia';
            $this->query['qPrevisao'] 					= 'Boleto_qPrevisao';
            $this->query['qRateioSave'] 				= 'Boleto_qRateioSave';
            $this->query['qRateioSaveCount'] 			= 'Boleto_qRateioSaveCount';            
            $this->query['qRecalculoEstProf'] 			= 'Boleto_qRecalculoEstProf';
            $this->query['qRecebimento_Id'] 			= 'Boleto_qRecebimento_Id';            
            $this->query['qRemessa'] 					= 'Boleto_qRemessa';
            $this->query['qRenovacaoPos'] 				= 'Boleto_qRenovacaoPos';
            $this->query['qReserva'] 					= 'Boleto_qReserva';            
            $this->query['qReservada'] 					= 'Boleto_qReservada';
            $this->query['qReservaPaga'] 				= 'Boleto_qReservaPaga';
            $this->query['qResVagaEmAberto'] 			= 'Boleto_qResVagaEmAberto';
            $this->query['qRetReferencia'] 				= 'Boleto_qRetReferencia';
            $this->query['qSave'] 						= 'Boleto_qSave';
            $this->query['qSaveCount'] 					= 'Boleto_qSaveCount';            
            $this->query['qServMultaAno'] 				= 'Boleto_qServMultaAno';
            $this->query['qTCobPessoa'] 				= 'Boleto_qTCobPessoa';
            $this->query['qTCobPessoaNew'] 				= 'Boleto_qTCobPessoaNew';            
            $this->query['qTemDebito'] 					= 'Boleto_qTemDebito';
            $this->query['qTipoEmAberto'] 				= 'Boleto_qTipoEmAberto';
            $this->query['qTipoPendente'] 				= 'Boleto_qTipoPendente';
            $this->query['qTodosEmAberto'] 				= 'Boleto_qTodosEmAberto';
            $this->query['qTotalAnoCursoDiluido'] 		= 'Boleto_qTotalAnoCursoDiluido';
            $this->query['qTotalAnoDiluido'] 			= 'Boleto_qTotalAnoDiluido';
            $this->query['qVerificacao'] 				= 'Boleto_qVerificacao';
            $this->query['qVestInscDia'] 				= 'Boleto_qVestInscDia';
            $this->query['qVestInscDiaC'] 				= 'Boleto_qVestInscDiaC';            
            $this->query['qVestInscDiaI'] 				= 'Boleto_qVestInscDiaI';
            $this->query['qWOcorr'] 					= 'Boleto_qWOcorr';
            
                
        } 
        
       
        public function GetStateMatric($Boleto_Id)
        {
			require_once("../model/PLetivo.class.php");
			require_once("../model/Matric.class.php");
			
        	$dbData = new DbData($this->db);
        	
        	$pletivo 	= new PLetivo($this->db);     
        	$matric 	= new Matric($this->db);   	
        	
        	$aMatric = array();
        	$dbData->Get("select 
        						state_gsRecognize(matric.state_Id) as State_Matric,
        						Matric.MatricTi_Id,
        						Matric.Matric_Pai_Id as Matric_Pai_Id 
        					from 
        						debcred,matric 
        					where 
        						debcred.state_id <> 3000000016003 
        					and 
        						matric.id= matric_origem_id 
        					and 
        						boleto_destino_id='$Boleto_Id' 
        					order by  matricti_id");
        	
        	$aMatric = $dbData->Row();
        	
        	if ($aMatric["MATRICTI_ID"] == 8300000000001)
        	{
        		$MatricState = $aMatric["STATE_MATRIC"];
        	}
        	
        	else
        	{
        		$dbData->Get('select state_gsRecognize(matric.state_Id) as State_Matric from matric where id=\''.$aMatric["MATRIC_PAI_ID"].'\'');
        		$aMatricPai = $dbData->Row();
        		$MatricState = $aMatricPai["STATE_MATRIC"];
        	}

        	if (empty($MatricState))
        	{
        		$aPLetivos = $pletivo->GetIdAtual();
        		$aBoleto = $this->GetIdInfo($Boleto_Id);

        		foreach ($aPLetivos as $key => $aRetPL)
        		{

        			$aMatric = $matric->GetStateMatricCorrente($aBoleto["WPESSOA_SACADO_ID"],$aRetPL,8300000000001);
        			if (is_array($aMatric))
        			{
        				$MatricState .= $matric->Recognize($aMatric[0],'State_Id'); 
        			}
        		}
        		
        	}
        	if (empty($MatricState))
        	{
        		$MatricState = 'Sem Matrícula';
        	}
        	
        	return $MatricState;
        }
        
        
        ///////////////
        public function GetDevedores($arCriterios)
        {
        	$dbData = new DbData($this->db);
        	 
        	require_once ("../model/PLetivo.class.php");
        	require_once ("../model/CCobTiXBolTi.class.php");
        	require_once ("../model/StateGru.class.php");
        	        	
        	$pLetivo 		= new PLetivo($this->db);
        	$ccobTiXBolTi 	= new CCobTiXBolTi($this->db);
        	$stateGru		= new StateGru($this->db);
        	
        	$aBoletoTi = $ccobTiXBolTi->GetBoletoTi($arCriterios["p_CCobCartaTi_Id"]);

       	
			$pInicio = substr($arCriterios["p_DtInicio"],3,4).substr($arCriterios["p_DtInicio"],0,2);
			$pTermino = substr($arCriterios["p_DtTermino"],3,4).substr($arCriterios["p_DtTermino"],0,2);

			$pLetivoAno = $pLetivo->GetIdAno(substr($arCriterios["p_DtTermino"],3,4));				

			if($arCriterios[p_SCPC] == 'off')
			{
				$sqlPlus = " AND NOT EXISTS ( SELECT id FROM ccobcarta WHERE tbBoleto.WPessoa_Id = ccobcarta.wpessoa_id AND EXISTS ( SELECT id FROM ccobconseq WHERE ccobcarta_id = ccobcarta.id AND dtexclusao IS NULL ) ) ";
			}				
			
			if (in_array('92200000000002',$aBoletoTi))
			{
				$sql = "select distinct(boleto.id) as boleto_id, replace(Boleto.Valor,',','.') as valor, wpessoa_sacado_id as wpessoa_id, parcel.id as parcel_id, null as matric_id
				from boleto, parcel, parcelxbol
				where
						exists (
		    						select
				  							WPessoa_Sacado_Id
									    from
			    							Boleto BoletoQtde
			    						where
			    							BoletoQtde.State_Base_Id = 3000000000006
			    						and
			    							BoletoQtde.BoletoTi_Id in (". implode(",",$aBoletoTi) .")
							    							and
							    							to_char(DtVencto,'yyyymm') between '". $pInicio ."' and '". $pTermino ."'
							    							and
							    							Boleto.WPessoa_Sacado_Id = BoletoQtde.WPessoa_Sacado_Id
							    							group by BoletoQtde.WPessoa_Sacado_Id having count(*) >= nvl ( " . $arCriterios["p_Qtde"] . " , 1)
  									)
				and
					ParcelXBol.Parcel_Id = Parcel.Id (+)
				and
					Boleto.Id = ParcelXBol.Boleto_Dest_Id (+)
				and
					Boleto.state_base_id = 3000000000006
				and
					boletoti_id = 92200000000002
				and
					to_char(DtVencto,'yyyymm') between '". $pInicio ."' and '". $pTermino ."'
				order by wpessoa_sacado_id,boleto_id";
				
			}
			else
			{
				$aStateMatric = $stateGru->GetState($arCriterios["p_State_Matric_Id"]);
				
				$sql = "select distinct(tbBoleto.Id) as Boleto_Id, replace(tbBoleto.Valor,',','.') as valor, tbBoleto.WPessoa_Id, Matric.Id as Matric_Id, Parcel.Id as Parcel_Id
					from
					Matric,	TurmaOfe, CurrOfe, Curr, Curso, Parcel, ParcelXBol,
        				(select
							Id,Valor,WPessoa_Sacado_Id as WPessoa_Id,BoletoTi_Id,DtVencto,OrdemRef
							from
							  	Boleto
							where
		  						exists (
		    						select
				  							WPessoa_Sacado_Id
									    from
			    							Boleto BoletoQtde
			    						where
			    							BoletoQtde.State_Base_Id = 3000000000006
			    						and
			    							BoletoQtde.BoletoTi_Id in (". implode(",",$aBoletoTi) .")
							    							and
							    							OrdemRef between '". $pInicio ."' and '". $pTermino ."'
							    							and
							    							Boleto.WPessoa_Sacado_Id = BoletoQtde.WPessoa_Sacado_Id
							    							group by BoletoQtde.WPessoa_Sacado_Id having count(*) >= nvl ( " . $arCriterios["p_Qtde"] . " , 1)
  									)
		  					and
		    					State_Base_Id = 3000000000006
		  					and
		    					BoletoTi_Id in (". implode(",",$aBoletoTi) .")
						    							and
						    							OrdemRef between '". $pInicio ."' and '". $pTermino ."'
						    							order by
						    							WPessoa_Sacado_Id,Referencia) tbBoleto
						    							where
						    							ParcelXBol.Parcel_Id = Parcel.Id (+)
						    							and
						    							tbBoleto.Id = ParcelXBol.Boleto_Dest_Id (+)
						    							and
						    							Matric.State_Id in (". implode(",",$aStateMatric) . ")
			  			and
			  				Matric.Id = (select max(matric.id) from matric,turmaofe,currofe where Matric.State_Id in (". implode(",",$aStateMatric) . ") and Matric.MatricTi_Id = 8300000000001 and matric.turmaofe_id = turmaofe.id and turmaofe.currofe_id = currofe.id and CurrOfe.PLetivo_Id in (".implode(",",$pLetivoAno).") and wpessoa_Id = tbBoleto.WPessoa_Id)
			  			and
		  					Matric.MatricTi_Id = 8300000000001
						and
		  					Matric.WPessoa_Id = tbBoleto.WPessoa_Id
						and
		  					Matric.TurmaOfe_Id = TurmaOfe.Id
						and
		  					TurmaOfe.CurrOfe_Id = CurrOfe.Id
						and
			  				( Curr.Curso_Id = '". $arCriterios["p_Curso_Id"] ."' or '". $arCriterios["p_Curso_Id"] ."' is null )
			  			and
			  				Curr.Id = CurrOfe.Curr_Id
			  			and
			  				Curso.Id = Curr.Curso_Id
			  			and
			  				( Curso.CursoNivel_id = '".$arCriterios[p_CursoNivel_Id]."' or '".$arCriterios[p_CursoNivel_Id]."' is null )
			  			and
		  					CurrOfe.PLetivo_Id in (".implode(",",$pLetivoAno).")
						".$sqlPlus."
						order by 1 desc";
				
			}
			
			//echo $sql;

			$dbData->Get($sql);
			 
			while ($row = $dbData->Row())
			{
				$aTotalValor[$row[WPESSOA_ID]][_NVL($row[MATRIC_ID],0)][_NVL($row[PARCEL_ID],0)][$row[BOLETO_ID]] = $row[VALOR];
			}
 
			
        	return $aTotalValor;     	
        	
        	
        }
        
        
        public function GetMatric($Boleto_Id, $dBase = '')
        {      	

        	if ($dBase == '')
        		$dBase = date('d/m/Y');
        	
        	require_once("../model/PLetivo.class.php");
        	require_once("../model/Matric.class.php");
        	require_once("../model/RateioBol.class.php");
        	require_once("../model/ParcelXBol.class.php");
        	require_once("../model/TempDivxBol.class.php");
        	        	        		
        	$dbData		= new DbData($this->db);
        	        	 
        	$pletivo 	= new PLetivo($this->db);
        	$matric 	= new Matric($this->db);        	
        	 
        	$dbData->Get("(
        			select
	        			Matric.Id,
    	    			Matric.MatricTi_Id,
        				Matric.Matric_Pai_Id as Matric_Pai_Id
        			from
	        			debcred,matric
        			where
    	    			debcred.state_id <> 3000000016003
        			and
        				matric.id= matric_origem_id
        			and
        				boleto_destino_id='$Boleto_Id'
        			)
        			union
        			(
        			select
	        			Matric.Id,
    	    			Matric.MatricTi_Id,
        				Matric.Matric_Pai_Id as Matric_Pai_Id
        			from
        				debcred,matric,tempstrito
        			where
        				debcred.state_id <> 3000000016003
        			and
	        			matric.id=tempstrito.matric_id
        			and
    	    			tempstrito.id=debcred.tempstrito_origem_id
        			and
        				boleto_destino_id='$Boleto_Id'
        			)
        			union
        			(
        			select
	        			Matric.Id,
    	    			Matric.MatricTi_Id,
        				Matric.Matric_Pai_Id as Matric_Pai_Id
        			from
        				debcred,matric,matricestdir
        			where
        				debcred.state_id <> 3000000016003
        			and
	        			matric.id=matricestdir.matric_id
        			and
    	    			matricestdir.id=debcred.matricestdir_or_id
        			and
        				boleto_destino_id='$Boleto_Id'
        			)					
        			union
        			(
        			select
	        			Matric.Id,
    	    			Matric.MatricTi_Id,
        				Matric.Matric_Pai_Id as Matric_Pai_Id
        			from
        				matric,	
        				debcred debcredbolsa,	
        				debcred debcrednadit,
        				debcred debcredmatr,
	        			boleto
        			where
        				debcredmatr.state_id <> 3000000016003
        			and
	        			matric.id=debcredmatr.matric_origem_id
        			and
    	    			debcredmatr.id=debcredbolsa.debcred_credbolsa_id
        			and
        			    debcredbolsa.id = debcrednadit.debcred_or_id
        			and
        				debcrednadit.boleto_destino_id=boleto.id
        			and
        				boleto.boletoti_id in (92200000000015, 92200000000018)
        			and
        				boleto.id='$Boleto_Id'
        			)
        			union
        			(
        			select
	        			Matric.Id,
    	    			Matric.MatricTi_Id,
        				Matric.Matric_Pai_Id as Matric_Pai_Id
        			from
        				matric,	
        				debcred debcredbolsa,	
        				debcred debcredrevisor,
        				debcred debcredmatr,
	        			boleto
        			where
        				debcredmatr.state_id <> 3000000016003
        			and
	        			matric.id=debcredmatr.matric_origem_id
        			and
    	    			debcredmatr.id=debcredbolsa.debcred_credbolsa_id
        			and
        			    debcredbolsa.id = debcredrevisor.debcred_or_id
        			and
        				debcredrevisor.boleto_destino_id=boleto.id
        			and
        				boleto.boletoti_id = 92200000000003
        			and
        				boleto.id='$Boleto_Id'
        			)        			
        			order by  matricti_id");
        			 
        	$aMatric = $dbData->Row();      	

            if (is_array($aMatric))
            {
        		if ($aMatric["MATRICTI_ID"] == 8300000000001)
	        	{
		        	$MatricId = $aMatric["ID"];
        		}
    	    	else
	        	{
			        $MatricId = _nvl( $aMatric["MATRIC_PAI_ID"] , $aMatric["ID"] );
	    	    }
	    	    $aReturn = $matric->GetIdInfo($MatricId);	    	    
            }
	        else 
	        {	
	        	$rateiobol = new RateioBol($this->db);
	        	$aRateioBol = $rateiobol->GetRateio($Boleto_Id, $dBase);
	        	if (is_array($aRateioBol))	        		
	        	{
	        		//print_r ( $aRateioBol );	
	        		$aReturn = $this->GetMatric($aRateioBol["BOLETO_ID"], $dBase);
	        		//print_r ( $aReturn );
	        	}	
	        	else
	        	{
	        		// chegar ao boleto que originou o parcelamento para pegar a matricula
	        		$aBoleto = $this->GetIdInfo($Boleto_Id);
	        		if ($aBoleto[BOLETOTI_ID] == 92200000000002 || $aBoleto[BOLETOTI_ID] == 92200000000009)
	        		{	        			 
		        		$parcelxbol		= new ParcelXBol($this->db);
	        			$tempdivxbol	= new TempDivxBol($this->db);
	        			if ($aBoleto[BOLETOTI_ID] == 92200000000002)
	        			{
	        				$aRegParc = $parcelxbol->GetBoletoOrigem($aBoleto[ID], TRUE);
	        			}
	        			else
	        			{
	        				$aRegParc = $tempdivxbol->GetBoletoOrigem($aBoleto[NOSSONUM], TRUE);
	        			}
	        			if (is_array($aRegParc) and count($aRegParc) >= 1)
	        			{
		        			foreach ($aRegParc as $row)
		        			{
	    	    				if ($vAchou == 0)
	        					{
	        						if ($row["BOLETOTI_ID"] == 92200000000003)
	        						{
	        							$aReturn = $this->GetMatric($row["Boleto_Id"], $dBase);
	        							if (is_array($aReturn))
	        							{
		        							$vAchou = 1;
		        							break;
	    	    						}	        							
	        						}
	        						else
	        						{
	        							$aReturn = $this->GetMatric($row["Boleto_Id"], $dBase);	        						 
	        						}	        					
		        				}
		        			}		        				
	        			}        			
	        			unset($tempdivxbol);
	        			unset($parcelxbol);
	        		}
	        		else
	        		{
		        		$aReturn = '';
	        		}
	        	}
	        	unset($rateiobol);	        	
	        }
	        
	        unset($matric);
	        unset($pletivo);
	        unset($dbData);

       		return $aReturn;
        }
        
        
        
        public function GetBoletoState($WPessoaId,$aStateId)
        {
        	$dbData = new DbData($this->db);
        	
        	$vStateId = '('.implode(',',$aStateId).')';
        	
        	$dbData->Get("select id,nossonum,referencia,competencia,valor from boleto where state_base_id in ".$vStateId." and WPessoa_Sacado_Id='".$WPessoaId."'");

        	while ($row = $dbData->Row())
        	{
        		$aReturn = $row;        		
        	}
        	
        	return $aReturn;
        	
        }
        

        //Retorna State de um boleto em determinada data.
        function GetStateData($Boleto_Id, $dBase='', $vBoleto_Considerar = 'CONSIDERAR_ABERTO')
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}       	
        	
        
        	$aBaseInvert = explode( '/', $dBase);
        	$dBaseInvert = $aBaseInvert[2] . $aBaseInvert[1] . $aBaseInvert[0];
        	$dAchou = $dBaseInvert;
        		
        	$aDadosBoleto = $this->GetIdInfo($Boleto_Id);
        
        	$vReturn = $aDadosBoleto['STATE_BASE_ID'];
        	
      
        	$sql = "select
			        	upper(Col)							as Col,
			        	Old									as Old,
			        	New									as New,
			        	trunc(boletohi.dt)					as Data,
			        	to_Char( boletohi.dt, 'yyyymmdd')	as DataInvert
		        	from
        				boletohi
        			where
        				upper(col) = 'STATE_BASE_ID'
        			and
        				to_date(boletohi.dt) >= to_date( '$dBase' )
        			and
        				boletohi.Boleto_id = $Boleto_Id
        			order by boletohi.dt";
        		
        	$dbData = new DbData($this->db);
        	        
        	$dbData->Get($sql);
        
        	$vAchou = 0;  	

        	 
        	if ($dbData->Count() >= 1)
        	{
	        	while ($row = $dbData->Row())
    	    	{
        			if ($dBaseInvert == $row['DATAINVERT'])
        			{
        				$vReturn = $row['NEW'];
        				$vAchou = 1;
        				$dAchou = $row['DATAINVERT'];
        			}
        			else
        			{
        				if ($vAchou == 0)
        				{
        					$vReturn = $row['OLD'];
        					$vAchou = 1;
        					$dAchou = $row['DATAINVERT'];
        				}
    		   		}
        		}
        	}

        	
       	
        	If ( $vReturn == 3000000000003 || $vReturn == 3000000000007 )
        	{
        		If ( strtoupper( $vBoleto_Considerar ) == 'CONSIDERAR_ABERTO' )
        		{        		
        			$vReturn = 3000000000006;
        		}
        		If ( strtoupper( $vBoleto_Considerar ) == 'CONSIDERAR_QUITADO' )
        		{
        			$vReturn = 3000000000004;
        		}
        	}
        	else 
        	{
        		If ( $vReturn == 3000000000004 )
        		{
        			require_once  ("../model/Recebimento.class.php");
        			$recebimento = new Recebimento($this->db);   			
       			
        			$aDadosRecebimento = $recebimento->GetBoletoIdInfo($Boleto_Id);
        			
        			if (is_array($aDadosRecebimento) && ($aDadosRecebimento[CNAB_ID] <> '' || $aDadosRecebimento[PARCEL_ID] <> '' || $aDadosRecebimento[POSTOBANC_ID]) && $aDadosRecebimento[DTPAGTOINVERT] > $dBaseInvert)
        			{
        				$vReturn = 3000000000006;
        			}
        			else 
        			{
        				if (is_array($aDadosRecebimento) && ($aDadosRecebimento[BAIXAMTI_ID] <> '' || $aDadosRecebimento[BOLETO_ORIGEM_ID] <> '') && $aDadosRecebimento[DTINVERT] > $dBaseInvert)
        				{
        					$vReturn = 3000000000006;
        				}
        			} 			
        			        			
        			unset($recebimento);        			 
        		}
        	}
        	
        	
        	
        	// Verifico se o dia do vencto do boleto é útil, senão trago próximo dia útil
        	If ( $vReturn == 3000000000006 )
        	{
        		require_once ("../model/Feriado.class.php");
        		$feriado = new Feriado($this->db);        		        		
        		        		
        		$vProximoDia = $feriado->GetProximoDiaUtilBancario($aDadosBoleto['DTVENCTO']);
        		
        		$aVenctoInvert = explode( '/', $vProximoDia);
        		$dVenctoInvert = $aVenctoInvert[2] . $aVenctoInvert[1] . $aVenctoInvert[0];
        		

        	 
        		If ($dVenctoInvert >= $dBaseInvert)
        		{
        			$vReturn = 3000000000005; 
        		}
        		Else
        		{
        			$vReturn = 3000000000002; 
        		}
        	}    	
        	
           	return $vReturn;
        }
        
        
        //Retorna Valor de um boleto em determinada data.
        function GetValorData($Boleto_Id, $dBase='')
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        	 
        	$nReturn = 0.00;
        	 
        	$aBaseInvert = explode( '/', $dBase);
        	$dBaseInvert = $aBaseInvert[2] . $aBaseInvert[1] . $aBaseInvert[0];
        
        	$aDadosBoleto = $this->GetIdInfo($Boleto_Id);
        
        	$aGeracaoInvert = explode( '/', $aDadosBoleto['DT']);
        	$dGeracaoInvert = $aGeracaoInvert[2] . $aGeracaoInvert[1] . $aGeracaoInvert[0];
        	 
        	if ($dBaseInvert >= $dGeracaoInvert)
        	{
        		
        		$nReturn = Str_Replace(',','.',$aDadosBoleto['VALOR']);

        		//echo 'Valor do boleto antes do historico ' . $nReturn . '<br>';
       
    	    	$sql = "select
				        	upper(Col)							as Col,
				        	Replace(Old,',','.')				as Old,
			    	    	Replace(New,',','.')				as New,
			        		trunc(boletohi.dt)					as Data,
				        	to_Char( boletohi.dt, 'yyyymmdd')	as DataInvert
			        	from
        					boletohi
        				where
        					upper(col) = 'VALOR'
        				and
	        				to_date(boletohi.dt) >= to_date( '$dBase' )
    	    			and
        					boletohi.Boleto_id = $Boleto_Id
        				order by boletohi.dt";
        
	        	$dbData = new DbData($this->db);
    	    		
        		$dbData->Get($sql);
        	
        		$vAchou = 0;        
        
	        	if ($dbData->Count() >= 1)
    	    	{
	    	    	while ($row = $dbData->Row())
        			{
		        		if ($dBaseInvert == $row['DATAINVERT'])
    	    			{
	        				$nReturn = $row['NEW'];
    	    				$vAchou = 1;
        					$dAchou = $row['DATAINVERT'];
       					}
       					else
	       				{
		        			if ($vAchou == 0)
        					{
		    	    			$nReturn = $row['OLD'];
       							$vAchou = 1;
    	    					$dAchou = $row['DATAINVERT'];
	        				}
    	   				}
        			}
    	    	}
        	}
	   		return $nReturn;
        }      

        
        public function GetBoletoCobExt($WPessoaId,$dtAcordo)
        {
        	$dbData = new DbData($this->db);
        	 
        	$dbData->Get("select 
        					id,
        					referencia,
        					boletoti_gsRecognize(boletoti_id) as boletoti,
        					dtvencto,valor,
        					to_char(valor,'999G999G999D99') as valor_format,
        					boleto_gnMulta(id,'$dtAcordo','CONSIDERAR_ABERTO') as multa, 
        					to_char(boleto_gnMulta(id,'$dtAcordo','CONSIDERAR_ABERTO'),'999G999G999D99') as multa_format,
        					boleto_gnMora(id,'$dtAcordo','CONSIDERAR_ABERTO') as mora,
        					to_char(boleto_gnMora(id,'$dtAcordo','CONSIDERAR_ABERTO'),'999G999G999D99') as mora_format,
        					boleto_gnValor(id,'$dtAcordo',null,null,'CONSIDERAR_ABERTO') as ValorTotal,
        					to_char(boleto_gnValor(id,'$dtAcordo',null,null,'CONSIDERAR_ABERTO'),'999G999G999D99') as ValorTotal_format,  
        					campus_gsRecognize(Campus_Id) as unidade 
        					from boleto 
        					where state_base_id = 3000000000007 and WPessoa_Sacado_Id='".$WPessoaId."'");
        	
        	$aReturn = array();
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn[] = $row;
        	}
        	 
        	return $aReturn;
        	 
        }
        
        //Retorna qtde de dias que o boleto esta vencido
        function GetDiasVencido($Boleto_Id, $dBase='')
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        	
        	$sql = "select
        				to_date('".$dBase."') - to_date(boleto.dtvencto)   	as dias
					from
        				boleto
					where
        				boleto.id = '". $Boleto_Id ."'";
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	$aReturn = $dbData->Row();
        
        	unset($dbData);
        	
        	$nReturn = $aReturn[DIAS];
        	if ($nReturn < 0)
        	{
        		$nReturn = 0;
        	}	        		
        
        	return $nReturn;
        }

        
        //Retorna os boletos em aberto de determinada pessoa
        function GetBoletoEmAbertoData($p_WPessoa_Id, $dBase='', $p_BoletoTi_Id = '', $p_Boleto_Considerar = 'CONSIDERAR_ABERTO', $p_TipoData = 'VIRTUAL' )
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        	
        	$aReturn = '';
        	 
        	$sql = "select
  						boleto.referencia 						as Referencia,
  						to_char(boleto.dtvencto, 'dd/mm/yyyy')	as Vencto,
	  					replace(boleto.valor , ',','.')			as Valor,
        				boleto.competencia                    	as Competencia,
        				boletoti.Nome                           as Boletoti_Nome        				
					from
						Boleto,
        				Boletoti
					where
        			(
        				(
  							boletoti.id = boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id )
  						and 
  							'" . $p_TipoData . "' = 'VIRTUAL'
  						)
  						or
        				(
  							boletoti.id = boleto.boletoti_id
  						and 
  							'" . $p_TipoData . "' = 'FISICO'
  						)
  					)  									
        			and
						Boleto_gnState(boleto.Id,sysdate, '" . $p_Boleto_Considerar . "' ) = 3000000000002
					and
					( 
						(
							'" . $p_BoletoTi_Id . "' is null
						and
      						BoletoTi_Id in (92200000000002,92200000000003,92200000000009,92200000000010,92200000000012,92200000000014,92200000000015,92200000000018)
    					)
    					or
    					( 
      						'" . $p_BoletoTi_Id . "' is not null
    					and
      						'" . $p_BoletoTi_Id . "' = BoletoTi_Id
    					)
  					)
					and
	  					WPessoa_Sacado_Id = nvl ( '" . $p_WPessoa_Id . "' ,0)
  					order by ordemref";
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
            while ($row = $dbData->Row())
        	{
        		$aReturn[] = $row;
        	}
        
        	unset($dbData);
        	 
        
        	return $aReturn;
        } 

        
               
        //Retorna as quantidades de boletos em aberto por tipo
        function GetBoletoEmAbertoDataGrupo($p_WPessoa_Id, $dBase='', $p_BoletoTi_Id = '', $p_Boleto_Considerar = 'CONSIDERAR_ABERTO', $p_TipoData = 'VIRTUAL' )
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        	 
        	$aReturn = '';
        
        	$sql = "select
	  					replace(sum(boleto.valor) , ',','.')			as Valor,        			
  						count(boleto.id)	as qtd,
        				boletoti.Nome       as Boletoti_Nome,
        				boletoti.id			as boletoti_id
					from
						Boleto,
        				Boletoti
					where
        			(
        				(
  							boletoti.id = boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id )
  						and 
  							'" . $p_TipoData . "' = 'VIRTUAL'
  						)
  						or
        				(
  							boletoti.id = boleto.boletoti_id
  						and 
  							'" . $p_TipoData . "' = 'FISICO'
  						)
  					)  									
        			and
						Boleto_gnState(boleto.Id,sysdate, '" . $p_Boleto_Considerar . "' ) = 3000000000002
					and
					(
						(
							'" . $p_BoletoTi_Id . "' is null
						and
      						BoletoTi_Id in (92200000000002,92200000000003,92200000000009,92200000000010,92200000000012,92200000000014,92200000000015,92200000000018)
    					)
    					or
    					(
      						'" . $p_BoletoTi_Id . "' is not null
    					and
      						'" . $p_BoletoTi_Id . "' = BoletoTi_Id
    					)
  					)
					and
	  					WPessoa_Sacado_Id = nvl ( '" . $p_WPessoa_Id . "' ,0)
	  				group by 
	  					boletoti.id, 
	  					boletoti.nome
  					order by boletoti.nome";
       	
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn[] = $row;
        	}
        
        	unset($dbData);
        
        
        	return $aReturn;
        }
        
	}
?>