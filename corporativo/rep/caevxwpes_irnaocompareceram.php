<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Candidatos que Não Compareceram - Controle de Atendimento","Candidatos que Não Compareceram - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);	
	
	include ('../model/CAEvento.class.php');
	
	$caEvento = new CAEvento($dbOracle);	
	$nav 		= new Navigation($user, $app,$dbData);
	
	
	if($_POST["consultar"] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");
		
	
		$view = new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form();	
	
			$form->Fieldset();	
		
				$form->Input("Evento",'select',array('name'=>'p_CAEvento_Id',"required"=>'1',"option"=>$caEvento->Calculate("Geral")));
					
			$form->CloseFieldset ();
		
			$form->Fieldset();
			
				$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em PDF"));
		
	
			$form->CloseFieldset ();
	
		unset($form);
	}
	else
	{
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{
		
			include("../engine/ReportPDF.class.php");
			include("../model/CAWPesDet.class.php");
			
			$wpesDet	= new CAWPesDet($dbOracle);
				
				
			
			$dadosEvento = $caEvento->GetIdInfo($_POST[p_CAEvento_Id]);
				
				
			$vDescricao = 'Candidatos Que Não Compareceram - Evento:  ' . $dadosEvento[RECOGNIZE];
		
			$dbData->Get("select lower(WPessoa.Nome) as nome,CPF, CAEvXWPes.Id as CAEvXWPes_Id from caevxwpes,wpessoa
							where
								wpessoa_id not in (
									select distinct(WPessoa_Id) 
									from casenha,casenharegra,casenhati,caassunto 
									where
  										CASenha.CASenhaRegra_Id = CASenhaRegra.Id
									and
										CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
									and
  										CASenhaTi.CAAssunto_Id = CAAssunto.Id
									and
  										CAAssunto.CAEvento_Id in (select id from caEvento where descricao='".$dadosEvento["DESCRICAO"]."')
									)
								AND
									WPessoa.Id = CAEvXWPes.WPessoa_Id 
								AND
  									CAEvento_Id = '".$_POST[p_CAEvento_Id]."' order by WPessoa.Nome
					 
				");
		
			//$row = $dbData->Row();
			
			//print_r($row);
			//$dadosPessoa = $wpesDet->GetWPesInfo($row[CAEVXWPES_ID]);
			
			//$dbData->ShowQuery();
			//die();
				
				
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
				
			$arH[0]['TEXT'] = "Nome";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
			$arH[1]['TEXT'] = "CPF";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
			$arH[2]['TEXT'] = "Bolsa Adicional";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[3]['TEXT'] = "Unidade";
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
			$arH[4]['TEXT'] = "Endereço";
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[5]['TEXT'] = "Telefone";
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[6]['TEXT'] = "E-mail";
			$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$viewReport->GridHeader($arH,array(65,25,23,15,70,25,55));
		
				
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				$dadosPessoa = $wpesDet->GetWPesInfo($rep[CAEVXWPES_ID]);
				
				
				$viewReport->GridContent(array("TEXT"=>ucfirst($rep["NOME"]),"TEXT_ALIGN"=>"L"));
				$viewReport->GridContent(array("TEXT"=>_FormataCPF($rep["CPF"])));				
				$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Bolsa Adicional'],"TEXT_ALIGN"=>"C"));
				$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Campus']));
				$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Endereço'],"TEXT_ALIGN"=>"L"));
				$viewReport->GridContent(array("TEXT"=>$dadosPessoa['Telefone'],"TEXT_ALIGN"=>"l"));
				$viewReport->GridContent(array("TEXT"=>$dadosPessoa['E-mail'],"TEXT_ALIGN"=>"L"));
		
				unset($aLotes);
					
			}
		
		}
		
	}
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>