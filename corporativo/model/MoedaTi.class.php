
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class MoedaTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'MoedaTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 20;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Descrição';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'MoedaTi_qGeral';

                 
        } 
} 