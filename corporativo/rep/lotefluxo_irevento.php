<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaчуo de Lotes por Evento","Relaчуo de Lotes por Evento",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/CAEvento.class.php");
	include("../model/LoteProc.class.php");
	include("../model/Depart.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$caEv 		= new CAEvento($dbOracle);
	$loteProc	= new LoteProc($dbOracle);
	$depart		= new Depart($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input('Evento','select',array("name"=>'p_CAEvento_Id',"option"=>$caEv->Calculate("Geral")));
			
			$form->Input('Procedimento','select',array("name"=>'p_LoteProc_Id',"option"=>$loteProc->Calculate()));
			
			$form->Input('Departamento','select',array("name"=>'p_Depart_Id',"option"=>$depart->Calculate("Geral")));
			
			$form->LabelMultipleInput("Data");
			$form->MultipleInput("","date",array("name"=>"p_Data1"));
			$form->MultipleInput("a","date",array("name"=>"p_Data2"));
		
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
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{

			include("../engine/ReportPDF.class.php");
			
			
			require_once '../model/CASenhaRegra.class.php';
						
			
		
			$casenharegra 	= new CASenhaRegra($dbOracle);
			
			
			$dadosEvento = $caEv->GetIdInfo($_POST[p_CAEvento_Id]);
			
			
			$todasSenhas 	= $casenharegra->GetSenhaRegraByEvento($_POST[p_CAEvento_Id]);
			
			
				
			$vDescricao = 'Situaчуo dos Processos - Evento:  ' . $dadosEvento[RECOGNIZE]; 

			
			
			
			$dbData->Get("SELECT
					count(*) as qtde,
					loteproc.nome as loteproc,
					sala.codigo as sala,
					depart.nomereduz as depart,
					campus.nome as unidade,
					LoteProc_Id,
					lotefluxo.Sala_Id,
					lotefluxo.Depart_Id,
					lotefluxo.Campus_Id,
					LoteFluxo.Numero,
					LoteFluxo.Us,
					trunc(LoteFluxo.Dt) as Dt
				FROM
					LoteFluxo,
					CASenha,
          			LoteProc,
					Sala,
					Depart,
					Campus
					
				WHERE
					lotefluxo.casenha_id = casenha.id
				AND
					( LoteProc.Id = '".$_POST[p_LoteProc_Id]."' or '".$_POST[p_LoteProc_Id]."' is null )
				AND
          			lotefluxo.loteproc_id = loteproc.id
        		AND
					lotefluxo.depart_id = depart.id
				AND
					lotefluxo.sala_id = sala.id (+)
				AND
					lotefluxo.campus_id = campus.id
				AND
					( LoteFluxo.Depart_Id = '".$_POST[p_Depart_Id]."' or '".$_POST[p_Depart_Id]."' is null )			
				AND
					trunc(lotefluxo.dt) between '".$_POST[p_Data1]."' and '".$_POST[p_Data2]."' 
				AND
					casenha.casenharegra_id in (".implode(", ",$todasSenhas[Id]).")
					
				GROUP BY
					loteproc.nome,
					sala.codigo,
					depart.nomereduz,
					campus.nome,
					LoteProc_Id,
					lotefluxo.Sala_Id,
					lotefluxo.Depart_Id,
					lotefluxo.Campus_Id,
					lotefluxo.Numero,
					LoteFluxo.Us,
					trunc(LoteFluxo.Dt)
				ORDER BY
					Numero
				");

			//$dbData->ShowQuery();
			//die();
			
			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
							
			$arH[0]['TEXT'] = "Nr. Lote";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = "Gerado Por";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = "Gerado em";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = "Procedimento";
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[4]['TEXT'] = "Unidade";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[5]['TEXT'] = "Sala";
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[6]['TEXT'] = "Departamento";
			$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[7]['TEXT'] = "Pendentes";
			$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[8]['TEXT'] = "Total";
			$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$viewReport->GridHeader($arH,array(20,25,20,30,20,20,30,17,17));
				
			
				
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				
				$aReceber = $dbDataAux->Row($dbDataAux->Get("select count(*) as Qtde 
										from lotefluxo 
										where dtrecebimento is null and numero ='".$rep["NUMERO"]."'"));
				
				
				$viewReport->GridContent(array("TEXT"=>$rep["NUMERO"],"TEXT_ALIGN"=>"R","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["US"],"TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["DT"],"TEXT_ALIGN"=>"C","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["LOTEPROC"],"TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["UNIDADE"],"TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["SALA"],"TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["DEPART"],"TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$aReceber["QTDE"],"TEXT_ALIGN"=>"R","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["QTDE"],"TEXT_ALIGN"=>"R","TEXT_SIZE"=>"8"));
				
				
				unset($aLotes);
					
			}
				
		}	
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>