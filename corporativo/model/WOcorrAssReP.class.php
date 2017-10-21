<?php

    require_once ("../engine/Model.class.php");

    class WOcorrAssReP extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAssReP'; 


        public $attribute     	= array();
        public $calculate     	= array();    
        public $query       	= array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Referencia']['Type'] 			= 'varchar2';
            $this->attribute['Referencia']['Length'] 		= 50;
            $this->attribute['Referencia']['Label'] 		= 'Referкncia';
            $this->attribute['Referencia']['NN'] 			= 1;
            $this->attribute['Referencia']['Recognize'] 	= '1';

            $this->attribute['Descricao']['Type'] 			= 'varchar2';
            $this->attribute['Descricao']['Length'] 		= 1000;
            $this->attribute['Descricao']['Label'] 			= 'Descriзгo';

            $this->attribute['Depart_Id']['Type'] 			= 'number';
            $this->attribute['Depart_Id']['Length'] 		= 15;
            $this->attribute['Depart_Id']['NN'] 			= 1;
            $this->attribute['Depart_Id']['Label'] 			= 'Departamento';

            $this->attribute['State_Id']['Type'] 			= 'number';
            $this->attribute['State_Id']['Length'] 			= 15;
            $this->attribute['State_Id']['Label'] 			= 'Situaзгo';

            $this->attribute['WOcorrAss_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAss_Id']['Label'] 		= 'Assunto';

			$this->recognize['Recognize']	= 'Depart_Id, Referencia';
			
            //Calculates para a criaзгo de querys no diretуrio SQL

            //Todas as Queries da classe
            $this->query['Id'] 			= 'WOcorrAssReP_qId';
            $this->query['qAssunto']	= 'WOcorrAssReP_qAssunto';

                            
        }
}
?>