<?php

    require_once ("../engine/Model.class.php");

    class CAEventoImg extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAEventoImg'; 


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

            $this->attribute['Caminho']['Type'] 		= 'varchar2';
            $this->attribute['Caminho']['Length'] 		= 300;
            $this->attribute['Caminho']['NN'] 			= 1;
            $this->attribute['Caminho']['Label']		= 'Mensagem';
                        
            $this->attribute['DtInicio']['Type']		= 'date';
            $this->attribute['DtInicio']['NN']			= 0;
            $this->attribute['DtInicio']['Label']		= 'Data/Hora de Início'; 

            $this->attribute['DtTermino']['Type']		= 'date';
            $this->attribute['DtTermino']['NN']			= 0;
            $this->attribute['DtTermino']['Label']		= 'Data/Hora de Término';
            
            
          	$this->recognize["Recognize"] = "Caminho";

          	$this->query["qGeral"]	= "CAEventoImg_qGeral";
          	$this->query["qId"]		= "CAEventoImg_qId";
          	
        }
}
?>