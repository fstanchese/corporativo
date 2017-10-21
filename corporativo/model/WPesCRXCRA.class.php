
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPesCRXCRA extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WPesCRXCRA'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['WPesCobRest_Id']['Type'] 		= 'number';
            $this->attribute['WPesCobRest_Id']['Length']	= 15;
            $this->attribute['WPesCobRest_Id']['Label'] 	= 'Motivo da Restrição';

            $this->attribute['CobRestAcao_Id']['Type'] 		= 'number';
            $this->attribute['CobRestAcao_Id']['Length'] 	= 15;
            $this->attribute['CobRestAcao_Id']['NN'] 		= 1;
            $this->attribute['CobRestAcao_Id']['Label'] 	= 'Ação';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'CobRestAcao_Id';

            //Índices

            //Todas as Queries da classe
            $this->query['qWPessoaAcao'] 	= 'WPesCRXCRA_qWPessoaAcao';
            $this->query['qWPesCobRest'] 	= 'WPesCRXCRA_qWPesCobRest';
            $this->query['qId'] 			= 'WPesCRXCRA_qId';

                 
        } 
} 