<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Tipos de Documentos para Atestado","Tipos de Documentos para Atestado",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	include("../model/AutDocTi.class.php");
	include("../model/CursoNivel.class.php");
	
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$autDocTi	= new AutDocTi($dbOracle);
	$cursoNivel = new CursoNivel($dbOracle);
	
	
	if($_POST[p_O_Option] == "select")
	{
		$linhaSelected = $autDocTi->GetIdInfo($_POST[p_AutDocTi_Id]);
	}
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	

	
	$autDocTi->IUD($_POST);
	
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset("Tipos de Documento");
	
		$form->Input('',		'hidden',			array("name"=>'p_AutDocTi_Id',"value"=>$linhaSelected[ID]));
		
		$form->Input($autDocTi->GetLabel("Nome"),'text',	array("name"=>'p_Nome',"required"=>'1',"maxlength"=>$autDocTi->GetLength("Nome"), "class"=>"size40", "value"=>$linhaSelected[NOME]));
		$form->Input($autDocTi->GetLabel("CursoNivel_Id"),'select',array("required"=>'1',"name"=>"p_CursoNivel_Id","option"=>$cursoNivel->Calculate("Geral"),"value"=>$linhaSelected[CURSONIVEL_ID]));
		
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	unset ($form);
	
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aRow = $autDocTi->GetInfo();
	
	
		
		$grid = new DataGrid(array("Nome", "Editar","Del"));
				
		foreach($aRow as $row)
		{
		
			$grid->Content($row[NOME],array('align'=>'left'));
			$grid->Content($view->Edit($autDocTi,$row[ID]),array("width"=>"5%"));
			$grid->Content($view->Delete($autDocTi,$row[ID]),array("width"=>"5%"));
		
		}
		
		
		unset($grid);
	}
	

	
	unset($autDocTi);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);
	

?>