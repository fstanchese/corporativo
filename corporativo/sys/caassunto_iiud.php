<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Assunto - Controle de Atendimento","Cadastro de Assunto - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../engine/Ajax.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CAAssunto.class.php");	
	include("../model/Campus.class.php");

	
	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	$nav = new Navigation($user, $app, $dbData);
	
	$ajax = new Ajax();

	$caEvento = new CAEvento($dbOracle);
	$caAssunto = new CAAssunto($dbOracle);
	$campus = new Campus($dbOracle);

	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $caAssunto->GetIdInfo($_POST[p_CAAssunto_Id]);
		$aAux = $caEvento->GetIdInfo($linhaSelected["CAEVENTO_ID"]);
		
		$linhaSelected[CAMPUS_ID] = $aAux[CAMPUS_ID];
	}
	
	if($_GET["p_CAAssunto_Id"] != "") $linhaSelected[ID] = $_GET["p_CAAssunto_Id"]; 
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
		
	$caAssunto->IUD($_POST);
	
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Assunto - Controle de Atendimento");
		
			$form->Input('',		'hidden',			array("name"=>'p_CAAssunto_Id',"value"=>$linhaSelected[ID]));
		
			$form->Input('Unidade',
					'select',
					array("name"=>'p_Campus_Id',  "value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral")));

			$form->Input('Evento',
					'select',
					array("name"=>'p_CAEvento_Id', "value"=>$linhaSelected[CAEVENTO_ID], "option"=>array(""=>"Selecione o Evento")));
				
			$ajax->InputRequired("p_Campus_Id","p_CAEvento_Id","change",$caEvento->query["qGeral"],array("p_Campus_Id"=>"p_Campus_Id"),$linhaSelected[CAEVENTO_ID]);
			
			$form->Input('Descriчуo','text',array("required"=>'1',"name"=>'p_Descricao', "value"=>$linhaSelected[DESCRICAO], "class"=>"size70"));
		
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
	//Consultas deverуo ser feitas somente se p_O_Option == 'search'
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$aCons = $caAssunto->GetInfo();
		if (is_array($aCons))
		{
	
			$grid = new DataGrid(array("Evento","Descriчуo","Editar","Del"));
			
			foreach ($aCons as $row)
			{
				$grid->Content($row[CAEVENTO_NOME],array('align'=>'left'));
				$grid->Content($row[DESCRICAO],array('align'=>'left'));
				$grid->Content($view->Edit($caAssunto,$row[ID]));
				$grid->Content($view->Delete($caAssunto,$row[ID]));
			}

			unset($grid);
		}
	}
	
	unset($caEvento);
	unset($caAssunto);
	unset($campus);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>