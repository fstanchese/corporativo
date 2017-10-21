<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Impressão de Carta de Cobrança","Impressão de Carta de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../model/WPessoa.class.php");
	include("../model/CCobDebito.class.php");
	include("../model/CCobCarta.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$view 		= new View();
	
	$wpessoa 	= new WPessoa($dbOracle);
	$cCobDebito	= new CCobDebito($dbOracle);
	$ccobCarta = new CCobCarta($dbOracle);
	
	
	if ($_GET["p_CCobCarta_Id"] != '')  $sqlPiece = " AND CCobCarta.Id = " . _Decrypt($_GET["p_CCobCarta_Id"]);
	if ($_GET["p_CCobCrit_Id"] != '')	$sqlPiece = " AND CCobCarta.CCobCrit_Id = " . _Decrypt($_GET["p_CCobCrit_Id"]);
	if ($_GET["p_CCobProc_Id"] != '')	$sqlPiece = " AND CCobCarta.CCobCrit_Id IN ( SELECT id FROM ccobcrit WHERE ccobproc_id = '" . _Decrypt($_GET["p_CCobProc_Id"])."' )";
	
	
	if ($sqlPiece == '')	die();
	
	//Impressão das Cartas dos Alunos/Responsáveis de Dívidas de Mensalidades ou Confessores de Dívidas de Parcelamento
	$sql = "SELECT 
				ccobcarta.id,
				ccobcarta.dtemissao,
				ccobcarta.wpessoa_id,
				wpessoa.nome, wpessoa.codigo,
				ccobcarta.dtvencto,
				ccobcartati.layout,
				ccobcartati.id as cartati_id,
				ccobcarta.parcel_id,
				ccobcarta.state_id			
			FROM ccobcarta, ccobcrit, ccobcartati, wpessoa,lograd
			WHERE ccobcarta.ccobcrit_id = ccobcrit.id
			AND ccobcrit.ccobcartati_id = ccobcartati.id
			AND wpessoa.lograd_id = lograd.id 
			AND wpessoa.id = ccobcarta.wpessoa_id	
			AND ccobcarta.state_id = 3000000047001		
			$sqlPiece order by lograd.CEP";
	
	$dbData->Get($sql);
	
	
	while($row = $dbData->Row())
	{
		
		if($_GET["2via"] == "")
		{
			
			if ($row[STATE_ID] == 3000000047001)
			{
				$arUpd["p_O_Option"] 		= "update";
				$arUpd["p_DtEmissao"] 		= date('d/m/Y');
				$arUpd["p_CCobCarta_Id"] 	= $row[ID];
				$arUpd["p_State_Id"] 		= 3000000047002;
				
				$ccobCarta->IUD($arUpd,FALSE);				
			}			
		}
		
		$p_WPessoa_Nome 		= $row[NOME];
		$p_WPessoa_Avalista_Id 	= "";
		$p_WPessoa_Resp_Id		= $row[WPESSOA_ID];
		
		if($row[CARTATI_ID] == 207900000000002 && $row[PARCEL_ID] != "")
		{
			$dbData2 		= new DbData($dbOracle);
			$parcelData 	= $dbData2->Row($dbData2->Get("SELECT wpessoa_confessor_id, wpessoa_avalista_id, wpessoa.nome as pessoa FROM parcel, wpessoa WHERE wpessoa.id = parcel.wpessoa_confessor_id AND parcel.id = '".$row[PARCEL_ID]."'"));
			
			$p_WPessoa_Nome 		= $parcelData[PESSOA];
			$p_WPessoa_Avalista_Id 	= $parcelData[WPESSOA_AVALISTA_ID];
			$p_WPessoa_Resp_Id		= $parcelData[WPESSOA_CONFESSOR_ID];
			
			unset($dbData2);
		}
		
				
		$boletoRef = $cCobDebito->GetBoletoReferencia($row[ID]);
		
		$layout = $row[LAYOUT]->load();
		$layout = str_replace("#DATAEXTENSO",_DataAtualExtenso($row[DTEMISSAO]),$layout);
		$layout = str_replace("#ALUNO",$p_WPessoa_Nome,$layout);
		$layout = str_replace("#DTVENCTO",$row[DTVENCTO],$layout);
		$layout = str_replace("#REFERENCIA",implode(", ",$boletoRef[REFERENCIA]),$layout);
		
		
		echo $view->Div(array("style"=>"width:700px;font-family:verdana;font-size:16px;margin-top:5px;padding: 60px;margin-left:135px;"))
			.($row[ID]-208600000000000)." / ".$row[CODIGO].$view->Br()
			.$wpessoa->GetEndereco($p_WPessoa_Resp_Id)
			.$view->CloseDiv() . $view->Br().$view->Br();		
		echo $view->Div(array("style"=>"width:420px;" )) . "- -" . $view->CloseDiv();
		echo $view->Div(array("style"=>"width:850px;font-family:verdana;font-size:16px;margin:135px 5px 0 25px;padding: 10px")).nl2br($layout).$view->CloseDiv().$view->P("",array("style"=>"page-break-before:always"));
		
		
	}

	//Impressão das Cartas dos Avalistas após a impressão das cartas dos confessores.
	$sql = "SELECT 
				ccobcarta.id,
				ccobcarta.dtemissao,
				ccobcarta.wpessoa_id,
				wpessoa.nome, wpessoa.codigo,
				ccobcarta.dtvencto,
				ccobcartati.layout,
				ccobcartati.id as cartati_id,
				ccobcarta.parcel_id,
        		parcel.WPessoa_Avalista_Id,
        		lograd.CEP
			FROM ccobcarta, ccobcrit, ccobcartati, wpessoa, lograd, parcel, wpessoa PessoaAvalista
			WHERE ccobcarta.ccobcrit_id = ccobcrit.id
      			AND PessoaAvalista.lograd_id = lograd.id
      			AND PessoaAvalista.Id (+) = Parcel.WPessoa_Avalista_Id      
      			AND parcel.id = ccobcarta.parcel_id
				AND ccobcrit.ccobcartati_id = ccobcartati.id
				AND wpessoa.id = ccobcarta.wpessoa_id
				AND ccobcarta.state_id = 3000000047001
				$sqlPiece order by lograd.CEP";
	
	$dbData->Get($sql);
	
	
	while($row = $dbData->Row())
	{
		
		$p_WPessoa_Nome 		= $row[NOME];
		$p_WPessoa_Avalista_Id 	= "";
		
		if($row[CARTATI_ID] == 207900000000002 && $row[PARCEL_ID] != "")
		{
			$dbData2 		= new DbData($dbOracle);
			$parcelData 	= $dbData2->Row($dbData2->Get("SELECT wpessoa_confessor_id, wpessoa_avalista_id, wpessoa.nome as pessoa FROM parcel, wpessoa WHERE wpessoa.id = parcel.wpessoa_confessor_id AND parcel.id = '".$row[PARCEL_ID]."'"));
				
			$p_WPessoa_Nome 		= $parcelData[PESSOA];
			$p_WPessoa_Avalista_Id 	= $parcelData[WPESSOA_AVALISTA_ID];
				
			unset($dbData2);

			if($p_WPessoa_Avalista_Id != "")
			{
			
				$dbData2 		= new DbData($dbOracle);
				$layoutCartaAvalista = $dbData2->Row($dbData2->Get("SELECT layout FROM ccobcartati WHERE id = 207900000000003"));
			
			
				$layout = $layoutCartaAvalista[LAYOUT]->load();
				$layout = str_replace("#DATAEXTENSO",_DataAtualExtenso($row[DTEMISSAO]),$layout);
				$layout = str_replace("#CONFESSOR",$p_WPessoa_Nome,$layout);
			
			
				echo $view->Div(array("style"=>"width:700px;font-family:verdana;font-size:16px;margin-top:5px;padding: 60px;margin-left:135px;"))
				.($row[ID]-208600000000000)." / ".$row[CODIGO].$view->Br()
				.$wpessoa->GetEndereco($p_WPessoa_Avalista_Id)
				.$view->CloseDiv(). $view->Br().$view->Br();
				echo $view->Div(array("style"=>"width:420px;" )) . "- -" . $view->CloseDiv();
				echo $view->Div(array("style"=>"width:850px;font-family:verdana;font-size:16px;margin:135px 5px 0 25px;padding: 10px")).nl2br($layout).$view->CloseDiv().$view->P("",array("style"=>"page-break-before:always"));
			
			
			
				unset($dbData2);
			
			
			}
				
		}
		
		
	}
	
	$dbData->Commit();
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	