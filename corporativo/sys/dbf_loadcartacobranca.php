<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user	= new User();
	$app	= new App("Carregar Conteúdo da Carta de Cobrança", "Carregar Conteúdo da Carta de Cobrança", array("ADM", "CPD"), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Dbf.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

		
	$view	= new ViewPage($app->title, $app->description);

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
		
	$view->Explain ("Ajuda");	
	$view->Header($user, $nav);
	
	$form = new Form();
	$form->Fieldset();
	
	$form->Input("Nome do arquivo DBF", "text", array("name"=>"p_DBFName"));
	$form->Button("submit", array("value"=>"Enviar"));
	
	$form->CloseFieldset();
	
	unset($form);

	if ($_POST[p_DBFName] != "")
	{
		/*
		$arSit["SR"] = "3000000002002";
		$arSit["MT"] = "3000000002005";
		$arSit["DE"] = "3000000002004";
		$arSit["NR"] = "3000000002000";
		$arSit["FR"] = "3000000002012";
		$arSit["TR"] = "3000000002005";
		$arSit["CA"] = "3000000002013";
		$arSit["SM"] = "3000000002000";
		
		$arSitCarta[1] = '3000000047002';
		$arSitCarta[2] = '3000000047003';
		$arSitCarta[3] = '3000000047004';
		$arSitCarta[4] = '3000000047004';
		$arSitCarta[6] = '3000000047004';
		$arSitCarta[5] = '3000000047005';
		
				
		
		$dbf = new Dbf('BASES/COBRANCA/oracle/PROCESS.DBF');	
			
		
		$info = $dbf->GetHeaderInfo();	
		
		while ($row = $dbf->Row())			
		{
			//cartas nao canceladas 
			if(trim($row[6]) == "")
			{
				//parcelamento
				if(strpos($row[8],'5') !== FALSE)
				{
					$dtInicio 	= substr(trim($row[18]),6,2)."/".substr(trim($row[18]),4,2)."/".substr(trim($row[18]),0,4);
					$dtFim 		= substr(trim($row[19]),6,2)."/".substr(trim($row[19]),4,2)."/".substr(trim($row[19]),0,4);
					$idCartatTi = 207900000000002;
					$qtdeBol 	= 1;
				}	
				//mensalidade
				else
				{
					if(substr(trim($row[16]),2,2) > 10) $anoIni = "19".substr(trim($row[16]),2,2); else $anoIni = "20".substr(trim($row[16]),2,2);
					if(substr(trim($row[17]),2,2) > 10) $anoFim = "19".substr(trim($row[17]),2,2); else $anoFim = "20".substr(trim($row[17]),2,2);
					
					
					$ultDiaIni = date("t", strtotime($anoIni."-".substr(trim($row[16]),0,2)."-01"));
					$ultDiaFim = date("t", strtotime($anoIni."-".substr(trim($row[17]),0,2)."-01"));
					
					$dtInicio 	= "01/".substr(trim($row[16]),0,2)."/".$anoIni;
					$dtFim 		= $ultDiaFim."/".substr(trim($row[17]),0,2)."/".$anoFim;
						
					$idCartatTi = 207900000000001;
					
					$qtdeBol 	= substr(trim($row[8]),0,1);
					if($qtdeBol > 3) $qtdeBol = 1;
					
				}

				
				$sql = "INSERT INTO ccobproc (dtinicio,dttermino) VALUES ('".$dtInicio."','".$dtFim."')";
				$dbData->Set($sql);
				
				
				//inserir no criterio
				
				
				if(trim($row[26]) == "0")
					$ignConsq = 'off';
				else
					$ignConsq = 'on';
				
				$ccobProcId = $dbData->GetInsertedId("ccobproc_id");
				
				$asitAcad = explode("-",trim($row[9]));
				
				foreach($asitAcad as $sitacad)
				{
					if($sitacad != "")
					{
						$sql = "INSERT INTO ccobcrit 
								(ccobproc_id,ccobcartati_id,state_matric_id,qtde,dtvencto,scpc) 
								VALUES 
								('".$ccobProcId."','".$idCartatTi."','".$arSit[$sitacad]."','".$qtdeBol."',sysdate,'".$ignConsq."')";
						$dbData->Set($sql);
						
						$arCri[trim($row[0])]	 = $dbData->GetInsertedId("ccobcrit_id");
						$arProc[trim($row[0])] 	= $ccobProcId;
						
					}
				}
							
				
			
				
			}
			
			
		}
		
		unset($dbf);
		
		
		
		//CARTA DE COBRANÇA
		
		$dbf = new Dbf("BASES/COBRANCA/oracle/CARTA.DBF");
		
		$info = $dbf->GetHeaderInfo();
		
		while ($row = $dbf->Row())
		{
		
			$ra = $dbData->Row($dbData->Get("SELECT id FROM wpessoa WHERE codigo = '".trim($row[4])."'"));
			if($ra[ID] == "")
			{
				$ra = $dbData->Row($dbData->Get("SELECT id_c as id FROM voliveira.tempaluno WHERE al_codigo = '".trim($row[4])."'"));
				
			}
			
			
			if(trim($row[5]) != "")
				$dtVencto 		= substr(trim($row[5]),6,2)."/".substr(trim($row[5]),4,2)."/".substr(trim($row[5]),0,4);
			else 
				$dtVencto = ""; 	
			
			if(trim($row[9]) != "")
				$dtEmissao 		= substr(trim($row[9]),6,2)."/".substr(trim($row[9]),4,2)."/".substr(trim($row[9]),0,4);
			else
			$dtEmissao 		= "";
			
			
			
			if(trim($row[11]) != "")
				$dtAviso 		= substr(trim($row[11]),6,2)."/".substr(trim($row[11]),4,2)."/".substr(trim($row[11]),0,4);
			else
				$dtAviso = "";

			if($ra[ID] == "")
			{
				
				$arErro[] = $arCri[trim($row[1])]." - ".trim($row[0])." - ".trim($row[4]);
				
			}
			else 
			{
				$sql = "INSERT INTO ccobcarta
								(id,ccobcrit_id,wpessoa_id,dtvencto,state_id,dtavisorec,dtemissao)
								VALUES
								(
								'".(208600000000000+trim($row[0]))."',
								'".$arCri[trim($row[1])]."',
								'".$ra[ID]."',
								'".$dtVencto."',
								'".$arSitCarta[trim($row[10])]."',
								'".$dtAviso."',
								'".$dtEmissao."')";
				//echo $sql."<br>";			
				$dbData->Set($sql);
			}
			if($dtVencto != "")
			{
				$dbData->Set("UPDATE ccobcrit SET dtvencto = '".$dtVencto."' WHERE ccobproc_id IN ( SELECT id FROM ccobproc WHERE id = '".$arProc[trim($row[1])]."' )");
				//echo "UPDATE ccobcrit SET dtvencto = '".$dtVencto."' WHERE ccobproc_id IN ( SELECT id FROM ccobproc WHERE id = '".$arProc[trim($row[1])]."' )<br>";
			}
			
			
			
		}
		
		$dbData->Commit();
		
		echo "<pre>";
		print_r($arErro);
		
		
		$dbData->Get("SELECT promess.data, carta_id  FROM voliveira.promess promess, voliveira.tempfollow tempfollow  WHERE tempfollow.idfollow = promess.id");
	
		$dbData2 = new DbData($dbOracle);
	while($row = $dbData->Row())
	{
		
		$sql = "INSERT INTO ccobfollow (ccobcarta_id, dtprevisao, texto) VALUES ('".(208600000000000+$row[CARTA_ID])."','".$row[DATA]."','Previsão de Pagamento para ".$row[DATA]."')";
		echo $sql."<br>";
		$dbData2->Set($sql);
		
	}
		
		$dbData->Commit();
		
		
		//Consequencia - SPC	
		$dbf = new Dbf("BASES/COBRANCA/oracle/CONSEQ.DBF"); 	
	
		$dbData2 = new DbData($dbOracle);
		
		while ($row = $dbf->Row())
		{
			if ($row[1] > 0)
			{
				$dtInc = ''; $dtExc = '';
				if ($row[4] > 0)
				{
					$dtInc 	= substr(trim($row[4]),6,2)."/".substr(trim($row[4]),4,2)."/".substr(trim($row[4]),0,4);
				}
				if ($row[5] > 0)
				{			
					$dtExc 	= substr(trim($row[5]),6,2)."/".substr(trim($row[5]),4,2)."/".substr(trim($row[5]),0,4);
				}
				$sql = "insert into ccobconseq (CCobCarta_Id,CCobConseqTi_Id,DtInclusao,DtExclusao) values ('".(208600000000000+$row[1])."','208300000000001','".$dtInc."','".$dtExc."')";
				$dbData2->Set($sql);
				echo $sql."<br>";
			}
			else
			{
				$arErro[] = $arCri[trim($row[0])]." - ".trim($row[0])." - ".trim($row[3]);
			}
		}
		
		echo "<pre>";
		print_r($arErro);
		
		
		$dbf = new Dbf("BASES/COBRANCA/oracle/DEBITOS.DBF");
		
		
		$dbData2 = new DbData($dbOracle);
		
		while ($row = $dbf->Row())
		{

			$aBoleto = $dbData->Row($dbData->Get("Select * from boleto where numdocantigo='".$row[1]."' OR numdoc='".$row[1]."'"));
			
			if ($aBoleto[ID] != '')
			{
				$aCarta = $dbData->Row($dbData->Get("select * from ccobcarta where Id='".(208600000000000+$row[0])."'"));
				if ($aCarta[WPESSOA_ID] == $aBoleto[WPESSOA_SACADO_ID])
				{
					$sql = "insert into CCobDebito (CCobcarta_Id, boleto_id) values ('".(208600000000000+$row[0])."','".$aBoleto[ID]."')";
					$dbData2->Set($sql);
						
				}

			}
		}
		$dbData->Commit();
*/		
		
		/*
		//atualizacao do matric_id na carta
		
		$dbData->Get("SELECT ccobproc.dtinicio, ccobcarta.id, ccobcarta.wpessoa_id FROM ccobcarta, ccobcrit, ccobproc WHERE ccobcarta.ccobcrit_id = ccobcrit.id AND ccobcrit.ccobproc_id = ccobproc.id");
	
		$dbData2 = new DbData($dbOracle);
		while($row = $dbData->Row())
		{
			$ano = end(explode("/",$row[DTINICIO]));
			$linha = $dbData2->Row($dbData2->Get("SELECT matric.id FROM matric, turmaofe, currofe WHERE matric.turmaofe_id = turmaofe.id and turmaofe.currofe_id = currofe.id AND matric.wpessoa_id = '".$row[WPESSOA_ID]."' AND currofe.pletivo_id IN ( SELECT id FROM pletivo WHERE nome like'".$ano."%')"));

			if($linha[ID] != "")
				
				$dbData2->Set("UPDATE ccobcarta SET matric_id = '".$linha[ID]."' WHERE id = '".$row[ID]."'");
			
			
		}
		
		
		$dbData->Commit();
		*/
		
		
		
		/*
		 //atualizacao do matric_id na carta para turmas especiais
		
		$dbData->Get("SELECT ccobproc.dtinicio, ccobcarta.id, ccobcarta.wpessoa_id FROM ccobcarta, ccobcrit, ccobproc WHERE ccobcarta.ccobcrit_id = ccobcrit.id AND ccobcrit.ccobproc_id = ccobproc.id AND matric_id is null");
		
		$dbData2 = new DbData($dbOracle);
		while($row = $dbData->Row())
		{
		$ano = end(explode("/",$row[DTINICIO]));
		$linha = $dbData2->Row($dbData2->Get("SELECT matric.id FROM matric, turmaofe, discesp WHERE matric.turmaofe_id = turmaofe.id and turmaofe.discesp_id = discesp.id AND matric.wpessoa_id = '".$row[WPESSOA_ID]."' AND discesp.pletivo_id IN ( SELECT id FROM pletivo WHERE nome like'".$ano."%')"));
		
		if($linha[ID] != "")
		
			$dbData2->Set("UPDATE ccobcarta SET matric_id = '".$linha[ID]."' WHERE id = '".$row[ID]."'");
			
			
		}
		
		
		$dbData->Commit();
		*/
		
		
		//atualizacao do matric_id na carta para turmas especiais
		
		$dbData->Get("SELECT ccobdebito.boleto_id ,  ccobcarta.id,  ccobcarta.wpessoa_id,  matric_origem_id,  parcel_origem_id FROM ccobcarta,  ccobcrit,  ccobdebito,  cnablog,  debcred WHERE ccobcarta.ccobcrit_id = ccobcrit.id AND ccobdebito.ccobcarta_id = ccobcarta.id and cnablog.boleto_dif_id   = ccobdebito.boleto_id and cnablog.boleto_id       = debcred.boleto_destino_id AND ccobcarta.matric_id    is null  ");
		$dbData2 = new DbData($dbOracle);
		while($row = $dbData->Row())
		{
			
		
			if($row[MATRIC_ORIGEM_ID] != "")
		
				$dbData2->Set("UPDATE ccobcarta SET matric_id = '".$row[MATRIC_ORIGEM_ID]."' WHERE id = '".$row[ID]."'");
			
			else
				
				$dbData2->Set("UPDATE ccobcarta SET parcel_id = '".$row[PARCEL_ORIGEM_ID]."' WHERE id = '".$row[ID]."'");
				
				
		}
		
		
		$dbData->Commit();
		
		
		
		/*
		$dbData->Get("SELECT ccobdebito.boleto_id , ccobcarta.id, ccobcarta.wpessoa_id, parcelxbol.parcel_id FROM ccobcarta, ccobcrit, ccobdebito, parcelxbol WHERE ccobcarta.ccobcrit_id = ccobcrit.id AND ccobdebito.ccobcarta_id = ccobcarta.id AND parcelxbol.boleto_dest_id = ccobdebito.boleto_id AND ccobcrit.ccobcartati_id = 207900000000002");
		$dbData2 = new DbData($dbOracle);
		while($row = $dbData->Row())
		{
			
		
			
		
				$dbData2->Set("UPDATE ccobcarta SET parcel_id = '".$row[PARCEL_ID]."' WHERE id = '".$row[ID]."'");
				
				
		}
		
		
		$dbData->Commit();
		*/
	}	

	
	unset($view);
	unset($app);
	unset($user);

?>