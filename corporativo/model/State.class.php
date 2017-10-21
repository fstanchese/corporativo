<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class State extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'State'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct($db) 
        {
        	
        	$this->db = $db;
        	
        	$this->rows = 500; 

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 30;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Estado';
            $this->attribute['Nome']['Recognize']	 	= '1';

            $this->attribute['Nick']['Type'] 			= 'varchar2';
            $this->attribute['Nick']['Length'] 			= 10;
            $this->attribute['Nick']['Label'] 			= 'Nick';

            $this->attribute['State_Id']['Type'] 		= 'number';
            $this->attribute['State_Id']['Length']		= 15;
            $this->attribute['State_Id']['Label'] 		= 'Estado Pai';

            $this->attribute['StateTi_Id']['Type'] 		= 'number';
            $this->attribute['StateTi_Id']['Length']	= 15;
            $this->attribute['StateTi_Id']['Label'] 	= 'Grupo de Situaзгo';
            
            $this->recognize['Recognize']	= 'Nome';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Estagio_Id'] 		= 'State_qEstagio';
            $this->calculate['Situacao_Id'] 	= 'State_qSituacao';
            $this->calculate['Matric_Id'] 		= 'State_qMatric';
            $this->calculate['BolsaSol_Id'] 	= 'State_qBolsaSol';
            $this->calculate['DiplFluxo_Id'] 	= 'State_qDiplFluxo';
            $this->calculate['Encaminha_Id'] 	= 'State_qEncaminha';
            $this->calculate['FIES_Id'] 		= 'State_qFIES';
            $this->calculate['Boleto_Id'] 		= 'State_qBoleto';
            $this->calculate['WOcorr_Id'] 		= 'State_qOcorrencia';
            $this->calculate['MatricExt_Id'] 	= 'State_qMatricExt';
            $this->calculate['MatricTodas_Id'] 	= 'State_qMatricTodas';
            $this->calculate['PagtoFoSeg_Id'] 	= 'State_qPagtoFoSeg';
            $this->calculate['StateTi']			= 'State_qStateTi';
            
            $this->calculate['StateTiNome']		= 'State_qStateTiNome';

            //Todas as Queries da classe
            $this->query['qMatricTodas'] 	= 'State_qMatricTodas';
            $this->query['qEstudante'] 		= 'State_qEstudante';
            $this->query['qMatric'] 		= 'State_qMatric';
            $this->query['qProjeto'] 		= 'State_qProjeto';
            $this->query['qMatricExt'] 		= 'State_qMatricExt';
            $this->query['qInqDisc'] 		= 'State_qInqDisc';
            $this->query['qSituacao'] 		= 'State_qSituacao';
            $this->query['qFIES'] 			= 'State_qFIES';
            $this->query['qFormacao'] 		= 'State_qFormacao';
            $this->query['qOcorrencia']		= 'State_qOcorrencia';
            $this->query['qBolsa'] 			= 'State_qBolsa';
            $this->query['qWOcorr'] 		= 'State_qWOcorr';
            $this->query['qBoleto'] 		= 'State_qBoleto';
            $this->query['qId'] 			= 'State_qId';
            $this->query['qProvao'] 		= 'State_qProvao';
            $this->query['qEstagio'] 		= 'State_qEstagio';
            $this->query['qTeleAtend'] 		= 'State_qTeleAtend';
            $this->query['qSAAMesa'] 		= 'State_qSAAMesa';
            $this->query['qVestPos'] 		= 'State_qVestPos';
            $this->query['qPagtoFoSeg'] 	= 'State_qPagtoFoSeg';
            $this->query['qDCEX'] 			= 'State_qDCEX';
            $this->query['qEncaminha'] 		= 'State_qEncaminha';
            $this->query['qDiplFluxo'] 		= 'State_qDiplFluxo';
			$this->query['qStateTi']		= 'State_qStateTi';
                 
        }
        
        public function GetState($vStateGru_Id)
        {
        	$dbData = new DbData($this->db);
        	$dbData->Get("SELECT id FROM statexstategru WHERE stategru_id = ".$vStateGru_Id);
        	
        	while($row = $dbData->Row()){
        		$aRet[] = $row[ID];
        	}
        
        	return $aRet;
        }
         
}
?>