<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Eventos da Agenda do Departamento","Consulta de Eventos da Agenda do Departamento",array('ADM','CPD','AGENDA','AGENDAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Agenda.class.php");
	
	
	//Conectar o usuбrio ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$dbData2 = new DbData($dbOracle);
	
	
	$agenda = new Agenda($dbOracle);
	
	//Instanciar a Navegaзгo da Pбgina
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View й necessбrio passar o Titulo da Pбgina
	$view = new ViewPage($app->title,$app->description);
	
	//$view->IncludeJS (array ("agenda.js"));
	
	//Para montar o Header precisa passar o nome do Usuбrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);

	
	$view->SubTitle("Usuбrio: ".$_GET[user]);
	

	echo $view->Ul(array("class"=>"tabs"));
	echo	$view->Li(array("idr"=>"1","class"=>"bgGeneral tabsHover")) . "Em Andamento / Prуximos" . $view->CloseLi();
	echo	$view->Li(array("idr"=>"2","class"=>"bgGeneral")) . "Atrasados" . $view->CloseLi();
	echo 	$view->Li(array("idr"=>"3","class"=>"bgGeneral")) . "Concluнdos" . $view->CloseLi();
	echo $view->CloseUl();
		
	echo $view->Div(array("class"=>"tabContent","idr"=>"1"));
			
		$dbData->Get($agenda->Query('qAndamento',array('p_Depart_Id'=>$user->GetCurrDept(),'p_Campus_Destino_Id'=>$user->GetCurrUnit())));
					
		while ($row = $dbData->Row())
		{
			echo $view->Div(array("class"=>"openAgenda")) . $agenda->GetAgendaInfo($row[ID]) . $view->CloseDiv();						
		}
		
	echo $view->CloseDiv();
	
	echo $view->Div(array("class"=>"tabContent","idr"=>"2"));
			
				
		$dbData->Get($agenda->Query('qNaoConcluida',array('p_Depart_Id'=>$user->GetCurrDept(),'p_Campus_Destino_Id'=>$user->GetCurrUnit())));
	
		while ($row = $dbData->Row())
		{
			echo $agenda->GetAgendaInfo($row[ID]);
		}
				
	echo $view->CloseDiv();
	
	echo $view->Div(array("class"=>"tabContent","idr"=>"3"));
	
		$dbData->Get($agenda->Query('qConcluido',array('p_Depart_Id'=>$user->GetCurrDept(),'p_Campus_Destino_Id'=>$user->GetCurrUnit())));
		
		while ($row = $dbData->Row())
		{
			echo $agenda->GetAgendaInfo($row[ID]);
		}
		
	echo $view->CloseDiv();		
	
	unset($agenda);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>