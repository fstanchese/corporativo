<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Eventos da Agenda do Departamento","Cadastro de Eventos da Agenda do Departamento",array('ADM','CPD','AGENDAGER'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/Agenda.class.php");
	include("../model/AgendaAss.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$agenda = new Agenda($dbOracle);	
	$agendaAss = new AgendaAss($dbOracle);
 
	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $agenda->GetIdInfo($_POST[p_Alinea_Id]);
	}
	
	if($_GET["p_Agenda_Id"] != "")
	{ 
		$linhaSelected[AGENDA_ID] = $_GET["p_Agenda_Id"]; 
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	

	$alinea->IUD($_POST);
	
	$view->Header($user,$nav);


	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_Agenda_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Alinea','text',array("name"=>'p_Alinea', "class"=>"size10", "required"=>'1',"value"=>$linhaSelected[ALINEA]));
			
			$form->Input('Motivo','text',array("name"=>'p_Motivo', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[MOTIVO]));
			

		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$dbData->Get($alinea->Query('qGeral'));
	
		if($dbData->Count () > 0)
		{
			$grid = new DataGrid(array("Alinea","Motivo","Editar","Del"));
			
			while($row = $dbData->Row())
			{
				
				$grid->Content($row[ALINEA],array('align'=>'left'));
				$grid->Content($row[MOTIVO],array('align'=>'left'));
				$grid->Content($view->Edit($alinea,$row[ID]));
				$grid->Content($view->Delete($alinea,$row[ID]));
								  				
			}
		}
		
		unset($grid);
		
		$dbData->Pagination();
	}
	
	unset($view);
	unset($alinea);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);	
	unset($user);

?>