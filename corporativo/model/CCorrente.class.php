<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CCorrente extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CCorrente'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20;


            $this->attribute['Banco_Id']['Type'] 		= 'number';
            $this->attribute['Banco_Id']['Length'] 		= 15;
            $this->attribute['Banco_Id']['NN'] 			= 1;
            $this->attribute['Banco_Id']['Label'] 		= 'Banco';

            $this->attribute['Agencia']['Type'] 		= 'varchar2';
            $this->attribute['Agencia']['Length'] 		= 15;
            $this->attribute['Agencia']['NN'] 			= 1;
            $this->attribute['Agencia']['Label'] 		= 'Agкncia';

            $this->attribute['Numero']['Type'] 			= 'varchar2';
            $this->attribute['Numero']['Length'] 		= 15;
            $this->attribute['Numero']['NN'] 			= 1;
            $this->attribute['Numero']['Label'] 		= 'Nъmero da Conta';

            $this->attribute['AgenciaNome']['Type'] 	= 'varchar2';
            $this->attribute['AgenciaNome']['Length'] 	= 30;
            $this->attribute['AgenciaNome']['Label'] 	= 'Nome da Agкncia';
            $this->attribute['AgenciaNome']['NN']		= 0;

            $this->attribute['UsarNoFIES']['Type'] 		= 'varchar2';
            $this->attribute['UsarNoFIES']['Length'] 	= 3;
            $this->attribute['UsarNoFIES']['Label'] 	= 'Usar no FIES';
            $this->attribute['UsarNoFIES']['NN']		= 0;

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Banco_Id,Agencia,Numero';

            //Нndices
            $this->index['Conta']['Cols'] = "Banco_Id Agencia Numero";
            
            //Todas as Queries da classe
            $this->query['qId'] 	= 'CCorrente_qId';
            $this->query['qGeral'] 	= 'CCorrente_qGeral';
            $this->query['qFIES'] 	= 'CCorrente_qFIES';

                 
        } 
}
?>