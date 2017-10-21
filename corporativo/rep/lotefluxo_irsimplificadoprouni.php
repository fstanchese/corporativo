<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Lista de Alunos por Lote - Simplificado","Lista de Alunos por Lote - Simplificado",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);	
	
	$nav 		= new Navigation($user, $app,$dbData);
	
	
	if($_GET[numero] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");
		
		require_once '../model/CAEvento.class.php';
		
		$caEvento = new CAEvento($dbOracle);
	
		$view = new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form(array("method"=>"get"));	
	
			$form->Fieldset();	
		
				$form->Input("Número do Lote",'text',array('name'=>'numero',"required"=>'1'));
					
			$form->CloseFieldset ();
		
			$form->Fieldset();
			
				$form->Button("submit",array("name"=>"enviar","value"=>"Gerar Lista"));
		
	
			$form->CloseFieldset ();
	
		unset($form);
	}
	else
	{
		

		include("../engine/ReportPDF.class.php");
		
		require_once("../model/Depart.class.php");
		require_once("../model/Campus.class.php");
		require_once("../model/Sala.class.php");
		require_once("../model/LoteProc.class.php");
		require_once("../model/CAWPesDet.class.php");
		
		
		$depart 	= new Depart($dbOracle);
		$campus 	= new Campus($dbOracle);
		$sala   	= new Sala($dbOracle);
		$loteProc 	= new LoteProc($dbOracle);
		$wpesDet	= new CAWPesDet($dbOracle);
		

		$qtdeLote = $dbData->Row($dbData->Get("SELECT count(*) as qtde FROM lotefluxo WHERE numero = '".($_REQUEST[numero])."'"));
		
		$primeiraLinha = $dbData->Row($dbData->Get("SELECT * FROM lotefluxo WHERE numero = '".($_REQUEST[numero])."'"));
		
		$dadosDepart 	= $depart->GetIdInfo($primeiraLinha[DEPART_ID]);
		$dadosCampus 	= $campus->GetIdInfo($primeiraLinha[CAMPUS_ID]);
		//$dadosSala 		= $sala->GetIdInfo($primeiraLinha[SALA_ID]);
		$dadosLoteProc 	= $loteProc->GetIdInfo($primeiraLinha[LOTEPROC_ID]);
		
		
		
		
		$viewReport = new ReportPDF($app->title,"Lote: ".$primeiraLinha[NUMERO]." - ".$dadosDepart[NOMEREDUZ]." - ".$dadosCampus[NOME]." - ".$dadosCampus[NOME]." ".$dadosLoteProc[NOME]." - Qtde Proc (".$qtdeLote[QTDE].")","G","L");
			
		$arH[0]['TEXT'] = "Nome";
		$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[1]['TEXT'] = "CPF";
		$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[2]['TEXT'] = "Curso";
		$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[3]['TEXT'] = "Periodo";
		$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[4]['TEXT'] = "Unidade";
		$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[5]['TEXT'] = "ENEM";
		$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[6]['TEXT'] = "Classific.";
		$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		
		$arH[7]['TEXT'] = "Tipo Bolsa";
		$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[8]['TEXT'] = "Bolsa Adicional";
		$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[9]['TEXT'] = "Cota";
		$arH[9]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$viewReport->GridHeader($arH,array(70,20,60,20,15,25,15,35,15,15));
		
		
		
		$dbData->Get("SELECT lotefluxo.* 
				FROM lotefluxo,CAEvXWPes 
				WHERE CAEvXWPes.Id = LoteFluxo.CAEvXWPes_Id and  numero = '".($_REQUEST[numero])."' order by wpessoa_gsRecognize(wpessoa_Id)");
		
		
		
	
		
		while($row = $dbData->Row())
		{
			$dadosPessoa = $wpesDet->GetWPesInfo($row[CAEVXWPES_ID]);
			
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['NOME']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['CPF']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Curso']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Período']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Campus']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Nota do ENEM']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Classificação'],"TEXT_ALIGN"=>"R"));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Tipo de Bolsa']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Bolsa Adicional']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Cota']));
			
			
			
		}
		
		
		unset($viewReport);
		
		
		
	}
	
	unset($depart);
	unset($campus);
	unset($sala);
	unset($loteProc);
	unset($wpesDet);
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	