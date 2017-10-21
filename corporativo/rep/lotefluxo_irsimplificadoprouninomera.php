<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Lista de Alunos por Lote - Simplificado - Nome e RA","Lista de Alunos por Lote - Simplificado - Nome e RA",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	
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
		

		$qtdeLote = $dbData->Row($dbData->Get("SELECT count(*) as qtde FROM LoteFluxo,CAEvXWPes WHERE LoteFluxo.CAEvXWPes_Id = CAEvXWPes.Id and LoteFluxo.numero = '".($_REQUEST[numero])."'"));
		
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
		
		$arH[2]['TEXT'] = "RA";
		$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[3]['TEXT'] = "Telefone";
		$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

		$arH[4]['TEXT'] = "Celular";
		$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

		$arH[5]['TEXT'] = "Curso";
		$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[6]['TEXT'] = "Percentual";
		$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$viewReport->GridHeader($arH,array(85,25,20,35,35,70,20));

		
		$dbData->Get("SELECT * FROM LoteFluxo, CAEvXWPes WHERE LoteFluxo.CAEvXWPes_Id = CAEvXWPes.Id and LoteFluxo.Numero = '".($_REQUEST[numero])."' order by WPessoa_gsRecognize(CAEvXWPes.WPessoa_Id)");
		
		while($row = $dbData->Row())
		{
			$dadosPessoa 	= $wpesDet->GetWPesInfo($row[CAEVXWPES_ID]);
			 
			if ($wpesDet->GetWPesInfo($row[CAEVXWPES_ID],'Bolsa Adicional') == 'Sim')
				$vPercentual = '50%';
			if ($wpesDet->GetWPesInfo($row[CAEVXWPES_ID],'Bolsa Adicional') == 'Não')
				$vPercentual = '100%';
			
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['NOME']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['CPF']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['RA']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Telefone']));
			$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Celular']));
			$viewReport->GridContent(array("TEXT"=>$wpesDet->GetWPesInfo($row[CAEVXWPES_ID],'Curso')));
			$viewReport->GridContent(array("TEXT"=>$vPercentual,"TEXT_ALIGN"=>"R"));
						
			
			
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