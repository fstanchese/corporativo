<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Acompanhamento de Atendimento por Período","Acompanhamento de Atendimento por Período",array('ADM','CPD','CASENHAGER','MARKETINGGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	
	
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);

	
	$nav 		= new Navigation($user, $app,$dbData);
	
	
	
	if($_POST[enviar] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");
		
		require_once '../model/CAEvento.class.php';
		
		$caEvento = new CAEvento($dbOracle);
	
		$view = new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form();	
	
			$form->Fieldset();	
		
				$form->Input("Evento",'select',array('name'=>'p_CAaEvento_Id',"required"=>'1',"option"=>$caEvento->Calculate("Geral")));
				$form->LabelMultipleInput("Data");
				$form->MultipleInput("","date",array("name"=>"p_Data1"));
				$form->MultipleInput("a","date",array("name"=>"p_Data2"));
					
			$form->CloseFieldset ();
		
			$form->Fieldset();
			
				$form->Button("submit",array("name"=>"enviar","value"=>"Gerar Relatório"));
		
	
			$form->CloseFieldset ();
	
		unset($form);
	}
	else
	{
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');
		
		require_once '../model/CASenhaRegra.class.php';
		require_once '../model/CAEvento.class.php';
		
		$casenharegra 	= new CASenhaRegra($dbOracle);
		$caEvento		= new CAEvento($dbOracle);
		
		$senhasRetorno 	= $casenharegra->GetSenhaRetonoByEvento($_POST[p_CAaEvento_Id]);
		$todasSenhas 	= $casenharegra->GetSenhaRegraByEvento($_POST[p_CAaEvento_Id]);
		
		$dadosEvento = $caEvento->GetIdInfo($_POST[p_CAaEvento_Id]);
		
		
		
		
		echo "<style>
				
					.titleSmall { font-weight:bold;font-size:13px }
				
					.titleBig { background:#bbb!important;font-size:13px;font-weight:bold; }
					
					.tbAcomp {
						background:#444;
					}
				
					.tbAcomp tr, .tbAcomp td { background:white }
				
					.tbAcomp tr td { padding: 3px 6px!important }
				
				</style>";
		
		
		
		
		//TODAS
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY to_char(casenha.dt,'hh24')");
		
	
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["TODOS"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["TODOS"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["TODOS"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["TODOS"] += $row[T];
		}
		
		
		//RETORNO
		if(is_array($senhasRetorno))
		{
			$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$senhasRetorno[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY to_char(casenha.dt,'hh24')");
			
			while($row = $dbData->Row())
			{
				$arItens["G"]["RETORNO"] += $row[T];
				if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["RETORNO"] += $row[T];
				if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["RETORNO"] += $row[T];
				if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["RETORNO"] += $row[T];
			}
		}
	
		
				
		
		//COM ATENDIMENTO
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dttriagem IS NOT NULL GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["CTRIAGEM"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["CTRIAGEM"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["CTRIAGEM"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["CTRIAGEM"] += $row[T];
		}
		
		
		//SEM ATENDIMENTO - CHEGOU AGORA
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dttriagem IS NULL AND dtchamada IS NULL AND emespera = '0' GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["CHEGOUAGORA"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["CHEGOUAGORA"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["CHEGOUAGORA"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["CHEGOUAGORA"] += $row[T];
		}
		
		
		//EM ESPERA
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dttriagem IS NULL AND  emespera = '1' GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["EMESPERA"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["EMESPERA"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["EMESPERA"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["EMESPERA"] += $row[T];
		}
		
		
		//CHAMADO SEM ATENDIMENTO
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dttriagem IS NULL AND dtchamada IS NOT NULL AND  emespera = '0' GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["CHAMADOSEMATENDIMENTO"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["CHAMADOSEMATENDIMENTO"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["CHAMADOSEMATENDIMENTO"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["CHAMADOSEMATENDIMENTO"] += $row[T];
		}
		
		
		//COM SAIDA
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dttriagem IS NOT NULL AND dtsaida IS NOT NULL GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["CSAIDA"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["CSAIDA"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["CSAIDA"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["CSAIDA"] += $row[T];
		}
		
		
		//SEM SAIDA
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND dtsaida IS NULL AND dttriagem IS NOT NULL GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["SSAIDA"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["SSAIDA"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["SSAIDA"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["SSAIDA"] += $row[T];
		}
		
		//COM lotefluxo
		
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'  AND casenha.id  in ( SELECT distinct(casenha_id) FROM lotefluxo ) GROUP BY to_char(casenha.dt,'hh24')");
		
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["Clotefluxo"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["Clotefluxo"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["Clotefluxo"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["Clotefluxo"] += $row[T];
		}
		
		
		
		
		
		//SEM lotefluxo
		$dbData->Get("SELECT to_char(casenha.dt,'hh24') as hr, count(*) as t FROM casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND casenha.id NOT IN ( SELECT distinct(casenha_id) FROM lotefluxo) GROUP BY to_char(casenha.dt,'hh24')");
		
		while($row = $dbData->Row())
		{
			$arItens["G"]["Slotefluxo"] += $row[T];
			if(intval($row[HR]) >=0 && intval($row[HR]) <=11)	$arItens["M"]["Slotefluxo"] += $row[T];
			if(intval($row[HR]) >=12 && intval($row[HR]) <=17)	$arItens["T"]["Slotefluxo"] += $row[T];
			if(intval($row[HR]) >=18 && intval($row[HR]) <=23)	$arItens["N"]["Slotefluxo"] += $row[T];
		}
		

		require_once("../engine/ViewReport.class.php");
		$viewReport = new ViewReport($app->title,$dadosEvento[DESCRICAO]." - ".$dadosEvento[CAMPUS_NOME]." - Período: ".$_POST[p_Data1]." a ".$_POST[p_Data2]);
		
		$viewReport->Header($dadosEvento[DESCRICAO]." - ".$dadosEvento[CAMPUS_NOME]." - Período: ".$_POST[p_Data1]." a ".$_POST[p_Data2]);
		
		echo $viewReport->Table(array("cellspacing"=>1,"border"=>0,"class"=>"tbAcomp")).
				$viewReport->Tr().
					$viewReport->Td(array("rowspan"=>2,"align"=>"center","class"=>"titleBig"))."Descrição".$viewReport->CloseTd().
					$viewReport->Td(array("colspan"=>4,"align"=>"center","class"=>"titleBig"))."Período (Hora)".$viewReport->CloseTd().
				$viewReport->CloseTr().
				$viewReport->Tr().
					$viewReport->Td(array("align"=>"center","class"=>"titleBig"))."Total".$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center","class"=>"titleBig"))."00:01 a 12:00".$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center","class"=>"titleBig"))."12:01 a 17:00".$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center","class"=>"titleBig"))."17:01 a 23:59".$viewReport->CloseTd().
				$viewReport->CloseTr();
		
		
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			
			echo $viewReport->Tr().$viewReport->Td(array("colspan"=>6,"class"=>"titleSmall"))."Atendimento - Senhas".$viewReport->CloseTd().$viewReport->CloseTr();
			
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
					$viewReport->Td()."Emitidas (Todas)".$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["TODOS"],0).$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["TODOS"],0).$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["TODOS"],0).$viewReport->CloseTd().
					$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["TODOS"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
						
	
			echo $viewReport->Tr().
				$viewReport->Td()."Retorno".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["RETORNO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["RETORNO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["RETORNO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["RETORNO"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Com Início de Atendimento".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["CTRIAGEM"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["CTRIAGEM"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["CTRIAGEM"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["CTRIAGEM"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			echo $viewReport->Tr().
				$viewReport->Td()."Em Espera".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["EMESPERA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["EMESPERA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["EMESPERA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["EMESPERA"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			echo $viewReport->Tr().
				$viewReport->Td()."Aguardando".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["CHEGOUAGORA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["CHEGOUAGORA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["CHEGOUAGORA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["CHEGOUAGORA"],0).$viewReport->CloseTd().
				$viewReport->CloseTr();
			
			echo $viewReport->Tr().
				$viewReport->Td()."Chamado S/ Início Atend.".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["CHAMADOSEMATENDIMENTO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["CHAMADOSEMATENDIMENTO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["CHAMADOSEMATENDIMENTO"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["CHAMADOSEMATENDIMENTO"],0).$viewReport->CloseTd().
				$viewReport->CloseTr();
			
			echo $viewReport->Tr().
				$viewReport->Td()."Atendimento Finalizado".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["CSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["CSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["CSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["CSAIDA"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
							
			
			echo $viewReport->Tr().
				$viewReport->Td()."Atendimento Não Finalizado".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["SSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["SSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["SSAIDA"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["SSAIDA"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Com Lote".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["Clotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["Clotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["Clotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["Clotefluxo"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Sem Lote".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["G"]["Slotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["M"]["Slotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["T"]["Slotefluxo"],0).$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($arItens["N"]["Slotefluxo"],0).$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			
			echo $viewReport->Tr().$viewReport->Td(array("colspan"=>6,"class"=>"titleSmall"))."Tempo de Espera".$viewReport->CloseTd().$viewReport->CloseTr();
			
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			
			
			


			// MENOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE 
					dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					ORDER BY tempo ASC";
					
			$menorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
			
			
			
			//menortempo MANHA
			
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo ASC";
				
			$menorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
			
			//menortempo TARDE
				
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo ASC";
			
			$menorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
			
			//menortempo NOITE
				
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo ASC";
			
			$menorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			
			
			
			// MAIOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					ORDER BY tempo DESC";
				
			$maiorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
				
				
				
			//MAIOR TEMPO MANHA
				
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo DESC";
			
			$maiorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
				
			//MAIOR TEMPO TARDE
			
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo DESC";
				
			$maiorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
				
			//MAIOR TEMPO NOITE
			
			$sql = "select LPAD(trunc(( (casenha.dtchamada - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtchamada - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtchamada - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo DESC";
				
			$maiorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			
			
			// TEMPO MEDIO GERAL
			$sql = "select TO_CHAR(TRUNC(avg((dtchamada-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtchamada-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtchamada-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					";
			
			$tempoMedio[GERAL] = $dbData->Row($dbData->Get($sql));
			
			
			
			//TEMPO MEDIO MANHA
			
			$sql = "select
						TO_CHAR(TRUNC(avg((dtchamada-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtchamada-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtchamada-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11";
				
			$tempoMedio[MANHA] = $dbData->Row($dbData->Get($sql));
			
			//TEMPO MEDIO TARDE
				
			$sql = "select
							TO_CHAR(TRUNC(avg((dtchamada-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtchamada-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtchamada-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17";
			
			$tempoMedio[TARDE] = $dbData->Row($dbData->Get($sql));
			
			//TEMPO MEDIO NOITE
				
			$sql = "select 	TO_CHAR(TRUNC(avg((dtchamada-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtchamada-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtchamada-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
			
					WHERE dttriagem is not null
					AND dtchamada is not null
					AND dtsaida is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23";
			
			$tempoMedio[NOITE] = $dbData->Row($dbData->Get($sql));
				

				
			
			echo $viewReport->Tr().
			$viewReport->Td()."Tempo Médio".$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[GERAL][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[MANHA][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[TARDE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
				
				
			echo $viewReport->Tr().
			$viewReport->Td()."Menor Tempo".$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
				
				
			echo $viewReport->Tr().
			$viewReport->Td()."Maior Tempo".$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			
			

			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
				
			echo $viewReport->Tr().$viewReport->Td(array("colspan"=>6,"class"=>"titleSmall"))."Atendimento que Gerou Lote".$viewReport->CloseTd().$viewReport->CloseTr();
				
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
				
			
			
			// MENOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo 
					FROM casenha WHERE  
					 
					dtsaida is not null	
					AND dtchamada is not null

					AND dtcancelado is null	
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' 
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) ORDER BY tempo ASC";
			
			$menorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
			
			
			
			//menortempo MANHA
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha WHERE
					dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo ASC";
				
			$menorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
			
			//menortempo TARDE
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE
					
					dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo ASC";
			
			$menorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
			
			//menortempo NOITE
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo ASC";
			
			$menorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			
			
			
			// MAIOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) ORDER BY tempo DESC";
				
			$maiorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
				
				
				
			//MAIOR TEMPO MANHA
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo DESC";
			
			$maiorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
				
			//MAIOR TEMPO TARDE
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo DESC";
				
			$maiorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
				
			//MAIOR TEMPO NOITE
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo DESC";
				
			$maiorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			
			
			// TEMPO MEDIO GERAL
			$sql = "select TO_CHAR(TRUNC(avg((dtsaida-casenha.dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-casenha.dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-casenha.dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo)";
			
			$tempoMedio[GERAL] = $dbData->Row($dbData->Get($sql));
			
			
			
			//TEMPO MEDIO MANHA
			
			$sql = "select 						TO_CHAR(TRUNC(avg((dtsaida-casenha.dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-casenha.dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-casenha.dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11";
				
			$tempoMedio[MANHA] = $dbData->Row($dbData->Get($sql));
			
			//TEMPO MEDIO TARDE
				
			$sql = "select 						TO_CHAR(TRUNC(avg((dtsaida-casenha.dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-casenha.dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-casenha.dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					 WHERE
					dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17";
			
			$tempoMedio[TARDE] = $dbData->Row($dbData->Get($sql));
			
			//TEMPO MEDIO NOITE
				
			$sql = "select 						TO_CHAR(TRUNC(avg((dtsaida-casenha.dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-casenha.dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-casenha.dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					WHERE 
					
					dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND casenha.id  IN ( SELECT distinct(casenha_id) FROM lotefluxo) AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23";
			
			$tempoMedio[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Tempo Médio".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Menor Tempo".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Maior Tempo".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			
			echo $viewReport->Tr().$viewReport->Td(array("colspan"=>6,"class"=>"titleSmall"))."Atendimento que Não Gerou Lote".$viewReport->CloseTd().$viewReport->CloseTr();
			
			
			
			
			// MENOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					ORDER BY tempo ASC";
			$menorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
				
				
				
			//menortempo MANHA
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo ASC";
			
			$menorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
				
			//menortempo TARDE
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dtsaida is not null
					AND dtchamada is not null
					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo ASC";
				
			$menorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
				
			//menortempo NOITE
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo ASC";
			
			$menorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
				
				
				
				
				
				
			// MAIOR TEMPO GERAL
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					ORDER BY tempo DESC";
			
			$maiorTempo[GERAL] = $dbData->Row($dbData->Get($sql));
			
			
			
			//MAIOR TEMPO MANHA
			
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11 ORDER BY tempo DESC";
				
			$maiorTempo[MANHA] = $dbData->Row($dbData->Get($sql));
			
			//MAIOR TEMPO TARDE
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17 ORDER BY tempo DESC";
			
			$maiorTempo[TARDE] = $dbData->Row($dbData->Get($sql));
			
			//MAIOR TEMPO NOITE
				
			$sql = "select LPAD(trunc(( (casenha.dtsaida - casenha.dt) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (casenha.dtsaida - casenha.dt) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (casenha.dtsaida - casenha.dt) * 86400, 3600 ), 60 )),2,0)	as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23 ORDER BY tempo DESC";
			
			$maiorTempo[NOITE] = $dbData->Row($dbData->Get($sql));
				
				
				
				
				
			// TEMPO MEDIO GERAL
			$sql = "select TO_CHAR(TRUNC(avg((dtsaida-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					";

			$tempoMedio[GERAL] = $dbData->Row($dbData->Get($sql));
				
				
				
			//TEMPO MEDIO MANHA
				
			$sql = "select  
						TO_CHAR(TRUNC(avg((dtsaida-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 0 and 11";
			
			$tempoMedio[MANHA] = $dbData->Row($dbData->Get($sql));
				
			//TEMPO MEDIO TARDE
			
			$sql = "select 		
							TO_CHAR(TRUNC(avg((dtsaida-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 12 and 17";
				
			$tempoMedio[TARDE] = $dbData->Row($dbData->Get($sql));
				
			//TEMPO MEDIO NOITE
			
			$sql = "select 	TO_CHAR(TRUNC(avg((dtsaida-dt)*24*60*60)/3600),'FM9900') || ':' ||
						    TO_CHAR(TRUNC(MOD(avg((dtsaida-dt)*24*60*60),3600)/60),'FM00') || ':' ||
						    TO_CHAR(MOD(avg((dtsaida-dt)*24*60*60),60),'FM00') as tempo
					FROM casenha
					
					WHERE dtsaida is not null
					AND dtchamada is not null

					AND dtcancelado is null
					AND casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."'
					AND to_number(to_char(casenha.dt,'HH24')) between 18 and 23";
				
			$tempoMedio[NOITE] = $dbData->Row($dbData->Get($sql));
			
			
			
			
			
			echo $viewReport->Tr(array("height"=>"30px")).$viewReport->Td(array("colspan"=>6)).$viewReport->CloseTd().$viewReport->CloseTr();
			

			echo $viewReport->Tr().
				$viewReport->Td()."Tempo Médio".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($tempoMedio[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Menor Tempo".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($menorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
			
			echo $viewReport->Tr().
				$viewReport->Td()."Maior Tempo".$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[GERAL][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[MANHA][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[TARDE][TEMPO],'','::').$viewReport->CloseTd().
				$viewReport->Td(array("align"=>"center"))._NVL($maiorTempo[NOITE][TEMPO],'','::').$viewReport->CloseTd().
			$viewReport->CloseTr();
			
		
		$viewReport->CloseTable();
		
		
		
		unset($viewReport);
		
		
		
	}
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	