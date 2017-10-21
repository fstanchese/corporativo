<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro do Situações","Cadastro do Situações",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/State.class.php");
	include("../model/StateTi.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$state 		= new State($dbOracle);
	$stateTi 	= new StateTi($dbOracle); 	
	


	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $state->GetIdInfo($_POST[p_State_Id]);
	}
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$state->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_State_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($state->GetLabel('Nome'),'text',array("name"=>'p_Nome', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[NOME]));
			$form->Input($state->GetLabel('Nick'),'text',array("name"=>'p_Nick', "class"=>"size20", "value"=>$linhaSelected[NICK]));
			$form->Input($state->GetLabel('StateTi_Id'),'select',array("name"=>'p_StateTi_Id',"value"=>$linhaSelected[STATETI_ID],"option"=>$stateTi->Calculate("Geral")));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$astate = $state->GetInfo();
	
		if(is_array($astate))			
		{
			$grid = new DataGrid(array("Id","Nome","Nick","Grupo","Editar","Del"));
			
			foreach ($astate as $row)
			{
				$grid->Content($row[ID],array('align'=>'left'));
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($row[NICK],array('align'=>'left'));
				$grid->Content($row[STATETI_NOME],array('align'=>'left'));
				$grid->Content($view->Edit($state,$row[ID]));
				$grid->Content($view->Delete($state,$row[ID]));

			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($stateTi);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>