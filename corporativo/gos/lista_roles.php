<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Lista de Roles","GOS - Lista de Roles",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);



	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Quando cria o objeto View щ necessсrio passar o Titulo da Pсgina
	$view = new ViewPage($app->title,$app->description);
	
	
	//Instanciar a Navegaчуo da Pсgina
	$nav = new Navigation($user, $app,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);


	//Instanciar formulсrio
	$form = new Form(array("method"=>"GET"));

		$form->Fieldset();
	
			$form->Input("Nome",'text', array("name"=>'nome_busca', "class"=>"size40", "value"=>$_GET[nome_busca]));
			
			$form->Button("submit",array("name"=>"buscar", "value"=>"Buscar"));
			
		$form->CloseFieldset ();	
		
	//fecha formulсrio
	unset ($form);
	
	
	
	
		
		if($_GET[nome_busca]) $sql_plus = " WHERE role like '".strtr(strtoupper($_GET[nome_busca])," '",'% ')."%'";

		$sql = "SELECT distinct(role) FROM dba_roles ".$sql_plus." ORDER BY role ASC"; // The unfiltered SELECT

		$dbData->Get($sql);
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("","","","",""),"Roles do Sistema");
			
			//Obtъm as linhas da execuчуo do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page],300))
			{
				
				$grid->Content($row[ROLE],array("width"=>"20%"));

				
			}
		}
		
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
	
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>