<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Inscritos Vestibular - Comparativo por Curso","Inscritos Vestibular - Comparativo por Curso",array('ADM','CPD','DIRETORES'),$user);

	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Chart.class.php");

	include("../model/Facul.class.php");
	include("../model/Vest.class.php");
	include("../model/WPleito.class.php");
	

	$user 		= new User ();
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
		
	$view 		= new ViewPage($app->title,$app->description);
	
	$facul 	= new Facul($dbOracle);
	$vest 	= new Vest($dbOracle);
	$wpleito 	= new WPleito($dbOracle);
	
	
	$view->Header($user);
	
	
	$form = new Form();
		
		$form->Fieldset();
		
				
			$form->Input('Vestibular',	'select',	array("name"=>'p_WPleito',"value"=>$_POST[p_WPleito], "option"=>$wpleito->Calculate("Tipo",array("p_VestTi_Id"=>95800000000002))));
			$form->Input('Comparar Com',	'select',	array("name"=>'p_WPleitoComp', "value"=>$_POST[p_WPleitoComp], "option"=>$wpleito->Calculate("Tipo",array("p_VestTi_Id"=>95800000000002))));
			$form->Input('Faculdade',	'select',	array("name"=>'p_Facul_Id', "value"=>$_POST[p_Facul_Id], "option"=>$facul->Calculate()));
				
			
			$form->LabelMultipleInput("Período");
			$form->MultipleInput("","text",array("name"=>'p_DtIni',"class"=>"size20 datePicker","value"=>$_POST[p_DtIni]));
			$form->MultipleInput(" a ","text",array("name"=>'p_DtFim',"class"=>"size20 datePicker","value"=>$_POST[p_DtFim]));
			
				
		$form->CloseFieldset ();
			
		$form->Fieldset();
			
			$form->Button("submit",array("name"=>"enviar","value"=>"Prosseguir"));
		
		$form->CloseFieldset ();
	
	unset ($form);
	
	
	
	if($_POST[enviar] == "Prosseguir")
	{

		$dadosWPleitoAt 	= $wpleito->GetIdInfo($_POST[p_WPleito]);
		$dadosWPleitoOld 	= $wpleito->GetIdInfo($_POST[p_WPleitoComp]);
		
		$chart = new Chart();
			
	
		//Line Chart - GERAL DO VESTIBULAR ATUAL
		$dbData->Get("
					select
				      count(*) as qtd,
					  state_gsrecognize(boleto.state_base_id) as state,
					  trunc(vest.dt) as data
					from
					  vest,
					  wpleito,
					  debcred,
					  boleto
					where
					  boleto.id = debcred.boleto_destino_id
					and
					  debcred.vest_origem_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleito]."'
			
					group by trunc(vest.dt), state_gsrecognize(boleto.state_base_id)
					order by trunc(vest.dt)
		
					");
		
		while($row = $dbData->Row())
		{
			if($row[STATE] == 'Quitado' || $row[STATE] == 'Isento')
				$arDias[substr($row[DATA],0,5)]['Efetivos'] += $row[QTD];
			else
				$arDias[substr($row[DATA],0,5)]['Efetivos'] += 0;
			
			$arDias[substr($row[DATA],0,5)]['Inscritos'] += $row[QTD];
		}
		
		
		$arDatas = array_keys($arDias);
		
		foreach($arDias as $qtd )
		{
			
			$arQtd['Inscritos'][] = $qtd[Inscritos];
			$arQtd['Efetivos'][] = $qtd[Efetivos];
			
		}
		
		$arLine['Inscritos'] 		= array(implode(", ",$arQtd[Inscritos]));
		$arLine['Efetivos'] 		= array(implode(", ",$arQtd[Efetivos]));
	
			
		$arOpt[titulo] 		= "Evolução do ".$dadosWPleitoAt[NOME];
		$arOpt[subtitulo] 	= "";
		$arOpt[eixoY] 		= "Quantidade";
		$arOpt[prefixo]		= "";
		$arOpt[sufixo]		= "";
		$arOpt[mostraLegenda] = "true";
		
			
			
			
		//GRAFICO DE LINHA
		
		$chart->LineChart("#teste5", $arDatas, $arLine, $arOpt);
			
			
			
		echo $view->Div(array("id"=>"teste5","style"=>""));
		echo $view->CloseDiv();
		
		
		
		
		
		
		
		//PIE CHART - GERAL DO VESTIBULAR ATUAL
		$dbData->Get("			
					select
				      count(*) as qtd,
					  state_gsrecognize(boleto.state_base_id) as state
					from
					  vest,
					  wpleito,
					  debcred,
					  boleto
					where
					  boleto.id = debcred.boleto_destino_id
					and
					  debcred.vest_origem_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleito]."'
					
					group by state_gsrecognize(boleto.state_base_id)
			
					");
		
		while($row = $dbData->Row())
		{
			
			if($row[STATE] == 'Quitado' || $row[STATE] == 'Isento')
				$arVest['Efetivos'] += $row[QTD];
			else
				$arVest['Efetivos'] += 0;
			
			$arVest['Inscritos'] += $row[QTD];
			
		}
		
		$arVest["Não Efetivos"] = $arVest['Inscritos'] - $arVest['Efetivos'];
		unset($arVest['Inscritos']);
		
		
		$arOpt[titulo] 		= "Inscrições do ".$dadosWPleitoAt[NOME]." (até data atual)";
		$arOpt[sufixo]		= "Pessoas";
		$arOpt[height]		= "400";
		$arOpt[mostralegenda] = '1';
		
		$chart->PieChart("#Teste2", $arVest, $arOpt);
		
		
		echo $view->Div(array("id"=>"Teste2","style"=>"float:left;width:45%;margin:2%"));
		echo $view->CloseDiv();
		
		
		unset($arVest);
		
		//PIE CHART - GERAL DO VESTIBULAR PASSADO
		$dbData->Get("
					select
				      count(*) as qtd,
					  state_gsrecognize(boleto.state_base_id) as state
					from
					  vest,
					  wpleito,
					  debcred,
					  boleto
					where
					  boleto.id = debcred.boleto_destino_id
					and
					  debcred.vest_origem_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleitoComp]."'
			
					group by state_gsrecognize(boleto.state_base_id)
		
					");
		
		while($row = $dbData->Row())
		{
				
			if($row[STATE] == 'Quitado' || $row[STATE] == 'Isento')
				$arVest['Efetivos'] += $row[QTD];
			else
				$arVest['Efetivos'] += 0;
				
			$arVest['Inscritos'] += $row[QTD];
				
		}
		
		$arVest["Não Efetivos"] = $arVest['Inscritos'] - $arVest['Efetivos'];
		unset($arVest['Inscritos']);
		
		
		$arOpt[titulo] 		= "Inscrições do ".$dadosWPleitoOld[NOME]. " (Todo o Período)";
		$arOpt[sufixo]		= "Pessoas";
		$arOpt[height]		= "400";
		$arOpt[mostralegenda] = '1';
		
		$chart->PieChart("#Teste3", $arVest, $arOpt);
		
		
		echo $view->Div(array("id"=>"Teste3","style"=>"float:left;width:45%;margin:2%"));
		echo $view->CloseDiv();
		
		
		
		
		echo $view->Br();
		
		
		unset($arVest);
		
		
		//Geral por Faculdade
		$dbData->Get("
			
					select
						facul.nome as facul,
						nvl(count(vestopcao.currofe_id),0) as qtd
					from
					  vestopcao,
					  vest,
					  wpleito,
					  currofe,
					  curr,
					  curso,
						facul
					where
					  curso.id=curr.curso_id
					and
					  curr.id = currofe.curr_id
					and
					  vestopcao.currofe_id = currofe.id
					and
					  vestopcao.vest_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleito]."'
					and
					  trunc(vest.dt) between '".$_POST[p_DtIni]."' AND '".$_POST[p_DtFim]."'
					and
				       facul.id = curso.facul_id 
					
						group by facul.nome
					order by facul.nome
			
					");
		
		
		
		while($row = $dbData->Row())
		{
			$arVest[$row[FACUL]] += $row[QTD];
		}
		
		
		
		$arOpt[titulo] 		= "Inscrições do ".$dadosWPleitoOld[NOME]. " - Por Faculdade - Período: ".$_POST[p_DtIni]." a ".$_POST[p_DtFim];
		$arOpt[sufixo]		= "Pessoas";
		$arOpt[height]		= "400";
		$arOpt[mostralegenda] = '1';
		
		$chart->PieChart("#Teste4", $arVest, $arOpt);
		
		
		echo $view->Div(array("id"=>"Teste4","style"=>""));
		echo $view->CloseDiv();
		
		
		echo $view->Br();
		
		
		//Periodo
		$qtdDiasPeriodo = _DateDiffDays($_POST[p_DtFim],$_POST[p_DtIni]);
		if($qtdDiasPeriodo < 0) die();
		
		$dtProva1 = $wpleito->GetDtProva($_POST[p_WPleito]);
		$dtProva2 = $wpleito->GetDtProva($_POST[p_WPleitoComp]);
		
		$auxDtConsulta 	= explode("/",$_POST[p_DtIni]);
		
		
		for($x = 0;$x<=$qtdDiasPeriodo;$x++)
		{

			unset($arVestAt);
			unset($arVestOld);
			unset($arCurso);
			unset($arChart);
					
						
			$dataConsulta = "";
			$auxProva2 = "";
			$qtdDiasVest1 = "";
			$pDataComp = "";
			
			$dataConsulta   = date('d/m/Y',mktime(0,0,0,$auxDtConsulta[1],$auxDtConsulta[0]+$x,$auxDtConsulta[2]));
		
			
			$auxProva2 = explode("/",$dtProva2);
		
			$qtdDiasVest1 = _DateDiffDays($dtProva1,$dataConsulta);
		
			$pDataComp    = date('d/m/Y',mktime(0,0,0,$auxProva2[1],$auxProva2[0]-$qtdDiasVest1,$auxProva2[2])); 
		
		
			//Vestibular 'atual'
			$dbData->Get("
					
					select
					  curso.nome as curso,
					  to_char(vest.dt, 'dd/mm/yyyy') as data, 
					  nvl(count(vestopcao.currofe_id),0) as qtd,
					  state_gsrecognize(boleto.state_base_id) as state
					from 
					  vestopcao,
					  vest, 
					  wpleito, 
					  currofe,
					  curr,
					  curso,
					  debcred,
					  boleto  
					where
					  boleto.id = debcred.boleto_destino_id
					and
					  debcred.vest_origem_id = vest.id
					and
					  curso.id=curr.curso_id
					and
					  curr.id = currofe.curr_id
					and
					  vestopcao.currofe_id = currofe.id
					and
					  vestopcao.vest_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleito]."'
					and
					  trunc(vest.dt) = '".$dataConsulta."'
					and
						curso.facul_id = '".$_POST[p_Facul_Id]."'
					group by curso.nome, to_char(vest.dt, 'dd/mm/yyyy'),  boleto.state_base_id
					order by curso				
					
					");
			
			
			
			while($row = $dbData->Row())
			{
				
				if($row[STATE] == 'Quitado' || $row[STATE] == 'Isento')
					$arVestAt[$row[CURSO]]['EFETIVO'] += $row[QTD];
				else
					$arVestAt[$row[CURSO]]['EFETIVO'] += 0;
				
				$arVestAt[$row[CURSO]]['INSCRITO'] += $row[QTD]; 
				
				
			}
			
			
			
			
			//Vestibular 'anterior'
			$dbData->Get("
			
					select
					  curso.nome as curso,
					  to_char(vest.dt, 'dd/mm/yyyy') as data,
					  nvl(count(vestopcao.currofe_id),0) as qtd,
					  state_gsrecognize(boleto.state_base_id) as state
					from
					  vestopcao,
					  vest,
					  wpleito,
					  currofe,
					  curr,
					  curso,
					  debcred,
					  boleto
					where
					  boleto.id = debcred.boleto_destino_id
					and
					  debcred.vest_origem_id = vest.id
					and
					  curso.id=curr.curso_id
					and
					  curr.id = currofe.curr_id
					and
					  vestopcao.currofe_id = currofe.id
					and
					  vestopcao.vest_id = vest.id
					and
					  vest.wpleito_id = wpleito.id
					and
					  wpleito.id = '".$_POST[p_WPleitoComp]."'
					and
					  trunc(vest.dt) = '".$pDataComp."'
					and
						curso.facul_id = '".$_POST[p_Facul_Id]."'
					group by curso.nome, to_char(vest.dt, 'dd/mm/yyyy'),  boleto.state_base_id
					order by curso
			
					");
			
			
			while($row = $dbData->Row())
			{
					
				if($row[STATE] == 'Quitado' || $row[STATE] == 'Isento')
					$arVestOld[$row[CURSO]]['EFETIVO'] += $row[QTD];
				else
					$arVestOld[$row[CURSO]]['EFETIVO'] += 0;
					
				$arVestOld[$row[CURSO]]['INSCRITO'] += $row[QTD];
					
					
			}
			
			
			$arCurso = array_keys($arVestAt);
			
			
			$arCurso = array_merge($arCurso,array_keys($arVestOld));
			$arCurso = array_unique($arCurso);
			
			
			
			
			foreach($arCurso as $nomeCurso)
			{
				
				if($arVestAt[$nomeCurso]['EFETIVO'] == "")
				{
					$arChart['Efetivos'][] = 0;
				}
				else 
				{
					$arChart['Efetivos'][] = $arVestAt[$nomeCurso]['EFETIVO'];
				}
				
				
				if($arVestAt[$nomeCurso]['INSCRITO'] == "")
				{
					$arChart['Inscritos'][] = 0;
				}
				else
				{
					$arChart['Inscritos'][] = $arVestAt[$nomeCurso]['INSCRITO'];
				}
				
				
				if($arVestOld[$nomeCurso]['INSCRITO'] == "")
				{
					$arChart['Vestibular Anterior'][] = 0;
				}
				else
				{
					$arChart['Vestibular Anterior'][] = $arVestOld[$nomeCurso]['INSCRITO'];
				}
				
			}
				
				
			
	
		
			
			$uniq = uniqid();
			$arChart['Inscritos'] 		= array(implode(", ",$arChart['Inscritos']));
			$arChart['Efetivos'] 		= array(implode(", ",$arChart['Efetivos']));
			$arChart['Vestibular Anterior'] 	= array(implode(", ",$arChart['Vestibular Anterior']));
			
			
			
			
			
			$arOpt[titulo] 		= "Comparativo Vestibulares Por Curso";
			$arOpt[subtitulo] 	= $qtdDiasVest1 . " dia(s) para a Prova - Data: ".$dataConsulta." Data Equivalente: ".$pDataComp;
			$arOpt[eixoY] 		= "Quantidade";
			$arOpt[prefixo]		= "";
			$arOpt[sufixo]		= "";
			$arOpt[mostraLegenda]		= "true";
		
			
			
			
			//GRAFICO DE LINHA
		
			$chart->BarChart("#".$uniq, $arCurso, $arChart, $arOpt);
			
			
			
			echo $view->Div(array("id"=>$uniq,"style"=>"height:auto;padding:1%;width:98%;border-bottom:1px dotted #ccc;height:800px"));
			echo $view->CloseDiv();
			
			
		
		}
	}


?>