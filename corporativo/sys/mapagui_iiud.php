<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro das Páginas do Mapa","Cadastro das Páginas do Mapa",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/MapaSub.class.php");	
	include("../model/MapaGUI.class.php");
	include("../model/IndexGUI.class.php");

	$dbOracle 	= new Db ($user);	
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	
	$mapaSub	= new MapaSub($dbOracle);
	$mapaGUI   	= new MapaGUI($dbOracle);
	$indexGUI	= new IndexGUI($dbOracle);
		

	if($_POST[p_O_Option] == "select")
	{
		$linhaSelected = $mapaGUI->GetIdInfo($_POST[p_MapaGUI_Id]);
	}
	
    if($_GET["p_MapaSub_Id"] != "") 
    { 
    	$linhaSelected[MAPAGUI_ID] = $_GET["p_MapaGUI_Id"];
    }
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$mapaGUI->IUD($_POST,$dbData);
	

	$view->Header($user,$nav);
	
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_MapaGUI_Id',"value"=>$linhaSelected[ID]));

			$form->Input("Menu",'select',array("name"=>'p_MapaSub_Id',"value"=>$linhaSelected[MAPASUB_ID], "option"=>$mapaSub->calculate("Geral",$dbData)));
			$form->Input("Página",'autocomplete',array("required"=>1,"execute"=>"IndexGUI.AutoCompletaNome","name"=>'p_IndexGUI_Id', "class"=>"size70", "required"=>'1',"value"=>$linhaSelected[INDEXGUI_ID],"label"=>$linhaSelected[INDEXGUI_NOME]));
			$form->Input("Abrir na mesma Janela?",'onoff',array("name"=>'p_LinkBox',"value"=>$linhaSelected[LINKBOX]));
			
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();
		
			$form->IUDButtons();
					
		$form->CloseFieldset ();
			
	unset($form);
		
	if($_GET["p_O_Option"] == "search" || $_GET[p_Cheque_Id] != '')
	{	
	
		$aMapaGUI = $mapaGUI->GetInfo();
	
		if(is_array($aMapaGUI))			
		{
	
			$grid = new DataGrid(array("Menu","Página","Abrir na mesma Janela?","Editar","Excluir"));
	
			foreach($aMapaGUI as $key => $aArr)
			{
				$grid->Content($aArr[MAPASUB_NOME],array('align'=>'left'));
				$grid->Content($indexGUI->Recognize($aArr[INDEXGUI_ID],'Desc'),array('align'=>'left'));
				$grid->Content($view->OnOff($aArr[LINKBOX]));				
				$grid->Content($view->Edit($mapaGUI,$aArr[ID]));
				$grid->Content($view->Delete($mapaGUI,$aArr[ID]));
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