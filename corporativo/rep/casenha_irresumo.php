<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Resumo de Atendimento por Dia","Resumo de Atendimento por Dia",array('ADM','CPD','CASENHAGER'),$user);
	
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
		

		require_once '../model/CASenhaRegra.class.php';
		require_once '../model/CAEvento.class.php';
		
		$casenharegra 	= new CASenhaRegra($dbOracle);
		$caEvento		= new CAEvento($dbOracle);
		
		$senhasRetorno 	= $casenharegra->GetSenhaRetonoByEvento($_POST[p_CAaEvento_Id]);
		$todasSenhas 	= $casenharegra->GetSenhaRegraByEvento($_POST[p_CAaEvento_Id]);
		
		$dadosEvento = $caEvento->GetIdInfo($_POST[p_CAaEvento_Id]);
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');
		
		
		include("../engine/ReportPDF.class.php");
		$viewReport = new ReportPDF($app->title,$dadosEvento[DESCRICAO]." - ".$dadosEvento[CAMPUS_NOME]." - Período: ".$_POST[p_Data1]." a ".$_POST[p_Data2]);
		

		//EMITIDOS
		$dbData->Get("select trunc(casenha.dt) as dt, count(*) as t from casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY trunc(casenha.dt) ORDER BY dt ASC");
	
		while ($row = $dbData->Row())
		{
			$arData[$row[DT]]["EMITIDOS"] = $row[T];
		}
		
		
		
		//RETORNO
		
		if(is_array($senhasRetorno))
		{
			$dbData->Get("select trunc(casenha.dt) as dt, count(*) as t from casenha WHERE casenharegra_id IN ( ".implode(",",$senhasRetorno[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY trunc(casenha.dt) ORDER BY dt ASC");
			
			while ($row = $dbData->Row())
			{
				$arData[$row[DT]]["RETORNO"] = $row[T];
			}
		}
		
		
		//COM ATENDIMENTO
		$dbData->Get("select trunc(casenha.dt) as dt, count(*) as t from casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND dttriagem IS NOT NULL AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY trunc(casenha.dt) ORDER BY dt ASC");
		
		while ($row = $dbData->Row())
		{
			$arData[$row[DT]]["CATEND"] = $row[T];
		}
		
		
		//SEM ATENDIMENTO
		$dbData->Get("select trunc(casenha.dt) as dt, count(*) as t from casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND dttriagem IS NULL AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' GROUP BY trunc(casenha.dt) ORDER BY dt ASC");
		
		while ($row = $dbData->Row())
		{
			$arData[$row[DT]]["SATEND"] = $row[T];
		}
		
		
		//COM lotefluxo
		$dbData->Get("select trunc(casenha.dt) as dt, count(*) as t from casenha WHERE casenharegra_id IN ( ".implode(",",$todasSenhas[Id])." ) AND trunc(casenha.dt) between '".$_POST[p_Data1]."' AND '".$_POST[p_Data2]."' AND casenha.id  in ( select distinct(casenha_id) FROM lotefluxo ) GROUP BY trunc(casenha.dt) ORDER BY dt ASC");
		
		while ($row = $dbData->Row())
		{
			$arData[$row[DT]]["CLOTE"] = $row[T];
		}
		
		

		$arH[0]['TEXT'] = "Data";
		$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[1]['TEXT'] = "Emitidos";
		$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[2]['TEXT'] = "Retorno";
		$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[3]['TEXT'] = "C/ Início Atend.";
		$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[4]['TEXT'] = "S/ Início Atend.";
		$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		$arH[5]['TEXT'] = "C/ Lote";
		$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
		$viewReport->GridHeader($arH,array(25,35,35,35,35,35));
		
		
		//print_r($arData);
		
		if(is_array($arData))
		{
		
			foreach($arData as $data => $array)
			{
				
			
				
				$viewReport->GridContent(array("TEXT"=>$data));
				$viewReport->GridContent(array("TEXT"=>_NVL($array[EMITIDOS])));
				$viewReport->GridContent(array("TEXT"=>_NVL($array[RETORNO])));
				$viewReport->GridContent(array("TEXT"=>_NVL($array[CATEND])));
				$viewReport->GridContent(array("TEXT"=>_NVL($array[SATEND])));
				$viewReport->GridContent(array("TEXT"=>_NVL($array[CLOTE])));
				
				$vTotal[EMITIDOS] 	+= $array[EMITIDOS];
				$vTotal[RETORNO]	+= $array[RETORNO];
				$vTotal[CATEND] 	+= $array[CATEND];
				$vTotal[SATEND] 	+= $array[SATEND];
				$vTotal[CLOTE] 		+= $array[CLOTE];
			}
			
			$viewReport->GridContent(array("TEXT"=>"Total"));
			$viewReport->GridContent(array("TEXT"=>_NVL($vTotal[EMITIDOS])));
			$viewReport->GridContent(array("TEXT"=>_NVL($vTotal[RETORNO])));
			$viewReport->GridContent(array("TEXT"=>_NVL($vTotal[CATEND])));
			$viewReport->GridContent(array("TEXT"=>_NVL($vTotal[SATEND])));
			$viewReport->GridContent(array("TEXT"=>_NVL($vTotal[CLOTE])));
			
		}
		else 
		{
			$viewReport->Content("Não há informações",array("align"=>"center","colspan"=>6));
			
		}
		
		
		
		unset($viewReport);
		
		
		
	}
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	