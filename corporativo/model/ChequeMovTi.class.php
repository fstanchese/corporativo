<?php

    require_once ("../engine/Model.class.php");

    class ChequeMovTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table 	= 'ChequeMovTi'; 


        public $attribute 	= array();
        public $calculate	= array();    
        public $query    	= array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 30;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Tipo de Movimentação';
            $this->attribute['Nome']['Recognize']	= '1';

            $this->recognize['Recognize']	= 'Nome';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Geral']	= 'ChequeMovTi_qGeral';
            
            //Todas as Queries da classe
            $this->query['qId']		= 'ChequeMovTi_qId';
            $this->query['qGeral']	= 'ChequeMovTi_qGeral';

                            
        }
}
?> 