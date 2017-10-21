<?php

    require_once ("../engine/Model.class.php");

    class CASenha extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CASenha'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
        
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 10000;

        	$this->attribute['WPessoa_Id']['Type'] 			= 'number';
        	$this->attribute['WPessoa_Id']['Length'] 		= 15;
        	$this->attribute['WPessoa_Id']['NN'] 			= 0;
        	$this->attribute['WPessoa_Id']['Label']			= 'Candidato';

        	$this->attribute['Numero']['Type'] 				= 'number';
        	$this->attribute['Numero']['Length'] 			= 4;
        	$this->attribute['Numero']['NN'] 				= 1;
        	$this->attribute['Numero']['Label']				= 'Número';
        	 
            $this->attribute['DtCancelado']['Type'] 		= 'date';
            $this->attribute['DtCancelado']['NN'] 			= 0;
            $this->attribute['DtCancelado']['Label']		= 'Data do Cancelamento';

            $this->attribute['Descricao']['Type'] 			= 'varchar2';
            $this->attribute['Descricao']['Length']			= '50';
            $this->attribute['Descricao']['NN'] 			= 1;
            $this->attribute['Descricao']['Label'] 			= 'Sigla';

            $this->attribute['CAMesa_Id']['Type'] 			= 'number';
            $this->attribute['CAMesa_Id']['Length'] 		= 15;
            $this->attribute['CAMesa_Id']['NN'] 			= 0;
            $this->attribute['CAMesa_Id']['Label']			= 'Mesa';
            
            $this->attribute['CAAtendente_Id']['Type'] 		= 'number';
            $this->attribute['CAAtendente_Id']['Length'] 	= 15;
            $this->attribute['CAAtendente_Id']['NN'] 		= 0;
            $this->attribute['CAAtendente_Id']['Label']		= 'Atendente';
                        
            $this->attribute['CASenhaRegra_Id']['Type'] 	= 'number';
            $this->attribute['CASenhaRegra_Id']['Length'] 	= 15;
            $this->attribute['CASenhaRegra_Id']['NN'] 		= 0;
            $this->attribute['CASenhaRegra_Id']['Label']	= 'Regra';
            
            $this->attribute['DtChamada']['Type'] 			= 'date';
            $this->attribute['DtChamada']['NN'] 			= 0;
            $this->attribute['DtChamada']['Label']			= 'Data da Chamada';
            
            $this->attribute['DtTriagem']['Type'] 			= 'date';
            $this->attribute['DtTriagem']['NN'] 			= 0;
            $this->attribute['DtTriagem']['Label']			= 'Data da Triagem';
            
            $this->attribute['DtSaida']['Type'] 			= 'date';
            $this->attribute['DtSaida']['NN'] 				= 0;
            $this->attribute['DtSaida']['Label']			= 'Data de Saida';
            
            $this->attribute['Chamada']['Type'] 			= 'number';
            $this->attribute['Chamada']['Length'] 			= 1;
            $this->attribute['Chamada']['NN'] 				= 1;
            $this->attribute['Chamada']['Label']			= 'Vezes Chamada';
            
            $this->attribute['EmEspera']['Type'] 			= 'number';
            $this->attribute['EmEspera']['Length'] 			= 1;
            $this->attribute['EmEspera']['NN'] 				= 1;
            $this->attribute['EmEspera']['Label']			= 'Senha em Espera';
            
            $this->attribute['DtEspera']['Type'] 			= 'date';
            $this->attribute['DtEspera']['NN'] 				= 0;
            $this->attribute['DtEspera']['Label']			= 'Data que entrou em Espera';
            
            
            
			$this->index["Numero"]["Cols"]	 	= "CASenhaRegra_Id,Numero";
			$this->index["Numero"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] = "Numero, Descricao";                            
        }
        
        
        public function VerificaUsuarioChamado($WPessoa_Id,$CAEvento_Id)
        {

        	
        	require_once '../model/CAEvento.class.php';
        	$casenharegra 	= new CASenhaRegra($this->db);
        	
			$senhasEvento 	= $casenharegra->GetSenhaRegraByEvento($CAEvento_Id);
        	
        	 
        	$dbData = new DbData($this->db);
        	

        	 
        	$linha = $dbData->Row($dbData->Get("SELECT id FROM casenha WHERE wpessoa_id = '".$WPessoa_Id."' AND casenharegra_id IN ( ".implode(", ",$senhasEvento[Id])." ) AND dttriagem is not null"));
        	 
        	 
        	unset($dbData);
        	 
        	if($linha[ID] != "") return '1'; else return '0';
        	 
        }
        
        
        public function GetNextSenhaNumero($CASenhaRegra_Id)
        {
        
        
        	$dbData = new DbData($this->db);
        
        
        	$linha = $dbData->Row($dbData->Get("SELECT max(numero) as senha FROM casenha WHERE trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('m'),date('i'),date('m'),date('d'),date('Y')))."' AND casenharegra_id = '".$CASenhaRegra_Id."'"));
        	
        
        	unset($dbData);
        
        	if($linha[SENHA] == "") return 1; else return $linha[SENHA]+1;
        	
        
        }
        
        public function GetEvento($CASenha_Id)
        {
        	
        	$dbData = new DbData($this->db);
        	
        	$evento = $dbData->Row($dbData->Get("SELECT caevento_id as id FROM caassunto, casenhati, casenharegra, casenha WHERE caassunto.id = casenhati.caassunto_id AND casenhati.id = casenharegra.casenhati_id AND casenharegra.id = casenha.casenharegra_id AND casenha.id = '".$CASenha_Id."'"));
        	
        	
        	return $evento[ID];
        }
        
        
        public function GetLayoutSenha($CASenha_Id=null,$via2=null)
        {
        	
        	require_once("../model/CAWPesDet.class.php");
        	require_once("../model/CAEvXWPes.class.php");
        	require_once("../model/WPessoa.class.php");
        	
        	$dbData = new DbData($this->db);
        	
        	$caWPes 	= new CAWPesDet($this->db);
        	$caEve 		= new CAEvXWPes($this->db);
        	$wpessoa 	= new WPessoa($this->db);
        	
        	$dadosSenha 	= $this->GetIdInfo($CASenha_Id);

        	$evento 		= $this->GetEvento($CASenha_Id);

        	$caxev_id 		= $caEve->GetIdByEventoWPessoa($dadosSenha[WPESSOA_ID]);

        	$dadosPessoa 	= $caWPes->GetWPesInfo($$caxev_id[ID]);
        	
        	$pessoa 		= $dbData->Row($dbData->Get("SELECT id, nome, cpf FROM wpessoa WHERE id = '".$dadosSenha[WPESSOA_ID]."'"));

        	
        	$this->IncludeCSS("casenha.css");
        	
        	$html = $this->Div(array("class"=>"senhaContainer"));
        	
	        	$html .= $this->H3(trim(reset(explode("-",$dadosSenha[CASENHAREGRA_NOME]))),array("class"=>"nomeEvento"));
	        	
	        	if (!empty($pessoa[ID]))
	        	{
	        		$html .= $this->P("CPF: "._FormataCPF($pessoa[CPF]),array("class"=>"infosAluno"));
	        		$html .= $this->P("Nome: ".$pessoa[NOME],array("class"=>"infosAluno"));
	        	}
	        	else
	        	{
	        		$html .= $this->P("&nbsp;");
	        	}
	        	$html .= $this->H2(trim(end(explode("-",$dadosSenha[CASENHAREGRA_NOME]))).str_pad($dadosSenha[NUMERO],3,0,STR_PAD_LEFT),array("class"=>"senhaInfo"));
	        	
	       		$html .= $this->Div()._CodeBar(substr($dadosSenha[ID],-9)).$this->CloseDiv();
	        	
	        	$html .= $this->P("Entrada: ".$dadosSenha[DATAHORA],array("class"=>"infosAluno"));
	        	
	        	
	        	$html .= $this->P($caWPes->GetInfoSenha($caxev_id),array("class"=>"infosAluno"));
	        	
	        	if($via2 != null) $html .= $this->P("2ª via",array("class"=>"via2"));
        		
        	
        	$html .= $this->CloseDiv();
        	
        	unset($caWPes);
       	
        	
        	return $html;
        	
        }
        
      
        
        
        public function GetQtdSenha($CAEvento_Id)
        {
        	 
        	 
        	$dbData = new DbData($this->db);
        	 
        	$sql = "SELECT count(*) as qtd
        			FROM casenharegra, casenhati, caassunto, casenha
        			WHERE casenharegra.casenhati_id = casenhati.id
        			AND casenha.casenharegra_id = casenharegra.id
        			AND casenhati.caassunto_id = caassunto.id
        			AND caassunto.caevento_id = '".$CAEvento_Id."'
        			AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
        			AND casenha.dttriagem is null
        			AND casenha.dtcancelado is null
        			";

        	$qtdSenha = $dbData->Row($dbData->Get($sql));
        	
        	return $qtdSenha[QTD];
        	 
        	 
        }
        
      
        
        public function ProximaSenha($CAEvento_Id,$CASenhaTi_Id=null)
        {
        	
        	require_once("../model/CASenhaRegra.class.php");
        	 
        	$caSenhaRegra = new CASenhaRegra($this->db);
        	$arSenhas = $caSenhaRegra->GetSenhaRegraByEvento($CAEvento_Id,$CASenhaTi_Id);
        	
        	$dbData = new DbData($this->db);
        	
        	//cancelar os que já foram chamados 3x
        	$dbData->Set("UPDATE casenha SET dtcancelado = sysdate WHERE casenharegra_id IN ( ".implode(", ",$arSenhas[Id])." ) AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."' AND dttriagem is null AND emespera = 1 AND chamada >= 3");
        	
        	//verificar senhas em espera com mais de 5 minutos

        	$sql = "SELECT casenha.id, to_char(casenha.dt,'hh24:mi:ss') as dtchegada, casenha.chamada, casenharegra.sequencia, emespera
        			FROM casenha, casenharegra
        			WHERE casenha.casenharegra_id = casenharegra.id
        			AND casenharegra_id IN ( ".implode(", ",$arSenhas[Id])." )
        			AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
        			AND casenha.dttriagem is null
        			AND casenha.dtcancelado is null
        			AND emespera = '1'
        			AND dtespera+5/3600 < sysdate
        			AND chamada <= 3
        			AND dtespera is not null
        			ORDER BY casenha.id ASC
        			";
        	
        	$dbData->Get($sql);
        	
        	if($dbData->Count() == 0)
        	{
        	
	        	$sql = "SELECT casenha.id, to_char(casenha.dt,'hh24:mi:ss') as dtchegada, casenha.chamada, casenharegra.sequencia, emespera
	        			FROM casenha, casenharegra
	        			WHERE casenha.casenharegra_id = casenharegra.id
	        			AND casenharegra_id IN ( ".implode(", ",$arSenhas[Id])." )
	        			AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
	        			AND casenha.dttriagem is null
	        			AND casenha.dtcancelado is null
	        			AND dtchamada is null
	        			AND chamada <= 3	        		
	        			ORDER BY casenha.id ASC
	        			";
        	
        				//AND dtchamada is null

        				$dbData->Get($sql);
        	}
        	
        	
        	if($dbData->Count() == 0) return;
        	
        	
        	while($row = $dbData->Row())
        	{
        		
        		$arAdj[$row[ID]] = (_SubtrairTempo(date('H:i:s'), $row[DTCHEGADA])*str_replace(",",".",$row[SEQUENCIA]));
        		
        	}

        	arsort($arAdj);

        	return key($arAdj);
        	 
        	 
        }
        
        public function GetSenha($CASenha_Id)
        {
        	
        	$row = $this->GetIdInfo($CASenha_Id); 
        	return trim(end(explode("-",$row[CASENHAREGRA_NOME]))).str_pad($row[NUMERO],3,0,STR_PAD_LEFT) . '('.substr($row[ID],-6).')';
        }
        
	}

?> 