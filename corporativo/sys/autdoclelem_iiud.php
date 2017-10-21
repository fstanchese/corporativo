<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Elementos dos Layouts de Documentos para Atestado","Elementos dos Layouts de Documentos para Atestado",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	
	include("../model/AutDocL.class.php");
	include("../model/AutDocLElem.class.php");
	
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav	 		= new Navigation($user, $app, $dbData);
	
	$autDocLElem	= new AutDocLElem($dbOracle);
	$autDocL		= new AutDocL($dbOracle);
	
	
	if($_POST[p_O_Option] == "select")
	{
	
		$linhaSelected = $autDocLElem->GetIdInfo($_POST[p_AutDocLElem_Id]);
		
	}
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	

	
	$autDocLElem->IUD($_POST);
	
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset("Elementos dos Layout do Documento");
	
		$form->Input('',		'hidden',			array("name"=>'p_AutDocLElem_Id',"value"=>$linhaSelected[ID]));

		$form->Input($autDocLElem->GetLabel("AutDocL_Id"),'select',	array("name"=>'p_AutDocL_Id',"required"=>'1', "value"=>$linhaSelected[AUTDOCL_ID],"option" => $autDocL->Calculate()));
		
		$form->Input($autDocLElem->GetLabel("Tag"),'text',	array("class"=>"size30","maxlength"=>$autDocL->GetLength("Tag"),"name"=>'p_Tag',"required"=>'1',  "value"=>$linhaSelected[TAG]));
		$form->Input($autDocLElem->GetLabel("Valor"),'text',	array("class"=>"size30","maxlength"=>$autDocL->GetLength("Valor"),"name"=>'p_Valor',"required"=>'1',  "value"=>$linhaSelected[VALOR]));
		
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	unset ($form);
	
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aRow = $autDocLElem->GetInfo();
	
		$grid = new DataGrid(array("Layout","Tag", "Valor", "Editar","Del"));
				
		foreach($aRow as $row)
		{
			
			$grid->Content($row[AUTDOCL_NOME],array('align'=>'left'));
			$grid->Content($row[TAG],array('align'=>'left'));
			$grid->Content($row[VALOR],array('align'=>'center'));
			
			$grid->Content($view->Edit($autDocLElem,$row[ID]),array("width"=>"5%"));
			$grid->Content($view->Delete($autDocLElem,$row[ID]),array("width"=>"5%"));
		
		}
		
		
		unset($grid);
	}
	

	
	unset($autDocLElem);
	unset($autDocL);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);
	

?>