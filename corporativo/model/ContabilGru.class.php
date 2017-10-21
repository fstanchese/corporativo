<?php
        
    require_once ("../engine/Model.class.php");
        
    class ContabilGru extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'ContabilGru'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        
        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['BoletoItemTi_Id']['Type'] 			= 'number';
            $this->attribute['BoletoItemTi_Id']['Length'] 			= 15;
            $this->attribute['BoletoItemTi_Id']['NN'] 				= 1;
            $this->attribute['BoletoItemTi_Id']['Label'] 			= 'Curso';

            $this->attribute['DtInicio']['Type'] 			= 'date';
            $this->attribute['DtInicio']['NN'] 				= 1;
            $this->attribute['DtInicio']['Label'] 			= 'Data Início';
            
            $this->attribute['DtTermino']['Type'] 			= 'date';
            $this->attribute['DtTermino']['NN'] 			= 0;
            $this->attribute['DtTermino']['Label'] 			= 'Data Término';            
            
            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 100;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Nome';




            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            
            //Indices
            $this->index["BoletoItemTi"]["Cols"] = "BoletoItemTi_Id";
			$this->index["BoletoItemTi"]["Unique"] = 0;
            
                
        }
        
        
      
        
}
?>
    