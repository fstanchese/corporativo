<?php
        
    require_once ("../engine/Model.class.php");
        
    class Escrita extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'Escrita'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length']	= 15;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Escrita';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

        }
        
}
?>