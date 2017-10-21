<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class TempDivxBol extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'TempDivxBol'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000000;


            $this->attribute['NP_Numero']['Type'] = 'number';
            $this->attribute['NP_Numero']['Length'] = 13;
            $this->attribute['NP_Numero']['NN'] = 1;
            $this->attribute['NP_Numero']['Label'] = 'Numero da NP';

            $this->attribute['Bt_DivPms']['Type'] = 'number';
            $this->attribute['Bt_DivPms']['Length'] = 13;
            $this->attribute['Bt_DivPms']['NN'] = 1;
            $this->attribute['Bt_DivPms']['Label'] = 'Boleto da Divida';

            $this->attribute['Bt_ParcPms']['Type'] = 'number';
            $this->attribute['Bt_ParcPms']['Length'] = 13;
            $this->attribute['Bt_ParcPms']['NN'] = 1;
            $this->attribute['Bt_ParcPms']['Label'] = 'Boleto do Parcelamento Gerado';

            $this->attribute['Vlr_Prin']['Type'] = 'number';
            $this->attribute['Vlr_Prin']['Length'] = 12.2;
            $this->attribute['Vlr_Prin']['NN'] = 1;
            $this->attribute['Vlr_Prin']['Label'] = 'Valor Principal';

            $this->attribute['Vlr_Juros']['Type'] = 'number';
            $this->attribute['Vlr_Juros']['Length'] = 12.2;
            $this->attribute['Vlr_Juros']['NN'] = 1;
            $this->attribute['Vlr_Juros']['Label'] = 'Valor Juros';

            $this->attribute['Vlr_Multa']['Type'] = 'number';
            $this->attribute['Vlr_Multa']['Length'] = 12.2;
            $this->attribute['Vlr_Multa']['NN'] = 1;
            $this->attribute['Vlr_Multa']['Label'] = 'Valor Multa';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes

            //Índices
            $this->index['ParcPms']['Cols']	= "bt_parcpms";
            
            //Todas as Queries da classe

                 
        }

        //Retorna um array com as informações do(s) boleto(s) que deu origem ao boleto de parcelamento.
        function GetBoletoOrigem($bt_parcpms, $lRealBoletoTi=TRUE)
        { 
        	      				 
        	$sql = "Select
			        	boleto.id                     as Boleto_Id,
			        	boleto_gnBoletoTi(boleto.id)  as BoletoTi_Id,
			        	boleto.Valor               	  as BoletoValor,
			        	tempdivxbol.Vlr_Prin    	  as Principal,
			        	tempdivxbol.Vlr_Juros      	  as Mora,
			        	tempdivxbol.Vlr_Multa		  as Multa,
			        	0 							  as vlrtxfinanc,
			        	boleto.Competencia         	  as Competencia,
			        	boleto.DtVencto           	  as DtVencto,
			        	boleto.Dt  					  as Geracao,
			        	boleto.OrdemRef				  as OrdemRef,
			        	boletoti_id                   as BoletoTi_Real_Id,
			        	boleto.nossonum               as NossoNum
			       	from
			        	boleto,
			        	tempdivxbol
			       	where
        				exists ( select id from boleto parc where parc.wpessoa_sacado_id = boleto.wpessoa_sacado_id and parc.nossonum = nvl('$bt_parcpms' ,0) )
        			and
		        		boleto.nossonum = tempdivxbol.bt_divpms
        			and
        				tempdivxbol.bt_parcpms = nvl('$bt_parcpms' ,0)
		        	order by
        				OrdemRef";
        	
       	
        	require_once("../model/ParcelXBol.class.php");        	
        	
        	$parcelxbol	= new ParcelXBol($this->db);        	
        	$dbData     = new DbData($this->db);
        
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
        		
        		if ($vBoletoTi == 92200000000002 || $vBoletoTi == 92200000000009)   
        		{
		        	// Se for boleto de parcelamento, eu chamo novamente o metodo da parcelxbol
		        	if ($vBoletoTi == 92200000000002) 
		        	{
        				$aRecursivo = $parcelxbol->GetBoletoOrigem( $row[BOLETO_ID], $lRealBoletoTi );
		        	}
		        	else 
		        	{
		        	// Se for boleto de parcelamento externo, eu chamo novamente o metodo        			      
		        		$aRecursivo = $this->GetBoletoOrigem( $row[NOSSONUM], $lRealBoletoTi );		        		
		        	}
        			
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
        	
        	unset($dbData);
        	unset($dbOracle);
        	unset($parcelxbol);
        	unset($user);
        	        	
        	return $aReturn;       	
        	
        }
	} 

?>