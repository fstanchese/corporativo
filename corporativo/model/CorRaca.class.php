<?php
        
    require_once ("../engine/Model.class.php");
        
    class CorRaca extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'CorRaca'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 10;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 45;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['CodMec']['Type'] 		= 'varchar2';
            $this->attribute['CodMec']['Length'] 	= 1;
            $this->attribute['CodMec']['Label'] 	= 'Cod Censo';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices

            //Todas as Queries da classe
            $this->query['qCenso'] 	= 'CorRaca_qCenso';
            $this->query['qId'] 	= 'CorRaca_qId';
            $this->query['qGeral']	= 'CorRaca_qGeral';

                
        }
}
?>