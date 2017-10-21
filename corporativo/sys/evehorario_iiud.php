<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User();
	$app = new App("Cadastro de Hor�rio - Eventos", "Cadastro de Hor�rio - Eventos", array('ADM','CPD', 'CPDEST'), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/EveHorario.class.php");
	
	$dbOracle = new Db($user);
	$dbData = new DbData($dbOracle);
	
	$eveHorario = new EveHorario($dbOracle);
	
	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($eveHorario->Query("qId",array("p_EveHorario_Id"=>$_POST[p_EveHorario_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$eveHorario->IUD($_POST);
	
	$view->Header($user,$nav);
	
	$form = new Form();
		$form->Fieldset("Cadastro de Hor�rio - Eventos");
			$form->Input('','hidden',array("name"=>'p_EveHorario_Id',"value"=>$linhaSelected[ID]));
			$form->Input("Hor�rio",'text',array("class"=>"size8",'name'=>'p_Horario','value'=>$linhaSelected[HORARIO]));
		$form->CloseFieldset ();
	    $form->Fieldset();
			// Bot�es de a��o
			$form->IUDButtons();
		$form->CloseFieldset ();
	unset($form);		
	
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
		
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($eveHorario->Query('qGeral'));
		
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{

			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Hor�rio","Editar","Excluir"));
		
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($eveHorario,$row[ID]));
				$grid->Content($view->Delete($eveHorario,$row[ID]));
			}
		}
		
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
		
	}
	
	unset($eveHorario);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>