<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	
	$user = new User ();
	$app = new App("Quantidade de Evasão por Motivo e Ano","Quantidade de Evasão por Motivo e Ano",array('ADM','CPD','SAA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);
	
	$view = new ViewPage($app->title);
	
	$view->Header($user);

	include("../engine/Chart.class.php");
	
	
		
		$dbData->Get("select to_char(pesqev.dt, 'yyyy') as dt, count(*) as t, pesqevmotd.nome from pesqev, pesqevxpemd, pesqevmotd WHERE pesqev.id = pesqevxpemd.pesqev_id and pesqevmotd_id = pesqevmotd.id AND to_char(pesqev.dt, 'yyyy') >= 2012 group by to_char(pesqev.dt, 'yyyy'), pesqevmotd.nome order by 1 desc, 2 desc");		
	
		
		while($row = $dbData->Row())
		{
			$arGraph[$row[DT]][$row[NOME]] = $row[T];
			
		}
		
		
		
		$chart = new Chart();
	
		
		echo $view->Div(array("class"=>"wrapper","style"=>"width:730px"));
		
		foreach($arGraph as $ano => $array)
		{
			
			
			echo $view->H2("Evasão do Ano de ".$ano,array("style"=>"font-size:20px;text-align:center;"));
			
			echo $view->Div(array("style"=>"float:left;width:100%;;height:600px;"));
			
			$grid = new DataGrid(array("Motivo","Quantidade"),"",FALSE);
			
			foreach($array as $motivo => $qtd)
			{
				
				$grid->Content($motivo);
				$grid->Content($qtd,array('align'=>'right'));
				
				$arGeral[$motivo] += $qtd;
				
			}
			
			$grid->Content("Total");
			$grid->Content(array_sum($array),array('align'=>'right',"style"=>"font-weight:bold"));
			
			
			
			unset($grid);
			
			echo $view->CloseDiv();
			
			
			$uniq = uniqid();
			echo $view->Div(array("id"=>$uniq,"style"=>"float:left;width:100%;;height:550px")).$view->CloseDiv();
			
			$arOpt[titulo] 		= "";
			$arOpt[sufixo]		= "";
			$arOpt[mostraLegenda] = true;
			
				
				
			$chart->PieChart("#".$uniq, $array, $arOpt);

			echo $view->Br().$view->Hr().$view->P("",array("style"=>"page-break-before:always"));
			
			
			
		}
		
		
		
		
		echo $view->H2("Resumo dos Anos ",array("style"=>"font-size:20px;text-align:center;"));
		
		echo $view->Div(array("style"=>"float:left;width:100%;;height:600px;"));
		
		$grid = new DataGrid(array("Motivo","Quantidade"),"",FALSE);
		
		
		foreach($arGeral as $motivo => $qtd)
		{
				
			$grid->Content($motivo);
			$grid->Content($qtd,array('align'=>'right'));
		
		}

		$grid->Content("Total");
		$grid->Content(array_sum($arGeral),array('align'=>'right',"style"=>"font-weight:bold"));
				
				
			unset($grid);
				
			echo $view->CloseDiv();
				
				
			$uniq = uniqid();
			echo $view->Div(array("id"=>$uniq,"style"=>"float:left;width:100%;height:550px")).$view->CloseDiv();
				
			$arOpt[titulo] 		= "";
			$arOpt[sufixo]		= "";
		
		
			$chart->PieChart("#".$uniq, $arGeral, $arOpt);
		
			echo $view->Br();
		
		
		echo $view->CloseDiv();
		
		unset ($chart);
		
		
				
		
		
		
		
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>