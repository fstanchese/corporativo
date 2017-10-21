<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Calendсrio de Eventos do Departamento","Calendсrio de Eventos do Departamento",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Agenda.class.php");
	
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$dbData2 = new DbData($dbOracle);
	
	
	$agenda = new Agenda($dbOracle);
	
	//Instanciar a Navegaчуo da Pсgina
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View щ necessсrio passar o Titulo da Pсgina
	$view = new ViewPage($app->title,$app->description);
	
	//$view->IncludeJS (array ("agenda.js"));
	
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	
	
	$view->Header($user);

	$view->IncludeJS("agenda.js");
	$view->IncludeCSS("agenda.css");
	
	echo $agenda->GetAgendaCalFormat(date('d/m/Y'),$user->GetCurrDept());
	//echo $agenda->GetAgendaCalFormat('01/11/2013');


	unset($agenda);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>