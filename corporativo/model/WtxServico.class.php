<?php

    require_once ("../engine/Model.class.php");

    class WTxServico extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WTxServico'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Valor']['Type'] 			= 'number';
            $this->attribute['Valor']['Length'] 		= 12.2;
            $this->attribute['Valor']['NN'] 			= 1;
            $this->attribute['Valor']['Label'] 			= 'Valor';

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 100;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Descriчуo';

            $this->attribute['Abreviacao']['Type'] 		= 'varchar2';
            $this->attribute['Abreviacao']['Length'] 	= 30;
            $this->attribute['Abreviacao']['NN'] 		= 1;
            $this->attribute['Abreviacao']['Label'] 	= 'Abreviaчуo';
            
            $this->recognize['Recognize']	= 'Abreviacao, valor';

        }
}
?>