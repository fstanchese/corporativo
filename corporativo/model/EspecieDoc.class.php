<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class EspecieDoc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'EspecieDoc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 15;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Nome';

            //Calculates para a cria��o de querys no diret�rio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //�ndices

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'EspecieDoc_qGeral';
            $this->query['qId'] 	= 'EspecieDoc_qId';

                 
        } 
    }
?>