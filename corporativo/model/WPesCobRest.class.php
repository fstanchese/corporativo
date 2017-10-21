<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPesCobRest extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WPesCobRest'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5000;


            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Id']['Label'] 	= 'Aluno';

            $this->attribute['CobRestMot_Id']['Type'] 	= 'number';
            $this->attribute['CobRestMot_Id']['Length']	= 15;
            $this->attribute['CobRestMot_Id']['NN'] 	= 1;
            $this->attribute['CobRestMot_Id']['Label'] 	= 'Motivo';

            $this->attribute['DtInicio']['Type'] 		= 'date';
            $this->attribute['DtInicio']['NN'] 			= 1;
            $this->attribute['DtInicio']['Label'] 		= 'Data de Inнcio';
            $this->attribute['DtInicio']['Mask'] 		= 'd';

            $this->attribute['DtTermino']['Type'] 		= 'date';
            $this->attribute['DtTermino']['Label'] 		= 'Data de Tйrmino';
            $this->attribute['DtTermino']['Mask'] 		= 'd';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'CobRestMot_Id';

            //Нndices

            //Todas as Queries da classe
            $this->query['qData'] 	= 'WPesCobRest_qData';
            $this->query['qId'] 	= 'WPesCobRest_qId';
            $this->query['qPessoa']	= 'WPesCobRest_qPessoa';
            $this->query['qGeral'] 	= 'WPesCobRest_qGeral';

                 
        }

        public function GetRestricao($WPessoa_Id)
        {
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get("select WPesCRXCRA.CobrEstAcao_Id from WPesCobRest, WPesCRXCRA where WPesCRXCRA.WPesCobrEst_Id = WPesCobrEst.Id and sysdate between WPesCobRest.DtInicio and WPesCobRest.DtTermino and WPesCobRest.WPessoa_Id =" . $WPessoa_Id);
        	
        	while ($row = $dbData->Row())
        	{
        		$aRet = $row;
        	}
        	        	
        	return $aRet;
        	
        }
}

?>