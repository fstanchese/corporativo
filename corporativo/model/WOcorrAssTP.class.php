<?php

    require_once ("../engine/Model.class.php");

    class WOcorrAssTP extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAssTP'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Referencia']['Type'] 		= 'varchar2';
            $this->attribute['Referencia']['Length'] 	= 50;
            $this->attribute['Referencia']['Label'] 	= 'Referência';
            $this->attribute['Referencia']['NN'] 		= 1;
            $this->attribute['Referencia']['Recognize']	= '1';

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 1000;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descrição';

            $this->attribute['WOcorrAss_Id']['Type'] 	= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 	= 15;
            $this->attribute['WOcorrAss_Id']['Label'] 	= 'Assunto';
            $this->attribute['WOcorrAss_Id']['NN'] 		= 1;

            $this->attribute['Ativo']['Type'] 			= 'varchar2';
            $this->attribute['Ativo']['Length'] 		= 3;
            $this->attribute['Ativo']['Label'] 			= 'Ativo';

            $this->recognize['Recognize']	= 'Referencia, Descricao';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdRecognize'] 	= 'WOcorrAssTP_qWOcorrAss';

            //Todas as Queries da classe
            $this->query['Todos'] 	= 'WOcorrAssTP_qTodos';
            $this->query['qId'] 	= 'WOcorrAssTP_qId';
            $this->query['qGeral']	= 'WOcorrAssTP_qGeral';
            $this->query['qWOcorrAss']	= 'WOcorrAssTP_qWOcorrAss';

                            
        }
}
?> 