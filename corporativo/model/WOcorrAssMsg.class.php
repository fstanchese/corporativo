<?php

    require_once ("../engine/Model.class.php");

    class WOcorrAssMsg extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAssMsg'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAss_Id']['Type'] 	= 'number';
            $this->attribute['WOcorrAss_Id']['Length']	= 15;
            $this->attribute['WOcorrAss_Id']['Label'] 	= 'Assunto';
            $this->attribute['WOcorrAss_Id']['NN'] 		= 1;

            $this->attribute['DtInicio']['Type'] 		= 'date';
            $this->attribute['DtInicio']['Label'] 		= 'Data de Início';
            $this->attribute['DtInicio']['NN'] 			= 1;
            $this->attribute['DtInicio']['Mask'] 		= 'd';

            $this->attribute['DtTermino']['Type'] 		= 'date';
            $this->attribute['DtTermino']['Label'] 		= 'Data de Término';
            $this->attribute['DtTermino']['Mask'] 		= 'd';

            $this->attribute['AbrirJanela']['Type'] 	= 'varchar2';
            $this->attribute['AbrirJanela']['Length'] 	= 3;
            $this->attribute['AbrirJanela']['Label'] 	= 'Abrir Janela?';

            $this->attribute['Texto']['Type'] 			= 'varchar2';
            $this->attribute['Texto']['Length'] 		= 500;
            $this->attribute['Texto']['Label'] 			= 'Mensagem';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, DtInicio, DtTermino';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qWOcorrAssPeriodo']	= 'WOcorrAssMsg_qWOcorrAssPeriodo';
            $this->query['qWOcorrAss']			= 'WOcorrAssMsg_qWOcorrAss';
            $this->query['qGeral']				= 'WOcorrAssMsg_qGeral';
            $this->query['qId']					= 'WOcorrAssMsg_qId';

                            
        }
}
?> 