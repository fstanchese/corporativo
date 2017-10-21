<?php 
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	
	$app = new App("Registro de Situaчѕes","Registro de Situaчѕes", array('ADM','CPD', 'CPDEST'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../model/StateGru.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$stategru = new StateGru($dbOracle);
	
	if($_POST[p_O_Option] == "select"){
		$linhaSelected = $stategru->GetIdInfo($_POST[p_StateGru_Id]);
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	
	$stategru->IUD($_POST);
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('','hidden', array("name"=>'p_StateGru_Id',"value"=>$linhaSelected[ID]));
	$form->Input($stategru->GetLabel("Nome"), "text", array("name"=>'Nome',"value"=>$linhaSelected[NOME]));
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	$form->IUDButtons();
	
	$form->CloseFieldset ();
	
	unset ($form);
	
	if($_GET["p_O_Option"] == "search"){
	
		//obtъm todas as colunas da tabela usada na pсgina
		//$dbData->Get($stategru->Query('qGeral'));
		
		$aDados = $stategru->GetInfo();
		//$dbData->ShowQuery();
	
	
		//define as colunas do DataGrid
		$grid = new DataGrid(array("Descriчуo","Editar","Del"));
	
		
		if(is_array($aDados)){
	
			foreach($aDados as $row)
			{
				//adiciona o conteњdo da GetInfo() no DataGrid da tela
				$grid->Content($row[RECOGNIZE]);
				$grid->Content($view->Edit($stategru,$row[ID]));
				$grid->Content($view->Delete($stategru,$row[ID]));
	
			}
		}
	
		unset($grid);
	}
?>