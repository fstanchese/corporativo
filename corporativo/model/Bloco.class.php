<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Bloco extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Bloco'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 30;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length']	= 5;
            $this->attribute['Nome']['NN']		= 1;
            $this->attribute['Nome']['Label'] 	= 'Bloco';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            //Нndices
            $this->index['Nome']['Cols'] 	= "Nome";
            $this->index["Nome"]["Unique"] 	= 1;


            //Todas as Queries da classe
            $this->query['qId'] 	= 'Bloco_qId';
            $this->query['qGeral'] 	= 'Bloco_qGeral';

                 
        } 
} 

?>