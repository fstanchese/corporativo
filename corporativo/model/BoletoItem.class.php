<?php
         
    require_once ("../engine/Model.class.php"); 
         
    class BoletoItem extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'BoletoItem'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 3000000;


            $this->attribute['Valor']['Type'] = 'number';
            $this->attribute['Valor']['Length'] = 12.2;
            $this->attribute['Valor']['NN'] = 1;
            $this->attribute['Valor']['Label'] = 'Valor do Item';
            $this->attribute['Valor']['Mask'] = 'm';

            $this->attribute['Boleto_Id']['Type'] = 'number';
            $this->attribute['Boleto_Id']['Length'] = 15;
            $this->attribute['Boleto_Id']['NN'] = 1;
            $this->attribute['Boleto_Id']['Label'] = 'Boleto';

            $this->attribute['Descricao']['Type'] = 'varchar2';
            $this->attribute['Descricao']['Length'] = 50;
            $this->attribute['Descricao']['NN'] = 1;
            $this->attribute['Descricao']['Label'] = 'Descrição do Item';

            $this->attribute['Ordem']['Type'] = 'number';
            $this->attribute['Ordem']['Length'] = 2;
            $this->attribute['Ordem']['NN'] = 1;
            $this->attribute['Ordem']['Label'] = 'Ordem';

            $this->attribute['LoteImportacao']['Type'] = 'number';
            $this->attribute['LoteImportacao']['Length'] = 5;
            $this->attribute['LoteImportacao']['Label'] = 'Lote da Importação';

            $this->attribute['BoletoItemTi_Id']['Type'] = 'number';
            $this->attribute['BoletoItemTi_Id']['Length'] = 15;
            $this->attribute['BoletoItemTi_Id']['Label'] = 'Tipo de Item';

            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Null'] = '';
            $this->attribute['State_Id']['Label'] = 'Situação';

            //Calculates para a criação de querys no diretório SQL

            
            //Recognizes

            
            //Índices
            $this->index['Boleto_Id']['Cols'] = "Boleto_Id";

            //Todas as Queries da classe

                 
        } 
        
        //Retorna um array com os itens do boleto na data, caso data=null usara a data corrente.
        function GetItensData($boleto_id, $dBase='', $vNome = 'NOME_ITEM')        
        {        	        	 
        	if ($dBase == '') 
        	   $dBase = date('d/m/Y');
        	
        	$aBaseInvert = explode( '/', $dBase);
        	$dBaseInvert = $aBaseInvert[2] . $aBaseInvert[1] . $aBaseInvert[0];
        	
        	$dbData = new DbData($this->db); 	
        	
     	 
        	 
        	$sql = "select 
        				boletoitem.id 						as Id,
			  		    replace(boletoitem.valor,',','.') 	as Valor,
			  		    contabilgru.nome 					as TipoItem,
			  		    boletoitemti.nome					as Nome,
					    boletoitem.dt 						as Data,
					    to_Char( boletoitem.dt, 'yyyymmdd') as DataInvert,
					    boletoitem.ordem 					as Ordem,
					    boletoitem.State_id					as State_Id,
					    boletoitemti.id                     as BoletoItemTi_Id
					from 
				    	contabilgru,				
			  			boletoitem,
			  			boletoitemti
					where
						boletoitemti.id = contabilgru.boletoitemti_id (+)
					and 
						boletoitem.BOLETOITEMTI_ID = BOLETOITEMTI.id
					and
					    to_Date(boletoitem.Dt) <= to_date( '$dBase' )
					and 
						boletoitem.Boleto_id = '". $boleto_id . "'
					order by Data";

        	
        
        	$aReturn = array();
        	 
        	$aDados = array();
        	 
        	$dbData->Get($sql);

        	while ($row = $dbData->Row())        		
        	{
        		$aItemHi = $this->GetHistoricoData($row,$dBase,'');

        		
        		if (_NVL($aItemHi['STATE_ID']['VALUE'],3000000017001) == 3000000017001)
        		{
        			if (strtoupper($vNome) == 'NOME_CONTABIL')
        			{	
    	    			$aDados[$row['NOME']]['TIPOITEM'] = $row['TIPOITEM'];
        			}
        			else 
        			{
        				if (strtoupper($vNome) == 'BOLETOITEMTI_ID')
        				{
        					$aDados[$row['NOME']]['TIPOITEM'] = $row['BOLETOITEMTI_ID'];
        				}
        				else
        				{
        					$aDados[$row['NOME']]['TIPOITEM'] = $row['NOME'];        					 
        				}	
        			}
        			$aDados[$row['NOME']]['VALOR'] = _NVL($aItemHi['VALOR']['VALUE'],$row['VALOR']);
        		}        	 
        	}	

        	foreach ($aDados as $row => $aItemReturn)
        	{
        		$aReturn[$aItemReturn['TIPOITEM']] += $aItemReturn['VALOR'];
        	}
   			return $aReturn;
		}
		

		//Retorna State e Valor de um item em determinada data ou coluna solicitada.
		function GetHistoricoData($aAtual, $dBase='', $vCol=' ')
		{
			if ($dBase == '')
			{
				$dBase = date('d/m/Y');
			}

	
			$boletoitem_id = $aAtual['ID'];

			$aBaseInvert = explode( '/', $dBase);
			$dBaseInvert = $aBaseInvert[2] . $aBaseInvert[1] . $aBaseInvert[0];
			
			$sql = "(
					select
						upper(Col)							 	as Col,
						replace(Old,',','.')					as Old,
						replace(New,',','.')					as New,
						trunc(boletoitemhi.dt)					as Data,
						to_Char( boletoitemhi.dt, 'yyyymmdd') 	as DataInvert,
						boletoitemhi.dt                         as dt
					from
						boletoitemhi
					where
					(
						(upper(col) in ('VALOR', 'STATE_ID') and '$vCol' is null)
					or
						(upper(col) = upper( '$vCol' ) and '$vCol' is not null)
					)
					and
						to_date(boletoitemhi.dt) <= to_date( '$dBase' )
					and
						boletoitemhi.BoletoItem_id = '$boletoitem_id'
					)
					union
					(
					select
						upper(Col)							 	as Col,
						replace(Old,',','.')					as Old,
						replace(New,',','.')					as New,
						trunc(boletoitemhi.dt)					as Data,
						to_Char( boletoitemhi.dt, 'yyyymmdd') 	as DataInvert,
						boletoitemhi.dt                         as dt
					from
						boletoitemhi
					where
					(
						(upper(col) in ('VALOR', 'STATE_ID') and '$vCol' is null)
					or
						(upper(col) = upper( '$vCol' ) and '$vCol' is not null)
					)
					and
						to_date(boletoitemhi.dt) > to_date( '$dBase' )
					and
						boletoitemhi.BoletoItem_id = '$boletoitem_id'
					and
						rownum = 1
					)
					order by dt desc";
				
			// continuar vendo historico 
			$aReturn = array();
			
			$aAchou = array();
				
			$dbData = new DbData($this->db);		
	
			$dbData->Get($sql);		
	
			
