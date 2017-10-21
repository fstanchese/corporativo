<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class StateTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'StateTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 100; 
        	
            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length']			= 50;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Tipo de Situaчуo';

            $this->recognize['Recognize'] 	= 'Nome';
            
            $this->calculate['Geral']		= 'StateTi_qGeral';
           
            $this->index["Nome"]["Cols"]	= "Nome";
            $this->index["Nome"]["Unique"] 	= 0;
            
            //Todas as Queries da classe            
            $this->query['qGeral'] 			= 'StateTi_qGeral';
            $this->query['qId'] 			= 'StateTi_qId';
                 
        } 
        

        
	} 

?>