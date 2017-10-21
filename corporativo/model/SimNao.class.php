
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class SimNao extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'SimNao'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 10;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['CodCenso']['Type'] 	= 'varchar2';
            $this->attribute['CodCenso']['Length'] 	= 1;
            $this->attribute['CodCenso']['Label'] 	= 'Cod Censo';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['USP_Id'] 				= 'SimNao_qGeral';
            $this->calculate['Adita_Id'] 			= 'SimNao_qGeral';
            $this->calculate['OutraIES_Id'] 		= 'SimNao_qGeral';


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices
            $this->index['Nome']['Cols'] 	= "nome";
            $this->index["Nome"]["Unique"]	= 1;


            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'SimNao_qGeral';
            $this->query['qProvao']	= 'SimNao_qProvao';

                 
        } 
} 