<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	

	$user = new User ();	
	$app = new App("Cadastro dos Departamentos","Cadastro dos Departamentos",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Depart.class.php");	

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app);
	
	//Instanciar a classe que irá utilizar
	$depart = new Depart($dbOracle);

	//se o p_O_Option for  == select - então 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($depart->Query("qId",array("p_Depart_Id"=>$_POST[p_Depart_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	if($_GET["p_WPessoa_Id"] != "")
	{
		$linhaSelected[WPESSOA_ID] = $_GET["p_WPessoa_Id"];
		$linhaSelected[WPESSOA_LABEL] = $_GET["p_WPessoa_Label"];
	}
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$depart->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulário
	$form = new Form();	

		$form->Fieldset();
			$form->Input('','hidden',array("name"=>'p_Depart_Id',"value"=>$linhaSelected[ID]));
	
			$form->Input("Nome do Departamento",'text',array('name'=>'p_Nome',"required"=>'1','value'=>$linhaSelected[NOME]));
			$form->Input("Pertencente ao Departamento ",'select',array("name"=>'p_Depart_Pai_Id',"value"=>$linhaSelected[DEPART_PAI_ID], "option"=>$depart->Calculate("Geral",$dbData)));
			$form->Input("Nome Reduzido",'text',array('name'=>'p_NomeReduz',"required"=>'1','value'=>$linhaSelected[NOMEREDUZ]));
			$form->Input('Encarregado','isel',array("name"=>"p_WPessoa","href"=>"../sel/wpessoa_iselfunc.php","submit"=>"true","value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_LABEL]));
			$form->Input("E-mail",'text',array('name'=>'p_email','value'=>$linhaSelected[EMAIL]));
				
		$form->CloseFieldset ();
	
		$form->Fieldset();
		
		// Botões de ação
		$form->IUDButtons();
			
		$form->CloseFieldset ();
		
	//fecha formulário
	unset($form);
	
	//Consultas deverão ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
	
		//Chamando o método Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($depart->Query('qGeral'));
	
		//Se a consulta possuir resultados
		if($dbData->Count() > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome do Departamento","Editar","Excluir"));
	
			//Obtêm as linhas da execução do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($depart,$row[ID]));
				$grid->Content($view->Delete($depart,$row[ID]));
			}
		}
	
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
		
	}	
	
	unset($depart);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);	
?>	
