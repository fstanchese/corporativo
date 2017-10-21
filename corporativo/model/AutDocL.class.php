<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AutDocL extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AutDocL'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 60; 
        	
        	
        	$this->attribute['AutDocTi_Id']['Type'] 	= 'number';
        	$this->attribute['AutDocTi_Id']['Length']	= 15;
        	$this->attribute['AutDocTi_Id']['NN'] 		= 1;
        	$this->attribute['AutDocTi_Id']['Label'] 	= 'Tipo de Documento';
        	
        	$this->attribute['DtInicio']['Type']	 	= 'date';
        	$this->attribute['DtInicio']['NN'] 			= 1;
        	$this->attribute['DtInicio']['Label'] 		= 'Data de Inнcio';
        	
        	$this->attribute['DtTermino']['Type'] 		= 'date';
        	$this->attribute['DtTermino']['NN'] 		= 1;
        	$this->attribute['DtTermino']['Label'] 		= 'Data de Tйrmino';
        	
        	$this->attribute['Descricao']['Type'] 		= 'varchar2';
        	$this->attribute['Descricao']['Length']		= 30;
        	$this->attribute['Descricao']['NN']			= 1;
        	$this->attribute['Descricao']['Label'] 		= 'Descriзгo';
        	
        	$this->attribute['Ano_Id']['Type'] 			= 'number';
        	$this->attribute['Ano_Id']['Length']		= 15;
        	$this->attribute['Ano_Id']['NN'] 			= 1;
        	$this->attribute['Ano_Id']['Label'] 		= 'Ano';
        	 
            $this->attribute['Layout']['Type'] 			= 'clob';
            $this->attribute['Layout']['NN'] 			= 1;
            $this->attribute['Layout']['Label'] 		= 'Layout';

            
            $this->recognize['Recognize'] 	= 'DtInicio, DtTermino, Ano_Id, Descricao';
            //Calculates para a criaзгo de querys no diretуrio SQL
            
            $this->index["AutDocTag"]["Cols"]	= "Descricao";
            $this->index["AutDocTag"]["Unique"]	= 0;
            
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'AutDocL_qGeral';
            $this->query['qId'] 	= 'AutDocL_qId';
            
        } 
        
        public function GetDocumento($NivelCurso_Id,$arMatric)
        {
        	require_once ('../engine/Crypt.class.php');
        	require_once ('../model/AutDoc.class.php');
        	
        	$dbData 	= new DbData($this->db);
        	$crypt 		= new Crypt($this->db);
        	$autDoc 	= new AutDoc($this->db);       	
  	
        	
        	$dbData->Get("select AutDocL.Id as AutDocL_Id,AutDocL.Layout from AutDocL,AutDocTi where AutDocTi.Id = AutDocL.AutDocTi_Id and sysdate between AutDocL.DtInicio and AutDocL.DtTermino and AutDocTi.CursoNivel_Id='$NivelCurso_Id'");
        	$aReturn = $dbData->Row();

        	$texto =  $aReturn[LAYOUT]->load();
        	
        	$dbData->Get("select * from AutDocLElem where AutDocL_Id='$aReturn[AUTDOCL_ID]'");

        	
        	while($aRet = $dbData->Row())
        	{
        		$aRetSubstituir[] = $aRet[TAG];
        		$aRetSubstituto[] = $arMatric[substr($aRet[TAG],1)];
        	}
        	$aRetSubstituir[] = '#DATA';
        	$aRetSubstituto[] = trim(_dataExtenso());
        	
        	
        	$sArquivo = $sDocumento = str_replace($aRetSubstituir,$aRetSubstituto,$texto);
        	
        	
        	$aHash = $crypt->GetHash($sArquivo);        		
        		
        	$showHash = substr($aHash["HASH"],0,4).'-'.substr($aHash["HASH"],4,4).'-'.substr($aHash["HASH"],8,4).'-'.substr($aHash["HASH"],12,4).'-'.substr($aHash["HASH"],16,4).'-'.substr($aHash["HASH"],20,4).'-'.substr($aHash["HASH"],24,4).'-'.substr($aHash["HASH"],28,4);
        		
        	$aRetSubstituir[] = '#CHAVE';
        	$aRetSubstituto[] = $showHash;
        		
        	$aRetSubstituir[] = '#DTGERACAO';
        	$aRetSubstituto[] = $aHash["DATA"];
        		
        	$sArquivo = str_replace($aRetSubstituir,$aRetSubstituto,$texto);

        	
        	$autDoc->ConfAtestado($aReturn[AUTDOCL_ID], $sDocumento, $arMatric["ID"], $aHash["HASH"], $aHash["DATA"], $aRetSubstituir, $aRetSubstituto);
        		
        	
        	return $sArquivo ;
        	 
        }
        
	} 

?>