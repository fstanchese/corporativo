<?php
        
    require_once ("../engine/Model.class.php");
        
    class CBO extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'CBO'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 5000;


            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 100;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descriзгo';

            $this->attribute['Codigo']['Type'] 			= 'varchar2';
            $this->attribute['Codigo']['Length'] 		= 7;
            $this->attribute['Codigo']['NN'] 			= 1;
            $this->attribute['Codigo']['Label'] 		= 'Cуdigo';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Descricao, Codigo';

            //Нndices
            $this->index['Descricao']['Cols'] = "Descricao";
            $this->index["Descricao"]["Unique"] = 1;

            $this->index['Codigo']['Cols'] = "Codigo";
            $this->index["Codigo"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qCountFunc'] = 'CBO_qCountFunc';
            $this->query['qSelecao'] = 'CBO_qSelecao';
            $this->query['qSelecaoCount'] = 'CBO_qSelecaoCount';
            $this->query['qId'] = 'CBO_qId';

                
        }
}
?>