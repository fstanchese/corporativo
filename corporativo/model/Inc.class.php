<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Inc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Inc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 50;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 40;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Descrição';

            $this->attribute['Mora']['Type'] 		= 'number';
            $this->attribute['Mora']['Length'] 		= 12.8;
            $this->attribute['Mora']['Label'] 		= 'Mora';
            $this->attribute['Mora']['NN'] 			= 0;

            $this->attribute['Multa']['Type'] 		= 'number';
            $this->attribute['Multa']['Length'] 	= 12.8;
            $this->attribute['Multa']['Label'] 		= 'Mora';
            $this->attribute['Multa']['NN'] 		= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
			$this->recognize['Recognize'] = 'Nome';
            //Índices

            //Todas as Queries da classe
            $this->query['qId'] 	= 'Inc_qId';
            $this->query['qGeral'] 	= 'Inc_qGeral';

                 
        } 
} 