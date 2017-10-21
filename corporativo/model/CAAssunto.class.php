<?php

    require_once ("../engine/Model.class.php");

    class CAAssunto extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAAssunto'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 500;

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 50;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descrição';

            $this->attribute['CAEvento_Id']['Type'] 	= 'number';
            $this->attribute['CAEvento_Id']['Length'] 	= 15;
            $this->attribute['CAEvento_Id']['NN'] 		= 1;
            $this->attribute['CAEvento_Id']['Label']	= 'Unidade';

        
			$this->index["Desc"]["Cols"] 	= "Descricao";
			$this->index["Desc"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] = "CAEvento_Id, Descricao";

			
			$this->query["qId"]		= "CAAssunto_qId";
			$this->query["qGeral"]	= "CAAssunto_qGeral";

			
			$this->calculate["Geral"] = "CAAssunto_qGeral";
			
        }
}
?>  