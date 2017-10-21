<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ColacaoGrauTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ColacaoGrauTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 2;


            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 15;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Tipo de Cola��o de Grau';

            //Calculates para a cria��o de querys no diret�rio SQL
            $this->calculate['Geral'] = 'ColacaoGrauTi_qGeral';
            

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //�ndices

            //Todas as Queries da classe
            $this->query['qGeral'] = 'ColacaoGrauTi_qGeral';

                 
        } 
} 
?> 