//			echo $sql . '<br>';
			
		
			if ($dbData->Count() == 0)
			{
				$aReturn['STATE_ID']['VALUE']	= $aAtual['STATE_ID'];
				$aReturn['STATE_ID']['DATA']	= $aAtual['DATA'];
				$aReturn['VALOR']['VALUE'] 		= $aAtual['VALOR'];
				$aReturn['VALOR']['DATA'] 		= $aAtual['DATA'];
			}
			
			while ($row = $dbData->Row())
			{
				
				/*echo $dBaseInvert . '<BR>';
				echo $row['DATAINVERT'] . '<BR>';
				print_r( $row ); 
				echo '<BR>';*/
				
				if ($dBaseInvert >= $row['DATAINVERT']) // && $aAchou[$row['COL']]['ACHOU'] == '')
				{					
					$aReturn[$row['COL']]['VALUE'] = $row['NEW'];
					$aReturn[$row['COL']]['DATA'] = $row['DATA'];
					if ($dBaseInvert == $row['DATAINVERT'])
					{
						$aAchou[$row['COL']]['ACHOU'] = 1;						
					}
				}
				else 
				{
					
					if ($aAchou[$row['COL']]['ACHOU'] == '')
					{		
						$aReturn[$row['COL']]['VALUE'] = $row['OLD'];
						$aReturn[$row['COL']]['DATA'] = $row['DATA'];
						$aAchou[$row['COL']]['ACHOU'] = 1;
					}
				}
			}
	/*print_r ($aReturn);
	echo '<br>';*/	
			return $aReturn;
		}		
		
	} 
?>