<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Alinea","Cadastro de Alinea",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/Alinea.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$alinea = new Alinea($dbOracle);	
	

 
	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $alinea->GetIdInfo($_POST[p_Alinea_Id]);
	}
	
	if($_GET["p_Alinea_Id"] != "")
	{ 
		$linhaSelected[ALINEA_ID] = $_GET["p_Alinea_Id"]; 
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	

	$alinea->IUD($_POST);
	
	$view->Header($user,$nav);


	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_Alinea_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Alinea','text',array("name"=>'p_Alinea', "class"=>"size10", "required"=>'1',"value"=>$linhaSelected[ALINEA]));
			
			$form->Input('Motivo','text',array("name"=>'p_Motivo', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[MOTIVO]));
			

		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aCons = $alinea->GetInfo();
	
		$grid = new DataGrid(array("Alinea","Motivo","Editar","Del"));
			
		foreach($aCons as $row)
		{
				
			$grid->Content($row[ALINEA],array('align'=>'left'));
			$grid->Content($row[MOTIVO],array('align'=>'left'));
			$grid->Content($view->Edit($alinea,$row[ID]));
			$grid->Content($view->Delete($alinea,$row[ID]));
								  				
		}
		
		unset($grid);
		
	}
	
	unset($view);
	unset($alinea);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);	
	unset($user);

?>