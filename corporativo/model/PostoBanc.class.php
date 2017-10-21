<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class PostoBanc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'PostoBanc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 300000;


            $this->attribute['DtEstacao']['Type'] 			= 'date';
            $this->attribute['DtEstacao']['Label'] 			= 'Data_hora local da maquina que gerou a transacao';

            $this->attribute['IP']['Type'] 					= 'varchar2';
            $this->attribute['IP']['Length'] 				= 15;
            $this->attribute['IP']['Label'] 				= 'IP';
            $this->attribute['IP']['NN'] 					= 1;

            $this->attribute['Transacao']['Type'] 			= 'varchar2';
            $this->attribute['Transacao']['Length'] 		= 64;
            $this->attribute['Transacao']['Label'] 			= 'Transaзгo';
            $this->attribute['Transacao']['NN'] 			= 1;

            $this->attribute['DtProcessamento']['Type'] 	= 'date';
            $this->attribute['DtProcessamento']['Label'] 	= 'Data do processamento da transaзгo';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
			$this->recognize['Recognize']		= 'Transacao';
            
            //Нndices

            //Todas as Queries da classe
            $this->query['qBaixa']				= 'PostoBanc_qBaixa';
            $this->query['qTipoMovimento'] 		= 'PostoBanc_qTipoMovimento';
            $this->query['qId'] 				= 'PostoBanc_qId';
            $this->query['qEstorno'] 			= 'PostoBanc_qEstorno';
            $this->query['qComprovante'] 		= 'PostoBanc_qComprovante';
            $this->query['qCampus'] 			= 'PostoBanc_qCampus';
            $this->query['qPrevisaoVisa'] 		= 'PostoBanc_qPrevisaoVisa';
            $this->query['qGeral'] 				= 'PostoBanc_qGeral';
            $this->query['qMovimento'] 			= 'PostoBanc_qMovimento';
            $this->query['qPercentualTipo'] 	= 'PostoBanc_qPercentualTipo';
            $this->query['qMovimentoVisa'] 		= 'PostoBanc_qMovimentoVisa';
            $this->query['qBaixaComPagamento'] 	= 'PostoBanc_qBaixaComPagamento';
            $this->query['qTransacao'] 			= 'PostoBanc_qTransacao';
            $this->query['qMovPeriodo'] 		= 'PostoBanc_qMovPeriodo';

                 
        } 
        
        public function GetValores($PostoBanc_Id)
        {
        	$aPosto = $this->GetIdInfo($PostoBanc_Id);
        	
        	$aRetorno["NUMTRANSACAO"] 	= $PostoBanc_Id - 86200000000000; 
        	$aRetorno["TRANSACAO"]		= $aPosto["TRANSACAO"];
        	$aRetorno["TIPO"] 			= substr($aPosto["TRANSACAO"],11,3);
        	$aRetorno["IP"] 			= $aPosto["IP"];
        	$aRetorno["DT"]				= $aPosto["DT"];
       		if (substr($aPosto[TRANSACAO],11,3) == 'bol')
       		{
       			$aRetorno["TPTRANS"]	= 'Boleto';
       			$aRetorno["BOLETO_ID"] 	= substr($aPosto["TRANSACAO"],19);
       			$aRetorno["VALOR"]		= str_replace('.',',',str_replace("_","",substr($aPosto["TRANSACAO"],0,10)));
       		}
       		if (substr($aPosto[TRANSACAO],11,3) == 'pag')
       		{
       			$aDados = explode("_",substr($aPosto["TRANSACAO"],11));
       			
       			if ($aDados[1] == 'VC')
       				$aTipo = 'Cartгo Crйdito';
       			if ($aDados[1] == 'VD')
       				$aTipo = 'Cartгo Dйbito';
       			
       			$aRetorno["VALOR"]		= str_replace('.',',',str_replace("_","",substr($aPosto["TRANSACAO"],0,10))); 
       			$aRetorno["TPTRANS"]	= $aTipo;
       			$aRetorno["NUMDOC"]		= $aDados[2];
       			$aRetorno["QTDEPARC"]	= $aDados[3];
       		}
       		
        	return $aRetorno;
        }
} 

?>