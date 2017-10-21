<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class MapaSub extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'MapaSub'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 50;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['Mapa_Id']['Type'] 	= 'number';
            $this->attribute['Mapa_Id']['Length'] 	= 15;
            $this->attribute['Mapa_Id']['NN'] 		= 1;
            $this->attribute['Mapa_Id']['Label'] 	= 'Menu Principal do Mapa';
            
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Geral'] 	= 'MapaSub_qGeral';

            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            //Índices
			$this->index['Nome'] = 'Nome';
			
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'MapaSub_qGeral';
            $this->query['qMapa']	= 'MapaSub_qMapa';

                 
        } 
} 