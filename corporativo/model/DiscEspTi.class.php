<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DiscEspTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DiscEspTi';
        
        public $attribute = array(); 
        public $calculate = array(); 
        public $query = array();
        
        public $rows; 
                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10;

            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 25;
            $this->attribute['Nome']['Label'] = 'Tipo Disciplina Especial';
            $this->attribute['Nome']['NN'] = 1;

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Geral'] = 'DiscEspTi_qGeral';
            
            //Нndices
            $this->index['Nome']['Cols'] = "Nome";
            $this->index["Nome"]["Unique"] = 1;

            //Todas as Queries da classe
            $this->query['Geral'] = 'DiscEspTi_qGeral';
                 
        } 
	}
	 
?>