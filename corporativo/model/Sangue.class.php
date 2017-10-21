<?php
        
    require_once ("../engine/Model.class.php");
        
    class Sangue extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'Sangue'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query         = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 	= 'varchar2';
            $this->attribute['Nome']['Length'] 	= 5;
            $this->attribute['Nome']['NN'] 		= 1;
            $this->attribute['Nome']['Label'] 	= 'Tipo';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'Sangue_qGeral';
            $this->query['qId'] 	= 'Sangue_qId';

                
        }
}
?>
