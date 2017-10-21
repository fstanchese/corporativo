<?php

    require_once ("../engine/Model.class.php");

    class CAWPesDet extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAWPesDet'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 50000;

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length']			= '50';
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Nome';

            $this->attribute['Valor']['Type'] 			= 'varchar2';
            $this->attribute['Valor']['Length'] 		= 100;
            $this->attribute['Valor']['NN'] 			= 1;
            $this->attribute['Valor']['Label']			= 'Valor';
            
            $this->attribute['CAEvXWPes_Id']['Type'] 	= 'number';
            $this->attribute['CAEvXWPes_Id']['Length'] 	= 15;
            $this->attribute['CAEvXWPes_Id']['NN'] 		= 1;
            $this->attribute['CAEvXWPes_Id']['Label']	= 'Pessoa';
            
            
			$this->index["Desc"]["Cols"] 				= "Nome";
			$this->index["Desc"]["Unique"] 				= 0;
            
			$this->recognize["Recognize"] 				= "Nome, Valor";
			
			$this->calculate["Geral"] 					= "CAWPesDet_qGeral";

			$this->query["qGeral"] 						= "CAWPesDet_qGeral";
			$this->query["qId"] 						= "CAWPesDet_qId";
			$this->query["qSelecaoAluno"] 				= "CAWPesDet_qSelecaoAluno";
			
        }
        
        
        public function GetTipoBolsa($WPessoa_Id,$CAEvento_Id)
        {
        	
        	$dbData = new DbData($this->db);
        	 
        	require_once '../model/CAEvXWPes.class.php';
        	require_once '../model/CASenhaTi.class.php';
        	
        	$caev 			= new CAEvXWPes($this->db);
        	$caSenhaTi 		= new CASenhaTi($this->db);
        	
        	
        	$caev_id = $caev->GetIdByEventoWPessoa($WPessoa_Id);
        	
        	 
        	$linha = $dbData->Row($dbData->Get("SELECT valor FROM cawpesdet WHERE nome = 'CASENHATI_ID' AND caevxwpes_id = '".$caev_id."'"));
        
        	$aSenhaTi = $caSenhaTi->GetSenhaTiByEvento($CAEvento_Id);
        	
        	if (array_search($linha[VALOR],$aSenhaTi[Id])===FALSE)
        	{
        		
        		$dadosSenha = $caSenhaTi->GetIdInfo($linha[VALOR]);
        		
        		
        		$senha_Ti_Id = $dbData->Row($dbData->Get("SELECT casenhati.id FROM casenhati WHERE descricao = '".$dadosSenha[DESCRICAO]."' AND caassunto_id IN ( SELECT id FROM caassunto WHERE caevento_id IN ( SELECT id FROM caevento WHERE id = '".$CAEvento_Id."' ) )"));
        		
        		unset($dbData);
        		unset($caev);
        		
        		unset($caSenhaTi);

        		return $senha_Ti_Id[ID];
        		
        	}
        	else
        	{
        		unset($dbData);
        		 
        		return $linha[VALOR];
        		
        	}
        	
       
        }
        
        
        public function GetWPesInfo($caevxwpes_id,$param="")
        {
        	
        	

        	$dbData = new DbData($this->db);
        	
        	$dbData->Get("SELECT * FROM cawpesdet WHERE caevxwpes_id ='".$caevxwpes_id."' ORDER BY id");
        	 
        	while($row = $dbData->Row())
        	{
        		
        		$arRet[$row[NOME]] = $row[VALOR];
        		
        		
        	}
        	
        	if($arRet['Cota'] == "Resultado das bolsas destinadas à política afirmativa para pretos, pardos, indígenas e deficientes") $arRet['Cota'] = "Sim"; else $arRet['Cota'] = "Não";
        	
        	
        	
        	$dadosPess = $dbData->Row($dbData->Get("SELECT nome, cpf, codigo, foneres, fonecel FROM wpessoa WHERE id IN ( SELECT wpessoa_id FROM caevxwpes WHERE id = '".$caevxwpes_id."' ) "));
        	
        	$arRet[NOME] 		= $dadosPess[NOME];
        	$arRet[CPF] 		= $dadosPess[CPF];
        	$arRet['Telefone']	= $dadosPess[FONERES];
        	$arRet['Celular']	= $dadosPess[FONECEL];
        	$arRet[RA] 			= $dadosPess[CODIGO];
        	
        	
        	
        	unset($dbData);
        	
        	if($param != "") return $arRet[$param]; else return $arRet;
        	
        	
        	
        }
        
        
        public function AutoCompleteAluno($value)
        {
        
        
        	$dbData = new DbData($this->db);
        		
        	$p_WPessoa_Nome = utf8_decode($value);
        	if(is_numeric($value)) $p_WPessoa_CPF = $value;
        	
        	$p_CAEvento_Id = 199700000000008;
        		
        	
        	$sql = "select  wpessoa.Id,	 WPessoa.Nome,  wpessoa.cpf
					from  WPessoa, CAEvXWPes
					where wpessoa.id = CAEvXWPes.wpessoa_id
					and  ( (CPF = '".$p_WPessoa_CPF."' and  '".$p_WPessoa_CPF."' is not null )  
							or ( translate(upper(wpessoa.nome),'ÁÃÉÍÓÔÚÇÊ','AAEIOOUCE') like replace( trim( translate(upper( '".$p_WPessoa_Nome."' ),'ÁÃÉÍÓÔÚÇÊ','AAEIOOUCE') ),' ','%')||'%' and '".$p_WPessoa_Nome."' is not null  )  )
					AND caevento_id IN ( SELECT id FROM caevento WHERE trunc(sysdate) between dtinicio and dttermino AND senhanominal = 'on')				    
					group by wpessoa.id, wpessoa.nome, wpessoa.cpf
					order by wpessoa.Nome";
        	
        	$dbData->Get($sql);
        		
        	if($dbData->Count() > 100)	die('0');
        	if($dbData->Count() == 0) 	die('1');
        		
        		
        	echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
        		
        	while($row = $dbData->Row())
        	{
        			
        		echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[NOME])));
        
        		echo "CPF: ".$row[CPF]." - ".$row[NOME];
        			
        
        		echo $this->CloseLi();
        			
        	}
        		
        	echo $this->CloseUl();
        		
        	unset($dbData);
        		
        		
        }
        
        public function GetInfoSenha($CAEvXWPes_Id)
        {
        	$vRetorno = '';
        	if ($this->GetWPesInfo($CAEvXWPes_Id,'Bolsa Adicional') == 'Sim')
        		$vRetorno = '50 / O: Não / ';
        	if ($this->GetWPesInfo($CAEvXWPes_Id,'Bolsa Adicional') == 'Não')
        		$vRetorno = '100 / O: Sim / ';
        	 
        	if ($this->GetWPesInfo($CAEvXWPes_Id,'Bolsa Adicional') == '')
        		return $vRetorno;
        	 
        	$vRetorno .= $this->GetWPesInfo($CAEvXWPes_Id,'Média do ENEM') . ' / ';
        	 
        	if (trim($this->GetWPesInfo($CAEvXWPes_Id,'Cota')) == 'Não')
        		$vRetorno .= ' C: Não / ';
        	if (trim($this->GetWPesInfo($CAEvXWPes_Id,'Cota')) == 'Sim')
        		$vRetorno .= ' C: Sim / ';

        	$vRetorno .= $this->GetWPesInfo($CAEvXWPes_Id,'Classificação');
        	 
        	if ($this->GetWPesInfo($CAEvXWPes_Id,'Campus') == 'B')
        		$vRetorno .= '<br>Unidade: Butantã';
        	if ($this->GetWPesInfo($CAEvXWPes_Id,'Campus') == 'M')
        		$vRetorno .= '<br>Unidade: Mooca';
        
    	
        	return $vRetorno;
        	 
        }
        
}
?>