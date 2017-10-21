<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro do Sub-Menu do Mapa","Cadastro do Sub-Menu do Mapa",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Mapa.class.php");
	include("../model/MapaSub.class.php");

	$dbOracle 	= new Db ($user);	
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$mapa   	= new Mapa($dbOracle);
	$mapaSub	= new MapaSub($dbOracle);

	
	//
	if($_POST[p_O_Option] == "select")
	{
		$linhaSelected = $mapaSub->GetIdInfo($_POST[p_MapaSub_Id]);
	}
	
    if($_GET["p_MapaSub_Id"] != "") 
    { 
    	$linhaSelected[MAPA_ID] = $_GET["p_Mapa_Id"];
    }
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$mapaSub->IUD($_POST,$dbData);
	

	$view->Header($user,$nav);
	
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_MapaSub_Id',"value"=>$linhaSelected[ID]));

			$form->Input("Menu",'select',array("name"=>'p_Mapa_Id',"value"=>$linhaSelected[MAPA_ID], "option"=>$mapa->calculate("Geral",$dbData)));
			$form->Input("Sub-Menu",'text',array("class"=>"size50",'name'=>'p_Nome','value'=>$linhaSelected[NOME]));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();
		
			$form->IUDButtons();
					
		$form->CloseFieldset ();
			
	unset($form);
		
	if($_GET["p_O_Option"] == "search" || $_GET[p_Cheque_Id] != '')
	{	
	
		$aMapaSub = $mapaSub->GetInfo();
	
		if(is_array($aMapaSub))			
		{
	
			$grid = new DataGrid(array("Menu","Sub-Menu","Editar","Excluir"));
	
			foreach($aMapaSub as $key => $aArr)
			{
				$grid->Content($aArr[MAPA_NOME],array('align'=>'left'));
				$grid->Content($aArr[NOME],array('align'=>'left'));				
				$grid->Content($view->Edit($mapaSub,$aArr[ID]));
				$grid->Content($view->Delete($mapaSub,$aArr[ID]));
			}
		}

		unset($grid);	
		
	}	

	unset($mapa);
	unset($mapaSub);	
	unset($dbData);	
	unset($dbOracle);
	unset($user);
?>