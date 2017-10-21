<?php

    require_once ("../engine/Model.class.php");

    class Alinea extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'Alinea'; 


        public $attribute 	= array();
        public $calculate  	= array();    
        public $query  		= array();


        public function __construct($db)
        {
        	$this->db = $db;
            $this->attribute['Alinea']['Type'] 		= 'varchar2';
            $this->attribute['Alinea']['Length'] 	= 10;
            $this->attribute['Alinea']['NN'] 		= 1;
            $this->attribute['Alinea']['Label']		= 'Alнnea';

            $this->attribute['Motivo']['Type'] 		= 'varchar2';
            $this->attribute['Motivo']['Length'] 	= 200;
            $this->attribute['Motivo']['NN'] 		= 1;
            $this->attribute['Motivo']['Label'] 	= 'Motivo';
            
            $this->recognize['Recognize']			= 'Alinea';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Geral']	= 'Alinea_qGeral';
            
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'Alinea_qGeral';
            $this->query['qId'] 	= 'Alinea_qId';
            
            
    	}
	}
?>