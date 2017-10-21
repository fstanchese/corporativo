<?php
        
    require_once ("../engine/Model.class.php");
        
    class Clas extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'Class'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query         = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 200;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 100;
            $this->attribute['Nome']['Label'] 		= 'Descriзгo';

            $this->attribute['Codigo']['Type'] 		= 'varchar2';
            $this->attribute['Codigo']['Length'] 	= 20;
            $this->attribute['Codigo']['Label'] 	= 'Cуdigo';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Selecao_Id'] = 'Class_qGeral';


            //Recognizes
            $this->recognize['Recognize'] = 'Codigo';

            //Нndices

            //Todas as Queries da classe
            $this->query['qId'] = 'Class_qId';

                
        }
}
?>