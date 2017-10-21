<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Tipos de Carta de Cobrança","Tipos de Carta de Cobrança",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/CCobCartaTi.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$cCartaTi = new CCobCartaTi($dbOracle);
	
	if($_POST[p_O_Option] == "select")
	{
		
		$linhaSelected = $cCartaTi->GetIdInfo($_POST[p_CCobCartaTi_Id]);
		$linhaSelected[LAYOUT] = $linhaSelected[LAYOUT]->load();
	}
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	


	
	$cCartaTi->IUD($_POST);
	
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset("Tipo de Carta");
	
		$form->Input('',		'hidden',			array("name"=>'p_CCobCartaTi_Id',"value"=>$linhaSelected[ID]));
		
		
		$form->Input($cCartaTi->GetLabel("Nome"),'text',	array("name"=>'p_Nome',"required"=>'1', "value"=>$linhaSelected[NOME]));
		
		
		$form->Input($cCartaTi->GetLabel("Layout"),'textarea',	array("class"=>"size90","name"=>'p_Layout',"required"=>'1',  "value"=>stripslashes($linhaSelected[LAYOUT])));
		
		
	$form->CloseFieldset ();
		
	$form->Fieldset();
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	unset ($form);
	
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aRow = $cCartaTi->GetInfo();
	
		$grid = new DataGrid(array("Nome", "Editar","Del"));
				
		foreach($aRow as $row)
		{
			
			$grid->Content($row[NOME],array('align'=>'left'));
			
			
			$grid->Content($view->Edit($cCartaTi,$row[ID]),array("width"=>"5%"));
			$grid->Content($view->Delete($cCartaTi,$row[ID]),array("width"=>"5%"));
		
		}
		
		
		unset($grid);
	}
	

	
	unset($cCartaTi);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);
	

?>