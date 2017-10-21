<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Follow Up - Carta de Cobrança","Cadastro de Follow Up - Carta de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	
	include("../engine/Db.class.php");
	//include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/CCobCarta.class.php");
	include("../model/CCobFollow.class.php");
	
	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	//$nav = new Navigation($user, $app);

	if ($_GET[p_CCobCarta_Id] != '')
	{
		$p_CCobCarta_Id = _Decrypt($_REQUEST[p_CCobCarta_Id]);
	}
	
	$ccobCarta 		= new CCobCarta($dbOracle);
	$ccobFollow 	= new CCobFollow($dbOracle);
	
	$view = new ViewBox($app->title,$app->description);	

	$view->Header();

	if ($_POST["btIncluir"] == "Incluir" && $_REQUEST[p_CCobCarta_Id] != '')
	{
		$ccobFollow->IUD($_POST);
	}
	
	
	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','label',$ccobCarta->GetCartaInfo(_NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id])));
			$form->Input('','hidden',array("name"=>'p_CCobCarta_Id', "value"=>_NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id])));
			
			$form->Input($ccobFollow->GetLabel('DtPrevisao'),'date',	array("name"=>'p_DtPrevisao', "required"=>'1'));
			$form->Input($ccobFollow->GetLabel('Texto'),'textarea',array("name"=>'p_Texto', "class"=>"size80", "required"=>'1','maxlength'=>$ccobFollow->GetLength('Texto')));
			
				
			$form->Button("submit",array("value"=>"Incluir","name"=>"btIncluir","class"=>"insert"));
						
		$form->CloseFieldset ();	
		
	
	unset ($form);
	
	
	$dbData->Get("select * from CCobFollow where CCobCarta_Id = '"._NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id])."'");
	
	if ($dbData->Count() > 0)
	{
		$grid = new DataGrid(array("Data de Previsão","Texto","Excluir"));
			
		while ($row = $dbData->Row())
		{
			$grid->Content($row[DTPREVISAO],array('align'=>'left'));
			$grid->Content($row[TEXTO],array('align'=>'left'));			
			$grid->Content($view->Delete($ccobFollow,$row[ID]));
		}
	
		unset($grid);
	}
	
	unset($view);
	unset($ccobFollow);
	unset($ccobCarta);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>