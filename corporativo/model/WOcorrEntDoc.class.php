<?php

    require_once ("../engine/Model.class.php");

    class WOcorrEntDoc extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrEntDoc'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorr_Id']['Type'] 		= 'number';
            $this->attribute['WOcorr_Id']['Length'] 	= 15;
            $this->attribute['WOcorr_Id']['NN'] 		= 1;

            $this->attribute['AnexoTi_Id']['Type'] 		= 'number';
            $this->attribute['AnexoTi_Id']['Length'] 	= 15;
            $this->attribute['AnexoTi_Id']['NN'] 		= 1;
            $this->attribute['AnexoTi_Id']['Recognize']	= '1';

            $this->attribute['UsEntrega']['Type'] 		= 'varchar2';
            $this->attribute['UsEntrega']['Length'] 	= 30;
            $this->attribute['UsEntrega']['Recognize'] 	= '2';

            $this->attribute['DtEntrega']['Type'] 		= 'date';
            $this->attribute['DtEntrega']['Recognize'] 	= '3';

            $this->attribute['State_Id']['Type'] 		= 'number';
            $this->attribute['State_Id']['Length'] 		= 15;
            $this->attribute['State_Id']['Label'] 		= 'Situação';
            
            $this->recognize['Recognize']	= 'WOcorr_Id, AnexoTi_Id';

            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['Geral'] 				= 'WOcorrEntDoc_qGeral';
            $this->query['PessoaNaoExc'] 		= 'WOcorrEntDoc_qPessoaNaoExc';
            $this->query['Id'] 					= 'WOcorrEntDoc_qId';
            $this->query['PessoaNaoEntregue'] 	= 'WOcorrEntDoc_qPessoaNaoEntregue';
            $this->query['Pessoa'] 				= 'WOcorrEntDoc_qPessoa';
            $this->query['qWOcorr']				= 'WOcorrEntDoc_qWOcorr';
            $this->query['IdIn']				= 'WOcorrEntDoc_qIdIn';

                            
        }
}
?> 