<?php
	include("../engine/User.class.php");
	include("../engine/Db.class.php");

	
	

	$user = new User('aluno',"jdfoj8303m3o9");  

	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);
	

	if($_GET[action] == "GetLogin" && _AntiInjection($_GET[codigo]) != "" && _AntiInjection($_GET[senha]) != "")
	{
		
		include("../model/Matric.class.php");
		$matric = new Matric($dbOracle);
		
		
		$linha = $dbData->Row($dbData->Get("SELECT id, nome, codigo, senha FROM wpessoa WHERE codigo = '"._AntiInjection($_GET[codigo])."' AND senha = '"._AntiInjection($_GET[senha])."'"));
		
		
		if($linha[ID] == "")
		{
			
			$arRet["DADOSALUNO"]["retorno"] = 0;
			
		}
		else 
		{
			$row = $dbData->Row($dbData->Get($matric->Query("qAlunoUltima",array("p_WPessoa_Id"=>$linha[ID]))));
			
			$arRet["DADOSALUNO"][retorno] 	= 1;
			$arRet["DADOSALUNO"][nome] 		= utf8_encode($linha[NOME]);
			$arRet["DADOSALUNO"][photo] 	= ("http://www.usjt.br/gera_img_carteirinha.php?p_img_id="._UrlEncrypt($linha[ID]));
			$arRet["DADOSALUNO"][ra] 		= utf8_encode($linha[CODIGO]);
			$arRet["DADOSALUNO"][auth] 		= _UrlEncrypt($linha[CODIGO]."_".$linha[SENHA]);
			$arRet["DADOSALUNO"][id] 		= _UrlEncrypt($linha[ID]);
			$arRet["DADOSALUNO"][turma]		= utf8_encode($row[TURMA]);
			$arRet["DADOSALUNO"][sala]		= utf8_encode($row[SALA]);
			$arRet["DADOSALUNO"][situacao]	= utf8_encode($row[PLETIVO]." (".$row[SITUACAO].")");
			$arRet["DADOSALUNO"][nivel]	    = utf8_encode($row[CURSONIVELID]);
			
		}
		
		echo json_encode($arRet);
		
		unset($dbData);
		unset($dbOracle);
		unset($user);
		unset($matric);
		
		die();  
		
	}
	
	
	
	
	
	
	
	
	
	if($_GET[action] == "GetMatric" && is_numeric(_Decrypt($_GET[id])) )
	{
		
		include("../model/Matric.class.php");
		include("../model/GradAlu.class.php");
		
		$matric = new Matric($dbOracle);
		
		$dbData->Get($matric->Query('qWPessoaPLetivo',array("p_WPessoa_Id"=>_Decrypt($_GET[id]),"p_O_Data"=>date('d/m/Y'))));
		
		$cont = 0;
		while ($row = $dbData->Row())
		{
			if ($row[MATRICTI_ID] == '8300000000001')
			{
		
				$arMatric[MATRICULA][$cont][CURSO] 		= utf8_encode($row[CURRNOMEHISTREDUZ]);
				$arMatric[MATRICULA][$cont][ID] 		= _UrlEncrypt($row[ID]);
				$arMatric[MATRICULA][$cont][PLETIVO]	= utf8_encode($row[PLETIVO]);
				$arMatric[MATRICULA][$cont][SITUACAO] 	= utf8_encode($row[SITUACAO]);

				$cont++;
	
			}
		}
		
		
		
		
		echo json_encode(_convertArrayKeysToUtf8($arMatric));
		
		
		
		unset($dbData);
		unset($dbOracle);
		unset($user);
		unset($matric);
		
		die();
		
	}
	
	
	if($_GET[action] == "GetDisc" && is_numeric(_Decrypt($_GET[id])) )
	{
		

		include("../model/GradAlu.class.php");
		
		$gradAlu = new GradAlu($dbOracle);
		
		$arMatric 	= $gradAlu->GetNotaWS(_Decrypt($_GET[id]));
		
		
		foreach ($arMatric as $key => $arvalue)
		{
			$cont = 0;
			foreach($arvalue as $key2 => $value)
			{	
				$arJson[$cont][utf8_encode($key)] = utf8_encode(trim($value));
			
				$cont++;
			}
		}
		
		echo json_encode(array("DISCIPLINA"=>$arJson));
		
		die();
		
	}
	
	
	
	if($_GET[action] == "GetHoraAula" && is_numeric(_Decrypt($_GET[id])) )
	{
		require_once('../model/Semana.class.php');
		require_once('../model/PLetivo.class.php');
		include("../model/HoraAula.class.php");
		
		$pLetivo	= new PLetivo($dbOracle);
		$semana 	= new Semana($dbOracle);
		$horaAula 	= new HoraAula($dbOracle);	
		
		$dbData->Get($horaAula->Query('qAluno',array("p_PLetivo_Id"=>$pLetivo->GetIdAnual(),"p_WPessoa_Id"=>_Decrypt($_GET[id]),"p_O_Data"=>date('d/m/Y'))));
		
		if($dbData->Count() > 0){
			
			$cont = 0;$cont2 = 0;
			$vSemanaAux = '';
			
			while($row = $dbData->Row() )
			{
				if ( $row[SEMANA_ID] != $vSemanaAux)
				{
					$cont++;
					$cont2 = 0;
					$vSemanaAux = $row[SEMANA_ID];
				}
					
				$vDiv = '';
				if ($row[DIVTURMA_TEORIA] != '')
					$vDiv = $row[DIVTURMA_TEORIA];
				if ($row[DIVTURMA_PRATICA] != '')
					$vDiv = $row[DIVTURMA_PRATICA];


				$vSemana = utf8_encode($semana->Recognize($row[SEMANA_ID]));
					
					
				//$arRet[$cont]["diasemana"] = $vSemana;
				$arRet[$vSemana][$cont2]["horario"] =  $row["HORA_INICIO"];
				$arRet[$vSemana][$cont2]["turma"] =  $row["TURMA"];
				$arRet[$vSemana][$cont2]["coddisc"] =  $row["DISCIPLINA"];
				$arRet[$vSemana][$cont2]["sala"] =  utf8_encode($row["SALA"]);
				$arRet[$vSemana][$cont2]["div"] = $vDiv;
				/*
				 $arRet["diasemana:$vSemana"][$cont2]["horario"] 	= $row["HORA_INICIO"];
				$arRet["diasemana:$vSemana"][$cont2]["turma"] 		= $row["TURMA"];
				$arRet["diasemana:$vSemana"][$cont2]["coddisc"] 	= $row["DISCIPLINA"];
				$arRet["diasemana:$vSemana"][$cont2]["sala"] 		= $row["SALA"];
				$arRet["diasemana:$vSemana"][$cont2]["div"] 		= $vDiv;
				*/
				$cont2++;
			}

		}else{
			$arRet["VAZIO"] = utf8_encode("Grade do horário de aula não gerada.");
		}
		//print_r($arRet);
		echo json_encode(array("HORARIOAULA"=>array($arRet)));
		
		unset ($semana);
		unset ($horaAula);
		
		die();
	
	}
	
		
	if($_GET[action] == "GetHoraProva" && is_numeric(_Decrypt($_GET[id])) )
	{

		include("../model/HoraProva.class.php");
		include("../model/PLetivo.class.php");
		
		$horaProva	= new HoraProva($dbOracle);
		$pl			= new PLetivo($dbOracle);
		
		$pletivo = $pl->GetIdAnual();

		$dbData->Get("select id from criavalpdt where dtinicad <= sysdate and pletivo_id = $pletivo and internet='on' order by id desc");
		
		$aRet = $dbData->Row();
		
		$dbData->Get($horaProva->Query('qHorario',array("p_WPessoa_Id"=>_Decrypt($_GET[id]),"p_CriAvalPDt_Id"=>$aRet["ID"],"p_CriAvalP_Id"=>NULL)));
		
		if($dbData->Count() > 0){

			$cont = 0;$cont2 = 0;
			$vSemanaAux = '';

			while($row = $dbData->Row() )
			{

				if ( $row[DATA] != $vDataAux)
				{
					$cont++;
					$cont2 = 0;
					$vDataAux = $row[DATA];
				}


				//$arRet[$cont]["diasemana"] = $vSemana;
				$arRet[$row[DATA]][$cont2]["hora"] 			= $row["HORA"];
				$arRet[$row[DATA]][$cont2]["sala"] 			= $row["SALA"];
				$arRet[$row[DATA]][$cont2]["turma"] 		= $row["TURMA"];
				$arRet[$row[DATA]][$cont2]["disciplina"] 	= $row["DISCIPLINA"];
				$arRet[$row[DATA]][$cont2]["divisao"] 		= utf8_encode($row["DIVTURMA"]);

				$cont2++;
			}
		}else{				
			$arRet["VAZIO"] = utf8_encode("Calendário do horário de prova não gerado.");
		}
	
		//print_r($arRet);
		echo json_encode(array("HORARIOPROVA"=>array($arRet)));
	
		unset ($semana);
		unset ($horaAula);
	
		die();
	
	}
	

	
	if($_GET[action] == "GetBancoFolha" && is_numeric(_Decrypt($_GET[id])) )
	{
		$dbData->Get("select bancofolha_gspessoa(" . _Decrypt($_GET[id]) . ") as resp from dual");
		
		$ret = $dbData->Row();
		
		$arRet["BANCOFOLHA"]["RESPONSE"] = utf8_encode($ret["RESP"]); 
		
		echo json_encode($arRet);
		
		die();
	}
	
	
	
	if($_GET[action] == "GetEventosMes" )
	{
		
		setlocale(LC_ALL, "pt_BR", "ptb");
		
		$dbMySQL = new Db ($user,"mysql","mysql.usjt.br|servicos|netserv|servicos");
		$dbDataMySQL = new DbData($dbMySQL);

		$sql = "SELECT  
					ev_descricao.data, 
					ev_descricao.horainicio, 
					ev_descricao.horafim, 
					ev_descricao.evento,  
					ev_local.localdesc as local,
					ev_descricao.obs
		 		FROM ev_descricao 
				INNER JOIN ev_local ON ev_local.codigo = ev_descricao.local
				WHERE ev_descricao.data between '".date('Y')."-".date('m')."-01' AND '".date('Y')."-".date('m')."-31' AND ev_descricao.data >= '".date('Y-m-d')."'
		 		ORDER BY ev_descricao.data";
		
		$dbDataMySQL->Get($sql);
		
		if($dbDataMySQL->Count() > 0){

			$cont = 0;
			$aux = "";

			while($row = $dbDataMySQL->Row() )
			{
				$auxData = explode("-",$row[data]);
					
				if($aux != utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) )))
				{
					$cont = 0;
					$aux = utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ));
				}
					
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["DATA"] 			= utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ));
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["HRINICIO"] 		= substr($row["horainicio"],0,5);
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["HRFIM"] 			= substr($row["horafim"],0,5);
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["DESCRICAO"]		= utf8_encode($row["evento"]);
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["LOCAL"]			= utf8_encode($row["local"]);
				$arRet['EVENTO'][0][utf8_encode(ucwords(strftime("%d/%m - %A", strtotime($auxData[2]."-".$auxData[1]."-".$auxData[0])) ))][$cont]["OBS"]				= utf8_encode($row["obs"]);
					
				$cont++;

			}

		}else{
			$arRet['EVENTO'][0]["VAZIO"] = utf8_encode("Não foram localizados eventos para o mês.");
		}
		
		//print_r($arRet);		
		echo json_encode($arRet);
		
		die();
		
	}
	

	//Por enquanto está recebendo o ID da matrícula, pode ser alterado para o id do aluno.
	if($_GET[action] == "GetFaltas" && is_numeric(_Decrypt($_GET[id])) )
	{


		include("../model/GradAlu.class.php");
		
		$gradAlu = new GradAlu($dbOracle);
		
		$sql = "SELECT gradalu.id, currxdisc_gsRetCodDisc(gradalu.currxdisc_id) as disc, currxdisc_gnChLimite(gradalu.currxdisc_id, GradAlu_gnRetPLetivo(GradAlu.Id) , GradAlu.Id )   as ChLimite FROM gradalu WHERE gradalu.matric_id in ( select id from matric start with matric.id = nvl( '"._Decrypt($_GET[id])."' ,0) connect by matric.matric_pai_id = prior matric.id )";
		
		$dbData->Get($sql);
		
		
		while($row = $dbData->Row() )
		{
			$cont2 = 0;
			$aFaltas = $gradAlu->GetFaltas($row[ID]);
			
			
			$vChave = $row[DISC] . ' ' . $aFaltas[Qtd].'/'.$row[CHLIMITE];
			
			if(is_array($aFaltas['Desc']))
			{
				foreach ($aFaltas['Desc'] as $key => $aArr)
				{
							
					$vAbono = '';
					if ($aArr[ABONO])
						$vAbono = ' (Abono)';
							
					$aReturn[$vChave][$cont2][quantidade] 	= $aArr[QTDFALTAS];
					$aReturn[$vChave][$cont2][data] 		= $key . $vAbono;
					
					$cont2++;
				}
				
				
			}
			else 
			{
					$aReturn[$vChave][$cont2][quantidade] 	= 0;
					$aReturn[$vChave][$cont2][data] 		= "";
				
			}
	
		}
	
		echo json_encode(array("FALTAS"=>array($aReturn)));
	
		unset ($gradAlu);
	
		die();
	
	}
	
	//retorna o último aviso cadastrado
	if($_GET[action] == "GetAviso" ){
		
		include("../model/Aviso.class.php");		
		
		$row = $dbData->Row($dbData->Get('select * from Aviso WHERE trunc(sysdate) between dtinicio and dttermino order by id DESC'));

		$arRet["AVISO"][titulo] 	= utf8_encode($row[TITULO]);
		$arRet["AVISO"][mensagem] 	= utf8_encode($row[MENSAGEM]);
		
		echo json_encode($arRet);

		unset($dbData);
		unset($dbOracle);	

		die();		
	}
	
	//retorna às ocorrências do SAA de determinado aluno ID
	if($_GET[action] == "GetSaa" && is_numeric(_Decrypt($_GET[id]))){
		
		include("../model/WOcorr.class.php");
		include("../model/WOcorrFluxo.class.php");
		
		$wocorr = new WOcorr($dbOracle);
		$wocorrfluxo = new WOcorrFluxo($dbOracle);					
	    
	    $aOcorr = $wocorr->GetOcorrPessoa(_Decrypt($_GET[id]));

	    if(is_array($aOcorr))
	    {
	    	$cont = 0;

	    	foreach($aOcorr as $value)
	    	{
	    		$arRet['SAA'][$cont][utf8_encode("Número")] =  $value[NUM];
	    		$arRet['SAA'][$cont][utf8_encode("Data")] =  $value[SOLICITACAO];
	    		$arRet['SAA'][$cont][utf8_encode("Assunto")] =  utf8_encode($value[ASSUNTO]);
	    		$arRet['SAA'][$cont][utf8_encode("Situação")] =  $value[SITUACAO];
	    			
	    		$aFluxo = $wocorrfluxo->GetFluxoInternet($value[ID]);

	    		$cont2 = 0;
	    			
	    		if(is_array($aFluxo))
	    		{
	    			foreach ($aFluxo as $arvalue)
	    			{
	    				$arRet['SAA'][$cont]["Fluxo"][$cont2]["DataResposta"] =  utf8_encode($arvalue[DTHORA]);
	    				$arRet['SAA'][$cont]["Fluxo"][$cont2]["Resposta"] =  utf8_encode($arvalue[TEXTODIGITADO]);
	    				$arRet['SAA'][$cont]["Fluxo"][$cont2]["Deferido"] =  utf8_encode($arvalue[DEFERIDO]);

	    				$cont2++;
	    			}
	    		}
	    			
	    		$cont++;
	    	}

	    }else{
	    	$arRet['SAA'][0]["VAZIO"] =  utf8_encode("Não possui ocorrências registradas no S.A.A.");
	    }
		
		echo json_encode($arRet);
		
		unset($dbData);
		unset($dbOracle);
		unset($wocorr);
		unset($wocorrfluxo);
		
		die();	
	}
	
	//retorna os documentos pendentes de determinado aluno 
	if($_GET[action] == "GetDocPendente" && is_numeric(_Decrypt($_GET[id]))){
	     
	    include("../model/WPessoaDoc.class.php");

	    $wpessoadoc = new WPessoaDoc($dbOracle);
	     
	    $aDoc = $wpessoadoc->GetPessoaDocInternet(_Decrypt($_GET[id]));	         

	    if(is_array($aDoc))
	    {
	        $cont = 0;
	        foreach($aDoc as $value)
	        {
	            //$arRet['DOC'][$cont][utf8_encode("Id")] =  $value[ID];
	            $arRet['DOC'][$cont][utf8_encode("Documento")] =  utf8_encode($value[DOCUMENTO]);
	            $arRet['DOC'][$cont][utf8_encode("Motivo")] =  utf8_encode($value[MOTIVO]);
	            $arRet['DOC'][$cont][utf8_encode("Vias")] =  utf8_encode($value[VIAS]);
	            $arRet['DOC'][$cont][utf8_encode("Prazo de Entrega")] =  utf8_encode($value[DATAENTREGA]);
	            //$arRet['DOC'][$cont][utf8_encode("Local")] = utf8_encode($value[LOCAL]);

	            $cont++;
	        }
	    }else{
	    	
	    	$arRet['DOC'][0]["VAZIO"] =  utf8_encode("Não possui documentos pendentes.");
	    }
	    echo json_encode($arRet);

	    unset($dbData);
	    unset($dbOracle);
	    unset($wpessoadoc);

	    die();
	}	
	
	//refatoração da consulta ao banco de folhas, importante manter a consulta 
	//antiga "GetBancoFolha"
	//pois versões anterior do app ainda usam
	if($_GET[action] == "GetBancoFolha_2" && is_numeric(_Decrypt($_GET[id]))){
	
		include("../model/BancoFolha.class.php");
	
		$bfolha = new BancoFolha($dbOracle);
	
		$aFolha = $bfolha->GetBancoFolhaInternet(_Decrypt($_GET[id]));
	
		if(is_array($aFolha))
		{
			$cont = 0;
			foreach($aFolha as $value)
			{				
				$arRet['BANCOFOLHA'][$cont][utf8_encode("Papel")] =  utf8_encode($value[PAPEL]);
				$arRet['BANCOFOLHA'][$cont][utf8_encode("Impressas no Ano")] =  utf8_encode($value[IMPRESSA]);			
				$arRet['BANCOFOLHA'][$cont][utf8_encode("Faces A4 Descontadas")] =  utf8_encode($value[DESCONTOFA4]);
				$arRet['BANCOFOLHA'][$cont][utf8_encode("Armazenadas")] =  utf8_encode($value[ARMAZENADA]);
					
				$cont++;
			}
			
			$arRet['BANCOFOLHA'][$cont][utf8_encode("Papel")] =  utf8_encode("Total");
			$arRet['BANCOFOLHA'][$cont][utf8_encode("Faces A4 Limite no Ano")] =  utf8_encode($value[LIMITE]);
			$arRet['BANCOFOLHA'][$cont][utf8_encode("Faces A4 Impressas no Ano")] =  utf8_encode($value[IMPRESSATOTAL]);
			
		}else{
			
			$arRet['BANCOFOLHA'][0]["VAZIO"] =  utf8_encode("Opção exclusiva para alunos que fazem uso do Banco de Folhas.");
		}
		echo json_encode($arRet);
	
		unset($dbData);
		unset($dbOracle);
		unset($bfolha);
	
		die();
	}
	
?>