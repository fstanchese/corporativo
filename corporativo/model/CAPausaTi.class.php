<?php

    require_once ("../engine/Model.class.php");

    class CAPausaTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAPausaTi'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;

        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 50;

            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 500;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label']		= 'Mensagem';
                        
          	$this->recognize["Recognize"] = "Nome";

          	$this->query["qGeral"]	= "CAPausaTi_qGeral";
          	$this->query["qId"]		= "CAPausaTi_qId";
          	
        }
}
?> 