<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	set_time_limit(5000);
	 
	$user = new User ();
	$app = new App("Situação dos Lotes","Situação dos Lotes",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	 
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	 
	include("../engine/Ajax.class.php");
	 
	include("../model/CAEvento.class.php");
	 
	$dbOracle    = new Db ($user);
	$dbData      = new DbData($dbOracle);
	$dbDataAux   = new DbData($dbOracle);
	
	$caEv        = new CAEvento($dbOracle);
	 
	if($_POST["consultar"] == "")
	{
		 
		$nav         = new Navigation($user, $app,$dbData);
		//$ajax             = new Ajax();
		 
		$view = new ViewPage($app->title,$app->description);
		 
		$view->Header($user,$nav);
		 
		$form = new Form();
		 
		$form->Fieldset();
		 
		$form->Input('Evento','select',array("name"=>'p_CAEvento_Id',"option"=>$caEv->Calculate()));
		 
		$form->CloseFieldset ();
	
		$form->Fieldset();
		 
		$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em PDF"));
		 
		 
		$form->CloseFieldset ();
	
		unset ($form);
		 
		 
		unset($view);
		unset($nav);
	}
	else
	{
		 
		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
	
	
			require_once '../model/CASenhaRegra.class.php';
	
	
			 
			$casenharegra       = new CASenhaRegra($dbOracle);
	
	
			$dadosEvento = $caEv->GetIdInfo($_POST[p_CAEvento_Id]);
	
	
			$todasSenhas = $casenharegra->GetSenhaRegraByEvento($_POST[p_CAEvento_Id]);
	
	
			 
			$vDescricao = 'Situação dos Processos - Evento:  ' . $dadosEvento[RECOGNIZE];
	
	
	
	
			$dbData->Get("select max(lotefluxo.id) as ID from lotefluxo, casenha  where lotefluxo.casenha_id = casenha.id AND    casenha.casenharegra_id in (".implode(", ",$todasSenhas[Id]).") group by casenha_id ");
	
	
			$dbData2 = new DbData($dbOracle);
			while($lista = $dbData->Row())
			{
	
				$linha = $dbData2->Row($dbData2->Get("SELECT nvl(sala_id,0) as sala_id, campus_id, depart_id, loteproc_id FROM lotefluxo WHERE id = '".$lista[ID]."'"));
				 
	
				 
				$arProc[$linha[CAMPUS_ID]."_".$linha[SALA_ID]."_".$linha[DEPART_ID]."_".$linha[LOTEPROC_ID]]++;
	
			}
	
			//     print_r($arProc);
	
	
			$dbData->Get("
	                                               select count(*) as qtde, tabela.loteproc_id, tabela.sala_id, tabela.campus_id, tabela.depart_id,
	                                               depart.nomereduz as depart,
	                                               campus.nome as unidade,
	                                               sala.codigo as sala,
	                                               loteproc.nome as loteproc
	                                                      from (
	                                                                            select
	                                                                              distinct(lotefluxo.numero),
	                                                                              loteproc_id, nvl(lotefluxo.sala_id,0) as sala_id, lotefluxo.campus_id, lotefluxo.depart_id
	
	                                                                                 from
	                                                                                   lotefluxo, casenha
	                                                                                 where
	                                                                                        lotefluxo.casenha_id = casenha.id
	                                                                                 AND
	                                                                                        casenha.casenharegra_id in (".implode(", ",$todasSenhas[Id]).")
	                                                                            order by loteproc_id ) tabela,
	
	                                                      depart, campus, sala, loteproc
	                                               WHERE
	                                                      tabela.loteproc_id = loteproc.id
	                                        AND
	                                                      tabela.depart_id = depart.id
	                                               AND
	                                                      tabela.sala_id = sala.id (+)
	                                               AND
	                                                      tabela.campus_id = campus.id
	
	                                  group by tabela.loteproc_id, tabela.sala_id, tabela.campus_id, tabela.depart_id,
	                                  depart.nomereduz,
	                                               campus.nome,
	                                               sala.codigo,
	                                               loteproc.nome
	
	                                  order by loteproc, unidade, depart
	
	
	
	                           ");
	
	
	
			//$dbData->ShowQuery();
			//die();
			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
			 
			$arH[0]['TEXT'] = "Processo do Lote";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
			$arH[1]['TEXT'] = "Unidade";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
			$arH[2]['TEXT'] = "Local";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			 
			$arH[3]['TEXT'] = "Departamento";
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	
			$arH[4]['TEXT'] = "Lotes";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			 
			$arH[5]['TEXT'] = "Processos";
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			 
			$viewReport->GridHeader($arH,array(50,25,25,50,20,20));
			 
			//echo "<pre>";
			//print_r($arProc);
			//die();
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				 
				//echo $linha[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]."\n";
				//echo $linha[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]."--------".$arProc[$linha[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]]."<br>";
				$viewReport->GridContent(array("TEXT"=>$rep["LOTEPROC"]));
				$viewReport->GridContent(array("TEXT"=>$rep["UNIDADE"]));
				$viewReport->GridContent(array("TEXT"=>$rep["SALA"]));
				$viewReport->GridContent(array("TEXT"=>$rep["DEPART"]));
				$viewReport->GridContent(array("TEXT"=>$rep["QTDE"],"TEXT_ALIGN"=>"R"));
				$viewReport->GridContent(array("TEXT"=>_NVL($arProc[$rep[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]],'0'),"TEXT_ALIGN"=>"R"));
				 
				$qtdelote += $rep["QTDE"];
				$qtdeproc += $arProc[$rep[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]];

				
				$arLoteByProc[$rep["LOTEPROC"]]["LOTE"] 	+= $rep["QTDE"];
				$arLoteByProc[$rep["LOTEPROC"]]["PROCESSO"] += $arProc[$rep[CAMPUS_ID]."_".$rep[SALA_ID]."_".$rep[DEPART_ID]."_".$rep[LOTEPROC_ID]];
				
				
				unset($aLotes);
				
				
				
	
			}
			
			$viewReport->GridContent(array("TEXT"=>''));
			$viewReport->GridContent(array("TEXT"=>''));
			$viewReport->GridContent(array("TEXT"=>''));
			$viewReport->GridContent(array("TEXT"=>Total));
			$viewReport->GridContent(array("TEXT"=>$qtdelote,"TEXT_ALIGN"=>"R"));
			$viewReport->GridContent(array("TEXT"=>$qtdeproc,"TEXT_ALIGN"=>"R"));
			
			
			
			$viewReport->CloseTable();
			
			
			$viewReport->Br();
			
			$arH[0]['TEXT'] = "Processo do Lote";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			
			$arH[1]['TEXT'] = "Lotes";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[2]['TEXT'] = "Processos";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$viewReport->GridHeader($arH,array(80,40,40));
			
			foreach($arLoteByProc as $lote => $array)
			{
					
				
				$viewReport->GridContent(array("TEXT"=>$lote));
				$viewReport->GridContent(array("TEXT"=>$array["LOTE"],"TEXT_ALIGN"=>"R"));
				$viewReport->GridContent(array("TEXT"=>$array["PROCESSO"],"TEXT_ALIGN"=>"R"));
			}
				
			 
		}
		 
	}
	 
	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);

	
?>