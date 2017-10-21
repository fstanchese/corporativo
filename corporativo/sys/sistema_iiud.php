<?php 
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User();
	
	$app = new App("Sistema", "Sistema", array('ADM','CPD', 'CPDEST'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Sistema.class.php");
	
	$dbOracle = new Db($user);
	$dbData = new DbData($dbOracle);
	$nav = new Navigation($user, $app, $dbData);
	
	$sistema = new Sistema($dbOracle);
	
	if($_POST[p_O_Option] == "select"){
		$linhaSelected = $sistema->GetIdInfo($_POST[p_Sistema_Id]);
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	$sistema->IUD($_POST);
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('','hidden', array("name"=>'p_Sistema_Id',"value"=>$linhaSelected[ID]));
	$form->Input($sistema->GetLabel("Nome"), "text", array("name"=>'Nome',"value"=>$linhaSelected[NOME]));
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	$form->IUDButtons();
	
	$form->CloseFieldset ();
	
	unset($form);
	
	if($_GET["p_O_Option"] == "search"){
		$aDados = $sistema->GetInfo();
		
		$grid = new DataGrid(array("Nome do Sistema", "Editar", "Delete"));
		
		if(is_array($aDados)){
			foreach($aDados as $row){
				$grid->Content($row[RECOGNIZE]);
				$grid->Content($view->Edit($sistema,$row[ID]));
				$grid->Content($view->Delete($sistema, $row[ID]));
			}
		}
		unset($grid);
	}
	
	
?>