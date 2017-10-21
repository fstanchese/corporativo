<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Recebimento extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Recebimento'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 250000;


            $this->attribute['DtPagto']['Type'] = 'date';
            $this->attribute['DtPagto']['NN'] = 1;
            $this->attribute['DtPagto']['Label'] = 'Data do Pagamento';
            $this->attribute['DtPagto']['Mask'] = 'd';

            $this->attribute['Valor']['Type'] = 'number';
            $this->attribute['Valor']['Length'] = 12.2;
            $this->attribute['Valor']['NN'] = 1;
            $this->attribute['Valor']['Label'] = 'Valor Pago';
            $this->attribute['Valor']['Mask'] = '9';

            $this->attribute['Mora']['Type'] = 'number';
            $this->attribute['Mora']['Length'] = 12.2;
            $this->attribute['Mora']['Label'] = 'Mora';
            $this->attribute['Mora']['OMask'] = '9';

            $this->attribute['Multa']['Type'] = 'number';
            $this->attribute['Multa']['Length'] = 12.2;
            $this->attribute['Multa']['Label'] = 'Multa';
            $this->attribute['Multa']['OMask'] = '9';

            $this->attribute['Boleto_Id']['Type'] = 'number';
            $this->attribute['Boleto_Id']['Length'] = 15;
            $this->attribute['Boleto_Id']['Label'] = 'Boleto';

            $this->attribute['Empresa_Id']['Type'] = 'number';
            $this->attribute['Empresa_Id']['Length'] = 15;
            $this->attribute['Empresa_Id']['Label'] = 'Empresa Responsável pelo Pagamento';

            $this->attribute['PostoBanc_Origem_Id']['Type'] = 'number';
            $this->attribute['PostoBanc_Origem_Id']['Length'] = 15;
            $this->attribute['PostoBanc_Origem_Id']['Label'] = 'Posto Bancário';

            $this->attribute['CNAB_Origem_Id']['Type'] = 'number';
            $this->attribute['CNAB_Origem_Id']['Length'] = 15;
            $this->attribute['CNAB_Origem_Id']['Label'] = 'Pago via Compensação';

            $this->attribute['BaixaMTi_Id']['Type'] = 'number';
            $this->attribute['BaixaMTi_Id']['Length'] = 15;
            $this->attribute['BaixaMTi_Id']['Label'] = 'Tipo da Baixa';

            $this->attribute['NFe']['Type'] = 'number';
            $this->attribute['NFe']['Length'] = 12;
            $this->attribute['NFe']['Label'] = 'Nota Fiscal Eletrônica';

            $this->attribute['NFeRPS']['Type'] = 'number';
            $this->attribute['NFeRPS']['Length'] = 12;
            $this->attribute['NFeRPS']['Label'] = 'RPS da Nota Fiscal Eletrônica';

            $this->attribute['NFeCodVerif']['Type'] = 'varchar2';
            $this->attribute['NFeCodVerif']['Length'] = 8;
            $this->attribute['NFeCodVerif']['Label'] = 'Verificação Nota Fiscal Eletrônica';

            $this->attribute['Boleto_Origem_Id']['Type'] = 'number';
            $this->attribute['Boleto_Origem_Id']['Length'] = 15;
            $this->attribute['Boleto_Origem_Id']['Label'] = 'Boleto - Transferência de Baixa';

            $this->attribute['Parcel_Origem_Id']['Type'] = 'number';
            $this->attribute['Parcel_Origem_Id']['Length'] = 15;
            $this->attribute['Parcel_Origem_Id']['Label'] = 'Parecelamento de Origem';

            $this->attribute['NFeNaoEnviar']['Type'] = 'varchar2';
            $this->attribute['NFeNaoEnviar']['Length'] = 3;
            $this->attribute['NFeNaoEnviar']['Label'] = 'Nota Fiscal Eletrônica - Não Enviar';

            $this->attribute['Hash']['Type'] = 'varchar2';
            $this->attribute['Hash']['Length'] = 50;
            $this->attribute['Hash']['Label'] = 'Hash';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['BaixaNFeEmpresa'] = 'Recebimento_qNFeEmpresa';


            //Recognizes

            //Índices
            $this->index['dtpagto']['Cols'] = "dtpagto";
            $this->index['boleto_id']['Cols'] = "boleto_id";
            $this->index['NFeRPS']['Cols'] = "NFeRPS";
            $this->index['PostoBanc_Id']['Cols'] = "PostoBanc_Origem_Id";
            $this->index['BaixaMTi_Id']['Cols'] = "BaixaMTi_Id";
            $this->index['trunc_Dt']['Cols'] = "truncDt";

            //Todas as Queries da classe
            $this->query['qBaixaManual'] = 'Recebimento_qBaixaManual';
            $this->query['qBoleto'] = 'Recebimento_qBoleto';
            $this->query['qBoleto_Id'] = 'Recebimento_qBoleto_Id';
            $this->query['qBoleto_IdCount'] = 'Recebimento_qBoleto_IdCount';
            $this->query['qBoletoResiduo'] = 'Recebimento_qBoletoResiduo';
            $this->query['qCompetenciaBaixada'] = 'Recebimento_qCompetenciaBaixada';
            $this->query['qComplementodeBaixa'] = 'Recebimento_qComplementodeBaixa';
            $this->query['qDtPagto'] = 'Recebimento_qDtPagto';
            $this->query['qGeral'] = 'Recebimento_qGeral';
            $this->query['qId'] = 'Recebimento_qId';
            $this->query['qNFeEmpresa'] = 'Recebimento_qNFeEmpresa';
            $this->query['qNFEEnviadas'] = 'Recebimento_qNFEEnviadas';
            $this->query['qNFeReenvio'] = 'Recebimento_qNFeReenvio';
            $this->query['qNFeReservadeVaga'] = 'Recebimento_qNFeReservadeVaga';
            $this->query['qPeriodo'] = 'Recebimento_qPeriodo';
            $this->query['qPeriodoEstac'] = 'Recebimento_qPeriodoEstac';
            $this->query['qPessoa'] = 'Recebimento_qPessoa';
            $this->query['qPostoBanc'] = 'Recebimento_qPostoBanc';
            $this->query['qPostoBanc_Id'] = 'Recebimento_qPostoBanc_Id';
            $this->query['qSomaAmortizacao'] = 'Recebimento_qSomaAmortizacao';
            $this->query['qUltimaDtPagto'] = 'Recebimento_qUltimaDtPagto';
            $this->query['qUnica'] = 'Recebimento_qUnica';
            
                 
        } 
        
        //Retorna informações do recebimento atraves da boleto.
        function GetBoletoIdInfo($Boleto_Id)
        {        
        	$sql = "select
						boleto_id 									as boleto_id,
						recebimento.dt 								as dt,
        				recebimento.dtpagto							as dtpagto,
				        replace(recebimento.valor,',','.') 			as Valor,
				        replace(recebimento.mora,',','.')		 	as Mora,
				        replace(recebimento.multa,',','.')	 		as Multa,
						recebimento.cnab_origem_id 					as Cnab_Id,
        				recebimento.parcel_origem_id 				as Parcel_Id,
						recebimento.postobanc_origem_id	 			as PostoBanc_Id,
						recebimento.baixamti_id 					as BaixaMTi_Id,
        				recebimento.empresa_id 	        			as Empresa_Id,
        				recebimento.boleto_origem_id 	  			as Boleto_Origem_Id,
        				to_char(recebimento.dt,'yyyymmdd')			as dtinvert,
        				to_char(recebimento.dtpagto,'yyyymmdd')		as dtpagtoinvert,
						to_char(recebimento.dt,'dd/mm/yyyy') 		as dt_format,
        				to_char(recebimento.dtpagto,'dd/mm/yyyy')	as dtpagto_format                        			
					from
						recebimento
					where
						recebimento.boleto_id = '". $Boleto_Id ."'
					order by recebimento.id";
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        		
        	$aReturn = $dbData->Row();       	
      
        	unset($dbData);
        
        	return $aReturn;
        }

        //Retorna informações de quantos dias o boleto foi recebidoa após o vencimento.
        function GetDiasAteRecebimento($Boleto_Id)
        {
        	$sql = "select
						boleto_id 									as boleto_id,
						recebimento.dt 								as dt,
        				recebimento.dtpagto							as dtpagto,
        				boleto.dtvencto								as dtvencto,
        				recebimento.dtpagto - boleto.dtvencto   	as dias,
						to_char(recebimento.dt,'dd/mm/yyyy') 		as dt_format,
        				to_char(recebimento.dtpagto,'dd/mm/yyyy')	as dtpagto_format,
					from
        				boleto,
						recebimento
					where
        				boleto.id=boleto_id
        			and
						recebimento.boleto_id = '". $Boleto_Id ."'
					order by recebimento.id";
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	$aReturn = $dbData->Row();
        
        	unset($dbData);
        
        	return $aReturn;
        }        
} 