<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Mapa extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Mapa'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 25;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Nome';

            //Calculates para a criação de querys no diretório SQL
			$this->calculate['Geral']	= 'Mapa_qGeral';

            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            //Índices
			$this->index['Nome'] = 'Nome';
			
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'Mapa_qGeral';

                 
        } 
} 