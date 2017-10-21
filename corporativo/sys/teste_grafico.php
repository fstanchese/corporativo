<?php 

	include("../engine/User.class.php");
	include("../engine/Db.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Chart.class.php");

	$user = new User ();
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPage("teste","teste");
	
	
	$view->Header($user);
	$chart = new Chart();
	
	
	
	$arMes = array ("Jan"=>"30/01/2013","Fev"=>"28/02/2013","Mar"=>"30/03/2013","Abr"=>"30/04/2013","Mai"=>"30/05/2013","Jun"=>"30/06/2013","Jul"=>"30/07/2013","Ago"=>"30/08/2013","Set"=>"30/09/2013","Out"=>"30/10/2013","Nov"=>"30/11/2013","Dez"=>"30/12/2013");
	
	foreach ( $arMes as $chave => $ar )
	{
		
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id = 5700000000002 and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );		
		$linha = $dbData->Row();
		$arBio[] = $linha[QTDE];
				
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id = 5700000000007 and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arEdF[] = $linha[QTDE];
				
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id = 5700000000008 and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arFar[] = $linha[QTDE];
				
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id = 5700000000012 and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arFis[] = $linha[QTDE];
		
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id = 5700000000014 and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arNutr[] = $linha[QTDE];
		
		
		
	}
	
	$arTeste["Ciências Biológicas"] = array(implode(",",$arBio));
	$arTeste["Educação Física"] = array(implode(",",$arEdF));
	$arTeste["Farmácia"] = array(implode(",",$arFar));
	$arTeste["Fisioterapia"] = array(implode(",",$arFis));
	$arTeste["Nutrição"] = array(implode(",",$arNutr));
	
	
	$arOpt[titulo] 		= "Quantidade de Alunos Matriculados";
	$arOpt[subtitulo] 	= "Por mês";
	$arOpt[eixoY] 		= "Quantidade de Alunos";
	$arOpt[prefixo]		= "";
	$arOpt[sufixo]		= "Alunos";

	
	
	//GRAFICO DE LINHA

	$chart->LineChart("#Teste", array_keys($arMes), $arTeste, $arOpt);
	
	
	
	echo $view->Div(array("id"=>"Teste"));
	echo $view->CloseDiv();
	
	$dbData->Get("select count(Matric.WPessoa_Id) as qtde,  Curso.nomered	from	Matric,	TurmaOfe,	CurrOfe,	Curr,	Curso	where	curso.id = curr.Curso_Id and			Matric.MatricTi_Id = 8300000000001	and	(	(	Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )	and	trunc(Matric.Data) < trunc(sysdate)	)	or	(	Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 )	and	trunc(Matric.DtState) >= trunc(sysdate)	)	)	and	Matric.TurmaOfe_Id = TurmaOfe.Id	and	TurmaOfe.CurrOfe_Id = CurrOfe.Id	and	CurrOfe.Curr_Id = Curr.Id	and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	group by Curso.Nomered order by curso.nomered" );	
	while ($row = $dbData->Row())
	{
		$arData2[$row[NOMERED]] = $row[QTDE];		
	}
	
	$arOpt[titulo] 		= "Quantidade de Alunos Matriculados Por Curso";
	$arOpt[sufixo]		= "Alunos";
	$arOpt[height]		= "700";
	$arOpt[mostralegenda] = false;
	
	
	//GRAFICO DE PIE

	$chart->PieChart("#Teste2", $arData2, $arOpt);
	
	
	echo $view->Div(array("id"=>"Teste2"));
	echo $view->CloseDiv();
	
	

	$dbData->Get("select	  count(Matric.WPessoa_Id) as qtde,  FACUL_GSrECOGNIZE(Curso.facul_id) as facul_rec	from	Matric,	TurmaOfe,	CurrOfe,	Curr,	Curso	where	curso.id = curr.Curso_Id and	Matric.MatricTi_Id = 8300000000001	and	(	(	Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )	and	trunc(Matric.Data) < trunc(sysdate)	)	or	(	Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 )	and	trunc(Matric.DtState) >= trunc(sysdate)	)	)	and	Matric.TurmaOfe_Id = TurmaOfe.Id	and	TurmaOfe.CurrOfe_Id = CurrOfe.Id	and	CurrOfe.Curr_Id = Curr.Id	and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	group by Curso.facul_id order by facul_rec" );		
	while ($row = $dbData->Row())
	{
		$arDataFacul[$row[FACUL_REC]] = $row[QTDE];
		//$arData[$row[FACUL_REC]] 		 = array($row[QTDE]);
	}
	
	$arOpt[titulo] 		= "Quantidade de Alunos Matriculados Por Faculdade";
	$arOpt[sufixo]		= "Alunos";
	$arOpt[height]		= "400";
	$arOpt[mostraLegenda] = true;
	
	
	
	
	//GRAFICO DE PIE
	
	$chart->PieChart("#Teste5", $arDataFacul, $arOpt);
	
	
	echo $view->Div(array("id"=>"Teste5"));
	echo $view->CloseDiv();
	
	
	
	
	
	
	
	//GRAFICO DE COLUNA
	
	
	
	
	
	$arMes2 = array ("Jan"=>"30/01/2013","Fev"=>"28/02/2013","Mar"=>"30/03/2013","Abr"=>"30/04/2013","Mai"=>"30/05/2013","Jun"=>"30/06/2013","Jul"=>"30/07/2013","Ago"=>"30/08/2013");
	
	foreach ( $arMes2 as $chave => $ar )
	{
	
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id In ( Select id from curso WHERE facul_id = 9600000000001) and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arBio2[] = $linha[QTDE];
	
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id In ( Select id from curso WHERE facul_id = 9600000000002)  and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arEdF2[] = $linha[QTDE];
	
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id In ( Select id from curso WHERE facul_id = 9600000000003)  and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arFar2[] = $linha[QTDE];
	
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id In ( Select id from curso WHERE facul_id = 9600000000004)  and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arFis2[] = $linha[QTDE];
	
		$dbData->Get("select count(Matric.WPessoa_Id) as qtde from Matric, TurmaOfe, CurrOfe, Curr, Curso where curso.id = curr.Curso_Id and Matric.MatricTi_Id = 8300000000001 and	( ( Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 ) and trunc(Matric.Data) < '".$ar."' ) or ( Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) and trunc(Matric.DtState) >= '".$ar."' ) ) and Matric.TurmaOfe_Id = TurmaOfe.Id and TurmaOfe.CurrOfe_Id = CurrOfe.Id and Curso.Id In ( Select id from curso WHERE facul_id = 9600000000005)  and	CurrOfe.Curr_Id = Curr.Id and	CurrOfe.PLetivo_Id = nvl ( 7200000000083 , 0 )	" );
		$linha = $dbData->Row();
		$arNutr2[] = $linha[QTDE];
	
	
	
	}
	
	print_r($arBio2);
	
	unset($arTeste);
	
	$arTeste2["Exatas"] = array(implode(",",$arBio2));
	$arTeste2["Humanas"] = array(implode(",",$arEdF2));
	$arTeste2["Biológicas"] = array(implode(",",$arFar2));
	$arTeste2["LACCE"] = array(implode(",",$arFis2));
	$arTeste2["Direito"] = array(implode(",",$arNutr2));
	
	
	$arOpt[titulo] 		= "Quantidade de Alunos Matriculados por Faculdade";
	$arOpt[subtitulo] 	= "Por mês";
	$arOpt[eixoY] 		= "Quantidade de Alunos";
	$arOpt[prefixo]		= "";
	$arOpt[sufixo]		= "Alunos";
	
	
	
	
	
	//GRAFICO DE COLUNA
	
	
	$chart->ColumnChart("#Teste3", array_keys($arMes2), $arTeste2, $arOpt);
	
	echo $view->Div(array("id"=>"Teste3"));
	echo $view->CloseDiv();
	
	
	
	
	
	
	
	$arMes3 = array ("Janeiro"=>"01/01/2013:30/01/2013","Fevereiro"=>"01/02/2013:28/02/2013","Março"=>"01/03/2013:30/03/2013","Abril"=>"01/04/2013:30/04/2013","Maio"=>"01/05/2013:30/05/2013","Junho"=>"01/06/2013:30/06/2013","Julho"=>"01/07/2013:30/07/2013","Agosto"=>"01/08/2013:30/08/2013");
	
	foreach ( $arMes3 as $chave => $ar )
	{
	
		$dbData->Get("SELECT * FROM pesqevmot order by nome");
		
		while($row = $dbData->Row())
		{
			
			$dbData2 = new DbData($dbOracle);
			$linha = $dbData2->Row($dbData2->Get("select count(*) as t from pesqevxpemd WHERE trunc(pesqevxpemd.dt) between '".reset(explode(":",$ar))."' and '".end(explode(":",$ar))."' AND pesqevmotd_id IN ( select id from pesqevmotd where pesqevmot_id =  '".$row[ID]."' )" ));
			

			
			unset($dbData2);
			
			$arEva[$row[NOME]][] = $linha[T];

			
			
		}
		
	
	}
	
	
	/*foreach ( $arMes3 as $chave => $ar )
	{
	
		
				
		$dbData2 = new DbData($dbOracle);
		$linha = $dbData2->Row($dbData2->Get("select count(*) as t from pesqevxpemd WHERE trunc(pesqevxpemd.dt) between '".reset(explode(":",$ar))."' and '".end(explode(":",$ar))."' AND pesqevmotd_id IN (127500000000106, 127500000000108)" ));
		unset($dbData2);
				
			$arEva[Outros][] = $linha[T];
	
	
	
	}*/
	
	
	
	
	foreach($arEva as $motivo => $qtde)
	{
		
		$arEvF[$motivo] = array(implode(",",$qtde));
		
	}
	

	
	
	$arOpt[titulo] 		= "Quantidade de Alunos que Deixaram a Instituição";
	$arOpt[subtitulo] 	= "Por Assunto";
	$arOpt[eixoY] 		= "Quantidade de Alunos";
	$arOpt[prefixo]		= "";
	$arOpt[sufixo]		= "Alunos";
	
	
	
	
	
	//GRAFICO DE COLUNA
	
	//$chart->ColumnChart("#Teste6", array_keys($arMes3), $arEvF, $arOpt);
	
	//echo $view->Div(array("id"=>"Teste6"));
	
	
	
	
	
	
	
	$dbData->Get("SELECT * FROM pesqevmotd WHERE pesqevmot_id = 127400000000003 order by nome");
	
	while($row = $dbData->Row())
	{
	
		$dbData2 = new DbData($dbOracle);
		$dbData2->Get("select count(*) as t from pesqevxpemd WHERE trunc(pesqevxpemd.dt) between '01/01/2013' and '31/08/2013' AND pesqevmotd_id = '".$row[ID]."'" );
		while ($linha = $dbData2->Row())
		{
			$arDataAssEv[$row[NOME]] = $linha[T];
			//$arData[$row[FACUL_REC]] 		 = array($row[QTDE]);
		}
		unset($dbData2);
	}
	
	
	
	
	
	$arOpt[titulo] 		= "Quantidade de Alunos que saíram - Financeiro";
	$arOpt[sufixo]		= "por Assunto";
	$arOpt[height]		= "400";
	$arOpt[mostraLegenda] = true;
	
	
	
	
	//GRAFICO DE PIE
	
	
	
	$chart->PieChart("#Teste20", $arDataAssEv, $arOpt);
	
	
	echo $view->Div(array("id"=>"Teste20"));
	echo $view->CloseDiv();
	
	
	
	
	
	
	$arData3[] = "-9.7, 9.4";
	$arData3[] = "-8.7, 6.5";
	$arData3[] = "-3.5, 9.4";
	$arData3[] = "-1.4, 19.9";
	$arData3[] = "0.0, 22.6";
	$arData3[] = "2.9, 29.5";
	$arData3[] = "9.2, 30.7";
	$arData3[] = "7.3, 26.5";
	$arData3[] = "4.4, 18.0";
	$arData3[] = "-3.1, 11.4";
	$arData3[] = "-5.2, 10.4";
	$arData3[] = "-13.5, 9.8";
	
	
	//GRAFICO DE RANGE
	echo $view->Div(array("id"=>"Teste10"));
	echo $view->CloseDiv();
	
	$chart->DynamicChart("#Teste10", $arCat, $arData3, $arOpt);
	
	
	



?>