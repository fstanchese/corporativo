<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Lista de LOG�s","GOS - Lista de LOG�s",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);



	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);


	//Instanciar formul�rio
	$form = new Form(array("method"=>"GET"));

		$form->Fieldset();
	
			$form->Input("Usu�rio",'text', array("name"=>'usuario_busca', "class"=>"size40", "value"=>$_GET[usuario_busca]));
			$form->Input("IP",'text', array("name"=>'ip', "class"=>"size40", "value"=>$_GET[ip]));
			$form->Input("Objeto",'text', array("name"=>'objeto_busca', "class"=>"size40", "value"=>$_GET[objeto_busca]));
			$form->LabelMultipleInput("Per�odo");
			$form->MultipleInput("",'text', array("name"=>'periodo_busca1', "class"=>"size80 data", "value"=>$_GET[periodo_busca1]));
			$form->MultipleInput("a",'text', array("name"=>'periodo_busca2', "class"=>"size80 data", "value"=>$_GET[periodo_busca2]));
			
			$form->Button("submit",array("name"=>"buscar", "value"=>"Buscar"));
			
		$form->CloseFieldset ();	
		
	//fecha formul�rio
	unset ($form);
	
	
	
	

	if($_GET[usuario_busca]) 	$sql_plus .= " AND lower(us) like '".strtr(strtolower($_GET[usuario_busca])," '",'% ')."%'";
	if($_GET[ip])				$sql_plus .= " AND lower(ip) like '".strtr(strtolower($_GET[ip_busca])," '",'% ')."%'";
	if($_GET[objeto_busca])		$sql_plus .= " AND lower(parametros) like '%".strtr(strtolower($_GET[objeto_busca])," '",'% ')."%'";
	if($_GET[periodo_busca1])
	{
		if($_GET[periodo_busca2] == '') $_GET[periodo_busca2] = $_GET[periodo_busca1];
		$sql_plus .= " AND trunc(dt) between '".$_GET[periodo_busca1]."' and '".$_GET[periodo_busca2]."'";
	}
	
	$sql = "SELECT parametros, pagina, ip, us, trunc(dt) as data, id FROM  usjtlog WHERE 1=1  ".$sql_plus." ORDER BY id DESC";

	

		$dbData->Get($sql);
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Usu�rio","IP","Data","A��o"));
			
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page]))
			{
				
				$grid->Content($row[US],array("width"=>"10%"));
				$grid->Content($row[IP],array("width"=>"10%"));
				$grid->Content($row[DATA],array("width"=>"15%"));
				$grid->Content($row[PARAMETROS],array("width"=>"75%"));
				
				
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