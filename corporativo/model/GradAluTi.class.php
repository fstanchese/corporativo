
<?php
        
    require_once ("../engine/Model.class.php");
        
    class GradAluTi extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'GradAluTi'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 5;


            $this->attribute['nome']['Type'] 		= 'varchar2';
            $this->attribute['nome']['Length'] 		= 15;
            $this->attribute['nome']['NN'] 			= 1;
            $this->attribute['nome']['Label'] 		= 'Tipo';

            $this->attribute['nick']['Type'] 		= 'varchar2';
            $this->attribute['nick']['Length'] 		= 05;
            $this->attribute['nome']['NN'] 			= 0;
            $this->attribute['nick']['Label']		= 'Abreviação';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'nick';

            //Índices

            //Todas as Queries da classe

                
        }
	}
?> 