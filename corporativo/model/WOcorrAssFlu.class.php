<?php

    require_once ("../engine/Model.class.php");

    class WOcorrAssFlu extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAssFlu'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAss_Id']['Type'] 		=         'number';
            $this->attribute['WOcorrAss_Id']['Length'] 		=         15;
            $this->attribute['WOcorrAss_Id']['NN'] 			=         1;
            $this->attribute['WOcorrAss_Id']['Label'] 		=         'Assunto';

            $this->attribute['Sequencia']['Type'] 			=         'number';
            $this->attribute['Sequencia']['Length'] 		=         2;
            $this->attribute['Sequencia']['NN'] 			=         1;
            $this->attribute['Sequencia']['Label'] 			=         'Seqüência';
            $this->attribute['Sequencia']['Mask'] 			=         '9';
            $this->attribute['Sequencia']['Recognize'] 		=         '1';

            $this->attribute['State_Id']['Type'] 			=         'number';
            $this->attribute['State_Id']['Length'] 			=         15;
            $this->attribute['State_Id']['NN'] 				=         1;
            $this->attribute['State_Id']['Label'] 			=         'Situação';

            $this->attribute['Depart_Id']['Type'] 			=         'number';
            $this->attribute['Depart_Id']['Length'] 		=         15;
            $this->attribute['Depart_Id']['NN'] 			=         1;
            $this->attribute['Depart_Id']['Label'] 			=         'Departamento';
            $this->attribute['Depart_Id']['Recognize'] 		=         '2';

            $this->attribute['Prazo']['Type'] 				=         'number';
            $this->attribute['Prazo']['Length'] 			=         3;
            $this->attribute['Prazo']['NN'] 				=         1;
            $this->attribute['Prazo']['Label'] 				=         'Prazo';
            $this->attribute['Prazo']['Mask'] 				=         '9';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, Sequencia, Depart_Id';
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['AssOcorEnc'] 		= 'WOcorrAssFlu_qAssOcorEnc';

                            
        }
}
?> 