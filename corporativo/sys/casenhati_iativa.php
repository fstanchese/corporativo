<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Ativar Tipo de Senha - Controle de Atendimento","Ativar Tipo de Senha - Controle de Atendimento",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CASenhaTi.class.php");	

	

	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	

	$nav = new Navigation($user, $app, $dbData);
	
	$caSenhaTi = new CASenhaTi($dbOracle);
		
			
	$view = new ViewPage($app->title,$app->description);
	
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}
	
	
	if($_POST[enviar] == 'Alterar')
	{
		
		$arUpd["p_O_Option"] = "update";

		foreach($_POST as $key => $value)
		{
			$arUpd["CASenhaTi_Id"] 	= $key;
			$arUpd["Ativo"]		 	= $value;
			
			if (substr($arUpd["CASenhaTi_Id"],0,4) == '2008')
				$caSenhaTi->IUD($arUpd);
						
		}
		
	}
	
	
	
	
	
	
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset();
		
			$dbData->Get("SELECT casenhati.descricao, casenhati.id, casenhati.ativo FROM casenhati, caassunto WHERE casenhati.caassunto_id = caassunto.id AND caassunto.caevento_id = '".$_COOKIE[p_CAEvento_Id]."' ORDER BY id");
			
			
			
			while($row = $dbData->Row())
			{
				$form->Input($row[DESCRICAO],'onoff', array("id"=>$row[ID], "name"=>$row[ID], "value"=>$row[ATIVO]));
			}
		
			


			$form->Button("submit",array("name"=>"enviar","value"=>"Alterar"));
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
		
	unset($caSenhaTi);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>