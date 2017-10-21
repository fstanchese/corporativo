<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();
	$app = new App("Critérios por Processo","Critérios por Processo",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	
	include("../model/CCobCartaTi.class.php");
	include("../model/BoletoTi.class.php");
	include("../model/StateGru.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	

	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);

	
	$ccobcartati 	= new CCobCartaTi($dbOracle);
	$boletoti 		= new BoletoTi($dbOracle);
	$stateGru		= new StateGru($dbOracle);
	$cursonivel 	= new CursoNivel($dbOracle);
	$curso 			= new Curso($dbOracle);
	
	
	
	$view = new ViewBox($app->title,$app->description);
	$view->Header ();
	
	$view->IncludeJS("ccobproc.js");

	
		
	$dbData->Get("SELECT ccobcrit.*, to_char(ccobcrit.valortotal,'999G999G990D99') as valor_format FROM ccobcrit WHERE ccobproc_id =  '"._Decrypt($_GET[p_CCobProc_Id])."'");
		
	if($dbData->Count () > 0)
	{
	
		$grid = new DataGrid(array("Tipo de Carta","Situação Acadêmica","Nível Curso","Curso","Boletos Aberto","Data Vencto","Ignora Conseq","Qtde Boleto","Qtde Aluno","Valor Total","Imprimir Carta","Imprimir Etiqueta"));
			
		while($row = $dbData->Row ())
		{
	
			$dadosCarta 			= $ccobcartati->GetIdInfo($row[CCOBCARTATI_ID]);
			$dadosState 			= $stateGru->GetIdInfo($row[STATE_MATRIC_ID]);
			$dadosCursoNivel 		= $cursonivel->GetIdInfo($row[CURSONIVEL_ID]);
			$dadosCurso 			= $curso->GetIdInfo($row[CURSO_ID]);
			
			$grid->Content($dadosCarta[NOME]);
			$grid->Content($dadosState[NOME]);
			$grid->Content($dadosCursoNivel[NOMECOMPLETO]);
			$grid->Content($dadosCurso[NOME]);
			$grid->Content($row[QTDE]);
			$grid->Content($row[DTVENCTO]);
			$grid->Content($view->OnOff($row[SCPC]));
			$grid->Content($row[QTDEBOLETO],array("align"=>"right"));
			$grid->Content($row[QTDEALUNO],array("align"=>"right"));
			$grid->Content($row[VALOR_FORMAT],array("align"=>"right"));
			$grid->Content($view->Link($view->IconFA("fa-print"),array("class"=>"btnPrintCarta","href"=>"#","link"=>"../rep/ccobproc_iimpressaocarta.php?p_CCobCrit_Id="._UrlEncrypt($row[ID]))));
			$grid->Content($view->Link($view->IconFA("fa-tags"),array("target"=>"_blank","href"=>"../rep/ccobproc_iimpressaoetiqueta.php?p_CCobCrit_Id="._UrlEncrypt($row[ID]))));
			
	
		}
	}
		
	
	unset($dadosCarta);
	unset($dadosBoletoTi);
	unset($dadosState);
	unset($dadosCursoNivel);
	unset($dadosCurso);
	
	unset($grid);
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	//
	
?>