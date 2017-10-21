<?php

    require_once ("../engine/Model.class.php");

    class WOAXAnexoTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOAXAnexoTi'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorrAss_Id']['Type'] 		= 'number';
            $this->attribute['WOcorrAss_Id']['Length'] 		= 15;
            $this->attribute['WOcorrAss_Id']['NN'] 			= 1;
            $this->attribute['WOcorrAss_Id']['Label'] 		= 'Assunto';
            $this->attribute['WOcorrAss_Id']['Recognize'] 	= '1';

            $this->attribute['AnexoTi_Id']['Type'] 			= 'number';
            $this->attribute['AnexoTi_Id']['Length'] 		= 15;
            $this->attribute['AnexoTi_Id']['NN'] 			= 1;
            $this->attribute['AnexoTi_Id']['Label'] 		= 'Tipo de Anexo';
            $this->attribute['AnexoTi_Id']['Recognize']		= '2';

            $this->attribute['DocEntrega']['Type'] 			= 'varchar2';
            $this->attribute['DocEntrega']['Length'] 		= 3;
            $this->attribute['DocEntrega']['Label'] 		= 'Documento a ser Entregue';

            $this->recognize['Recognize']	= 'WOcorrAss_Id, AnexoTi_Id';
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe            
            $this->query['qGeral'] 					= 'WOAXAnexoTi_qGeral';
            $this->query['qGeralEntrada']			= 'WOAXAnexoTi_qGeralEntrada';
            $this->query['qGeralEntrega']			= 'WOAXAnexoTi_qGeralEntrega';
            $this->query['qId']						= 'WOAXAnexoTi_qId';
            $this->query['qWOcorr']					= 'WOAXAnexoTi_qWOcorr';
            $this->query['qWOcorrAss'] 				= 'WOAXAnexoTi_qWOcorrAss';
            $this->query['1WOcorrAssDocEntrega']	= 'WOAXAnexoTi_qWOcorrAssDocEntrega';

                            
        }
}
?> 