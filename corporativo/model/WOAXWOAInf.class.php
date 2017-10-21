<?php

    require_once ("../engine/Model.class.php");

    class WOAXWOAInf extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOAXWOAInf'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAss_Id']['Type'] 			= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 			= 15;
            $this->attribute['WOcorrAss_Id']['NN'] 				= 1;
            $this->attribute['WOcorrAss_Id']['Label'] 			= 'Assunto';
            $this->attribute['WOcorrAss_Id']['Recognize'] 		= '1';

            $this->attribute['WOcorrAssInf_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAssInf_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAssInf_Id']['NN'] 			= 1;
            $this->attribute['WOcorrAssInf_Id']['Label'] 		= 'Informação obrigatória do Assunto';
            $this->attribute['WOcorrAssInf_Id']['Recognize'] 	= '3';

            $this->attribute['Sequencia']['Type'] 				= 'number';
            $this->attribute['Sequencia']['Length'] 			= 2;
            $this->attribute['Sequencia']['NN'] 				= 1;
            $this->attribute['Sequencia']['Label'] 				= 'Sequência';
            $this->attribute['Sequencia']['Recognize'] 			= '2';

            $this->attribute['Obrigatoria']['Type'] 			= 'varchar2';
            $this->attribute['Obrigatoria']['Length'] 			= 3;
            $this->attribute['Obrigatoria']['Label'] 			= 'Obrigatória';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, WOcorrAssInf_Id, Sequencia';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qAssunto'] 	= 'WOAXWOAInf_qAssunto';
            $this->query['qWOcorrAss'] 	= 'WOAXWOAInf_qWOcorrAss';
            $this->query['qId']			= 'WOAXWOAInf_qId';
            $this->query['qGeral']		= 'WOAXWOAInf_qGeral';

                            
        }
}
?>