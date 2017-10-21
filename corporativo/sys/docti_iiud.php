<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Inclusão de Tipo de Documento","Inclusão de Tipo de Documento",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/DocTi.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$docti = new DocTi($dbOracle);	
	


	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $docti->GetIdInfo($_POST[p_DocTi_Id]);
	}
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$docti->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_DocTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($docti->GetLabel('Nome'),'text',array("name"=>'p_Nome', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[NOME]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$adocTi = $docti->GetInfo();
	
		if(is_array($adocTi))			
		{
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			foreach ($adocTi as $row)
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($docti,$row[ID]));
				$grid->Content($view->Delete($docti,$row[ID]));

			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($docti);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>