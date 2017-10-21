<?php

    require_once ("../engine/Model.class.php");

    class WOcorrinf extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrinf'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorr_Id']['Type'] 		= 'number';
            $this->attribute['WOcorr_Id']['Length'] 	= 15;
            $this->attribute['WOcorr_Id']['NN'] 		= 1;
            $this->attribute['WOcorr_Id']['Label'] 		= 'Id da Ocorrência';

            $this->attribute['Informacao']['Type'] 		= 'number';
            $this->attribute['Informacao']['Length'] 	= 3;
            $this->attribute['Informacao']['NN'] 		= 1;
            $this->attribute['Informacao']['Label'] 	= 'Informação';

            $this->attribute['Conteudo']['Type'] 		= 'varchar2';
            $this->attribute['Conteudo']['Length'] 		= 2000;
            $this->attribute['Conteudo']['Label'] 		= 'Conteúdo';

            $this->recognize['Recognize']	= 'WOcorr_Id, Informacao';
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qId']					= 'WOcorrInf_qId';
            $this->query['qRetTemRevisao'] 		= 'WOcorrInf_qRetTemRevisao';
            $this->query['qWOcorr']				= 'WOcorrInf_qWOcorr';
            $this->query['qWOcorrInformacao']	= 'WOcorrInf_qWOcorrInformacao';

                            
        }
}
?> 