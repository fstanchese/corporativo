<?php
        
    require_once ("../engine/Model.class.php");
        
    class PesqSAA extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'PesqSAA'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['Q1']['Type'] 			= 'number';
            $this->attribute['Q1']['Length'] 		= 1;
            $this->attribute['Q1']['Label'] 		= 'Quest�o 1';
            $this->attribute['Q1']['NN']			= 0;

            $this->attribute['Q2']['Type'] 			= 'number';
            $this->attribute['Q2']['Length'] 		= 1;
            $this->attribute['Q2']['Label'] 		= 'Quest�o 2';
            $this->attribute['Q2']['NN']			= 0;
            
            $this->attribute['Q2_1']['Type'] 		= 'number';
            $this->attribute['Q2_1']['Length'] 		= 1;
            $this->attribute['Q2_1']['Label'] 		= 'Quest�o 2.1';
            $this->attribute['Q2_1']['NN']			= 0;
                        
            $this->attribute['Q3']['Type'] 			= 'number';
            $this->attribute['Q3']['Length'] 		= 1;
            $this->attribute['Q3']['Label'] 		= 'Quest�o 3';
            $this->attribute['Q3']['NN']			= 0;

            $this->attribute['Q4']['Type'] 			= 'number';
            $this->attribute['Q4']['Length'] 		= 1;
            $this->attribute['Q4']['Label'] 		= 'Quest�o 4';
            $this->attribute['Q4']['NN']			= 0;

            $this->attribute['Q5']['Type'] 			= 'number';
            $this->attribute['Q5']['Length'] 		= 1;
            $this->attribute['Q5']['Label'] 		= 'Quest�o 5';
            $this->attribute['Q5']['NN']			= 0;

            $this->attribute['Q6_1']['Type'] 		= 'varchar2';
            $this->attribute['Q6_1']['Length'] 		= 3;
            $this->attribute['Q6_1']['Label'] 		= 'Quest�o 6.1';
            $this->attribute['Q6_1']['NN']			= 0;

            $this->attribute['Q6_2']['Type'] 		= 'varchar2';
            $this->attribute['Q6_2']['Length'] 		= 3;
            $this->attribute['Q6_2']['Label'] 		= 'Quest�o 6.2';
            $this->attribute['Q6_2']['NN']			= 0;

            $this->attribute['Q6_3']['Type'] 		= 'varchar2';
            $this->attribute['Q6_3']['Length'] 		= 3;
            $this->attribute['Q6_3']['Label'] 		= 'Quest�o 6.3';
            $this->attribute['Q6_3']['NN']			= 0;

            $this->attribute['Q6_4']['Type'] 		= 'varchar2';
            $this->attribute['Q6_4']['Length'] 		= 3;
            $this->attribute['Q6_4']['Label'] 		= 'Quest�o 6.4';
            $this->attribute['Q6_4']['NN']			= 0;

            $this->attribute['Q6_5']['Type'] 		= 'varchar2';
            $this->attribute['Q6_5']['Length'] 		= 3;
            $this->attribute['Q6_5']['Label'] 		= 'Quest�o 6.5';
            $this->attribute['Q6_5']['NN']			= 0;

            $this->attribute['Q6_6']['Type'] 		= 'varchar2';
            $this->attribute['Q6_6']['Length'] 		= 3;
            $this->attribute['Q6_6']['Label'] 		= 'Quest�o 6.6';
            $this->attribute['Q6_6']['NN']			= 0;

            $this->attribute['Q6_7']['Type'] 		= 'varchar2';
            $this->attribute['Q6_7']['Length'] 		= 3;
            $this->attribute['Q6_7']['Label'] 		= 'Quest�o 6.7';
            $this->attribute['Q6_7']['NN']			= 0;

            $this->attribute['Q6_8']['Type'] 		= 'varchar2';
            $this->attribute['Q6_8']['Length'] 		= 3;
            $this->attribute['Q6_8']['Label'] 		= 'Quest�o 6.8';
            $this->attribute['Q6_8']['NN']			= 0;

            $this->attribute['Q6_9']['Type'] 		= 'varchar2';
            $this->attribute['Q6_9']['Length'] 		= 3;
            $this->attribute['Q6_9']['Label'] 		= 'Quest�o 6.9';
            $this->attribute['Q6_9']['NN']			= 0;

            $this->attribute['Q6_txt']['Type'] 		= 'varchar2';
            $this->attribute['Q6_txt']['Length'] 	= 70;
            $this->attribute['Q6_txt']['Label'] 	= 'Quest�o 6 Outros';
            $this->attribute['Q6_txt']['NN'] 		= 0;
            
            $this->attribute['Q7']['Type'] 			= 'number';
            $this->attribute['Q7']['Length'] 		= 1;
            $this->attribute['Q7']['Label'] 		= 'Quest�o 7';
            $this->attribute['Q7']['NN']			= 0;
            
            $this->attribute['Q8_txt']['Type'] 		= 'varchar2';
            $this->attribute['Q8_txt']['Length'] 	= 300;
            $this->attribute['Q8_txt']['Label'] 	= 'Quest�o 8';
            $this->attribute['Q6_txt']['NN']		= 0;

            $this->attribute['Data']['Type'] 		= 'date';
            $this->attribute['Data']['Label'] 		= 'Data';
            $this->attribute['Data']['NN']			= 0;

            //Calculates para a cria��o de querys no diret�rio SQL


            //Recognizes
			$this->recognize['Recognize'] 	= 'Data';
            //�ndices

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'PesqSAA_qGeral';
            $this->query['qId']		= 'PesqSAA_qId';

                
        }
}
?> 