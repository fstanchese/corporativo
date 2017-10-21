<?php 
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User();
	$app = new App("Cadastro de Pausa", "Cadastro de Pausa", array('ADM','CPD','CASENHAGER', 'CPDEST'), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/CAPausaTi.class.php");
	
	$dbOracle = new Db($user);
	$dbData = new DbData($dbOracle);
	$caPausaTi = new CAPausaTi($dbOracle);
	
	$nav = new Navigation($user, $app, $dbData);
	
	if($_POST[p_O_Option] != ""){
		$linhaSelected = $caPausaTi->GetIdInfo($_POST[p_CAPausaTi_Id]);
	}
	
	if($_GET["p_CAPausaTi_Id"] != "") $linhaSelected[ID] = $_GET["p_CAPausaTi_Id"];
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$caPausaTi->IUD($_POST);
	$view->Header($user,$nav);
	
	$form = new Form();
		$form->Fieldset("Evento - Pausa");
		
			$form->Input('',		'hidden',			array("name"=>'p_CAPausaTi_Id',"value"=>$linhaSelected[ID]));
				
			$form->Input('Nome', 'text', array("required"=>'1',"name"=>'p_Nome', "value"=>$linhaSelected[NOME], "class"=>"size70"));
			
			$form->IUDButtons();
			
		$form->CloseFieldset ();
	unset($form);
	
	if($_GET["p_O_Option"] == "search"){
	
		$aDados = $caPausaTi->GetInfo();
	
		if(is_array($aDados)){
				
	
			$grid = new DataGrid(array("Nome", "Editar", "Del"));
				
			foreach($aDados as $row)
			{
	
				$grid->Content($row[NOME]);
				$grid->Content($view->Edit($caPausaTi,$row[ID]));
				$grid->Content($view->Delete($caPausaTi,$row[ID]));
	
			}
			unset($grid);
	
		}
	}
	
	unset($caPausaTi);
	unset($dbData);
	unset($dbOracle);
	unset($user);
?>