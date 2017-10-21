<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Banco","Cadastro de Banco",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/Banco.class.php");

	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$banco = new Banco($dbOracle);	
	


	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($banco->Query("qId",array("p_Banco_Id"=>$_POST[p_Banco_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	if($_GET["p_Banco_Id"] != "") $linhaSelected[ID] = $_GET["p_Banco_Id"]; 
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	if(($_POST["p_O_Option"] == "insert" || $_POST["p_O_Option"] == "update" ) && $_POST["p_Ativo"] == "")
		$_POST["p_Ativo"] = "off";
	
		
	 	
	$banco->IUD($_POST);

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_Banco_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Número','text',array("name"=>'p_Numero', "class"=>"size10", "maxlenght"=>4, "required"=>'1',"value"=>$linhaSelected[NUMERO]));
			
			$form->Input('Nome','text',	array("name"=>'p_Nome', "class"=>"size50", "maxlenght"=>50, "value"=>$linhaSelected[NOME]));
						
			$form->Input('Ativo','checkbox',array("name"=>'p_Ativo', "checked"=>$linhaSelected[ATIVO], "value"=>$linhaSelected[ATIVO]));
				
			
		$form->CloseFieldset ();
		$form->Fieldset();			
			$form->IUDButtons();						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$aBanco = $banco->GetInfo();
	
		if(is_array($aBanco))
		{
			$grid = new DataGrid(array("Número","Nome","Ativo","Editar","Del"));
			
			foreach($aBanco as $row)
			{				
				$grid->Content($row[NUMERO],array('align'=>'left'));
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->OnOff($row[ATIVO]),array('align'=>'center'));
				$grid->Content($view->Edit($banco,$row[ID]));
				$grid->Content($view->Delete($banco,$row[ID]));				  
								  				
			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($Remessa);	
	unset($nav);		
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);

?>