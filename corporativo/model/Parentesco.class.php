<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Parentesco extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Parentesco'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 30;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Parentesco';

            $this->attribute['BolsaSolteiro']['Type'] 		= 'varchar2';
            $this->attribute['BolsaSolteiro']['Length'] 	= 3;
            $this->attribute['BolsaSolteiro']['Label'] 		= 'Utilizado em solicitaзгo de bolsa';

            $this->attribute['BolsaNaoSolteiro']['Type'] 	= 'varchar2';
            $this->attribute['BolsaNaoSolteiro']['Length'] 	= 3;
            $this->attribute['BolsaNaoSolteiro']['Label'] 	= 'Utilizado em solicitaзгo de bolsa';

            //Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Geral'] 	= 'Parentesco_qGeral';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices

            //Todas as Queries da classe
            $this->query['qBolsaNaoSolteiro']	= 'Parentesco_qBolsaNaoSolteiro';
            $this->query['qBolsaSolteiro'] 		= 'Parentesco_qBolsaSolteiro';            
            $this->query['qGeral'] 				= 'Parentesco_qGeral';
            $this->query['qId'] 				= 'Parentesco_qId';

                 
        } 
} 

?>