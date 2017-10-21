<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Moeda extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Moeda'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['nome']['Type'] 			= 'varchar2';
            $this->attribute['nome']['Length'] 			= 50;
            $this->attribute['nome']['NN'] 				= 1;
            $this->attribute['nome']['Label'] 			= 'Moeda';

            $this->attribute['moeda']['Type'] 			= 'varchar2';
            $this->attribute['moeda']['Length'] 		= 05;
            $this->attribute['moeda']['NN'] 			= 1;
            $this->attribute['moeda']['Label'] 			= 'Moeda';

            $this->attribute['MoedaTi_Id']['Type'] 		= 'number';
            $this->attribute['MoedaTi_Id']['Length'] 	= 15;
            $this->attribute['MoedaTi_Id']['NN'] 		= 1;
            $this->attribute['MoedaTi_Id']['Label'] 	= 'Tipo';

            $this->attribute['Ciclo_Id']['Type'] 		= 'number';
            $this->attribute['Ciclo_Id']['Length'] 		= 15;
            $this->attribute['Ciclo_Id']['Label'] 		= 'Periodicidade';
            $this->attribute['Ciclo_Id']['NN']			= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'moeda';

            //Índices

            //Todas as Queries da classe
            $this->query['qMoeda'] 	= 'Moeda_qMoeda';
            $this->query['qGeral'] 	= 'Moeda_qGeral';
            $this->query['qId'] 	= 'Moeda_qId';

                 
        } 
} 