<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Assunto por Mesa - Controle de Atendimento","Assunto por Mesa - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Ajax.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CAAssunto.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAAssXCAMesa.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);

	$caAssunto 	= new CAAssunto($dbOracle);
	$caMesa 	= new CAMesa($dbOracle);
	$caAssMesa 	= new CAAssXCAMesa($dbOracle);
	
	


	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($caAssMesa->Query("qId",array("p_CAAssXCAMesa_Id"=>$_POST[p_CAAssXCAMesa_Id])));
		
		$linhaSelected = $dbData->Row();
		
	}
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	 	
	$caAssMesa->IUD($_POST,$dbData);
	
	$view->Header($user,$nav);


	$form = new Form();

		$form->Fieldset("Assuntos por Mesa - Controle de Atendimento");
		
			$form->Input('',	'hidden',			array("name"=>'p_CAAssXCAMesa_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($caAssMesa->GetLabel("CAAssunto_Id"),'select',array("required"=>'1',"name"=>"p_CAAssunto_Id","option"=>$caAssunto->Calculate("Geral",$dbData),"value"=>$linhaSelected[CAASSUNTO_ID]));
			$form->Input($caAssMesa->GetLabel("CAMesa_Id"),'select',array("required"=>'1',"name"=>"p_CAMesa_Id","option"=>$caMesa->Calculate("Geral",$dbData),"value"=>$linhaSelected[CAMESA_ID]));

			
			
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$acaAssMesa = $caAssMesa->GetInfo();

		if(is_array($acaAssMesa))
		{

			$grid = new DataGrid(array("Assunto","Mesa","Editar","Del"));

			foreach($acaAssMesa as $row)
			{
				
		
				$grid->Content($row[CAASSUNTO_NOME]);
				$grid->Content($row[CAMESA_NOME]);
				$grid->Content($view->Edit($caAssMesa,$row[ID]));
				$grid->Content($view->Delete($caAssMesa,$row[ID]));
			}
		}
		
		unset($grid);
		
	}

	unset($caAssunto);
	unset($caMesa);
	unset($caAssMesa);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>