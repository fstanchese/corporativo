<?php

    require_once ("../engine/Model.class.php");

    class CASenhaRegra extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CASenhaRegra'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 1000;

            $this->attribute['Sequencia']['Type'] 		= 'number';
            $this->attribute['Sequencia']['Length'] 	= 4;
            $this->attribute['Sequencia']['NN'] 		= 1;
            $this->attribute['Sequencia']['Label']		= 'Sequencia';

            $this->attribute['Sigla']['Type'] 			= 'varchar2';
            $this->attribute['Sigla']['Length']			= '30';
            $this->attribute['Sigla']['NN'] 			= 1;
            $this->attribute['Sigla']['Label'] 			= 'Sigla';

            $this->attribute['CASenhaTi_Id']['Type'] 	= 'number';
            $this->attribute['CASenhaTi_Id']['Length'] 	= 15;
            $this->attribute['CASenhaTi_Id']['NN'] 		= 1;
            $this->attribute['CASenhaTi_Id']['Label']	= 'Tipo de Senha';
            
            
            $this->attribute['Preferencial']['Type'] 	= 'varchar2';
            $this->attribute['Preferencial']['Length'] 	= 3;
            $this->attribute['Preferencial']['NN'] 		= 0;
            $this->attribute['Preferencial']['Label']	= 'Preferencial';
            
            $this->attribute['Retorno']['Type'] 	= 'varchar2';
            $this->attribute['Retorno']['Length'] 	= 3;
            $this->attribute['Retorno']['NN'] 		= 0;
            $this->attribute['Retorno']['Label']	= 'Retorno';
            
            
			$this->index["Sequencia"]["Cols"] 	= "Grau de Preferência";
			$this->index["Sequencia"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] 	= "CASenhaTi_Id, Sequencia, Sigla";
			$this->recognize["Sigla"]		= "Sigla"; 

			$this->calculate["Geral"] = "CASenhaRegra_qGeral";
			
			$this->query["qGeral"]	= "CASenhaRegra_qGeral";
			$this->query["qId"]		= "CASenhaRegra_qId";
			
        }
        
        
        public function GetSenhasEvento($caevento_id,$casenhati_id =null)
        {
        	
        	
        	$dbData = new DbData($this->db);
        	
        	$sqlAux = '';
        	if (!empty($casenhati_id))
        		$sqlAux = " AND casenhati_id = '".$casenhati_id."' ";  
        	
        	$sql = "SELECT casenhati.id as senhati_id, casenharegra.id, casenharegra.sigla, casenharegra.sequencia, preferencial, retorno 
        			FROM casenharegra, casenhati, caassunto
        			WHERE casenharegra.casenhati_id = casenhati.id ".
        			$sqlAux .
        			" AND casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$caevento_id."'
        			ORDER BY sequencia
        			";
        	
        	$dbData->Get($sql);
        	
        	while($row = $dbData->Row())
        	{
        		
        		$flagP = 0;
        		if($row[PREFERENCIAL] == "on") $flagP = 1;
        		
        		$flagR = 0;
        		if($row[RETORNO] == "on") $flagR = 1;
        		
        		$arRet[$flagR][$flagP][$row[SENHATI_ID]] = $row[ID];
        		
        	}
        	
        	
        	unset($dbData);
        	
        	return $arRet;
        	
        	
        	
        	
        }
        
        
        
        
        public function GetMaxSeq($caevento_id)
        {
        	 
        	 
        	$dbData = new DbData($this->db);
        	 
        	$sql = "SELECT max(sequencia) as sequencia
        			FROM casenharegra, casenhati, caassunto
        			WHERE casenharegra.casenhati_id = casenhati.id
        			AND casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$caevento_id."'
        			
        			";
        	 
        	$sequencia = $dbData->Row($dbData->Get($sql));
        	
        	unset($dbData);
        	 
        	return $sequencia[SEQUENCIA];
        	 
        	 
        	 
        	 
        }
        
        
        public function GetSenhaRegraByEvento($caevento_id,$casenhati_id=null)
        {
        
        
        	$dbData = new DbData($this->db);

        	$sqlAux = '';
        	if (!empty($casenhati_id))
        		$sqlAux = " AND casenhati_id = '".$casenhati_id."' ";
        	         	
        	$sql = "SELECT casenharegra.sequencia, casenharegra.sigla, casenharegra.id
        			FROM casenharegra, casenhati, caassunto
        			WHERE casenharegra.casenhati_id = casenhati.id ".
        			$sqlAux .  
        			" AND casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$caevento_id."'
      				ORDER BY sequencia";
        
        	
        	$dbData->Get($sql);
        	
        	while($row = $dbData->Row())
        	{
        		
        		$arRet["Sequencia"][] 	= $row[SEQUENCIA];
        		$arRet["Sigla"][] 		= $row[SIGLA];
        		$arRet["Id"][] 			= $row[ID];
        		
        	}
        	 
        	unset($dbData);
        
        	return $arRet;
        
        
        
        
        }
        
        
        
        public function GetSenhaRetonoByEvento($caevento_id)
        {
        
        
        	$dbData = new DbData($this->db);
        
        	$sql = "SELECT casenharegra.sequencia, casenharegra.sigla, casenharegra.id
        			FROM casenharegra, casenhati, caassunto
        			WHERE casenharegra.casenhati_id = casenhati.id
        			AND casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$caevento_id."'
        			AND retorno = 'on'
      				ORDER BY sequencia
        			";
        
        	$dbData->Get($sql);
        	 
        	while($row = $dbData->Row())
        	{
        
        		$arRet["Sequencia"][] 	= $row[SEQUENCIA];
        		$arRet["Sigla"][] 		= $row[SIGLA];
        		$arRet["Id"][] 			= $row[ID];
        
        	}
        
        	unset($dbData);
        
        	return $arRet;
        
        
        
        
        }
        
	}

?>