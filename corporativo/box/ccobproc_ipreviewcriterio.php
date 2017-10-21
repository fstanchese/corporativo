<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Preview da Geraчуo de Cartas por Critщrio","Preview da Geraчуo de Cartas por Critщrio",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../model/WPessoa.class.php");
	include("../model/CCobCarta.class.php");
	include("../model/CCobCrit.class.php");
	include("../model/State.class.php");
	include("../model/CCobDebito.class.php");	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$wpessoa	= new WPessoa($dbOracle);
	$ccobCarta 	= new CCobCarta($dbOracle);
	$ccobCrit 	= new CCobCrit($dbOracle);
	$state		= new State($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
		
	$view = new ViewBox($app->title,$app->description);

	$dbData->Get("select * from ccobcarta where ccobcrit_id in (select Id from ccobcrit where ccobproc_id = '"._Decrypt($_GET[p_CCobProc_Id])."')");

	if($dbData->Count() > 0)
	{
		
		$grid = new DataGrid(array("Carta","Aluno","Data Vencto","Situaчуo","Boletos","Data AR","Data Emissуo"));
		
		while ($row = $dbData->Row())
		{	
			$arBoletos 	= $ccobDebito->GetBoletoReferencia($row[ID]);
				
			if (!is_array($arBoletos))
			{
				$vRef = 'Nуo informado';
			}
			else
			{
				$vRef = implode(", ",$arBoletos[REFERENCIA]);
			}
									
			$grid->Content($row[ID]-208600000000000,array('align'=>'right'));
			$grid->Content($wpessoa->Recognize($row[WPESSOA_ID]),array('align'=>'left'));
			$grid->Content($row[DTVENCTO]);
			$grid->Content($state->Recognize($row[STATE_ID]),array('align'=>'left'));
			$grid->Content($vRef);
			$grid->Content($row[DTAVISOREC]);
			$grid->Content($row[DTEMISSAO]);
			
		}
	}
	
	unset($grid);
	
	
	echo $view->Br().$view->Br().$view->Br().$view->Br().$view->Br();
	
	
	unset($ccobCrit);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	
?>