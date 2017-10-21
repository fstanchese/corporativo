<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relação de Inscritos - Bolsa Incentivo Acadêmico","Relação de Inscritos - Bolsa Incentivo Acadêmico",array('ADM','CPD','BOLSA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/BolsaSol.class.php");
	include("../model/PLetivo.class.php");
	include("../model/CESJProcSel.class.php");
	include("../model/WPleito.class.php");
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);
	

	$bolsaSol		= new BolsaSol($dbOracle);
	$cesjProcSel	= new CESJProcSel($dbOracle);
	$pLetivo		= new PLetivo($dbOracle);
	$wPleito		= new WPleito($dbOracle);
		
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->LabelMultipleInput("Data");
			$form->MultipleInput("","date",array("name"=>"p_Data1"));
			$form->MultipleInput("a","date",array("name"=>"p_Data2"));

			$form->Input('Período Letivo', 'select', array("name"=>'p_PLetivo_Id', "option"=>$pLetivo->Calculate("Geral",$dbData)));
			
			$form->Input('Processo Seletivo Bolsa', 'select', array("name"=>'p_CESJProcSel_Id', "option"=>array(""=>"Selecione o Período Letivo")));
				
			$ajax->InputRequired("p_PLetivo_Id","p_CESJProcSel_Id","change",$cesjProcSel->query["qPLetivo"],array("p_PLetivo_Id"=>"p_PLetivo_Id"));
			
			$form->Input('Processo Seletivo', 'select', array("name"=>'p_WPleito_Id', "option"=>array(""=>"Selecione o Período Letivo")));
			
			$ajax->InputRequired("p_PLetivo_Id","p_WPleito_Id","change",$wPleito->query["qPLetivo"],array("p_PLetivo_Id"=>"p_PLetivo_Id"));			
				
			
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

		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
			
			$vDescricao = 'Período de ' . $_POST[p_Data1] . ' a ' . $_POST[p_Data2]; 
			
			$dbData->Get($bolsaSol->query('qTodosIncentivo',array('p_O_Valor2' => 724, 'p_BolsaSol_CESJProcSel_Id' => $_POST["p_CESJProcSel_Id"], 'p_PLetivo_Id' => $_POST["p_PLetivo_Id"],'p_WPleito_Id' => $_POST["p_WPleito_Id"], 'p_Data1' => $_POST["p_Data1"], 'p_Data2' => $_POST["p_Data2"] )));

			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
							
			$arH[0]['TEXT'] = utf8_encode("Código");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = utf8_encode("Dt.Solicitação");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Nome");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = utf8_encode("Renda Total");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[4]['TEXT'] = "Grupo Familiar";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[5]['TEXT'] = "Renda PC";
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[6]['TEXT'] = utf8_encode("Situação");
			$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[7]['TEXT'] = "Unidade";
			$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[8]['TEXT'] = utf8_encode("Período");
			$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[9]['TEXT'] = utf8_encode("Curso");
			$arH[9]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[10]['TEXT'] = utf8_encode("Int.FIES?");
			$arH[10]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[11]['TEXT'] = utf8_encode("Matric.");
			$arH[11]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[12]['TEXT'] = utf8_encode("Bolsa");
			$arH[12]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$viewReport->GridHeader($arH,array(20,20,50,20,15,15,30,15,15,50,10,20,10));
				
			$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
			while ($rep = $dbData->Row())
			{

				if ($vCor == array(255,255,255))
					$vCor = array(233,240,240);
				else 
					$vCor = array(255,255,255);

				$vIntFIES = '-';
				if ($rep["FIESINT"] == 'on')
					$vIntFIES = 'S';
				if ($rep["FIESINT"] == 'off')
					$vIntFIES = 'N';

				if ($_POST["p_PLetivo_Id"] < 7200000000092 )
				{
					$vIntFIES = 'N';
					$dbDataAux->Get("select count(*) as Quantidade from bolsa where bolsati_id in (10600000000156,10600000000048,10600000000152,10600000000153,10600000000160) and wpessoa_id=". $rep["WPESSOA_ID"]);
					$sqlFIES = $dbDataAux->Row();
					if ($sqlFIES[QUANTIDADE] > 0)
						$vIntFIES = 'S';
				}
				
				$dbDataAux->Get("select count(*) as Qtde from matric where State_Id = 3000000002002 and WPessoa_Id =". $rep["WPESSOA_ID"]); 

				$sqlMatric = $dbDataAux->Row();
				
				$vMatric = 'Reservada';
				if ( $sqlMatric["QTDE"] > 0 )
				{
					$vMatric = 'Matriculado';
				}
				
				
			
				$viewReport->GridContent(array("TEXT"=>$rep["RA"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["DTSOLICITACAO"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["NOME"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["RENDATOTALFORMAT"],"BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["GRUPOFAMILIAR"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["VALORSM_PCFORMAT"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["SITUACAO"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>substr($rep["CAMPUS_RECOGNIZE"],0,1),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>substr($rep["PERIODO"],0,1),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				
				$viewReport->GridContent(array("TEXT"=>$rep["CURSO"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$vIntFIES,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$vMatric,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>_NVL($rep["PERCBOLSA"],'--'),"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
				
				$aTotal[$rep["CAMPUS_RECOGNIZE"]][$rep["CURSO"]][_NVL($rep["PERCBOLSA"],'Verificação')] += 1;  
				
				
			}
			
			
			
			$viewReport->CloseTable();
			$viewReport->NewPage();
				
			$arH[0]['TEXT'] = utf8_encode("Unidade");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[1]['TEXT'] = utf8_encode("Curso");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Percentual");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = utf8_encode("Quantidade");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			
			$viewReport->GridHeader($arH,array(20,150,20,20));
			ksort($aTotal);
			$qtde = 0;
			
			foreach ($aTotal as $key => $aCurso)
			{
				ksort($aCurso);
				foreach ($aCurso as $chave => $aTotalC)
				{
						
					ksort($aTotalC);
					foreach ($aTotalC as $item => $aPerc)
					{
						
						if ($chave != $vCurso)
						{
							if ($vCor == array(255,255,255))
								$vCor = array(233,240,240);
							else
								$vCor = array(255,255,255);
						}
						
						$viewReport->GridContent(array("TEXT"=>$key,"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
						$viewReport->GridContent(array("TEXT"=>$chave,"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
						$viewReport->GridContent(array("TEXT"=>$item,"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
						$viewReport->GridContent(array("TEXT"=>$aPerc,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
						
						$qtde += $aPerc;
						$qtdeG += $aPerc;
						
						$vCurso = $chave;
						
					}
					
				}	

				$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>"Sub-Total","TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor,"TEXT_TYPE"=>"B"));
				$viewReport->GridContent(array("TEXT"=>$qtde,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor,"TEXT_TYPE"=>"B"));
				$qtde = 0;
				
			}
			
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor));
			
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
			$viewReport->GridContent(array("TEXT"=>'',"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
			$viewReport->GridContent(array("TEXT"=>Total,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor,"TEXT_TYPE"=>"B"));
			$viewReport->GridContent(array("TEXT"=>$qtdeG,"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>$vCor,"TEXT_TYPE"=>"B"));
				
			
			//print_r($aTotal);

			
			
		}

		
		//Gerar em Excell
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Vest.","Código","Dt Solicitação","Nome","Renda Total","Grupo Familiar","Renda PC","Situação","Unidade","Período","Curso","Int.FIES?","Matric.","Bolsa"));
			
			$dbData->Get($bolsaSol->query('qTodosIncentivo',array('p_O_Valor2' => 724, 'p_BolsaSol_CESJProcSel_Id' => $_POST["p_CESJProcSel_Id"], 'p_PLetivo_Id' => $_POST["p_PLetivo_Id"],'p_WPleito_Id' => $_POST["p_WPleito_Id"], 'p_Data1' => $_POST["p_Data1"], 'p_Data2' => $_POST["p_Data2"] )));
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{

				$vIntFIES = '-';
				if ($rep["FIESINT"] == 'on')
					$vIntFIES = 'S';
				if ($rep["FIESINT"] == 'off')
					$vIntFIES = 'N';
				

				if ($_POST["p_PLetivo_Id"] < 7200000000092 )
				{
					$vIntFIES = 'N';
					$dbDataAux->Get("select count(*) as Quantidade from bolsa where bolsati_id in (10600000000156,10600000000048,10600000000152,10600000000153,10600000000160) and wpessoa_id=". $rep["WPESSOA_ID"]);
					$sqlFIES = $dbDataAux->Row();
					if ($sqlFIES[QUANTIDADE] > 0)
						$vIntFIES = 'S';
				}
				
				$dbDataAux->Get("select count(*) as Qtde from matric where State_Id = 3000000002002 and WPessoa_Id =". $rep["WPESSOA_ID"]);
				
				$sqlMatric = $dbDataAux->Row();
				
				$vMatric = 'Reservada';
				if ( $sqlMatric["QTDE"] > 0 )
				{
					$vMatric = 'Matriculado';
				}
				
				$excel->Content($rep["WPLEITO_RECOGNIZE"],array("class"=>"TEXTO"));
				$excel->Content($rep["RA"],array("class"=>"TEXTO"));
				$excel->Content($rep["DTSOLICITACAO"],array("class"=>"TEXTO"));
				$excel->Content($rep["NOME"],array("class"=>"TEXTO"));
				$excel->Content($rep["RENDATOTALFORMAT"],array("class"=>"TEXTO"));
				$excel->Content($rep["GRUPOFAMILIAR"],array("class"=>"TEXTO"));
				$excel->Content($rep["VALORSM_PCFORMAT"],array("class"=>"TEXTO"));
				$excel->Content($rep["SITUACAO"],array("class"=>"TEXTO"));
				$excel->Content($rep["CAMPUS_RECOGNIZE"],array("class"=>"TEXTO"));
				$excel->Content($rep["PERIODO"],array("class"=>"TEXTO"));
				$excel->Content($rep["CURSO"],array("class"=>"TEXTO"));
				$excel->Content($vIntFIES,array("class"=>"TEXTO"));
				$excel->Content($vMatric,array("class"=>"TEXTO"));
				$excel->Content(_NVL($rep["PERCBOLSA"],'--'),array("class"=>"TEXTO"));
				
				
				$aTotal[$rep["CAMPUS_RECOGNIZE"]][$rep["CURSO"]][_NVL($rep["PERCBOLSA"],'Verificação')] += 1;
				
				
					
			}
			
			$excel->EndTable();
				
			echo $excel->Br().$excel->Br();
				
			$excel->OpenTable();

			$excel->Header(array("Unidade","Curso","Percentual","Quantidade"));
			
			ksort($aTotal);
			$qtde = 0;
				
			foreach ($aTotal as $key => $aCurso)
			{
				ksort($aCurso);
				foreach ($aCurso as $chave => $aTotalC)
				{
			
					ksort($aTotalC);
					foreach ($aTotalC as $item => $aPerc)
					{
			
						$excel->Content($key,array("class"=>"TEXTO"));
						$excel->Content($chave,array("class"=>"TEXTO"));
						$excel->Content($item,array("class"=>"TEXTO"));
						$excel->Content($aPerc,array("class"=>"NUMERO"));
			
						$qtde += $aPerc;
						$qtdeG += $aPerc;
			
						$vCurso = $chave;
			
					}
				}
					
				$excel->Content('',array("class"=>"TEXTO"));
				$excel->Content('',array("class"=>"TEXTO"));
				$excel->Content("Sub-Total",array("class"=>"TEXTO"));
				$excel->Content($qtde,array("class"=>"NUMERO"));
						
			}
			
			$excel->Content('',array("class"=>"TEXTO"));
			$excel->Content('',array("class"=>"TEXTO"));
			$excel->Content("Total",array("class"=>"TEXTO"));
			$excel->Content($qtdeG,array("class"=>"NUMERO"));
				

			unset($excel);
			
			
		}
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>