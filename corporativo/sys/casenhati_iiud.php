<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Tipos de Senha - Controle de Atendimento","Tipos de Senha - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Ajax.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CAAssunto.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaTi.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	$ajax 		= new Ajax();

	$caAssunto 	= new CAAssunto($dbOracle);
	$caSenhaTi 	= new CASenhaTi($dbOracle);
	$caEvento 	= new CAEvento($dbOracle);
	
	


	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($caSenhaTi->Query("qId",array("p_CASenhaTi_Id"=>$_POST[p_CASenhaTi_Id])));
		$linhaSelected = $dbData->Row();
		
	}
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	 	
	$caSenhaTi->IUD($_POST,$dbData);
	
	$view->Header($user,$nav);


	$form = new Form();

		$form->Fieldset("Tipos de Senha - Controle de Atendimento");
		
			$form->Input('',	'hidden',			array("name"=>'p_CASenhaTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($caSenhaTi->GetLabel("Descricao"),'text',array("required"=>'1',"name"=>'p_Descricao', "value"=>$linhaSelected[DESCRICAO], "class"=>"size70"));
			$form->Input("Evento",'select',array("required"=>'1',"name"=>"p_CAEvento_Id","option"=>$caEvento->Calculate("Geral",$dbData),"value"=>$linhaSelected[CAEVENTO_ID]));
			$form->Input($caSenhaTi->GetLabel("CAAssunto_Id"),	'select', array("required"=>'1',"name"=>'p_CAAssunto_Id',  "option"=>array(""=>"Selecione o Evento")));
			
			$ajax->InputRequired("p_CAEvento_Id","p_CAAssunto_Id","change",$caAssunto->query["qGeral"],array("p_CAEvento_Id"=>"p_CAEvento_Id"),$linhaSelected[CAASSUNTO_ID]);
			
			$form->Input($caSenhaTi->GetLabel("Ativo"),'onoff',array("name"=>'p_Ativo', "value"=>$linhaSelected[ATIVO]));
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$acaSenhaTi = $caSenhaTi->GetInfo();
		
		if(is_array($acaSenhaTi))
		{
			
			$grid = new DataGrid(array("Assunto","Descriчуo da Senha","Editar","Del"));

			foreach($acaSenhaTi as $key => $aArr)
			{
				$grid->Content($caAssunto->Recognize($aArr[CAASSUNTO_ID]));
				$grid->Content($aArr[DESCRICAO]);
				$grid->Content($view->Edit($caSenhaTi,$aArr[ID]));
				$grid->Content($view->Delete($caSenhaTi,$aArr[ID]));
			}
		}
		
		unset($grid);
		
	}
	
	unset($caSenhaTi);
	unset($caAssunto);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>