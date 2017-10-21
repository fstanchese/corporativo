<?php

    require_once ("../engine/Model.class.php");

    class WOcorrFluxo extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrFluxo'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorr_Id']['Type'] 			= 'number';
            $this->attribute['WOcorr_Id']['Length'] 		= 15;
            $this->attribute['WOcorr_Id']['Label'] 			= 'Ocorrência';
            $this->attribute['WOcorr_Id']['Recognize'] 		= '1';

            $this->attribute['State_Id']['Type'] 			= 'number';
            $this->attribute['State_Id']['Length'] 			= 15;
            $this->attribute['State_Id']['Label'] 			= 'Situação';

            $this->attribute['Depart_Id']['Type'] 			= 'number';
            $this->attribute['Depart_Id']['Length'] 		= 15;
            $this->attribute['Depart_Id']['NN'] 			= 1;
            $this->attribute['Depart_Id']['Label'] 			= 'Departamento';

            $this->attribute['WOcorrAssReP_Id']['Type'] 	= 'number';
            $this->attribute['WOcorrAssReP_Id']['Length'] 	= 15;
            $this->attribute['WOcorrAssReP_Id']['Label'] 	= 'Resposta Padrão';

            $this->attribute['Texto']['Type'] 				= 'varchar2';
            $this->attribute['Texto']['Length'] 			= 1200;
            $this->attribute['Texto']['Label'] 				= 'Texto';

            $this->attribute['DtAnexo']['Type'] 			= 'date';
            $this->attribute['DtAnexo']['Label']			= 'Data do Recebimento do Anexo';

            $this->attribute['SimNao_Defer_Id']['Type'] 	= 'number';
            $this->attribute['SimNao_Defer_Id']['Length'] 	= 15;
            $this->attribute['SimNao_Defer_Id']['Label'] 	= 'Situação';

            $this->attribute['Depart_Origem_Id']['Type'] 	= 'number';
            $this->attribute['Depart_Origem_Id']['Length'] 	= 15;
            $this->attribute['Depart_Origem_Id']['Label'] 	= 'Departamento';

            $this->attribute['UsInicial']['Type'] 			= 'varchar2';
            $this->attribute['UsInicial']['Length'] 		= 30;
            $this->attribute['UsInicial']['Label'] 			= 'usuário inicial';

            $this->attribute['UsAnexo']['Type'] 			= 'varchar2';
            $this->attribute['UsAnexo']['Length'] 			= 30;
            $this->attribute['UsAnexo']['Label'] 			= 'anexo recebido por';

            $this->attribute['Depart_Resp_Id']['Type'] 		= 'number';
            $this->attribute['Depart_Resp_Id']['Length'] 	= 15;
            $this->attribute['Depart_Resp_Id']['Label'] 	= 'Departamento';

            $this->attribute['RespInternet']['Type'] 		= 'varchar2';
            $this->attribute['RespInternet']['Length'] 		= 3;
            $this->attribute['RespInternet']['Label'] 		= 'Disponibiliza Resposta na Internet';

            $this->attribute['Campus_Id']['Type'] 			= 'number';
            $this->attribute['Campus_Id']['Length'] 		= 15;
            $this->attribute['Campus_Id']['Label'] 			= 'Campus';

            $this->attribute['Inativo']['Type'] 			= 'varchar2';
            $this->attribute['Inativo']['Length'] 			= 3;
            $this->attribute['Inativo']['Label'] 			= 'Resposta Excluida';

            $this->recognize['Recognize']	= 'WOcorr_Id, Depart_Id, Dt'; 
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qWOcorr'] 						= 'WOcorrFluxo_qWOcorr';
            $this->query['qOcorrEnc'] 					= 'WOcorrFluxo_qOcorrEnc';
            $this->query['qWOcorrDeferido'] 				= 'WOcorrFluxo_qWOcorrDeferido';
            $this->query['qWOcorrCountRespInternet'] 	= 'WOcorrFluxo_qWOcorrCountRespInternet';
            $this->query['qId'] 							= 'WOcorrFluxo_qId';
            $this->query['qDepart'] 					= 'WOcorrFluxo_qDepart';

                            
        }
        
        public function GetFluxoInternet($WOcorr_Id)
        {        		
        	$dbData = new DbData($this->db);
        		
        	$dbData->Get("
        			SELECT
        				WOcorrFluxo.Inativo,
        				to_char(WOcorrFluxo.Dt,'DD/MM/YYYY HH24:MI:SS')  as DtHora,
        				WOcorrFluxo.Id   as WOcorrFluxo_Id,
        				WOcorrFluxo.Texto   as TextoDigitado,
        				WOcorrAssReP.Descricao   as RespostaPadrao,
        				SimNao_gsRecognize(SimNao_Defer_Id)   as DEFERIDO,
        				DtAnexo    as DtAnexo,
        				WOcorrFluxo.RespInternet   as RespInternet,
        				WOcorrFluxo.Us   as WOcorrFluxo_Us,
        				WOcorrFluxo.DtAnexo    as DtAnexo
        			FROM
        				WOcorrFluxo,
        				WOcorrAssReP
        			WHERE
        				WOcorrFluxo.WOcorrAssReP_Id = WOcorrAssReP.Id (+)
        			AND
        				WOcorrFluxo.RespInternet = 'on'
        			AND
        				WOcorrFluxo.WOcorr_Id = '".$WOcorr_Id."'
        			ORDER BY
        				WOcorrFluxo.Dt DESC");	
        		     		       
			$cont = 0;	
			
			while($row = $dbData->Row() )
			{
				$arEnd[$cont]["INATIVO"] 		= $row["INATIVO"];
				$arEnd[$cont]["DTHORA"]			= $row["DTHORA"];
				if($row["RESPOSTAPADRAO"] != "")
					$arEnd[$cont]["TEXTODIGITADO"] 	= $row["RESPOSTAPADRAO"];
				else
					$arEnd[$cont]["TEXTODIGITADO"]	= $row["TEXTODIGITADO"];
				$arEnd[$cont]["DEFERIDO"]	= $row["DEFERIDO"];
				$arEnd[$cont]["RESPINTERNET"]= $row["RESPINTERNET"];
				
				$cont++;
			}
        		
        	return $arEnd;        		
        }
}
?> 