<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AutDoc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AutDoc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 200000; 

        	$this->attribute['AutDocL_Id']['Type']		= 'number';
        	$this->attribute['AutDocL_Id']['Length']	= 15;
        	$this->attribute['AutDocL_Id']['NN'] 		= 1;
        	$this->attribute['AutDocL_Id']['Label'] 	= 'Layout do Documento Autenticado';
        	 
            $this->attribute['Documento']['Type'] 		= 'clob';
            $this->attribute['Documento']['NN'] 		= 1;
            $this->attribute['Documento']['Label'] 		= 'Documento';

            $this->attribute['Matric_Id']['Type'] 		= 'number';
            $this->attribute['Matric_Id']['Length']		= 15;
            $this->attribute['Matric_Id']['NN'] 		= 1;
            $this->attribute['Matric_Id']['Label'] 		= 'Aluno';
            
            $this->attribute['Hash']['Type'] 			= 'varchar2';
            $this->attribute['Hash']['Length']			= 32;
            $this->attribute['Hash']['NN'] 				= 1;
            $this->attribute['Hash']['Label'] 			= 'Hash';
            
            
            $this->recognize['Recognize'] 	= 'WPessoa_Id, AutDocL_Id';
            //Calculates para a criaзгo de querys no diretуrio SQL
            
            $this->index["AutDocTag"]["Cols"]	= "Hash";
            $this->index["AutDocTag"]["Unique"]	= 1;
            
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'AutDoc_qGeral';
            $this->query['qId'] 	= 'AutDoc_qId';
            $this->query['qAluno']	= 'AutDoc_qAluno';
                 
        } 
        
        
        public function ConfAtestado($AutDocL_Id,$Documento,$Matric_Id,$Hash,$DtGeracao,$aTag,$aValor)
        {
        	
        	$instrucao = "begin insert into AutDoc (Dt,AutDocL_Id,Documento,Matric_Id,Hash) values (to_date('$DtGeracao','dd/mm/yyyy hh24:mi:ss'),'$AutDocL_Id','$Documento','$Matric_Id','$Hash'); End;";

        	$dbData = new DbData($this->db);
        	
        	
        	if($dbData->Set($instrucao))
        	{
        		$dbData->Commit();
        		echo $this->MsgPage("Success","Aзгo efetuada com sucesso.");
        	}
        	else
        	{
        		echo $this->MsgPage("Error","Ocorreu um erro. Tente novamente ou entre em contato com o Depto de TI.");
        	}

        	
        	$dbData->Get("select AutDoc_Id.currval as Id from dual");
        	$row = $dbData->Row();
        	$AutDoc_Id = $row[ID];

       	
        	$instrucao = 'begin ';
        	foreach ($aTag as $key => $value)
        	{
        		if (!empty($aValor[$key]))
        		{
        			$instrucao .= "insert into AutDocElem (AutDoc_Id,Tag,Valor) values ('$AutDoc_Id','$value','$aValor[$key]');";
        		}
        	}
        	
        	$instrucao .= ' End;';

        	if($dbData->Set($instrucao))
        	{
        		$dbData->Commit();
        		echo $this->MsgPage("Success","Aзгo efetuada com sucesso.");
        		$bReturn = TRUE;
        	}
        	else
        	{
        		echo $this->MsgPage("Error","Ocorreu um erro. Tente novamente ou entre em contato com o Depto de TI.");
        		$bReturn = FALSE;
        	}
        	 
        	unset($dbData);
        	       	
        	return $bReturn;

        }
        
        public function GetDocumento($vHash)
        {
        	$dbData = new DbData($this->db);        	
        	
        	
        	$dbData->Get("select id,documento,to_char(dt,'dd/mm/yyyy hh24:mi:ss') as DtGeracao from AutDoc where Hash='$vHash'");
        	$row = $dbData->Row();
        	if ($row["ID"] != '')
        	{
        		$vHash = substr($vHash,0,4).'-'.substr($vHash,4,4).'-'.substr($vHash,8,4).'-'.substr($vHash,12,4).'-'.substr($vHash,16,4).'-'.substr($vHash,20,4).'-'.substr($vHash,24,4).'-'.substr($vHash,28,4);
        		$sDocumento = str_replace("#CHAVE", $vHash, $row["DOCUMENTO"]->load());
        		$sDocumento = str_replace("#DTGERACAO", $row["DTGERACAO"], $sDocumento);
        		
        		$return = $sDocumento;	
        	}
        	else 
        	{
        		$return = NULL;
        	}
	       	return  $return;
        }
        
    
	} 

?>