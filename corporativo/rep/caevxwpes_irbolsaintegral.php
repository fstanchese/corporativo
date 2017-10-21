<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Candidatos com Bolsa Integral - Controle de Atendimento","Candidatos com Bolsa Integral - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
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
		
	
		$arFiltro[] 		= " ---- ";
		$arFiltro['ncomp'] 	= " Não compareceu ";
		$arFiltro['slote'] 	= " Não gerou processo ";
		
		$form = new Form();	
	
			$form->Fieldset();	
		
				$form->Input("Evento",'select',array('name'=>'p_CAEvento_Id',"required"=>'1',"option"=>$caEvento->Calculate("Geral")));
				
				
				$form->Input("Filtro",'select',array('name'=>'filtro',"option"=>$arFiltro));
				
					
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
				
				
			$vDescricao = 'Bolsal Integral - ';
			
		
			// NÃO COMPARECEU
			
			if($_REQUEST[filtro] == 'ncomp')
			{
			
			
				$dbData->Get("select
								wpessoa.nome, wpessoa.cpf
								from wpessoa, caevxwpes
								where
								wpessoa.id = caevxwpes.wpessoa_id
								
								AND wpessoa.id NOT IN ( SELECT wpessoa_id FROM casenha WHERE wpessoa_id IS NOT NULL )
								and caevento_id = '".$_POST[p_CAEvento_Id]."'
								AND 
									caevxwpes.id IN ( SELECT caevxwpes_id FROM cawpesdet WHERE valor = 'BOLSA INTEGRAL' )
								group by wpessoa.nome, wpessoa.cpf ORDER BY wpessoa.nome
					");
			}
			
			
			// NAO GEROU PROCESSO
			
			if($_REQUEST[filtro] == 'slote')
			{
					
				$vDescricao .= " Sem Processo ";
				
				
					
				
				$dbData->Get("select
								wpessoa.nome, wpessoa.cpf
								from wpessoa, caevxwpes, casenha
								where
								wpessoa.id = caevxwpes.wpessoa_id
								and
								casenha.wpessoa_id = wpessoa.id
								AND casenha.id NOT IN ( SELECT lotefluxo.casenha_id FROM lotefluxo )
								and caevento_id = '".$_POST[p_CAEvento_Id]."'
								AND 
									caevxwpes.id IN ( SELECT caevxwpes_id FROM cawpesdet WHERE valor = 'BOLSA INTEGRAL' )
								group by wpessoa.nome, wpessoa.cpf ORDER BY wpessoa.nome
					");
			}
		
			
			// 
			
			if($_REQUEST[filtro] == '')
			{
				
				$dbData->Get("select 
								WPessoa.Nome,CPF, CAEvXWPes.Id as CAEvXWPes_Id 
								FROM caevxwpes, wpessoa
								WHERE
									caevxwpes.wpessoa_id = wpessoa.id
								AND
									caevxwpes.CAEvento_Id = '".$_POST[p_CAEvento_Id]."'
								AND 
									caevxwpes.id IN ( SELECT caevxwpes_id FROM cawpesdet WHERE valor = 'BOLSA INTEGRAL' )
								order by WPessoa.Nome
					");
				
				
			}
			
				
			$vDescricao .= " - ".$dadosEvento[RECOGNIZE];
			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
				
			$arH[0]['TEXT'] = "Nome";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
			$arH[1]['TEXT'] = "CPF";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
		
		

			$viewReport->GridHeader($arH,array(80,50));
		
				
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				
				
				$viewReport->GridContent(array("TEXT"=>$rep["NOME"],"TEXT_ALIGN"=>"L"));
				$viewReport->GridContent(array("TEXT"=>_FormataCPF($rep["CPF"])));				
		
				unset($aLotes);
					
			}
		
		}
		
	}
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>