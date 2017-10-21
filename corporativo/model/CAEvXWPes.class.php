<?php

    require_once ("../engine/Model.class.php");

    class CAEvXWPes extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAEvXWPes'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 1000;
            
            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Id']['NN'] 		= 1;
            $this->attribute['WPessoa_Id']['Label']		= 'Pessoa';
            
            $this->attribute['CAEvento_Id']['Type'] 	= 'number';
            $this->attribute['CAEvento_Id']['Length'] 	= 15;
            $this->attribute['CAEvento_Id']['NN'] 		= 1;
            $this->attribute['CAEvento_Id']['Label']	= 'Evento';
            
            
			$this->index["Desc"]["Cols"] 		= "WPessoa_Id, CAEvento_Id";
			$this->index["Desc"]["Unique"] 		= 0;
            
			$this->recognize["Recognize"] 		= "CAEvento_Id, WPessoa_Id";
						
        }
        
        
        
        public function GetIdByEventoWPessoa($WPessoa_Id)
        {
        	
        	$dbData = new DbData($this->db);
        	
        	$id = $dbData->Row($dbData->Get("SELECT id FROM caevxwpes WHERE wpessoa_id = '".$WPessoa_Id."' AND caevento_id IN ( SELECT id FROM caevento WHERE trunc(sysdate) between dtinicio and dttermino AND senhanominal = 'on') ORDER BY id DESC"));
        	
        	unset($dbData);
        	
        	return $id[ID];
        	
        }
        
        
        
        public function GetIdByEventoWPessoaLote($WPessoa_Id)
        {
        	 
        	$dbData = new DbData($this->db);
        	 
        	$id = $dbData->Row($dbData->Get("SELECT id FROM caevxwpes WHERE wpessoa_id = '".$WPessoa_Id."' AND caevento_id IN ( SELECT id FROM caevento WHERE senhanominal = 'on') ORDER BY id DESC"));
        	 
        	unset($dbData);
        	 
        	return $id[ID];
        	 
        }
        
}
?> 