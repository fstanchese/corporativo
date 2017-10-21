<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relatórios de Indivíduos a Incluir no SPC","Relatórios de Indivíduos a Incluir no SPC",array('ADM','CPD','CARTACOBRANCA'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/CCobCarta.class.php");
	include("../model/WPessoa.class.php");
	include("../model/CCobDebito.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$wpessoa 	= new WPessoa($dbOracle);
	$ccobCarta	= new CCobCarta($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
	
	
		

	if ($_GET["p_CCobProc_Id"] == '')	
		die();
	
	$sql = "SELECT 
				ccobcarta.*
			FROM ccobcarta
			WHERE	CCobCarta.CCobCrit_Id IN ( SELECT id FROM ccobcrit WHERE state_id = 3000000047003 and dtavisorec is not null and ccobproc_id = '" . _Decrypt($_GET["p_CCobProc_Id"])."' ) 
			order by WPessoa_gsRecognize(WPessoa_Id)";
	
	
	$dbData->Get($sql);
	
	
	include("../engine/ReportPDF.class.php");
	
	$vDescricao = 'Lote número '.(_Decrypt($_GET["p_CCobProc_Id"])-207900000000000); 
	

	$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
					
	$arH[0]['TEXT'] = "Vencto\nNP";
	$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

	$arH[1]['TEXT'] = utf8_encode("RA\nTurma");
	$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

	$arH[2]['TEXT'] = utf8_encode("Contratante\nConfessor\Aluno");
	$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$arH[3]['TEXT'] = utf8_encode("Telefone");
	$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
	$arH[4]['TEXT'] = "RG\nCPF";
	$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

	$arH[5]['TEXT'] = utf8_encode("Dt.Nascto\nDívida");
	$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$arH[6]['TEXT'] = "AR\n1o. Vencto";
	$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$arH[7]['TEXT'] = "Contrato";
	$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$arH[8]['TEXT'] = "Nota Ok";
	$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$arH[9]['TEXT'] = utf8_encode("Débitos");
	$arH[9]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
	$viewReport->GridHeader($arH,array(20,20,50,25,25,20,20,20,20,70));

	
	$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
	while ($rep = $dbData->Row())
	{
		
		if ($vCor == array(255,255,255))
			$vCor = array(233,240,240);
		else 
			$vCor = array(255,255,255);

		$aDebitos = $ccobDebito->GetBoletoReferencia($rep[ID]);
		
		
		
		$aPessoa = $wpessoa->GetIdInfo($rep["WPESSOA_ID"]);
				
		$viewReport->GridContent(array("TEXT"=>$rep["DTVENCTO"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["CODIGO"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["NOME"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["FONERES"],"BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["RGRNE"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["DTNASCTO"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$rep["DTAVISOREC"],"BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>implode("; ",$aDebitos[REFERENCIA]),"TEXT_ALIGN"=>"L","TEXT_SIZE"=>"6","BACKGROUND_COLOR"=>$vCor));
				
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$aPessoa["FONECOM"],"BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>_FormataCPF($aPessoa["CPF"]),"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$ccobDebito->GetValorAtual($rep[ID]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>$ccobDebito->GetMenorVencto($rep[ID]),"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","BACKGROUND_COLOR"=>$vCor));
		$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
		
		$vIP = $aPosto["IP"];
		
			
	}
/*
	$viewReport->GridContent(array("TEXT"=>"Sub-Total","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
	$viewReport->GridContent(array("TEXT"=>_FormatValor($aSub["Cartão Débito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
	
	$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
	$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
	$viewReport->GridContent(array("TEXT"=>_FormatValor($aSub["Cartão Débito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
	
*/
		
		
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>