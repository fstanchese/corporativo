
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CriProm extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CriProm'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 30;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Nome';

            //Calculates para a cria��o de querys no diret�rio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //�ndices

            //Todas as Queries da classe

                 
        } 
} 

?>