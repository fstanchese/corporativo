<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Informações obrigatórias dos Assuntos - S.A.A.","Cadastro de Informações obrigatórias dos Assuntos - S.A.A.",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	

	include("../model/WOcorrAssInf.class.php");
	
	
	

	$dbOracle 		= new Db ($user);
	

	$dbData 		= new DbData ($dbOracle);
	

	$wocorrAssInf 	= new WOcorrassInf($dbOracle);
		
	if($_POST[p_O_Option] == 'select') 
	{
		$dbData->Get($wocorrAssInf->Query("qId",array("p_WOcorrAssInf_Id"=>$_POST[WOcorrAssInf_Id])));
		
		$dadosSelect = $dbData->Row();
		
	}
	
	
	
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Explain('IUD');
	
	$view->Header($user);
	
	
	$wocorrAssInf->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',		array("name"=>"WOcorrAssInf_Id","value"=>$dadosSelect[ID]));
	$form->Input('Informação','text',		array("name"=>"p_Informacao","class"=>"size50","value"=>$dadosSelect[INFORMACAO]));
	$form->Input('Label','text',			array("name"=>"p_Label","class"=>"size50","value"=>$dadosSelect[LABEL]));
	$form->Input('Atributo','text',			array("name"=>"p_Atributo","class"=>"size40","value"=>$dadosSelect[ATRIBUTO]));
	
	$form->Input('Tipo de Entrada','text',	array("name"=>"p_Entrada","require"=>"1","class"=>"size40","value"=>$dadosSelect[ENTRADA]));
	$form->Input('Query','text',			array("name"=>"p_Selecao","class"=>"size40","value"=>$dadosSelect[SELECAO]));
	$form->Input('Formatação','text',		array("name"=>"p_Formatacao","class"=>"size40","value"=>$dadosSelect[FORMATACAO]));

	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$aDados = $wocorrAssInf->GetInfo("Informacao");

		$grid = new DataGrid(array("Informação","Label","Atributo","Tipo de Entrada","Query","Formatação","Editar","Excluir"));
		
		
		foreach($aDados as $row)
		{

			$grid->Content($row[INFORMACAO],array('align'=>'left'));
			$grid->Content($row[LABEL],array('align'=>'left'));
			$grid->Content($row[ATRIBUTO],array('align'=>'left'));
			$grid->Content($row[ENTRADA],array('align'=>'left'));
			$grid->Content($row[SELECAO],array('align'=>'left'));
			$grid->Content($row[FORMATACAO],array('align'=>'left'));
			$grid->Content($view->Edit($wocorrAssInf,$row[ID]),array('width'=>'05%'));
			$grid->Content($view->Delete($wocorrAssInf,$row[ID]),array('width'=>'05%'));
							
		}
		unset($grid);
		
	}	
	
	unset($wocorrAssInf);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>