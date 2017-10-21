<?php 

    require_once ("../engine/Model.class.php"); 

    class DiplReg extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DiplReg'; 


        public $attribute 	= array(); 
        public $calculate	= array();     
        public $query   	= array();
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Registro']['Type'] 			= 'number';
            $this->attribute['Registro']['Length'] 			= 10;
            $this->attribute['Registro']['Label'] 			= 'Registro n.º';

            $this->attribute['DtRegistro']['Type'] 			= 'date';
            $this->attribute['DtRegistro']['Label'] 		= 'Data do Registro';
            $this->attribute['DtRegistro']['Mask'] 			= 'd';

            $this->attribute['WPessoa_Resp_Id']['Type']  	= 'number';
            $this->attribute['WPessoa_Resp_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Resp_Id']['Label'] 	= 'Responsável';
            
            $this->recognize['Recognize']	= 'Registro';
            
            $this->query["qRegistro"]	= "DiplReg_qRegistro";
            $this->query["qId"]			= "DiplReg_qId";
            $this->query["qProcesso"]	= "DiplReg_qProcesso";
            
                             
        } 
	} 
?> 