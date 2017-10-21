<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaзгo de Quantidade de Mesa em Atendimento por Hora","Relaзгo de Quantidade de Mesa em Atendimento por Hora",array('ADM','SAA_ANALISTA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/CAEvento.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$caEv 		= new CAEvento($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input('Evento','select',array("name"=>'p_CAEvento_Id',"option"=>$caEv->Calculate("Geral")));
			
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
			
			
			$vDescricao = 'Evento:  ' . $caEv->Recognize($_POST[p_CAEvento_Id],"RecReduz") . ' - Perнodo: ' . $_POST[p_Data1] .' a ' . $_POST[p_Data2];
			 

			
			$dbData->Get("select count(*) as qtde,ddhh as hora from 
							(
						select distinct(camesa_id), to_char(dttriagem,'dd/mm/yyyy hh24') as ddhh from casenha where camesa_id in (select id from camesa where caevento_id='$_POST[p_CAEvento_Id]')
						and trunc(dttriagem) between '".$_POST[p_Data1]."' and '".$_POST[p_Data2]."'
							) tbLa
						group by ddhh
						order by 2
				");

		
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
							
			$arH[0]['TEXT'] = "Dia/Hora";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = "Quantidade";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

		
			$viewReport->GridHeader($arH,array(50,50));
				
			
				
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				
				$viewReport->GridContent(array("TEXT"=>trim($rep["HORA"]).'h' ,"TEXT_SIZE"=>"8"));
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