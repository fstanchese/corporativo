<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CobRestMot extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CobRestMot'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 30;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 30;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Motivo de Restriзгo de Cobranзa';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices
            $this->index['Nome']['Cols'] 	= "Nome";
            $this->index["Nome"]["Unique"] 	= 1;


            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'CobRestMot_qGeral';
            $this->query['qId'] 	= 'CobRestMot_qId';

                 
        } 
} 

?>