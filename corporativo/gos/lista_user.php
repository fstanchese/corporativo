<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Lista de Usuários","GOS - Lista de Usuários",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);


	//Instanciar formulário
	$form = new Form(array("method"=>"GET"));

		$form->Fieldset();
	
			$form->Input("Nome",'text', array("name"=>'nome_busca', "class"=>"size40", "value"=>$_GET[nome_busca]));
			$form->Input("User",'text', array("name"=>'user_busca', "class"=>"size40", "value"=>$_GET[user_busca]));
			$form->Input("Role",'text', array("name"=>'role_busca', "class"=>"size40", "value"=>$_GET[role_busca]));
			
			$form->Button("submit",array("name"=>"buscar", "value"=>"Buscar"));
			
		$form->CloseFieldset ();	
		
	//fecha formulário
	unset ($form);
	
	
	
	
		
		if($_GET[nome_busca]) $sql_plus = " AND lower(nome) like '".strtr(strtolower($_GET[nome_busca])," '",'% ')."%'";
		
		if($_GET[user_busca]) $sql_plus .= " AND grantee like '".strtr(strtoupper($_GET[user_busca])," '",'% ')."%'";
		
		if($_GET[role_busca]) $sql_plus .= " AND granted_role like '".strtr(strtoupper($_GET[role_busca])," '",'% ')."%'";
		
		
		$sql = "SELECT teste.id, grantee, teste.nome, teste.usuario, LISTAGG(granted_role, ',') WITHIN GROUP (ORDER BY granted_role) as role
				FROM dba_role_privs, ( select wpessoa.id, wpessoa.nome, Upper(usuario) as usuario from wpessoa where wpessoa.usuario is not null) teste
				WHERE teste.usuario = UPPER(dba_role_privs.grantee) ".$sql_plus."
				GROUP BY teste.id, teste.nome, teste.usuario, grantee
				ORDER BY teste.nome ASC";

	

		$dbData->Get($sql);
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome","Usuário","ROLES"));
			
			//Obtêm as linhas da execução do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page]))
			{
				
				$grid->Content("<a href='user_detalhe.php?user=".$row[USUARIO]."'>".$row[NOME]."</a>",array("width"=>"30%"));
				$grid->Content($row[GRANTEE],array("width"=>"30%"));
				
				$rolesUser = explode(",",$row[ROLE]);
				
				$html = "";
				foreach($rolesUser as $role)
				{
					$html .= "[<a href='role_detalhe.php?role=".$role."'>".$role."</a>] ";
						
				}
				
				$grid->Content($html,array("width"=>"40%"));
				
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