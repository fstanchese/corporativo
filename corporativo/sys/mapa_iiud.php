<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro do Menu do Mapa","Cadastro do Menu do Mapa",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Mapa.class.php");

	$dbOracle 	= new Db ($user);	
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$mapa   	= new Mapa($dbOracle);

	
	//
	if($_POST[p_O_Option] == "select")
	{
		$linhaSelected = $mapa->GetIdInfo($_POST[p_Mapa_Id]);
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$mapa->IUD($_POST);
	

	$view->Header($user,$nav);
	
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_Mapa_Id',"value"=>$linhaSelected[ID]));

			$form->Input("Menu",'text',array("class"=>"size50",'name'=>'p_Nome','value'=>$linhaSelected[NOME]));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();
		
			$form->IUDButtons();
					
		$form->CloseFieldset ();
			
	unset($form);
		
	if($_GET["p_O_Option"] == "search")
	{	
	
		$aMapa = $mapa->GetInfo();
	
		if(is_array($aMapa))
		{
	
			$grid = new DataGrid(array("Nome","Editar","Excluir"));
	
			foreach($aMapa as $key => $aArr)
			{
				$grid->Content($aArr[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($mapa,$aArr[ID]));
				$grid->Content($view->Delete($mapa,$aArr[ID]));
			}
		}

		unset($grid);	
		
	}	


	unset($mapa);
	unset($dbData);	
	unset($dbOracle);
	unset($user);
?>