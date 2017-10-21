
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class SAAMesa extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'SAAMesa'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Numero']['Type'] 			= 'varchar2';
            $this->attribute['Numero']['Length'] 		= 2;
            $this->attribute['Numero']['Label'] 		= 'Mesa de Atendimento';
            $this->attribute['Numero']['NN']			= 0;

            $this->attribute['IP']['Type'] 				= 'varchar2';
            $this->attribute['IP']['Length'] 			= 19;
            $this->attribute['IP']['Label'] 			= 'IP';
            $this->attribute['IP']['NN']				= 0;

            $this->attribute['State_Id']['Type'] 		= 'number';
            $this->attribute['State_Id']['Length'] 		= 15;
            $this->attribute['State_Id']['Label'] 		= 'Situação';
            $this->attribute['State_Id']['NN']			= 0;

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length'] 	= 15;
            $this->attribute['Campus_Id']['Label'] 		= 'Campus';
            $this->attribute['Campus_Id']['NN']			= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Numero,IP';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] = 'SAAMesa_qGeral';

                 
        } 
} 