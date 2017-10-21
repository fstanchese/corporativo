<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Mapa Acadêmico, Financeiro e Administrativo","Mapa Acadêmico, Financeiro e Administrativo",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Navigation.class.php");
	
	include("../model/Mapa.class.php");
	include("../model/MapaSub.class.php");
	include("../model/MapaGUI.class.php");
	include("../model/IndexGUI.class.php");
	

	$dbOracle 	= new Db ($user);	
	$dbData 	= new DbData ($dbOracle);
	
	$nav 		= new Navigation($user, $app, $dbData);
	
	$mapa   	= new Mapa($dbOracle);
	$mapaSub  	= new MapaSub($dbOracle);
	$mapaGUI	= new MapaGUI($dbOracle);
	$indexGUI	= new IndexGUI($dbOracle);
	
	
	$nav = new Navigation($user, $app, $dbData);


	$view = new ViewPage($app->title,$app->description);
	$view->IncludeJS("mapa.js");
	$view->IncludeCSS("mapa.css");
	
	$view->Header($user,$nav);
	
	$aMapa = $mapa->GetInfo();

	
	echo $view->Ul();
	
	foreach($aMapa as $key => $aArrMapa)
	{
		echo $view->Li(array("class"=>"mapa")).
				$view->Div().$aArrMapa[NOME].$view->CloseDiv().
					$view->Ul();
		
		$dbData->Get($mapaSub->Query("qMapa",array("p_Mapa_Id"=>$aArrMapa[ID])));
		while ($rowSub = $dbData->Row())
		{
			
			echo $view->Li(array("class"=>"mapasub")).
				$view->Div().$rowSub[NOME].$view->CloseDiv().
					$view->Ul(array("class"=>"mapaguiul"));
		
			$dbDataAux  = new DbData ($dbOracle);
			$dbDataAux->Get($mapaGUI->Query("qMapaSub",array("p_MapaSub_Id"=>$rowSub[ID])));
			while ($rowGUI = $dbDataAux->Row())
			{
				
				echo $view->Li(array("class"=>"mapagui")).$indexGUI->GetLink($rowGUI[INDEXGUI_ID]).$view->CloseLi();
			}
			unset($dbDataAux);
			
			echo $view->CloseUl().$view->CloseLi();
		}
		echo $view->CloseUl().$view->CloseLi();
	}
	echo $view->CloseUl();
		
			
	
	
	unset($mapa);
	unset($mapaSub);
	unset($mapaGUI);
	unset($dbData);	
	unset($dbOracle);
	unset($user);
?>
