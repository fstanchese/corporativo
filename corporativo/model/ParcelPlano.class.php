<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ParcelPlano extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ParcelPlano'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 50;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Nome';

            $this->attribute['Parcelas']['Type'] 		= 'number';
            $this->attribute['Parcelas']['Length'] 		= 3;
            $this->attribute['Parcelas']['NN']			= 0;
            $this->attribute['Parcelas']['Label'] 		= 'Parcelas';

            $this->attribute['TaxaMora']['Type'] 		= 'number';
            $this->attribute['TaxaMora']['Length'] 		= 12.4;
            $this->attribute['TaxaMora']['NN']			= 0;
            $this->attribute['TaxaMora']['Label'] 		= 'Juros de Mora';

            $this->attribute['TaxaMulta']['Type'] 		= 'number';
            $this->attribute['TaxaMulta']['Length'] 	= 12.4;
            $this->attribute['TaxaMulta']['NN']			= 0;
            $this->attribute['TaxaMulta']['Label'] 		= 'Multa';

            //Calculates para a criação de querys no diretório SQL
			$this->calculate['Geral'] 		= 'ParcelPlano_qGeral';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices
            $this->index['nome']['Cols'] = "Nome";
            $this->index["nome"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qId'] = 'ParcelPlano_qId';

                 
        } 
} 