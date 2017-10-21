<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AutDocTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AutDocTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 20; 
        	
            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length']			= 50;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Tipo de Documento';

            $this->attribute['CursoNivel_Id']['Type'] 	= 'number';
            $this->attribute['CursoNivel_Id']['Length'] = 15;
            $this->attribute['CursoNivel_Id']['NN'] 	= 1;
            $this->attribute['CursoNivel_Id']['Label'] 	= 'Nível do Curso';
            
            
            $this->recognize['Recognize'] 	= 'Nome';
            
           
            $this->index["Nome"]["Cols"]	= "Nome";
            $this->index["Nome"]["Unique"] 	= 0;
            
            //Todas as Queries da classe
            $this->query['qGeral'] 		= 'AutDocTi_qGeral';
            $this->query['qId'] 		= 'AutDocTi_qId';
                 
        } 
        
	} 

?>