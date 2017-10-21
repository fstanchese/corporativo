<?php 
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	
	$app = new App("Registro de Grupos de Situaчѕes por Sistema","Registro de Grupos de Situaчѕes por Sistema", array('ADM','CPD', 'CPDEST'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../model/StateXStateGru.class.php");
	include("../model/StateGru.class.php");
	include("../model/State.class.php");
	include("../model/Sistema.class.php");
	include("../engine/Ajax.class.php");
	include("../model/StateTi.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	$stateti	= new StateTi($dbOracle);
	$ajax = new Ajax();
	
	$statexstategru = new StateXStateGru($dbOracle);
	$stategru = new StateGru($dbOracle);
	$state = new State($dbOracle);
	$sistema = new Sistema($dbOracle);
	
	if($_POST[p_O_Option] == "select"){

		$linhaSelected = $statexstategru->GetIdInfo($_POST[p_StateXStateGru_Id]);
		
		$aState = $state->GetIdInfo($linhaSelected["STATE_ID"]);
		
		$linhaSelected["STATETI_ID"] = $aState["STATETI_ID"];
		
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$statexstategru->IUD($_POST);
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset();
	
	
	$form->Input('','hidden', array("name"=>'p_StateXStateGru_Id',"value"=>$linhaSelected[ID]));
	
	$form->Input($statexstategru->GetLabel("StateGru_Id"), "select", array("name"=>'p_StateGru_Id',"value"=>$linhaSelected[STATEGRU_ID], "option"=>($stategru->Calculate(null,null,"nome"))));
	
	$form->Input($statexstategru->GetLabel("Sistema_Id"), "select", array("name"=>'p_Sistema_Id',"value"=>$linhaSelected[SISTEMA_ID], "option"=>$sistema->Calculate(null,null,"nome")));
	
	$form->Input($stateti->GetLabel("Nome"), "select", array("name"=>'p_StateTi_Id', 'value'=>$linhaSelected[STATETI_ID], "option"=>$stateti->Calculate(null,null,"nome")));
	
	$form->Input($statexstategru->GetLabel("State_Id"), "select", array("name"=>'p_State_Id', "option"=>array(""=>"Selecione o tipo de situaчуo")));
	
	$ajax->InputRequired("p_StateTi_Id","p_State_Id","change",$state->query["qStateTi"],array("p_StateTi_Id"=>"p_StateTi_Id"), $linhaSelected[STATE_ID]);
	
	$form->CloseFieldset();
	
	
	$form->Fieldset();
	$form->IUDButtons();
	
	$form->CloseFieldset ();
	
	unset ($form);
	
	if($_GET["p_O_Option"] == "search"){
	
		//obtъm todas as colunas da tabela usada na pсgina
		$aDados = $statexstategru->GetInfo();
		//define as colunas do DataGrid
		$grid = new DataGrid(array("Descriчуo","Editar","Del"));
	
			if(is_array($aDados)){
	
			foreach($aDados as $row){
				//adiciona o conteњdo da GetInfo() no DataGrid da tela
				$grid->Content($row[RECOGNIZE]);
				$grid->Content($view->Edit($statexstategru,$row[ID]));
				$grid->Content($view->Delete($statexstategru,$row[ID]));
			}
		}
	
		unset($grid);
	}
?>