<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Recebimento das Máquinas de Cartão de Crédito e Débito","Recebimento das Máquinas de Cartão de Crédito e Débito",array('ADM','CPD','CONTABILIDADE'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/PostoBanc.class.php");
	include("../model/Boleto.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$postoBanc	= new PostoBanc($dbOracle);
	$boleto 	= new Boleto($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->LabelMultipleInput("Data");
			$form->MultipleInput("","date",array("name"=>"p_Data1"));
			$form->MultipleInput("a","date",array("name"=>"p_Data2"));
		
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em PDF"));
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em Excel"));
							
		$form->CloseFieldset ();	
			
		unset ($form);
		
		
		unset($view);	
		unset($nav);	
	}	
	else 
	{
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');

		$sql = "SELECT id,ip,dt
				FROM
					PostoBanc					
				WHERE
					trunc(PostoBanc.dt) between '".$_POST[p_Data1]."' and '".$_POST[p_Data2]."' 
				ORDER BY
					IP,Id
				";
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
			
			$vDescricao = 'Período de ' . $_POST[p_Data1] . ' a ' . $_POST[p_Data2]; 
			
			$dbData->Get($sql);

			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
							
			$arH[0]['TEXT'] = "Data";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = utf8_encode("Número");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Transação");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = utf8_encode("Cartão");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[4]['TEXT'] = "Valor";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$viewReport->GridHeader($arH,array(20,25,60,40,30));
				
			$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
			while ($rep = $dbData->Row())
			{
				
				$aPosto = $postoBanc->GetValores($rep[ID]);
				
				$aTPTrans = $aPosto["TPTRANS"];
				if ($aPosto["QTDEPARC"] > 1)
					$aTPTrans .= ' ('.$aPosto["QTDEPARC"].' vezes)';
					
				if ($aPosto["VALOR"] > 0)
				{
					if ($vCor == array(255,255,255))
						$vCor = array(233,240,240);
					else 
						$vCor = array(255,255,255);
				}			

				if ($vIP != $aPosto["IP"] && !empty($vIP) )
				{
					$viewReport->GridContent(array("TEXT"=>"Sub-Total","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Débito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
						
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Débito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
						
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Crédito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
				
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Crédito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
						
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
					$viewReport->GridContent(array("TEXT"=>"Boletos","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotalBol["Boleto"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));

					$viewReport->GridContent(array("TEXT"=>"&nbsp;"));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));					
					$aSubBol 	= array();
					$aSub		= array();
				}
				
				$aTotal[$aPosto["TPTRANS"]][$aBoleto["CAMPUS_NOME"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aTotalBol[$aPosto["TPTRANS"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aSub[$aPosto["TPTRANS"]][$aBoleto["CAMPUS_NOME"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aSubBol[$aPosto["TPTRANS"]] += str_replace(',','.',$aPosto["VALOR"]);
				
				if ($aPosto["BOLETO_ID"] != '')
				{
					$aBoleto = $boleto->GetIdInfo($aPosto["BOLETO_ID"]);
				}
				
				
				$viewReport->GridContent(array("TEXT"=>$rep["DT"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$aPosto["NUMTRANSACAO"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$aTPTrans,"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$aPosto["NUMDOC"],"BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$aPosto["VALOR"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				
				$vIP = $aPosto["IP"];
				
				unset($aPosto);
					
			}

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
			
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aSub["Cartão Crédito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aSub["Cartão Crédito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Boletos","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aSubBol["Boleto"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			
			$viewReport->GridContent(array("TEXT"=>"&nbsp;"));
			$viewReport->GridContent(array("TEXT"=>""));
			$viewReport->GridContent(array("TEXT"=>""));
			$viewReport->GridContent(array("TEXT"=>""));
			$viewReport->GridContent(array("TEXT"=>""));
				
			$viewReport->GridContent(array("TEXT"=>"Total","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Débito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));

			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Débito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Débito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
				
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Butantã","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Crédito"]["Butantã"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Cartão Crédito","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Mooca","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotal["Cartão Crédito"]["Mooca"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
				
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
			$viewReport->GridContent(array("TEXT"=>"Boletos","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>_FormatValor($aTotalBol["Boleto"]),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240),"TEXT_TYPE"=>"B"));
			
			
		}

		
		//Gerar em Excell
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Data","Número","Transação","Cartão","Valor"));
			
			$dbData->Get($sql);
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				$aPosto = $postoBanc->GetValores($rep[ID]);
				
				$aTPTrans = $aPosto["TPTRANS"];
				if ($aPosto["QTDEPARC"] > 1)
					$aTPTrans .= ' ('.$aPosto["QTDEPARC"].' vezes)';

				
				if ($vIP != $aPosto["IP"] && !empty($vIP) )
				{
					$excel->Content("Sub-Total",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
					$excel->Content("Butantã",array("class"=>"DETAIL"));
					$excel->Content(_FormatValor($aSub["Cartão Débito"]["Butantã"]),array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
					$excel->Content("Mooca",array("class"=>"DETAIL"));
					$excel->Content(_FormatValor($aSub["Cartão Débito"]["Mooca"]),array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
					$excel->Content("Butantã",array("class"=>"DETAIL"));
					$excel->Content(_FormatValor($aSub["Cartão Crédito"]["Butantã"]),array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
					$excel->Content("Mooca",array("class"=>"DETAIL"));
					$excel->Content(_FormatValor($aSub["Cartão Crédito"]["Mooca"]),array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("",array("class"=>"DETAIL"));
					$excel->Content("Boletos",array("class"=>"DETAIL"));
					$excel->Content(_FormatValor($aSubBol["Boleto"]),array("class"=>"DETAIL"));
						
					$excel->Content("");
					$excel->Content("");
					$excel->Content("");
					$excel->Content("");
					$excel->Content("");
					$aSub = array();
					$aSubBol = array();					
						
				}
				
				$excel->Content($rep["DT"]);
				$excel->Content($aPosto["NUMTRANSACAO"],array("class"=>'NUMERO'));
				$excel->Content($aTPTrans);
				$excel->Content($aPosto["NUMDOC"]);
				$excel->Content($aPosto["VALOR"]);

				$aTotal[$aPosto["TPTRANS"]][$aBoleto["CAMPUS_NOME"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aTotalBol[$aPosto["TPTRANS"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aSub[$aPosto["TPTRANS"]][$aBoleto["CAMPUS_NOME"]] += str_replace(',','.',$aPosto["VALOR"]);
				$aSubBol[$aPosto["TPTRANS"]] += str_replace(',','.',$aPosto["VALOR"]);
				$vIP = $aPosto["IP"];
				
				if ($aPosto["BOLETO_ID"] != '')
				{
					$aBoleto = $boleto->GetIdInfo($aPosto["BOLETO_ID"]);
				}
				
			
			}
			
			$excel->Content("Sub-Total",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
			$excel->Content("Butantã",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aSub["Cartão Débito"]["Butantã"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
			$excel->Content("Mooca",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aSub["Cartão Débito"]["Mooca"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
			$excel->Content("Butantã",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aSub["Cartão Crédito"]["Butantã"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
			$excel->Content("Mooca",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aSub["Cartão Crédito"]["Mooca"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Boletos",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aSubBol["Boleto"]),array("class"=>"DETAIL"));
			
			$excel->Content("");
			$excel->Content("");
			$excel->Content("");
			$excel->Content("");
			$excel->Content("");
			
			$excel->Content("Total",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
			$excel->Content("Butantã",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aTotal["Cartão Débito"]["Butantã"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Débito",array("class"=>"DETAIL"));
			$excel->Content("Mooca",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aTotal["Cartão Débito"]["Mooca"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
			$excel->Content("Butantã",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aTotal["Cartão Crédito"]["Butantã"]),array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Cartão Crédito",array("class"=>"DETAIL"));
			$excel->Content("Mooca",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aTotal["Cartão Crédito"]["Mooca"]),array("class"=>"DETAIL"));		
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("",array("class"=>"DETAIL"));
			$excel->Content("Boletos",array("class"=>"DETAIL"));
			$excel->Content(_FormatValor($aTotalBol["Boleto"]),array("class"=>"DETAIL"));
			
			$excel->EndTable();
			
			unset($excel);
			
			
		}
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>