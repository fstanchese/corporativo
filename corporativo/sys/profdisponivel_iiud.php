<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Diponibilidade de hor�rio do professor","Diponibilidade de hor�rio do professor",array('ADM'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/ProfDisponivel.class.php");
	include("../model/PLetivo.class.php");

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);

	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a classe que ir� utilizar
	$profDisponivel = new profDisponivel($dbOracle);
	$pLetivo = new pLetivo($dbOracle);
	
	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($profDisponivel->Query("qId",array("p_ProfDisponivel_Id"=>$_POST[p_ProfDisponivel_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	if($_GET["p_WPessoa_Id"] != "")
	{
		$linhaSelected[WPESSOA_ID] = $_GET["p_WPessoa_Id"];
		$linhaSelected[WPESSOA_LABEL] = $_GET["p_WPessoa_Label"];
	}
	
	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$profDisponivel->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formul�rio
	$form = new Form();
	
	$form->Fieldset();
	
		$form->Input('','hidden',array("name"=>'p_ProfDisponivel_Id',"value"=>$linhaSelected[ID]));
		$form->Input('Professor','isel',array("name"=>"p_WPessoa","href"=>"../box/wpessoa_iselprof.php","submit"=>"true","value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_LABEL]));
		$form->Input("Per�odo Letivo",'select',array('name'=>'p_PLetivo_Id','value'=>$linhaSelected[PLETIVO_ID],"option"=>$pLetivo->Calculate("Geral",$dbData)));
		$form->Input('Confirmado','checkbox',array('name'=>'p_Confirmado',"checked"=>$linhaSelected[CONFIRMADO],"value"=>'on'));
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	// Bot�es de a��o
	$form->IUDButtons();
	$form->CloseFieldset();
	
	//fecha formul�rio
	unset($form);

	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
	
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($profDisponivel->Query('qWPessoa',array("p_WPessoa_Id"=>$_GET[p_WPessoa_Id],"p_PLetivo_Id"=>$_GET[p_PLetivo_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count() > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome","Confirmado","Editar","Excluir"));
	
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($row[CONFIRMADO],array('align'=>'left'));
				$grid->Content($view->Edit($profDisponivel,$row[ID]));
				$grid->Content($view->Delete($profDisponivel,$row[ID]));
			}
		}
	
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
		
	}	
	
	unset($profDisponivel);
	unset($pLetivo);
	unset($dbData);
	unset($dbOracle);
	unset($user);
?>