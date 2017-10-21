<?php

    require_once ("../engine/Model.class.php");

    class CAAssXCAMesa extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAAssXCAMesa'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 2000;

            $this->attribute['CAMesa_Id']['Type'] 		= 'number';
            $this->attribute['CAMesa_Id']['Length'] 	= 15;
            $this->attribute['CAMesa_Id']['NN'] 		= 1;
            $this->attribute['CAMesa_Id']['Label']		= 'Mesa';

            $this->attribute['CAAssunto_Id']['Type'] 	= 'number';
            $this->attribute['CAAssunto_Id']['Length'] 	= 15;
            $this->attribute['CAAssunto_Id']['NN'] 		= 1;
            $this->attribute['CAAssunto_Id']['Label']	= 'Assunto';
                        
            
          	$this->recognize["Recognize"] = "CAMesa_Id, CAAssunto_Id";          

          	$this->query["qGeral"] 		= "CAAssXCAMesa_qGeral";
          	$this->query["qId"] 		= "CAAssXCAMesa_qId";
          	
        }
}
?> 