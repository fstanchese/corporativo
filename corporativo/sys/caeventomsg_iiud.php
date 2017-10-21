<?php 
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User();
	$app = new App("Cadastro de Mensagem", "Cadastro de Mensagem", array('ADM','CPD','CASENHAGER', 'CPDEST'), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/CAEvento.class.php");
	include("../model/CAEventoMsg.class.php");
	include("../model/Campus.class.php");
	
	$dbOracle = new Db($user);
	$dbData = new DbData($dbOracle);
	
	$nav = new Navigation($user, $app, $dbData);
	
	$ajax = new Ajax();
	$campus = new Campus($dbOracle);
	
	$caEvento = new CAEvento($dbOracle);
	$caEventoMsg = new CAEventoMsg($dbOracle);
	
	if($_POST[p_O_Option] != ""){
		$linhaselected = $caEventoMsg->GetIdInfo($_POST[p_CAEventoMsg_Id]);
	}
	
	if($_GET["p_CAEventoMsg_Id"] != ""){
		$linhaSelected[ID] = $_GET["p_CAEventoMsg_Id"];
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$caEventoMsg->IUD($_POST);
	$view->Header($user,$nav);
	
	$form = new Form();
		$form->Fieldset("Evento - Inserзгo de Mensagem");
	
			$form->Input('',		'hidden',			array("name"=>'p_CAEventoMsg_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Unidade', 'select', array("name"=>'p_Campus_Id',  "value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral", $dbData)));
			$form->Input('Evento', 'select', array("name"=>'p_CAEvento_Id', "option"=>array(""=>"Selecione o Evento")));
				
			$ajax->InputRequired("p_Campus_Id", "p_CAEvento_Id", "change", $caEvento->query["qGeral"], array("p_Campus_Id"=>"p_Campus_Id"), $linhaSelected[CAEVENTO_ID]);
			
			$form->Input('Mensagem','text',array("required"=>'1',"name"=>'p_Mensagem', "value"=>$linhaSelected[MENSAGEM], "class"=>"size70"));
			
			$form->Input('Data de Inнcio','datetime',	array("required"=>'1',"name"=>'p_DtInicio',"value"=>$linhaSelected[DTINICIO]));
			$form->Input('Data de Tйrmino','datetime',	array("name"=>'p_DtTermino',"value"=>$linhaSelected[DTTERMINO]));
				
			$form->IUDButtons();
			
		$form->CloseFieldset ();
	unset($form);
	
	if($_GET["p_O_Option"] == "search"){

		$aDados = $caEventoMsg->GetInfo();
		
		if(is_array($aDados)){
			

			$grid = new DataGrid(array("Mensagem", "Dt.Inнcio", "Dt.Tйrmino", "Editar", "Del"));
			
			foreach($aDados as $row)
			{
	
					$grid->Content($row[MENSAGEM]);
					$grid->Content($row[DTINICIO]);
					$grid->Content($row[DTTERMINO]);
					$grid->Content($view->Edit($caEvento,$row[ID]));
					$grid->Content($view->Delete($caEvento,$row[ID]));
				

			}
			unset($grid);

		}
	}	
	
	unset($caEvento);
	unset($dbData);
	unset($dbOracle);
	unset($user);
?>