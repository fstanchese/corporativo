<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	set_time_limit(5000);
	 
	$user = new User ();
	$app = new App("Relaчуo de Cartas do Lote","Relaчуo de Cartas do Lote",array('ADM','CPD','CARTACOBRANCA'),$user);
	 
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	 
	include("../engine/Ajax.class.php");
	 
	//include("../model/CAEvento.class.php");
	include("../model/CCobDebito.class.php");
		
	 
	$dbOracle    = new Db ($user);
	$dbData      = new DbData($dbOracle);
	//$dbDataAux   = new DbData($dbOracle);
	
	//$caEv        = new CAEvento($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
		
	 
	if ($_GET["p_CCobProc_Id"] != '')
		$_POST[p_Lote] = _Decrypt($_GET["p_CCobProc_Id"]) - 207900000000000;
	

	if($_POST["consultar"] == "" && $_GET["p_CCobProc_Id"] == '')
	{
		 
		$nav         = new Navigation($user, $app,$dbData);
		//$ajax             = new Ajax();
		 
		$view = new ViewPage($app->title,$app->description);
		 
		$view->Header($user,$nav);
		 
		$form = new Form();
		 
		$form->Fieldset();
		 
		$form->Input('Lote','text',array("name"=>'p_Lote'));
		 
		$form->CloseFieldset ();
	
		$form->Fieldset();
		 
		$form->Button("submit",array("name"=>"consultar","value"=>"Gerar"));
		 
		 
		$form->CloseFieldset ();
	
		unset ($form);
		 
		 
		unset($view);
		unset($nav);
	}
	else
	{
		 

			include("../engine/ReportPDF.class.php");
	
	
			
			$pLoteId 		= 207900000000000 + $_POST[p_Lote];
			$vDescricao 	= 'Cartas do Lote ' . $_POST[p_Lote];
	
	
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
			
			$arH[0]['TEXT'] = "Nome";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[1]['TEXT'] = "RA";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[2]['TEXT'] = "ID Carta";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = "Sit. Carta";
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[4]['TEXT'] = "Debitos";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[5]['TEXT'] = "Dt. Vencto.";
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			
			$viewReport->GridHeader($arH,array(50,20,15,15,80,20));
			
	
	
			$dbData->Get("SELECT wpessoa.nome, wpessoa.codigo, (ccobcarta.id-208600000000000) as idcarta, state.nome as situacao, ccobcarta.dtvencto, ccobcarta.id as id
							FROM ccobcarta, wpessoa, state
					WHERE ccobcarta.wpessoa_id = wpessoa.id and state.id = ccobcarta.state_id AND ccobcarta.ccobcrit_id IN ( SELECT id FROM ccobcrit WHERE ccobproc_id = '".$pLoteId."' ) ORDER BY nome");
	
			$cont = 0;
			while($lista = $dbData->Row())
			{
				$arBoletos 	= $ccobDebito->GetBoletoReferencia($lista["ID"]);

				if (!is_array($arBoletos))
				{
					$vRef = 'Nуo Localizei Dщbitos';
				}
				else
				{
					$vRef = implode(", ",$arBoletos[REFERENCIA]);
				}
								
				$arQtdState[$lista["SITUACAO"]]++;
				$cont++;
			 
				$viewReport->GridContent(array("TEXT"=>_ShortName($lista["NOME"],40)));
				$viewReport->GridContent(array("TEXT"=>$lista["CODIGO"]));
				$viewReport->GridContent(array("TEXT"=>$lista["IDCARTA"]));
				$viewReport->GridContent(array("TEXT"=>$lista["SITUACAO"]));
				$viewReport->GridContent(array("TEXT"=>$vRef));				
				$viewReport->GridContent(array("TEXT"=>$lista["DTVENCTO"]));
				
	
			}
			
			$viewReport->CloseTable().$viewReport->Br();
			
			$arH[0]['TEXT'] = utf8_encode("Situaчуo");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
			$arH[1]['TEXT'] = "Quantidade";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
			$viewReport->GridHeader($arH,array(80,40));
			
			foreach($arQtdState as $key => $value)
			{
				
				$viewReport->GridContent(array("TEXT"=>$key));
				$viewReport->GridContent(array("TEXT"=>$value));
				
			}
			
			$viewReport->GridContent(array("TEXT"=>"TOTAL"));
			$viewReport->GridContent(array("TEXT"=>$cont));
			
			
			
	}	
		 
	
	 
	unset($dbDataAux);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);

	
?>