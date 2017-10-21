<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CA extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CA'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500;


            $this->attribute['Numero']['Type'] 		= 'number';
            $this->attribute['Numero']['Length'] 	= 6;
            $this->attribute['Numero']['NN'] 		= 1;
            $this->attribute['Numero']['Label'] 	= 'Nъmero';

            $this->attribute['Data']['Type'] 		= 'date';
            $this->attribute['Data']['NN'] 			= 1;
            $this->attribute['Data']['Label'] 		= 'Data';
            $this->attribute['Data']['Mask'] 		= 'd';

            $this->attribute['Aprovado']['Type'] 	= 'varchar2';
            $this->attribute['Aprovado']['Length']	= 3;
            $this->attribute['Aprovado']['Label'] 	= 'Aprovado';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] 	= "Numero||'/'||to_char(Data,'YYYY')";

            //Нndices
            $this->index['Data']['Cols'] 	= "Data unique";

            //Todas as Queries da classe
            $this->query['qId'] 	= 'CA_qId';
            $this->query['qGeral']	= 'CA_qGeral';

                 
        } 
        
        
        

        public function AutoCompleteCA($value)
        {
        
        
        	$dbData = new DbData($this->db);

        	$aux = explode("/",$value);
        	
        	
        	

        		
        	
        		
        		
        }
        
}

?>