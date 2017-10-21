<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Diponibilidade de horсrio do professor","Diponibilidade de horсrio do professor",array('ADM'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/ProfDisponivel.class.php");
	include("../model/PLetivo.class.php");

	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);

	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$profDisponivel = new profDisponivel($dbOracle);
	$pLetivo = new pLetivo($dbOracle);
	
	//se o p_O_Option for  == select - entуo 1 linha foi selecionada
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
	
	//Quando cria o objeto View щ necessсrio passar o Titulo da Pсgina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$profDisponivel->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulсrio
	$form = new Form();
	
	$form->Fieldset();
	
		$form->Input('','hidden',array("name"=>'p_ProfDisponivel_Id',"value"=>$linhaSelected[ID]));
		$form->Input('Professor','isel',array("name"=>"p_WPessoa","href"=>"../box/wpessoa_iselprof.php","submit"=>"true","value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_LABEL]));
		$form->Input("Perэodo Letivo",'select',array('name'=>'p_PLetivo_Id','value'=>$linhaSelected[PLETIVO_ID],"option"=>$pLetivo->Calculate("Geral",$dbData)));
		$form->Input('Confirmado','checkbox',array('name'=>'p_Confirmado',"checked"=>$linhaSelected[CONFIRMADO],"value"=>'on'));
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	// Botѕes de aчуo
	$form->IUDButtons();
	$form->CloseFieldset();
	
	//fecha formulсrio
	unset($form);

	//Consultas deverуo ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
	
		//Chamando o mщtodo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($profDisponivel->Query('qWPessoa',array("p_WPessoa_Id"=>$_GET[p_WPessoa_Id],"p_PLetivo_Id"=>$_GET[p_PLetivo_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count() > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome","Confirmado","Editar","Excluir"));
	
			//Obtъm as linhas da execuчуo do arquivo .sql
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