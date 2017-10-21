<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AreaAcad extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AreaAcad'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 15;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Nome';

            $this->attribute['Facul_Id']['Type'] = 'number';
            $this->attribute['Facul_Id']['Length'] = 15;
            $this->attribute['Facul_Id']['Label'] = 'Nome';
            $this->attribute['Facul_Id']['NN'] = 1;

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Geral']	= 'AreaAcad_qGeral';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices

            //Todas as Queries da classe
            $this->query['qGeral']	= "AreaAcad_qGeral";
            

                 
        } 
	} 
?>