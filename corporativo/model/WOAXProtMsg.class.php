<?php

    require_once ("../engine/Model.class.php");

    class WOAXProtMsg extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOAXProtMsg'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAss_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAss_Id']['NN'] 			= 1;
            $this->attribute['WOcorrAss_Id']['Label'] 		= 'Assunto';
            $this->attribute['WOcorrAss_Id']['Recognize'] 	= '1';

            $this->attribute['ProtMsg_Id']['Type'] 			= 'number';
            $this->attribute['ProtMsg_Id']['Length'] 		= 15;
            $this->attribute['ProtMsg_Id']['NN'] 			= 1;
            $this->attribute['ProtMsg_Id']['Label'] 		= 'Mensagem do Protocolo';
            $this->attribute['ProtMsg_Id']['Recognize'] 	= '3';

            $this->attribute['Sequencia']['Type'] 			= 'number';
            $this->attribute['Sequencia']['Length'] 		= 2;
            $this->attribute['Sequencia']['NN'] 			= 1;
            $this->attribute['Sequencia']['Label'] 			= 'Sequência';
            $this->attribute['Sequencia']['Recognize'] 		= '2';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, ProtMsg_Id'; 
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qWOcorrAss'] 	= 'WOAXProtMsg_qWOcorrAss';
            $this->query['qGeral'] 		= 'WOAXProtMsg_qGeral';
            $this->query['qId'] 			= 'WOAXProtMsg_qId';

                            
        }
}
?> 