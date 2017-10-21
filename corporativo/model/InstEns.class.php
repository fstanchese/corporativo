
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class InstEns extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'InstEns'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500;


            $this->attribute['CodVal']['Type'] 		= 'number';
            $this->attribute['CodVal']['Length'] 	= 10;
            $this->attribute['CodVal']['Label'] 	= 'Código';

            $this->attribute['Codigo']['Type'] 		= 'varchar2';
            $this->attribute['Codigo']['Length'] 	= 15;
            $this->attribute['Codigo']['NN'] 		= 1;
            $this->attribute['Codigo']['Label'] 	= 'Código';

            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 100;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['Pais_Id']['Type'] 	= 'number';
            $this->attribute['Pais_Id']['Length'] 	= 15;
            $this->attribute['Pais_Id']['Label'] 	= 'País';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] 	= 'Codigo,Nome';

            //Índices
            $this->index['Nome']['Cols'] 	= "nome";
            $this->index["Nome"]["Unique"] 	= 1;


            //Todas as Queries da classe
            $this->query['qIndex']			= 'InstEns_qIndex';
            $this->query['qLetrasInicio'] 	= 'InstEns_qLetrasInicio';
            $this->query['qIndexExt'] 		= 'InstEns_qIndexExt';
            $this->query['qGeral'] 			= 'InstEns_qGeral';

                 
        } 
} 