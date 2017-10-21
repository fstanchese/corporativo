<?php

    require_once ("../engine/Model.class.php");

    class CAEventoMsg extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAEventoMsg'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;

        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 1000;

            $this->attribute['CAEvento_Id']['Type'] 	= 'number';
            $this->attribute['CAEvento_Id']['Length']	= 15;
            $this->attribute['CAEvento_Id']['NN'] 		= 1;
            $this->attribute['CAEvento_Id']['Label']	= 'Evento';

            $this->attribute['Mensagem']['Type'] 		= 'varchar2';
            $this->attribute['Mensagem']['Length'] 		= 500;
            $this->attribute['Mensagem']['NN'] 			= 1;
            $this->attribute['Mensagem']['Label']		= 'Mensagem';
                        
            $this->attribute['DtInicio']['Type']		= 'date';
            $this->attribute['DtInicio']['NN']			= 0;
            $this->attribute['DtInicio']['Label']		= 'Data/Hora de Início'; 

            $this->attribute['DtTermino']['Type']		= 'date';
            $this->attribute['DtTermino']['NN']			= 0;
            $this->attribute['DtTermino']['Label']		= 'Data/Hora de Término';
            
            
          	$this->recognize["Recognize"] = "Mensagem";

          	$this->query["qGeral"]	= "CAEventoMsg_qGeral";
          	$this->query["qId"]		= "CAEventoMsg_qId";
          	
        }
}
?>