<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Layouts de Documentos para Atestado","Layouts de Documentos para Atestado",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	
	include("../model/AutDocL.class.php");
	include("../model/AutDocTi.class.php");
	include("../model/Ano.class.php");
	
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$autDocL	= new AutDocL($dbOracle);
	$ano		= new Ano($dbOracle);
	$autDocTi	= new AutDocTi($dbOracle);
	
	
	if($_POST[p_O_Option] == "select")
	{
		
		$linhaSelected = $autDocL->GetIdInfo($_POST[p_AutDocL_Id]);
		$linhaSelected[LAYOUT] = $linhaSelected[LAYOUT]->load();
	}
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	

	//print_r($_POST); die();
	
	$autDocL->IUD($_POST);
	
	
	$view->Header($user,$nav);
	
	$form = new Form();
	
	$form->Fieldset("Layout do Documento");
	
		$form->Input('',		'hidden',			array("name"=>'p_AutDocL_Id',"value"=>$linhaSelected[ID]));
		
		$form->Input($autDocL->GetLabel("AutDocTi_Id"),'select',	array("name"=>'p_AutDocTi_Id',"required"=>'1', "value"=>$linhaSelected[AUTDOCTI_ID],"option" => $autDocTi->Calculate()));
		
		$form->Input($autDocL->GetLabel("Ano_Id"),'select',	array("name"=>'p_Ano_Id',"required"=>'1', "value"=>$linhaSelected[ANO_ID],"option" => $ano->Calculate()));
		
		$form->Input($autDocL->GetLabel("DtInicio"),'date',	array("name"=>'p_DtInicio',"required"=>'1',  "value"=>$linhaSelected[DTINICIO]));
		
		$form->Input($autDocL->GetLabel("DtTermino"),'date',	array("name"=>'p_DtTermino',"required"=>'1',  "value"=>$linhaSelected[DTTERMINO]));
		
		$form->Input($autDocL->GetLabel("Descricao"),'text',	array("class"=>"size50","maxlength"=>$autDocL->GetLength("Descricao"),"name"=>'p_Descricao',"required"=>'1',  "value"=>$linhaSelected[DESCRICAO]));
		
		$form->Input($autDocL->GetLabel("Layout"),'textarea',	array("class"=>"size90","name"=>'p_Layout',"required"=>'1',  "value"=>stripslashes($linhaSelected[LAYOUT])));
		
		
	$form->CloseFieldset ();
		
	$form->Fieldset();
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	unset ($form);
	
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aRow = $autDocL->GetInfo();
	
		$grid = new DataGrid(array("Tipo Documento","Descriзгo", "Data Inнcio", "Data Fim", "Editar","Del"));
				
		foreach($aRow as $row)
		{
			
			$grid->Content($row[AUTDOCTI_NOME],array('align'=>'left'));
			$grid->Content($row[DESCRICAO],array('align'=>'left'));
			$grid->Content($row[DTINICIO],array('align'=>'center'));
			$grid->Content($row[DTTERMINO],array('align'=>'center'));
			
			$grid->Content($view->Edit($autDocL,$row[ID]),array("width"=>"5%"));
			$grid->Content($view->Delete($autDocL,$row[ID]),array("width"=>"5%"));
		
		}
		
		
		unset($grid);
	}
	

	
	unset($autDocL);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);
	

?>