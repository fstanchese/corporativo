<?php

    require_once ("../engine/Model.class.php");

    class CASenhaTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CASenhaTi'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 50;

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length']		= '50';
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Tipo de Senha';

            $this->attribute['CAAssunto_Id']['Type'] 	= 'number';
            $this->attribute['CAAssunto_Id']['Length'] 	= 15;
            $this->attribute['CAAssunto_Id']['NN'] 		= 1;
            $this->attribute['CAAssunto_Id']['Label']	= 'Assunto';
            
            $this->attribute['Ativo']['Type']			= 'varchar2';
            $this->attribute['Ativo']['Length']			= '3';
            $this->attribute['Ativo']['NN']				= 0;
            $this->attribute['Ativo']['Label']			= 'Ativar Senha';
            
			$this->index["Desc"]["Cols"] 	= "Descricao";
			$this->index["Desc"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] = "CAAssunto_Id, Descricao";
			
			$this->calculate["Geral"] 	= "CASenhaTi_qGeral";
			$this->calculate["Evento"]	= "CASenhaTi_qEvento";

			$this->query["qGeral"] 		= "CASenhaTi_qGeral";
			$this->query["qId"] 		= "CASenhaTi_qId";
			$this->query["qEvento"]		= "CASenhaTi_qEvento";
			
        }
        
        
        
        public function GetSenhaTiByEvento($caevento_id)
        {
        
        
        	$dbData = new DbData($this->db);
        
        	$sql = "SELECT casenhati.descricao, casenhati.id
        			FROM casenhati, caassunto
        			WHERE
        			casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$caevento_id."'
      				ORDER BY id
        			";
        
        	$dbData->Get($sql);
        	 
        	while($row = $dbData->Row())
        	{
        
        		$arRet["Nome"][] 		= $row[DESCRICAO];
        		$arRet["Id"][] 			= $row[ID];
        
        	}
        
        	unset($dbData);
        
        	return $arRet;
        
        
        
        
        }
        
        
        
}
?> 