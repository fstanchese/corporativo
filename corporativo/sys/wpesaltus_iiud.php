<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de usuсrios alterados no sistema","Cadastro de usuсrios alterados no sistema",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/WPesAltUs.class.php");
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	//
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$WPesAltUs = new WPesAltUs($dbOracle);

	//se o p_O_Option for  == select - entуo 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($WPesAltUs->Query("qId",array("p_WPesAltUs_Id"=>$_POST[p_WPesAltUs_Id])));
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
	$WPesAltUs->IUD($_POST);
	
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulсrio
	$form = new Form();	

		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_WPesAltUs_Id',"value"=>$linhaSelected[ID]));
			$form->Input('Nome','isel',array("name"=>"p_WPessoa","href"=>"../box/wpessoa_iselfunc.php","submit"=>"true","value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_LABEL]));
            $form->Input("Usuсrio Antigo",'text',array('name'=>'p_UsOld',"required"=>'1','value'=>$linhaSelected[USOLD]));
            $form->Input("Usuсrio Novo",'text',array('name'=>'p_UsNew',"required"=>'1','value'=>$linhaSelected[USNEW]));
			$form->Input("Observaчуo",'text',array("class"=>"size90",'name'=>'p_Obs','value'=>$linhaSelected[OBS]));			
	
		$form->CloseFieldset ();
	
		$form->Fieldset();
			// Botѕes de aчуo
		    $form->IUDButtons();
		$form->CloseFieldset ();
		
	//fecha formulсrio
	unset($form);
	
	//Consultas deverуo ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
	
		//Chamando o mщtodo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($WPesAltUs->Query('qGeral'));
	
		//Se a consulta possuir resultados
		if($dbData->Count() > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome","Editar","Excluir"));
	
			//Obtъm as linhas da execuчуo do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($WPesAltUs,$row[ID]));
				$grid->Content($view->Delete($WPesAltUs,$row[ID]));
			}
		}
	
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
		
	}	
	
	unset($WPesAltUs);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);	
?>