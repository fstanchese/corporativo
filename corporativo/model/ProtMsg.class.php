<?php

    require_once ("../engine/Model.class.php");

    class ProtMsg extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'ProtMsg'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Protocolo']['Type'] 		= 'varchar2';
            $this->attribute['Protocolo']['Length']	 	= 500;
            $this->attribute['Protocolo']['NN'] 		= 1;
            $this->attribute['Protocolo']['Label'] 		= 'Mensagem do Protocolo';
            $this->attribute['Protocolo']['Recognize'] 	= '1';

            $this->recognize['Recognize'] 	= 'Protocolo'; 
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qGeral']		= 'ProtMsg_qGeral';
            $this->query['qId'] 		= 'ProtMsg_qId';
            $this->query['qSelecao']	= 'ProtMsg_qSelecao';

                            
        }
}
?> 