<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Remessa de Boletos","Cadastro de Remessa de Boletos",array('ADM','CPD'),$user);

	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/Remessa.class.php");



	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	
	$nav = new Navigation($user, $app, $dbData);

	
	$remessa = new Remessa($dbOracle);	
	

	 
	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($remessa->Query("qId",array("p_Remessa_Id"=>$_POST[p_Remessa_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	
	if($_GET["p_Remessa_Id"] != "") $linhaSelected[REMESSA_ID] = $_GET["p_Remessa_Id"]; 
	
	
		
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$remessa->IUD($_POST);
	
	
	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('', 'hidden',	array("name"=>'p_Remessa_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Nome da Remessa',	'text',	array("name"=>'p_Nome', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[NOME]));
			
			$form->Input('Data de Envio da Remessa', 'datetime', array("name"=>'p_DtEnvio',"class"=>"size20","value"=>$linhaSelected[DTENVIO]));

			
		$form->CloseFieldset ();
				
		$form->Fieldset();
				
	 		$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
	
		$dbData->Get($remessa->Query('qGeral',array("p_Remessa_Id"=>$_GET[p_Remessa_Id])));
	
		if($dbData->Count () > 0)
		{
			$grid = new DataGrid(array("Remessa","Enviada Em","Editar","Del"));
			
			while($row = $dbData->RowLimit ($_GET[page],15))
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($row[DTENVIO],array('align'=>'left'));
				$grid->Content($view->Edit($remessa,$row[ID]));
				if($row[DTENVIO] == '')
				{  	
					$grid->Content($view->Delete($remessa,$row[ID]));
				}  				  
				else
				{						 
			    	$grid->Content('<strong>Está em Uso</strong>');
				}    		
								  				
			}
		}
		
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
	}
	
	unset($view);	
	unset($remessa);	
	unset($nav);		
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);
	
?>