<?php

    require_once ("../engine/Model.class.php");

    class WOAXWOAReP extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOAXWOAReP'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAssReP_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAssReP_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAssReP_Id']['NN'] 			= 1;
            $this->attribute['WOcorrAssReP_Id']['Label'] 		= 'Resposta Padrão';
            $this->attribute['WOcorrAssReP_Id']['Recognize'] 	= '2';

            $this->attribute['WOcorrAss_Id']['Type'] 			= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 			= 15;
            $this->attribute['WOcorrAss_Id']['NN'] 				= 1;
            $this->attribute['WOcorrAss_Id']['Label'] 			= 'Assunto';
            $this->attribute['WOcorrAss_Id']['Recognize'] 		= '1';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, WOcorrAssReP_Id';
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['Id'] 		= 'WOAXWOAReP_qId';
            $this->query['Geral'] 	= 'WOAXWOAReP_qGeral';

                            
        }
}
?> 