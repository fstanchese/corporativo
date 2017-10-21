<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaчуo de Respostas Padrуo por Assunto e Departamento","Relaчуo de Respostas Padrуo por Assunto e Departamento",array('ADM','SAA_ANALISTA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/WOcorrAss.class.php");
	include("../model/WOcorrAssReP.class.php");	
	include("../model/Depart.class.php");
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);
	
	$wocorrAss		= new WOcorrAss($dbOracle);
	$wocorrAssReP	= new WOcorrAssReP($dbOracle);
	$depart			= new Depart($dbOracle);
		
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();

			$form->Input('Assunto', 'select', array("name"=>'p_WOcorrAss_Id', "option"=>$wocorrAss->Calculate("Geral",$dbData)));
			$form->Input('Departamento', 'select', array("name"=>'p_Depart_Id', "option"=>$depart->Calculate("Geral",$dbData)));
			
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
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
			
			if (empty($_POST["p_WOcorrAss_Id"]))
			{
				$vDescricao = 'Assunto: Todos';
			}
			else 
			{
				$aWOA = $wocorrAss->GetIdInfo($_POST["p_WOcorrAss_Id"]);
				$vDescricao = 'Assunto: ' . $aWOA["NOMENET"]; 
			}
			
			if (!empty($_POST["p_Depart_Id"]))
			{
				$aDep = $depart->GetIdInfo($_POST["p_Depart_Id"]);
				$vDescricao .= ' (' . $aDep["NOMEREDUZ"] . ')';
			}
			
			$dbData->Get($wocorrAssReP->query('qAssunto',array('p_Depart_Id' => $_POST["p_Depart_Id"], 'p_WOcorrAss_Id' => $_POST["p_WOcorrAss_Id"] )));

			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
							
			$arH[0]['TEXT'] = utf8_encode("Assunto");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = utf8_encode("Departamento");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Referъncia");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = utf8_encode("Descriчуo");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$viewReport->GridHeader($arH,array(50,45,50,145));
				
			$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
			while ($rep = $dbData->Row())
			{

				if ($vCor == array(255,255,255))
					$vCor = array(233,240,240);
				else 
					$vCor = array(255,255,255);


				$viewReport->GridContent(array("TEXT"=>$rep["WOCORRASS_RECOGNIZE"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["DEPART_RECOGNIZE"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["REFERENCIA"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["DESCRICAO"],"BACKGROUND_COLOR"=>$vCor));
				
			}
			
			
		}

		
		//Gerar em Excell
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Assunto","Departamento","Referъncia","Descriчуo"));
			
			$dbData->Get($wocorrAssReP->query('qAssunto',array('p_Depart_Id' => $_POST["p_Depart_Id"], 'p_WOcorrAss_Id' => $_POST["p_WOcorrAss_Id"] )));
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{

				$excel->Content($rep["WOCORRASS_RECOGNIZE"],array("class"=>"TEXTO"));
				$excel->Content($rep["DEPART_RECOGNIZE"],array("class"=>"TEXTO"));
				$excel->Content($rep["REFERENCIA"],array("class"=>"TEXTO"));
				$excel->Content($rep["DESCRICAO"],array("class"=>"TEXTO"));
					
			}
			
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