<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro do Tipo de Situaчуo","Cadastro do Tipo de Situaчуo",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/StateTi.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$stateTi = new StateTi($dbOracle);	
	


	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $stateTi->GetIdInfo($_POST[p_StateTi_Id]);
	}
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$stateTi->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_StateTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($stateTi->GetLabel('Nome'),'text',array("name"=>'p_Nome', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[NOME]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$astateTi = $stateTi->GetInfo();
	
		if(is_array($astateTi))			
		{
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			foreach ($astateTi as $row)
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($stateTi,$row[ID]));
				$grid->Content($view->Delete($stateTi,$row[ID]));

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