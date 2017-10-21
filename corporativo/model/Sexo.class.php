<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Sexo extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Sexo'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 2;


            $this->attribute['nome']['Type'] 		= 'varchar2';
            $this->attribute['nome']['Length'] 		= 15;
            $this->attribute['nome']['NN'] 			= 1;
            $this->attribute['nome']['Label'] 		= 'Sexo';

            $this->attribute['CodCenso']['Type'] 	= 'varchar2';
            $this->attribute['CodCenso']['Length'] 	= 1;
            $this->attribute['CodCenso']['Label'] 	= 'Cod Censo';
            $this->attribute['CodCenso']['NN']		= 0;
            
            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'nome';

            //Нndices

            //Todas as Queries da classe
            $this->query['qProvao']	= 'Sexo_qProvao';
            $this->query['qGeral']	= 'Sexo_qGeral';

                 
        } 
} 
?>