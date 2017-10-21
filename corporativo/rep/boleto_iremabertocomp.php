<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaзгo de Boletos em Aberto por Competкncia","Relaзгo de Boletos em Aberto por Competкncia, Tipo de Boleto, Curso, Faculdade e Unidade",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Campus.class.php");
	include("../model/BoletoTi.class.php");
	
	include("../model/Curso.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Facul.class.php");
	include("../model/Boleto.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	
	$campus 	= new Campus($dbOracle);
	$boletoTi 	= new BoletoTi($dbOracle);
	$curso		= new Curso($dbOracle);
	$facul		= new Facul($dbOracle);
	$cnivel		= new CursoNivel($dbOracle);
	$boleto		= new Boleto($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$ajax->InputRequired("p_Campus_Id","p_Curso_Id","change",$curso->query['qCampus'],array("p_Campus_Id"=>"p_Campus_Id","p_Facul_Id"=>"p_Facul_Id","p_CursoNivel_Id"=>"p_CursoNivel_Id"));
		$ajax->InputRequired("p_Facul_Id","p_Curso_Id","change",$curso->query['qCampus'],array("p_Campus_Id"=>"p_Campus_Id","p_Facul_Id"=>"p_Facul_Id","p_CursoNivel_Id"=>"p_CursoNivel_Id"));
		$ajax->InputRequired("p_CursoNivel_Id","p_Curso_Id","change",$curso->query['qCampus'],array("p_Campus_Id"=>"p_Campus_Id","p_Facul_Id"=>"p_Facul_Id","p_CursoNivel_Id"=>"p_CursoNivel_Id"));
		
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
			$form->Fieldset();
				
				$form->Input('Unidade','select',array("name"=>'p_Campus_Id',"option"=>$campus->Calculate()));
				$form->Input('Faculdade','select' , array("name"=>'p_Facul_Id',"option"=>$facul->Calculate()));
				$form->Input('Nнvel do Curso','select' , array("name"=>'p_CursoNivel_Id',"option"=>$cnivel->Calculate()));
				$form->Input('Curso','select' , array("name"=>'p_Curso_Id',"option"=>array(""=>"Selecione Nнvel do Curso ou Faculdade ou Unidade")));
				$form->LabelMultipleInput("Competкncia");
				$form->MultipleInput("","text",array("required"=>"1","name"=>'p_CompIni',"class"=>"competencia size90"));
				
				$form->MultipleInput(" а ","text",array("required"=>"1","name"=>'p_CompFim',"class"=>"competencia size80"));
				
				$form->Input('Tipo de Boleto','select',array("name"=>'p_BoletoTi_Id',"value"=>array(), "option"=>$boletoTi->Calculate('Geral')));
				
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
		
		$p_Competencia 	= substr($_POST[p_CompIni],3,4).substr($_POST[p_CompIni],0,2);
		
		if($_POST[p_CompFim] == "") $_POST[p_CompFim] = $_POST[p_CompIni];
			
		$p_Competencia_Fim 	= substr($_POST[p_CompFim],3,4).substr($_POST[p_CompFim],0,2);
		
		$vDescricao = "Boletos em Aberto por Competкncia ($_POST[p_CompIni] a $_POST[p_CompFim])";
		
		if (!empty($_POST[p_Campus_Id]))
			$vDescricao .= " - " . $campus->Recognize($_POST[p_Campus_Id]);
		if (!empty($_POST[p_Facul_Id]))
			$vDescricao .=  " - " . $facul->Recognize($_POST[p_Facul_Id]);
		if (!empty($_POST[p_CursoNivel_Id]))
			$vDescricao .= " - " . $cnivel->Recognize($_POST[p_CursoNivel_Id]);
		if (!empty($_POST[p_Curso_Id]))
			$vDescricao .= " - " . $curso->Recognize($_POST[p_Curso_Id]);
		
		$dbData->Get("select
				Boleto.Id                                     as Boleto_Id,
				WPessoa.Codigo                                as WPessoa_Codigo,
				WPessoa.Nome                                  as WPessoa_Nome,
				Boleto.NossoNum                               as NossoNum,
				Boleto.Referencia                             as Referencia,
				Boleto.Dt                                     as DtEmissao,
				to_char(Boleto.Valor,'999G999G990D00')        as Valor_Format,
				Boleto.Valor                                  as Valor,
				Boleto.DtVencto                               as DtVencto,
				Curso.Nome                                    as Curso,
				Campus_gsRecognize(Boleto.Campus_Id)          as Unidade,
				Facul_gsRecognize(Curso.Facul_Id)             as Facul,
				CursoNivel_gsRecognize(Curso.Cursonivel_id)   as CursoNivel,
				State_gsRecognize(Boleto.State_Base_Id)       as Boleto_State
				from
				WPessoa,
				Boleto,
				Curso
				where
				( Curso.CursoNivel_Id = '$_POST[p_CursoNivel_Id]' or	'$_POST[p_CursoNivel_Id]' is null )
				and
				( Curso.Facul_Id = '$_POST[p_Facul_Id]'	or	'$_POST[p_Facul_Id]' is null	)
				and
				Boleto.Curso_Id = Curso.Id (+)
				and
				( Boleto.Campus_Id = '$_POST[p_Campus_Id]'	or	'$_POST[p_Campus_Id]' is null )
				and
				( Boleto.Curso_Id = '$_POST[p_Curso_Id]'	or '$_POST[p_Curso_Id]' is null	)
				and
				WPessoa.Id = Boleto.WPessoa_Sacado_Id
				and
				( Boleto.BoletoTi_Id = '$_POST[p_BoletoTi_Id]'	or	'$_POST[p_BoletoTi_Id]' is null	)
				and
				Boleto.State_Base_Id in (3000000000006,3000000000007)
				and
				Boleto.Competencia between '$p_Competencia' and '$p_Competencia_Fim'
				order by
				DtVencto
				");		
	
	
				if ($_POST["consultar"] == "Gerar em PDF")
				{
					
					include("../engine/ReportPDF.class.php");
					$viewReport = new ReportPDF($vDescricao,"G","P");
					
					$arH[0]['TEXT'] = "RA";
					$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[1]['TEXT'] = "Aluno";
					$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[2]['TEXT'] = "Boleto";
					$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[3]['TEXT'] = "Ref.";
					$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[4]['TEXT'] = utf8_encode("Dt Emissгo");
					$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[5]['TEXT'] = "Valor";
					$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[6]['TEXT'] = "Dt Vencto";
					$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[7]['TEXT'] = "Sit. Acad.";
					$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

					$arH[8]['TEXT'] = "Sit. Boleto.";
					$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$viewReport->GridHeader($arH,array(15,40,25,20,20,20,20,20,20));
					
				
					
					$vTotal = 0;
					while ($rep = $dbData->Row())
					{

						
						$viewReport->GridContent(array("TEXT"=>$rep["WPESSOA_CODIGO"]));
						$viewReport->GridContent(array("TEXT"=>$rep["WPESSOA_NOME"]));
						$viewReport->GridContent(array("TEXT"=>$rep["NOSSONUM"]));
						$viewReport->GridContent(array("TEXT"=>$rep["REFERENCIA"]));
						$viewReport->GridContent(array("TEXT"=>$rep["DTEMISSAO"],"TEXT_ALIGN"=>"C"));
						$viewReport->GridContent(array("TEXT"=>$rep["VALOR_FORMAT"],"TEXT_ALIGN"=>"R"));
						$viewReport->GridContent(array("TEXT"=>$rep["DTVENCTO"],"TEXT_ALIGN"=>"C"));
						$viewReport->GridContent(array("TEXT"=>$boleto->GetStateMatric($rep["BOLETO_ID"])));
						$viewReport->GridContent(array("TEXT"=>$rep["BOLETO_STATE"]));
					
						$vTotal += _DecimalPoint($rep[VALOR]);
						$aTotalC[$rep["CURSO"]] 			+= _DecimalPoint($rep["VALOR"]);
						$aTotalF[$rep["FACUL"]] 			+= _DecimalPoint($rep["VALOR"]);
						$aTotalU[$rep["UNIDADE"]] 		+= _DecimalPoint($rep["VALOR"]);
						$aTotalCN[$rep["CURSONIVEL"]] 	+= _DecimalPoint($rep["VALOR"]);
					
					}
					
					ksort($aTotalC);
					ksort($aTotalF);
					ksort($aTotalU);
					ksort($aTotalCN);
			
					
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>"Total","TEXT_ALIGN"=>"R"));
					$viewReport->GridContent(array("TEXT"=>_FormatValor($vTotal),"TEXT_ALIGN"=>"R"));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					$viewReport->GridContent(array("TEXT"=>""));
					
					
					$viewReport->CloseTable();
					
					
					
					$viewReport->NewPage();
					
					$arH[0]['TEXT'] = "Unidade";
					$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[1]['TEXT'] = "Valor";
					$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$cont = 0;
					
					
					$viewReport->GridHeader($arH,array(80,40));
					
					foreach($aTotalU as $unidade => $valor)
					{
						$viewReport->GridContent(array("TEXT"=>$unidade));
						$viewReport->GridContent(array("TEXT"=>_FormatValor($valor),"TEXT_ALIGN"=>"R"));
					
					
					}
					
					$viewReport->CloseTable();
					
					$viewReport->Br();
					
					
					$arH[0]['TEXT'] = utf8_encode("Nнvel Curso");
					$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[1]['TEXT'] = "Valor";
					$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$cont = 0;
					
					
					$viewReport->GridHeader($arH,array(80,40));
					
					foreach($aTotalCN as $cn => $valor)
					{
						$viewReport->GridContent(array("TEXT"=>$cn));
						$viewReport->GridContent(array("TEXT"=>_FormatValor($valor),"TEXT_ALIGN"=>"R"));
					}
					
					$viewReport->CloseTable();
					
					$viewReport->Br();
					
					
					
					$arH[0]['TEXT'] = "Faculdade";
					$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[1]['TEXT'] = "Valor";
					$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$cont = 0;
					
					
					$viewReport->GridHeader($arH,array(80,40));
					
					foreach($aTotalF as $facul => $valor)
					{
						$viewReport->GridContent(array("TEXT"=>$facul));
						$viewReport->GridContent(array("TEXT"=>_FormatValor($valor),"TEXT_ALIGN"=>"R"));
							
							
					}
					
					$viewReport->CloseTable();
					
					$viewReport->NewPage();
					
					$arH[0]['TEXT'] = "Curso";
					$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					$arH[1]['TEXT'] = "Valor";
					$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					
					
					$viewReport->GridHeader($arH,array(80,40));
					
					foreach($aTotalC as $curso => $valor)
					{
						
						$viewReport->GridContent(array("TEXT"=>$curso));
						$viewReport->GridContent(array("TEXT"=>_FormatValor($valor),"TEXT_ALIGN"=>"R"));
							
					
					}
					
					
					unset($viewReport);
				
					
				}
				
	
	
	
	
	
	
	
	
				if ($_POST["consultar"] == "Gerar em Excel")
				{
					require_once("../engine/Excel.class.php");
					
					$excel = new Excel("Boletos-em-Aberto-por-Competкncia");
					
					$excel->Header(array("RA","ALUNO","BOLETO","REF","DT EMISSВO","VALOR","DT VENCTO","SIT. ACAD.","SIT. BOLETO"));
					
					
				
					$vTotal = 0;
					while ($rep = $dbData->Row())
					{
					
						$excel->Content($rep["WPESSOA_CODIGO"]);
						$excel->Content($rep["WPESSOA_NOME"]);
						$excel->Content($rep["NOSSONUM"],array("class"=>'NUMERO'));
						$excel->Content($rep["REFERENCIA"]);
						$excel->Content($rep["DTEMISSAO"]);
						$excel->Content($rep["VALOR_FORMAT"]);
						$excel->Content($rep["DTVENCTO"]);
						$excel->Content($boleto->GetStateMatric($rep["BOLETO_ID"]));
						$excel->Content($rep["BOLETO_STATE"]);								
						$vTotal += _DecimalPoint($rep["VALOR"]);
						$aTotalC[$rep["CURSO"]] 			+= _DecimalPoint($rep["VALOR"]);
						$aTotalF[$rep["FACUL"]] 			+= _DecimalPoint($rep["VALOR"]);
						$aTotalU[$rep["UNIDADE"]] 			+= _DecimalPoint($rep["VALOR"]);
						$aTotalCN[$rep["CURSONIVEL"]] 		+= _DecimalPoint($rep["VALOR"]);
					
					}
					ksort($aTotalC);
					ksort($aTotalF);
					ksort($aTotalU);
					ksort($aTotalCN);
					
					
					$excel->Content("");
					$excel->Content("");
					$excel->Content("");
					$excel->Content("");
					
					$excel->Content("Total");
					$excel->Content(_FormatValor($vTotal));
					
					
					$excel->EndTable();
					
					echo $excel->Br().$excel->Br();
					
					$excel->OpenTable();
					
					
					$excel->Header(array("Unidade","Valor"));
					
					foreach($aTotalU as $key => $valor)
					{
						$excel->Content($key);
						$excel->Content(_FormatValor($valor));
						
					}
					
					$excel->EndTable();
					
					echo $excel->Br().$excel->Br();
					
					$excel->OpenTable();
					
					
					$excel->Header(array("Nнvel Curso","Valor"));
					
					foreach($aTotalCN as $key => $valor)
					{
						$excel->Content($key);
						$excel->Content(_FormatValor($valor));
						
					}
					
					$excel->EndTable();
					
					echo $excel->Br().$excel->Br();
					
					$excel->OpenTable();
					
					$excel->Header(array("Faculdade","Valor"));
					
					foreach($aTotalF as $key => $valor)
					{
						$excel->Content($key);
						$excel->Content(_FormatValor($valor));
						
					}
					
					$excel->EndTable();
					
					
					echo $excel->Br().$excel->Br();
					
					$excel->OpenTable();
					
					$excel->Header(array("Curso","Valor"));
					
					foreach($aTotalC as $key => $valor)
					{
						$excel->Content($key);
						$excel->Content(_FormatValor($valor));
						
					}
					
					unset($excel);
					
					
				}
	}
	
	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>