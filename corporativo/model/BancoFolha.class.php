<?php

       
    require_once ("../engine/Model.class.php");
        
    class BancoFolha extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'BancoFolha'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 200000;


            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Nome';

            $this->attribute['PapelTi_Id']['Type'] = 'number';
            $this->attribute['PapelTi_Id']['Length'] = 15;
            $this->attribute['PapelTi_Id']['NN'] = 1;
            $this->attribute['PapelTi_Id']['Label'] = 'Papel';

            $this->attribute['Credito']['Type'] = 'number';
            $this->attribute['Credito']['Length'] = 5;
            $this->attribute['Credito']['NN'] = 1;
            $this->attribute['Credito']['Label'] = 'Crédito';
            $this->attribute['Credito']['Mask'] = '9';

            $this->attribute['Debito']['Type'] = 'number';
            $this->attribute['Debito']['Length'] = 5;
            $this->attribute['Debito']['NN'] = 1;
            $this->attribute['Debito']['Label'] = 'Débito';
            $this->attribute['Debito']['Mask'] = '9';

            $this->attribute['Limite']['Type'] = 'number';
            $this->attribute['Limite']['Length'] = 4;
            $this->attribute['Limite']['NN'] = 1;
            $this->attribute['Limite']['Label'] = 'Limite';
            $this->attribute['Limite']['Mask'] = '9';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'WPessoa_Id,PapelTi_Id';

            //Índices
            $this->index['BancoFolha']['Cols'] = "WPessoa_Id PapelTi_Id";
            $this->index["BancoFolha"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qPessoa'] = 'BancoFolha_qPessoa';
            $this->query['qPesLim'] = 'BancoFolha_qPesLim';
            $this->query['qHistorico'] = 'BancoFolha_qHistorico';
            $this->query['qId'] = 'BancoFolha_qId';
            $this->query['qGeral'] = 'BancoFolha_qGeral';

                
        }
        
        public function GetBancoFolhaInternet($WPessoa_Id){
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get("
            		SELECT
        				BancoFolha.*,
        				PapelTi_gsRecognize(PapelTi_Id) as Papel,
        				(BancoFolha.LIMITE - BancoFolha.DEBITO) AS Cota
        			FROM
        				BancoFolha
        			WHERE
        				WPessoa_Id = nvl( '".$WPessoa_Id."' ,0)
        			ORDER BY
        				PAPEL ASC");
        	
        	$cont = 0;
        	$cota = 0; 
        	while($row = $dbData->Row() )
        	{
        		$arEnd[$cont]["PAPEL"] 		   = $row["PAPEL"];

        		//Papel A0
        		if($row["PAPELTI_ID"] == '102600000000003'){
        			$cota = $cota +(16*(int)$row["DEBITO"]);
        			$arEnd[$cont]["DESCONTOFA4"] = (16*(int)$row["DEBITO"]);
        		}
        		
        		//Papel A1
        		if($row["PAPELTI_ID"] == '102600000000004'){
        			$cota = $cota +(8*(int)$row["DEBITO"]);
        			$arEnd[$cont]["DESCONTOFA4"] = (8*(int)$row["DEBITO"]);
        		}
        		
        		//Papel A2
        		if($row["PAPELTI_ID"] == '102600000000005'){
        			$cota = $cota +(4*(int)$row["DEBITO"]);
        			$arEnd[$cont]["DESCONTOFA4"] = (4*(int)$row["DEBITO"]);
        		}
        		
        		//Papel A3
        		if($row["PAPELTI_ID"] == '102600000000002'){
        			$cota = $cota +(2*(int)$row["DEBITO"]);
        			$arEnd[$cont]["DESCONTOFA4"] = (2*(int)$row["DEBITO"]);
        		}

        		//Papel A4
        		if($row["PAPELTI_ID"] == '102600000000001'){        			
        			$cota = $cota +(int)$row["DEBITO"];
        			$arEnd[$cont]["DESCONTOFA4"] = $row["DEBITO"];        			
        		} 
        		
        		$arEnd[$cont]["IMPRESSA"]	   = $row["DEBITO"];
        		$arEnd[$cont]["ARMAZENADA"]	   = $row["CREDITO"];
        		      			
        		$arEnd[$cont]["LIMITE"]		   = ((int)$row["LIMITE"] - $cota).'/'.$row["LIMITE"];
        		$arEnd[$cont]["IMPRESSATOTAL"] = $cota; 		        		      			
        		        	
        		$cont++;
        	}
        	
        	return $arEnd;
        }
}
?>
  