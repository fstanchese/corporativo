<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Resumo - Controle de Atendimento","Resumo - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Chart.class.php");
	include("../engine/Form.class.php");

	include("../model/CAEvento.class.php");
	
	
	$dbOracle 	= new Db ($user);
	
	$dbData 	= new DbData ($dbOracle);
	
	$view 		= new ViewPage($app->title,$app->description);
	
	$caEvento 	= new CAEvento($dbOracle);
	
	$view->Header($user);
	$chart = new Chart();
	
	
	$form = new Form();
	
		$form->Fieldset("Seleção de Datas");
		
		$form->Input("Evento",'select',array('name'=>'p_CAEvento_Id',"required"=>'1',"option"=>$caEvento->Calculate("Geral")));
		
		$form->LabelMultipleInput("Período");
		$form->MultipleInput('','date',	array("name"=>'p_DtInicio'));
		$form->MultipleInput('a','date',	array("name"=>'p_DtTermino'));
						
		
		$form->Button("submit",array("value"=>"Consultar"));
		
					
	$form->CloseFieldset ();	
		
	unset ($form);
	
	if ($_POST[p_DtInicio] != '' && $_POST[p_DtTermino] != '')
	{
		
	////Q1
		$aAuxHora = array ("08"=>"08:00-08:59","09"=>"09:00-09:59","10"=>"10:00-10:59","11"=>"11:00-11:59","12"=>"12:00-12:59","13"=>"13:00-13:59","14"=>"14:00-14:59","15"=>"15:00-15:59","16"=>"16:00-16:59","17"=>"17:00-17:59","18"=>"18:00-18:59","19"=>"19:00-19:59","20"=>"20:00-20:59","21"=>"21:00-21:59","22"=>"22:00-22:59","23"=>"23:00-23:59");		
		$arQ1_titulo = array ("1"=>"1 Atendimento","2"=>"2 Atendimentos","3"=>"3 Atendimentos","4"=>"4 Atendimentos","5"=>"5 Atendimentos","6"=>"6 Atendimentos","7"=>"7 Atendimentos");
	
		
		$dbData->Get("select count(*) as total,qtde from
						(select count(*) as qtde,wpessoa_id from casenha,CASenhaRegra,CASenhaTi,CAAssunto
							where
                  				casenha.dttriagem is not null
              				and 
  								CASenha.CASenhaRegra_Id = CASenhaRegra.Id
							and
								CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
							and
  								CASenhaTi.CAAssunto_Id = CAAssunto.Id
							and
                  				trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'
              				and
  								CAAssunto.CAEvento_Id = '$_POST[p_CAEvento_Id]'
						group by wpessoa_id) tabela
					group by qtde
					order by qtde");
		
		//$dbData->ShowQuery(); die();
		
		while ($linha = $dbData->Row())
		{
			$arQ1[$arQ1_titulo[$linha["QTDE"]]] = $linha["TOTAL"];
		}
		
	
		$arOpt[titulo] 		= "Quantidade de Atendimentos Iniciados por Candidato";
		$arOpt[sufixo]		= "Candidatos";
		$arOpt[height]		= "350";
		$arOpt[subtitulo] 	= "Período de " . $_POST[p_DtInicio] . ' a '. $_POST[p_DtTermino] . ' - ' . $caEvento->Recognize($_POST[p_CAEvento_Id],"RecReduz");
		$arOpt[mostraLegenda] = true;
		
		//GRAFICO DE PIZZA
		
		
		$chart->PieChart("#Q1", $arQ1, $arOpt);
		
		echo $view->Div(array("id"=>"Q1","style"=>"float:left;width:50%"));
		echo $view->CloseDiv();
		
		
		//Fim Quantidade de Atendimentos Iniciados por Candidato
		
		
		
		

		$dbData->Get("select count(*) as qtde,to_char(CASenha.dt,'dd/mm/yy') as data from casenha,CASenhaRegra,CASenhaTi,CAAssunto
				where
				CASenha.CASenhaRegra_Id = CASenhaRegra.Id
				and
				CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
				and
				CASenhaTi.CAAssunto_Id = CAAssunto.Id
				and
				trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'
				and
				CAAssunto.CAEvento_Id = '$_POST[p_CAEvento_Id]'
				group by to_char(CASenha.dt,'dd/mm/yy')
				order by to_char(CASenha.dt,'dd/mm/yy')
				");
		
		
		while ($linha = $dbData->Row())
		{
			$arP3[$linha[DATA]] = $linha["QTDE"];
		}
		
		
		
		$arOpt[titulo] 		= "Quantidade de Atendimentos por Dia";
		$arOpt[sufixo]		= "Senhas";
		$arOpt[height]		= "350";
		$arOpt[subtitulo] 	= "Período de " . $_POST[p_DtInicio] . ' a '. $_POST[p_DtTermino] . ' - ' . $caEvento->Recognize($_POST[p_CAEvento_Id],"RecReduz");
		$arOpt[mostraLegenda] = true;
	
		//GRAFICO DE PIZZA


		$chart->PieChart("#P3", $arP3, $arOpt);

		echo $view->Div(array("id"=>"P3","style"=>"float:left;width:50%"));
		echo $view->CloseDiv();
		
				// FIM GRAFICO POR CURSO
		
		
		
	
		
		$dbData->Get("select count(*) as qte, cawpesdet.valor from caevxwpes, cawpesdet
				where
				caevxwpes.id = cawpesdet.caevxwpes_id
				and
				CAevxwpes.CAEvento_Id = '$_POST[p_CAEvento_Id]'
				and
				caevxwpes.wpessoa_id IN ( select wpessoa_id from casenha where 	trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]' )
				and	cawpesdet.nome = 'Curso'
				group by cawpesdet.valor
				");
		
		
		while ($linha = $dbData->Row())
		{
			$arQ2[$linha[VALOR]] = $linha["QTE"];
		}
		
		
		$arOpt[titulo] 		= "Quantidade de Atendimentos por Curso";
		$arOpt[sufixo]		= "Candidatos";
		$arOpt[height]		= "750";
		$arOpt[subtitulo] 	= "Período de " . $_POST[p_DtInicio] . ' a '. $_POST[p_DtTermino] . ' - ' . $caEvento->Recognize($_POST[p_CAEvento_Id],"RecReduz");
		$arOpt[mostraLegenda] = true;
		
		//GRAFICO DE PIZZA
		
		
		$chart->PieChart("#P2", $arQ2, $arOpt);
		
		echo $view->Div(array("id"=>"P2","style"=>"float:left;width:98%"));
		echo $view->CloseDiv();
		
		// FIM GRAFICO POR CURSO
		
		
		
		
		
		
		
		
		
		
		


		

		$dbData->Get("select count(*) as qtde,to_char(CASenha.dt,'HH24') as hora from casenha,CASenhaRegra,CASenhaTi,CAAssunto
				where
				CASenha.CASenhaRegra_Id = CASenhaRegra.Id
				and
				CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
				and
				CASenhaTi.CAAssunto_Id = CAAssunto.Id
				and
				trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'
				and
				CAAssunto.CAEvento_Id = '$_POST[p_CAEvento_Id]'
				group by to_char(CASenha.dt,'HH24')
				order by to_char(CASenha.dt,'HH24')");
		
		
		while ($linha = $dbData->Row())
		{
			$aGraf04[$linha["HORA"]] = $linha["QTDE"];
			$aGraf04_titulo[] = $aAuxHora[$linha["HORA"]];
		}
		
		
		
		//Fim Quantidade de Senhas Geradas por Hora
				
		
		$dbData->Get("select count(*) as qtde,to_char(dttriagem,'HH24') as hora from casenha,CASenhaRegra,CASenhaTi,CAAssunto
							where
								casenha.dttriagem is not null
							and
								CASenha.CASenhaRegra_Id = CASenhaRegra.Id
							and
								CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
							and
								CASenhaTi.CAAssunto_Id = CAAssunto.Id
							and
                  				trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'
								and
								CAAssunto.CAEvento_Id = '$_POST[p_CAEvento_Id]'
								group by to_char(dttriagem,'HH24')
								order by to_char(dttriagem,'HH24')");

	
		while ($linha = $dbData->Row())
		{
			$aGraf03[$linha["HORA"]] = $linha["QTDE"];
			$aGraf03_titulo[] = $aAuxHora[$linha["HORA"]];
		}
		
		
		
		$dbData->Get("select count(*) as qtde,to_char(dttriagem,'HH24') as hora from casenha,CASenhaRegra,CASenhaTi,CAAssunto
				where
				casenha.dttriagem is not null
				and
				CASenha.CASenhaRegra_Id = CASenhaRegra.Id
				and
				CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
				and
				CASenhaTi.CAAssunto_Id = CAAssunto.Id
				and
				 casenharegra.retorno = 'on'
				and
				trunc(CASenha.Dt) between '$_POST[p_DtInicio]' and '$_POST[p_DtTermino]'
				and
				CAAssunto.CAEvento_Id = '$_POST[p_CAEvento_Id]'
				group by to_char(dttriagem,'HH24')
				order by to_char(dttriagem,'HH24')");
		
		
		while ($linha = $dbData->Row())
		{
			$aGraf05[$linha["HORA"]] = $linha["QTDE"];
			$aGraf05_titulo[] = $aAuxHora[$linha["HORA"]];
		}

		
		//print_r($aGraf02); die();
		
		$arOpt[titulo] 		= "Quantidade de Senhas Geradas, Atendidas e Retorno por Hora";
		$arOpt[eixoY] 		= "Quantidade";
		$arOpt[prefixo]		= "";
		$arOpt[mostraLegenda] = "false";
		
		$arAux["Senha Gerada"] 		= array(implode(",",$aGraf04));
		$arAux["Senha Atendida"] 	= array(implode(",",$aGraf03));
		$arAux["Retorno"] 			= array(implode(",",$aGraf05));
		
		$chart->ColumnChart("#Graf3", $aGraf03_titulo, $arAux, $arOpt);
		
		echo $view->Div(array("id"=>"Graf3","style"=>"float:left;width:98%"));
		echo $view->CloseDiv();
		
//Fim Quantidade de Atendimentos por Hora


	
	}
	
	echo $view->Br();echo $view->Br();
	
?>