<?php

    require_once ("../engine/Model.class.php");

    class CAMesa extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAMesa'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;


        
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 1000;

            $this->attribute['Sala_Id']['Type'] 		= 'number';
            $this->attribute['Sala_Id']['Length'] 		= 15;
            $this->attribute['Sala_Id']['NN'] 			= 1;
            $this->attribute['Sala_Id']['Label']		= 'Sala';

            $this->attribute['Numero']['Type'] 			= 'number';
            $this->attribute['Numero']['Length']		= '3';
            $this->attribute['Numero']['NN'] 			= 1;
            $this->attribute['Numero']['Mask'] 			= 'd';
            $this->attribute['Numero']['Label'] 		= 'Número';

            $this->attribute['CAEvento_Id']['Type'] 	= 'number';
            $this->attribute['CAEvento_Id']['Length'] 	= 15;
            $this->attribute['CAEvento_Id']['NN'] 		= 1;
            $this->attribute['CAEvento_Id']['Label']	= 'Evento';
            
            $this->attribute['Ativa']['Type'] 			= 'string';
            $this->attribute['Ativa']['Length'] 		= 3;
            $this->attribute['Ativa']['NN'] 			= 0;
            $this->attribute['Ativa']['Label']			= 'Situação';
                        
			$this->index["Sala"]["Cols"] 	= "Sala_Id";
			$this->index["Sala"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] 	= "CAEvento_Id, Sala_Id, Numero";
			$this->recognize["RecNumero"] 	= "Numero";

			$this->query["qGeral"] 			= "CAMesa_qGeral";
			$this->query["qId"] 			= "CAMesa_qId";
			
			$this->calculate["Geral"] 		= "CAMesa_qGeral";
			
        }
        
        
        public function GetListMesaAtiva($CAEvento_Id,$CAMesa_Id=null)
        {
        	
        	$dbData 	= new DbData($this->db);
        	$dbData2 	= new DbData($this->db);
        	
        	$html = $this->Ul(array("class"=>"listMesa"));
        	
        	$dbData->Get("SELECT id, numero FROM camesa WHERE caevento_id = '".$CAEvento_Id."' AND ativa = 'on' and (Id = '$CAMesa_Id' or '$CAMesa_Id' is null)  ORDER BY numero");
        	
        	while($row = $dbData->Row())
        	{
        		/*
        		$dbData2->Get("SELECT count(*) as qtde 
        				from casenha 
        				where dttriagem is not null 
        				AND dtsaida is null 
        				AND dtcancelado is null 
        				AND emespera = '0'
        				AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."' 
        				AND camesa_id='".$row[ID]."'");

        		$row2 = $dbData2->Row();
        		if ($row2[QTDE] == 0)
        		{*/
        			$html .= $this->Li(array("idr"=>$row[ID])).$row[NUMERO].$this->CloseLi();
        		//}        		
        	}
        	
        	$html .= $this->CloseUl();
        	
        	return $html;
        }
        
        
        public function GetListMesa($CAEvento_Id)
        {
        	 
        	$dbData = new DbData($this->db);
        	 
        	$html = $this->Ul(array("class"=>"listMesa"));
        	 
        	$dbData->Get("SELECT id, numero, ativa FROM camesa WHERE caevento_id = '".$CAEvento_Id."' ORDER BY numero");
        	 
        	while($row = $dbData->Row())
        	{
        		if ($row[ATIVA] == 'on')
        			$vClass = "listMesaOn";
        		else
        			$vClass = "listMesaOff";
        		
        		$html .= $this->Li(array("class"=>$vClass,"idr"=>$row[ID])).$row[NUMERO].$this->CloseLi();
        
        	}
        	 
        	$html .= $this->CloseUl();
        	 
        	return $html;
        }
        
        
        public function GetListMesaSituacao($CAEvento_Id,$CAMesa_Id=null)
        {
        	require_once('../model/CASenha.class.php');
        	 
        	$dbData 	= new DbData($this->db);
        	$dbDta 		= new DbData($this->db);
        	
        	$caSenha 	= new CASenha($this->db);
        	 
        	$html = $this->Ul(array("class"=>"listMesaSit"));
        	 
        	$dbData->Get("SELECT id, numero FROM camesa WHERE caevento_id = '".$CAEvento_Id."' AND ativa = 'on' and (Id = '$CAMesa_Id' or '$CAMesa_Id' is null)  ORDER BY numero");
        	 
        	while($row = $dbData->Row())
        	{
        		
        		$dbDta->Get("SELECT casenha.*,to_char(dt,'hh24:mi') as criacao,to_char(dttriagem,'hh24:mi') as inicio 
        				FROM casenha 
        				WHERE camesa_id = '".$row[ID]."'
        				AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'        				         				 
        				and dtsaida is null and dtcancelado is null order by id desc");
       				
        		$linha = $dbDta->Row();
        		$vRet = '';
        		$vClass = '';
        		if ($linha[ID] != '')
        		{
        			$vRet = '<div class="infosSituacao"><br>'. $caSenha->GetSenha($linha[ID]) . '<br>criação: '.$linha[CRIACAO].'<br>início: '. $linha[INICIO] . '</div>';
        			if ($linha[INICIO] == '')
        				$vClass = 'glower';
        			if ($linha[EMESPERA] == 1)
        				$vRet .= '<p style="color:#FF0000;font-size:12px;text-align:center">Em espera</p>';

        		}        		
        		$html .= $this->Li(array("idr"=>$row[ID],"class"=>$vClass)).$row[NUMERO].' '. $vRet . $this->CloseLi();
        
        	}
        	 
        	$html .= $this->CloseUl();
        	 
        	return $html;
        }

        
        public function GetMesaSituacao($CAEvento_Id,$CAMesa_Id=null)
        {
        	require_once('../model/CASenha.class.php');
        	require_once('../model/CAPausaTi.class.php');
        	require_once('../model/WPessoa.class.php');
        
        	$dbData 	= new DbData($this->db);
        	 
        	$caSenha 	= new CASenha($this->db);
        	$caPausaTi	= new CAPausaTi($this->db);
        	$wpessoa	= new WPessoa($this->db);
        
        	$html = $this->Ul(array("class"=>"listMesaSit"));
        
        	$dbData->Get("SELECT id, numero FROM camesa WHERE caevento_id = '".$CAEvento_Id."' AND ativa = 'on' and (Id = '$CAMesa_Id' or '$CAMesa_Id' is null)  ORDER BY numero");

        	//#9C9797 => Fechada
        	//#D80404 => Intervalo
        	//#30F522 => livre
        	//#F5E022 => em Atendimento
        	
        	while($row = $dbData->Row())
        	{
        		
				$aSit = $this->GetSituacao($row["ID"]);

				$vTexto = '';
				$vAtendente = '';
				
				if (empty($aSit[CAPAUSATI_ID]))
				{
					$vCor = '#7cfa88';
					
				}
				else
				{
					if ($aSit[CAPAUSATI_ID] == '212900000000003')
						$vCor = '#fe7777';
						
					if ($aSit[CAPAUSATI_ID] == '212900000000004')
						$vCor = '#9fb5fc';
				}

				$vTexto = $caPausaTi->Recognize($aSit[CAPAUSATI_ID]);
				$vAtendente = reset(explode(' ',$aSit[ATENDENTE]));
				
				if (empty($aSit))
					$vCor = '#b9b9b9';									       		

        		$html .= $this->Li(array("idr"=>$row[ID])).
        					$this->Div(array("style"=>"border:0px;margin:0px 0px 0px 0px;text-align:right;height:auto;float:left;")) .
        						$wpessoa->GetFoto($aSit["WPESSOA_ID"],array("width"=>"40px")).
        					$this->CloseDiv().
        					$this->Div(array("style"=>"float:right;text-align:right;width:30px;height:30px;background-color:".$vCor.";color:#222")) .
        						$this->H5($row[NUMERO],array("style"=>"margin-right:3px")).
        					$this->CloseDiv().
        					$this->Br().
        					$this->P($vAtendente,array("style"=>"font-size:15px;text-align:center;margin:0;padding:0")).
        					$this->P($vTexto,array("style"=>"font-size:11px;text-align:center;margin:0;padding:0")).
        		 	$this->CloseLi();
        
        	}
        
        	$html .= $this->CloseUl();
        
        	return $html;
        }

        
        public function GetSituacao($CAMesa_Id)
        {
        	$dbData 	= new DbData($this->db);
        	
        	$dbData->Get("select camesa_id,shortname(wpessoa_gsRecognize(wpessoa_id),15) as atendente,wpessoa_id,CAPausaTi_Id,WPessoa_Id 
        					from caatendente 
        					where camesa_id='$CAMesa_Id' and trunc(sysdate) between trunc(dtinicio) and trunc(nvl(dttermino,sysdate)) order by id desc");
        	
        	$aDados = $dbData->Row();
        	
        	return $aDados;
        	
        }
}
?> 