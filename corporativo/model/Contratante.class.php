<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Contratante extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Contratante'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['NN'] 			= 1;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Contratante';

            $this->attribute['ContratanteTi_Id']['Type'] 	= 'number';
            $this->attribute['ContratanteTi_Id']['Length'] 	= 15;
            $this->attribute['ContratanteTi_Id']['NN'] 		= 1;
            $this->attribute['ContratanteTi_Id']['Label'] 	= 'Tipo de Contratante';

            $this->attribute['Matric_Id']['Type'] 			= 'number';
            $this->attribute['Matric_Id']['Length'] 		= 15;
            $this->attribute['Matric_Id']['Label'] 			= 'Matrнcula';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'ContratanteTi_Id';

            //Нndices

            //Todas as Queries da classe
            $this->query['qId'] 			= 'Contratante_qId';
            $this->query['qMatric'] 		= 'Contratante_qMatric';
            $this->query['qGeral'] 			= 'Contratante_qGeral';
            $this->query['qDtEmancipacao']	= 'Contratante_qDtEmancipacao';
                 
        } 
        
        function GetNome($vMatricId)
        {
        	require_once("../model/Matric.class.php");
        	
        	$matric = new Matric($this->db);
        	$dbData = new DbData($this->db);
        	
        	$aContratante = $dbData->Row($dbData->Get("select WPessoa_gsRecognize(Contratante.WPessoa_Id) as Nome from Contratante where matric_id='".$vMatricId."'"));
        	
        	if ($aContratante[NOME] == '')
        	{
        		$aMatric = $matric->GetIdInfo($vMatricId);        		
        		return $aMatric[WPESSOA_NOME];
        	}
        	else
        	{
        		return $aContratante[NOME];
        	}        	
			        	
        }
} 

?>