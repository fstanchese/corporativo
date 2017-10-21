<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Instrucao extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Instrucao'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 300;
            $this->attribute['Nome']['Label'] 	= 'Instru��o';
            $this->attribute['Nome']['NN'] 		= 1;

            //Calculates para a cria��o de querys no diret�rio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //�ndices

            //Todas as Queries da classe
            $this->query['qGeral'] = 'Instrucao_qGeral';

                 
        } 
}
?>