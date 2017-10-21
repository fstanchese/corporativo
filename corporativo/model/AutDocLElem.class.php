<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AutDocLElem extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AutDocLElem'; 

         
        public $attribute	= array(); 
        public $calculate 	= array(); 
        public $query     	= array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 200000; 
        	
            $this->attribute['AutDocL_Id']['Type'] 		= 'number';
            $this->attribute['AutDocL_Id']['Length']	= 15;
            $this->attribute['AutDocL_Id']['NN'] 		= 1;
            $this->attribute['AutDocL_Id']['Label'] 	= 'Layout da Autenticaзгo do Documento';

            $this->attribute['Tag']['Type'] 			= 'varchar2';
            $this->attribute['Tag']['Length']			= 30;
            $this->attribute['Tag']['NN'] 				= 1;
            $this->attribute['Tag']['Label'] 			= 'Tag';
            
            $this->attribute['Valor']['Type'] 			= 'varchar2';
            $this->attribute['Valor']['Length']			= 70;
            $this->attribute['Valor']['NN'] 			= 1;
            $this->attribute['Valor']['Label'] 			= 'Valor';
            
            $this->recognize['Recognize'] 	= 'AutDocL_Id, Tag';
            //Calculates para a criaзгo de querys no diretуrio SQL
            
            $this->index["AutDocTag"]["Cols"]	= "AutDocL_Id, Tag";
            $this->index["AutDocTag"]["Unique"]	= 0;
            
            //Todas as Queries da classe
            $this->query['qGeral'] 		= 'AutDocLElem_qGeral';
            $this->query['qId'] 		= 'AutDocLElem_qId';
                 
        } 
        
	} 

?>