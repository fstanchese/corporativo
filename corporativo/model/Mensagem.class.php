<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Mensagem extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Mensagem'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 200;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['Funcao']['Type'] 		= 'varchar2';
            $this->attribute['Funcao']['Length'] 	= 200;
            $this->attribute['Funcao']['Label'] 	= 'função';
            $this->attribute['Funcao']['NN']		= 0;

            $this->attribute['Texto']['Type'] 		= 'varchar2';
            $this->attribute['Texto']['Length'] 	= 1000;
            $this->attribute['Texto']['Label'] 		= 'Mensagem';
            $this->attribute['Texto']['NN']			= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome,funcao,Texto';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'Mensagem_qGeral';
            $this->query['qId'] 	= 'Mensagem_qId';

                 
        } 
} 