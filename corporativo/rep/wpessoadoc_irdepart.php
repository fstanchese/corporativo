<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaзгo de Documentos Pendentes por Departamento","Relaзгo de Documentos Pendentes por Departamento",array('ADM','CPD','PROUNI'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Depart.class.php");
	include("../model/Curso.class.php");
	include("../model/CursoNivel.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);
	
	$ajax		= new Ajax($dbOracle);

	$depart 	= new Depart($dbOracle);
	$curso		= new Curso($dbOracle);
	$cursoNivel	= new CursoNivel($dbOracle);

	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$ajax->InputRequired("p_CursoNivel_Id","p_Curso_Id","change",$curso->query['qNivel'],array("p_CursoNivel_Id"=>"p_CursoNivel_Id"));
		
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input("Departamento",'select',array("name"=>'p_Depart_Id',"required"=>"1","option"=>$depart->Calculate("Geral")));
			
			$form->Input('Nнvel do Curso','select' , array("name"=>'p_CursoNivel_Id',"option"=>$cursoNivel->Calculate()));
			
			$form->Input('Curso','select' , array("name"=>'p_Curso_Id',"option"=>array(""=>"Selecione Nнvel do Curso ou Faculdade ou Unidade")));
				
			
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
		
		$sql = "SELECT  WPessoaDoc.*,
						WPessoa.Nome,
						WPessoa.Codigo,
						WPessoa.FoneRes,
						WPessoa.FoneCel,
						WPessoa.Email1,
						WPessoaDocTi_gsRecognize(WPessoaDoc.WPessoaDocTi_Id) as DocTi,
						WPessoaDocMot_gsRecognize(WPessoaDoc.WPessoaDocMot_Id) as DocMot,
						Depart_gsRecognize(WPessoaDoc.Depart_Id) as Depart,
						Parentesco_gsRecognize(WPessoaDoc.Parentesco_Id) as Parente
				FROM
					WPessoaDoc,
					WPessoa,
          			Matric,
          			TurmaOfe,
          			CurrOfe,
          			Curr					
				WHERE
					( '$_POST[p_Curso_Id]' is null or Curr.Curso_Id = '$_POST[p_Curso_Id]' )
        		and
          			CurrOfe.Curr_Id = Curr.Id
        		and
          			TurmaOfe.CurrOfe_Id = CurrOfe.Id
        		and
          			Matric.TurmaOfe_Id = TurmaOfe.Id
        		and
          			matric.id = (select max(id) from matric where matricti_id = 8300000000001 and wpessoa_Id = WPessoa.Id)
        		and
					WPessoa.Id = WPessoaDoc.WPessoa_Id
				and
					( '$_POST[p_Depart_Id]' is null or WPessoaDoc.Depart_Id = '$_POST[p_Depart_Id]' ) 
				ORDER BY
					WPessoa.Nome,Parente,DocTi
				";
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
			
			$vDescricao = 'Departamento ' . $depart->Recognize($_POST[p_Depart_Id]);
						
			$dbData->Get($sql);

			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
							
			$arH[0]['TEXT'] = utf8_encode("Cуdigo");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = utf8_encode("Nome");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Parentesco");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = utf8_encode("Tipo de Documento");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[4]['TEXT'] = utf8_encode("Motivo");
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[5]['TEXT'] = utf8_encode("Fone Res.");
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[6]['TEXT'] = utf8_encode("Fone Com.");
			$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$viewReport->GridHeader($arH,array(18,60,30,68,68,23,23));
				
			$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
			while ($rep = $dbData->Row())
			{
				
				if ($vCor == array(255,255,255))
				{
					$vCor = array(233,240,240);
				}
				else
				{ 
					$vCor = array(255,255,255);
				}

				
				$viewReport->GridContent(array("TEXT"=>$rep["CODIGO"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["NOME"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["PARENTE"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["DOCTI"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["DOCMOT"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["FONERES"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
				$viewReport->GridContent(array("TEXT"=>$rep["FONECEL"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>$vCor));
						
				unset($aPosto);
					
			}

		}

		
		//Gerar em Excell
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Cуdigo","Nome","Parentesco","Tipo de Documento","Motivo","Fone Residencial","Fone Comercial","e-mail"));
			
			$dbData->Get($sql);
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				
				$excel->Content($rep["CODIGO"]);
				$excel->Content($rep["NOME"]);
				$excel->Content($rep["PARENTE"]);
				$excel->Content($rep["DOCTI"]);
				$excel->Content($rep["DOCMOT"]);
				$excel->Content($rep["FONERES"]);
				$excel->Content($rep["FONECEL"]);
				$excel->Content($rep["EMAIL1"]);

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