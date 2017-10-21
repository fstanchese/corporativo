<?php

    require_once ("../engine/Model.class.php");

    class WOcorrXAnexoTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrXAnexoTi'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WOcorr_Id']['Type'] 			= 'number';
            $this->attribute['WOcorr_Id']['Length'] 		= 15;
            $this->attribute['WOcorr_Id']['NN'] 			= 1;
            $this->attribute['WOcorr_Id']['Recognize'] 		= '1';

            $this->attribute['AnexoTi_Id']['Type'] 			= 'number';
            $this->attribute['AnexoTi_Id']['Length'] 		= 15;
            $this->attribute['AnexoTi_Id']['NN'] 			= 1;
            $this->attribute['AnexoTi_Id']['Label'] 		= 'Tipo de Anexo';
            $this->attribute['AnexoTi_Id']['Recognize'] 	= '2';

            $this->attribute['State_Id']['Type'] 			= 'number';
            $this->attribute['State_Id']['Length'] 			= 15;
            $this->attribute['State_Id']['NN'] 				= 1;

            $this->attribute['QtdeVias']['Type'] 			= 'number';
            $this->attribute['QtdeVias']['Length'] 			= 3;
            $this->attribute['QtdeVias']['Mask'] 			= '9';
            $this->attribute['QtdeVias']['Label'] 			= 'Quantidade de Vias';

            $this->attribute['Depart_Resp_Id']['Type'] 		= 'number';
            $this->attribute['Depart_Resp_Id']['Length']	= 15;

            $this->recognize['Recognize']	= 'WOcorr_Id, AnexoTi_Id';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['Pendente'] 	= 'WOcorrXAnexoTi_qPendente';
            $this->query['qWOcorrAss']	= 'WOcorrXAnexoTi_qWOcorrAss';

                            
        }
}
?> 