<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Resultado da Pesquisa de Atendimento do SAA por Per�odo","Resultado da Pesquisa de Atendimento do SAA por Per�odo",array('ADM','CPD','SAA_ANALISTA'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Chart.class.php");
	include("../engine/Form.class.php");

	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPage($app->title,$app->description);
	
	
	$view->Header($user);
	$chart = new Chart();
	
	
	$form = new Form();
	
		$form->Fieldset("Sele��o de Datas");
		
				
		$form->Input('Data de In�cio','date',	array("required"=>'1',"name"=>'p_DtInicio'));
		$form->Input('Data de T�rmino','date',	array("required"=>'1',"name"=>'p_DtTermino'));
						
		
		$form->Button();
		
					
	$form->CloseFieldset ();	
		
	unset ($form);
	
	if ($_POST[p_DtInicio] != '' && $_POST[p_DtTermino] != '')
	{
		
	////Q1
		
		$arQ1_titulo = array ("1"=>"Calmo/Sereno","2"=>"Preocupado","3"=>"Irritado","4"=>"Indiferente",""=>"Nulo");
	
		
		$dbData->Get("select count(nvl(Q1,1)) as qtde,Q1 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q1 order by 2");
		if ($dbData->Count() > 0)
		{
			while ($linha = $dbData->Row())
			{
				$arQ1[$arQ1_titulo[$linha["Q1"]]] = $linha["QTDE"];
			}
			
			$arOpt[titulo] 		= "1. Qual era o seu estado emocional quando chegou ao SAA?";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[subtitulo] 	= "Per�odo de " . $_POST[p_DtInicio] . ' a '. $_POST[p_DtTermino];
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q1", $arQ1, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q1","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();				
		}
		
	////Q2 	
		
		$arQ2_titulo = array ("1"=>"Gradua��o","2"=>"P�s Lato Sensu","3"=>"P�s Stricto Sensu","4"=>"Outros",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q2,1)) as qtde,Q2 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q2 order by 2");
		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ2[$arQ2_titulo[$linha["Q2"]]] = $linha["QTDE"];
			}
			
			$arOpt[titulo] 		= "2. O seu curso �:";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q2", $arQ2, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q2","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();
		
		}	
	////Q2.1
		
		$arQ2_1_titulo = array ("1"=>"Humanas","2"=>"Exatas","3"=>"Biol�gicas","4"=>"Direito","5"=>"LACCE",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q2_1,1)) as qtde,Q2_1 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q2_1 order by 2");
		
		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ2_1[$arQ2_1_titulo[$linha["Q2_1"]]] = $linha["QTDE"];
			}
			
			
			$arOpt[titulo] 		= "2.1. Se o seu curso for Gradua��o, qual a sua Faculdade?";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q2_1", $arQ2_1, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q2_1","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();
	
		}	
	////Q3
		
		$arQ3_titulo = array ("1"=>"Muito R�pido","2"=>"R�pido","3"=>"Demorado","4"=>"Muito Demorado","5"=>"Suficiente",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q3,1)) as qtde,Q3 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q3 order by 2");

		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ3[$arQ3_titulo[$linha["Q3"]]] = $linha["QTDE"];
			}
			
			
			$arOpt[titulo] 		= "3. Qual a sua opini�o com rela��o ao tempo de espera antes de ser atendido?";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q3", $arQ3, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q3","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();
		
		}
	////Q4
		
		$arQ4_titulo = array ("1"=>"Muito R�pido","2"=>"R�pido","3"=>"Demorado","4"=>"Muito Demorado","5"=>"Suficiente",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q4,1)) as qtde,Q4 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q4 order by 2");
		
		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ4[$arQ4_titulo[$linha["Q4"]]] = $linha["QTDE"];
			}
			
			
			$arOpt[titulo] 		= "4. A dura��o do atendimento feito pelo funcion�rio foi:";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q4", $arQ4, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q4","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();
		
		}	
	////Q5
		
		$arQ5_titulo = array ("1"=>"Muito Satisfeito","2"=>"Satisfeito","3"=>"Insatisfeito","4"=>"Muito Insatisfeito","5"=>"Indiferente",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q5,1)) as qtde,Q5 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q5 order by 2");

		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ5[$arQ5_titulo[$linha["Q5"]]] = $linha["QTDE"];
			}
			
			
			$arOpt[titulo] 		= "5. Como voc� se sentiu com as informa��es prestadas pelo atendente?";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q5", $arQ5, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q5","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();
		}		
	////Q6
		
		$arQ6_titulo = array ("Cordialidade","Respeito","Indiferen�a","Paci�ncia","Agressividade","Intoler�ncia","Bom ouvinte","Atencioso","Outros");

		
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_1 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Cordialidade"] = $linha["QTDE"];				
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_2 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Respeito"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_3 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Indiferen�a"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_4 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Paci�ncia"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_5 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Agressividade"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_6 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Intoler�ncia"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_7 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Bom ouvinte"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_8 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Atencioso"] = $linha["QTDE"];
		unset($linha);
		$dbData->Get("select count(*) as qtde from pesqsaa where Q6_9 = 'on' and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'");
		$linha = $dbData->Row();
		$arQ6["Outros"] = $linha["QTDE"];
		unset($linha);

		
		$arOpt[titulo] 		= "6. Assinale abaixo uma ou mais caracter�sticas que definam o funcion�rio que o atendeu:";
		$arOpt[eixoY] 		= "Quantidade de Respostas";
		$arOpt[prefixo]		= "";
		$arOpt[mostraLegenda] = "false";
	
		$arAux[] = array(implode(",",$arQ6));
		$chart->ColumnChart("#Q6", $arQ6_titulo, $arAux, $arOpt);
	
		echo $view->Br().$view->Br().$view->Br();
		echo $view->Div(array("id"=>"Q6","style"=>"float:left;width:100%"));
		echo $view->CloseDiv();
		
		echo $view->Div(array("style"=>"float:left;width:100%;border:1px black solid;margin-left:5px"));

		$dbData->Get("select Q6_txt as texto from pesqsaa where Q6_txt is not null and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' order by 1");
		
		echo $view->P(' Outros',array("style"=>"font-weight:bold;margin-left:5px"));
		while ($row = $dbData->Row())
		{
			echo $view->P(' ' . $row["TEXTO"],array("style"=>"font-weight:normal;margin-left:10px"));
		}
		echo $view->CloseDiv();		
	////Q7
		
		$arQ7_titulo = array ("1"=>"Muito Satisfeito","2"=>"Satisfeito","3"=>"Insatisfeito","4"=>"Muito Insatisfeito","5"=>"Indiferente",""=>"Nulo");
		
		
		$dbData->Get("select count(nvl(Q7,1)) as qtde,Q7 from PesqSAA where nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' group by Q7 order by 2");
		if ($dbData->Count() > 0)
		{
		
			while ($linha = $dbData->Row())
			{
				$arQ7[$arQ5_titulo[$linha["Q7"]]] = $linha["QTDE"];
			}
			
			
			$arOpt[titulo] 		= "7. Qual a sua opini�o com rela��o ao ambiente (limpeza)?";
			$arOpt[sufixo]		= "Alunos";
			$arOpt[height]		= "350";		
			$arOpt[mostraLegenda] = true;
			
			//GRAFICO DE COLUNA
			
			
			$chart->PieChart("#Q7", $arQ7, $arOpt);
			
			echo $view->Br().$view->Br().$view->Br();
			echo $view->Div(array("id"=>"Q7","style"=>"float:left;width:100%"));
			echo $view->CloseDiv();		

		}
	}
	echo $view->Br();echo $view->Br();
	
	echo $view->Div(array("style"=>"float:left;width:100%;border:1px black solid;margin-left:5px"));
	
	$dbData->Get("select Q8_txt as texto from pesqsaa where Q8_txt is not null and nvl(PesqSAA.Data,PesqSAA.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' order by 1");
	
	echo $view->P(' 8. Deixe uma sugest�o de melhoria para o SAA?',array("style"=>"font-weight:bold;margin-left:5px"));
	while ($row = $dbData->Row())
	{
		echo $view->P(' ' . $row["TEXTO"],array("style"=>"font-weight:normal;margin-left:10px"));
	}
	echo $view->CloseDiv();
	
?>