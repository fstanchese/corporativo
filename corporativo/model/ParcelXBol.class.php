<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ParcelXBol extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ParcelXBol'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 300000;


            $this->attribute['VlrPrincipal']['Type'] 		= 'number';
            $this->attribute['VlrPrincipal']['Length'] 		= 12.2;
            $this->attribute['VlrPrincipal']['Label'] 		= 'Valor de Principal';
            $this->attribute['VlrPrincipal']['Mask'] 		= '9';

            $this->attribute['VlrMora']['Type'] 			= 'number';
            $this->attribute['VlrMora']['Length'] 			= 12.2;
            $this->attribute['VlrMora']['Label'] 			= 'Valor de Mora';
            $this->attribute['VlrMora']['Mask'] 			= '9';

            $this->attribute['VlrMulta']['Type'] 			= 'number';
            $this->attribute['VlrMulta']['Length'] 			= 12.2;
            $this->attribute['VlrMulta']['Label'] 			= 'Valor de Multa';
            $this->attribute['VlrMulta']['Mask'] 			= '9';

            $this->attribute['VlrTxFinanc']['Type'] 		= 'number';
            $this->attribute['VlrTxFinanc']['Length'] 		= 12.2;
            $this->attribute['VlrTxFinanc']['Label'] 		= 'Valor de Taxa de Financiamento';
            $this->attribute['VlrTxFinanc']['Mask'] 		= '9';

            $this->attribute['Boleto_Orig_Id']['Type'] 		= 'number';
            $this->attribute['Boleto_Orig_Id']['Length'] 	= 15;
            $this->attribute['Boleto_Orig_Id']['Label'] 	= 'Boleto Origem';

            $this->attribute['Boleto_Dest_Id']['Type'] 		= 'number';
            $this->attribute['Boleto_Dest_Id']['Length'] 	= 15;
            $this->attribute['Boleto_Dest_Id']['NN'] 		= 1;
            $this->attribute['Boleto_Dest_Id']['Label'] 	= 'Boleto Destino';

            $this->attribute['Parcel_Id']['Type'] 			= 'number';
            $this->attribute['Parcel_Id']['Length'] 		= 15;
            $this->attribute['Parcel_Id']['NN'] 			= 1;
            $this->attribute['Parcel_Id']['Label'] 			= 'Parcelamento';

            $this->attribute['CESJRe_Orig_Id']['Type'] 		= 'number';
            $this->attribute['CESJRe_Orig_Id']['Length'] 	= 15;
            $this->attribute['CESJRe_Orig_Id']['Label'] 	= 'Crédito Educativo Origem';

            //Calculates para a criação de querys no diretório SQL
			$this->calculate['Parcel']			= 'ParcelXBol_qParcelTotal';

            //Recognizes
			$this->recognize['Recognize']		= 'Parcel_Id,Boleto_Orig_Id,Boleto_Dest_Id';
			
            //Índices

            //Todas as Queries da classe
            $this->query['qParcelTotal'] 		= 'ParcelXBol_qParcelTotal';
            $this->query['qBoletoTotal'] 		= 'ParcelXBol_qBoletoTotal';
            $this->query['qGeral'] 				= 'ParcelXBol_qGeral';
            $this->query['qBolDeMaxBolOr'] 		= 'ParcelXBol_qBolDeMaxBolOr';
            $this->query['qId'] 				= 'ParcelXBol_qId';
            $this->query['qBolDeSemTxFinanc'] 	= 'ParcelXBol_qBolDeSemTxFinanc';

                 
        } 
        
        //Retorna um array com as informações do(s) boleto(s) que deu origem ao boleto de parcelamento.
        function GetBoletoOrigem($boleto_dest_id, $lRealBoletoTi=TRUE)
        {
        	
        	$sql = "Select 
        				boleto.id                     	as Boleto_Id,
        				boleto_gnBoletoTi(boleto.id)  	as BoletoTi_Id,
        			    boleto.Valor               	  	as BoletoValor,
        				parcelxbol.VlrPrincipal    	  	as Principal,
        				parcelxbol.VlrMora         	  	as Mora,
        				parcelxbol.VlrMulta			  	as Multa,
        				parcelxbol.VlrTxFinanc	   	  	as VlrTxFinanc,
        				boleto.Competencia         	  	as Competencia,
        			    boleto.DtVencto           	  	as DtVencto,
        			    boleto.Dt  					  	as Geracao,
        			 	boleto.OrdemRef					as OrdemRef,
			        	boletoti_id 	                as BoletoTi_Real_Id,
			        	nossonum						as NossoNum 
        			from
        				boleto,
        				parcelxbol
        			where
        				boleto.id = parcelxbol.boleto_orig_id
        			and
        				parcelxbol.boleto_orig_id is not null
        			and
        				parcelxbol.boleto_dest_id = nvl('$boleto_dest_id' ,0)
        			order by
        				boleto.Boletoti_id desc, boleto.OrdemRef";
        	
        	$dbData = new DbData($this->db);
        		
        	$aReturn = array();
        	$aRecursivo = array();
        	
        	$dbData->Get($sql);
        	
        	while ($row = $dbData->Row())
        	{
        		if ($lRealBoletoTi == TRUE)
        		{
        			$vBoletoTi = $row["BOLETOTI_REAL_ID"];
        		}
        		else
        		{
        			$vBoletoTi = $row["BOLETOTI_ID"];
        		}        		
        		// Se for boleto de parcelamento, eu chamo novamente o metodo
        		if ($vBoletoTi == 92200000000002)   
        		{
        			$aRecursivo = $this->GetBoletoOrigem( $row[BOLETO_ID], $lRealBoletoTi );
        			
        			foreach($aRecursivo as $key => $array)
        			{
       					$aReturn[$array[BOLETO_ID]]['MORA'] = _DecimalPoint($array[MORA]);
       					$aReturn[$array[BOLETO_ID]]['MULTA'] = _DecimalPoint($array[MULTA]);
        				$aReturn[$array[BOLETO_ID]]['VLRTXFINANC'] = _DecimalPoint($array[VLRTXFINANC]);
        				$aReturn[$array[BOLETO_ID]]['COMPETENCIA'] = $array[COMPETENCIA];
        				$aReturn[$array[BOLETO_ID]]['VLRPRINCIPAL'] = _DecimalPoint($array[PRINCIPAL]);
        				$aReturn[$array[BOLETO_ID]]['BOLETOTI_ID'] = $array[BOLETOTI_ID];
        				$aReturn[$array[BOLETO_ID]]['BOLETO_ID'] = $array[BOLETO_ID];        				
        			}        			
        		}
        		else 
        		{
        			$aReturn[$row[BOLETO_ID]]['MORA'] = _DecimalPoint($row[MORA]);
        			$aReturn[$row[BOLETO_ID]]['MULTA'] = _DecimalPoint($row[MULTA]);
        			$aReturn[$row[BOLETO_ID]]['VLRTXFINANC'] = _DecimalPoint($row[VLRTXFINANC]);
        			$aReturn[$row[BOLETO_ID]]['COMPETENCIA'] = $row[COMPETENCIA];
        			$aReturn[$row[BOLETO_ID]]['VLRPRINCIPAL'] = _DecimalPoint($row[PRINCIPAL]);
   					$aReturn[$row[BOLETO_ID]]['BOLETOTI_ID'] = $vBoletoTi;
        			$aReturn[$row[BOLETO_ID]]['BOLETO_ID'] = $array[BOLETO_ID];        				
        		}
        	}
        		
        	return $aReturn;
        }        
	} 
?>