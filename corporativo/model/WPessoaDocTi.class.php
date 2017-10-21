<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPessoaDocTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WPessoaDocTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 70;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Tipo de Documento';

            //Calculates para a criação de querys no diretório SQL
			$this->calculate['Geral'] 		= 'WPessoaDocTi_qGeral';

            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] 			= 'WPessoaDocTi_qGeral';
            $this->query['qId'] 			= 'WPessoaDocTi_qId';

                 
        } 
} 