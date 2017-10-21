<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Relaзгo de Alunos Nгo Matriculados - Carteira de Passe","Relaзгo de Alunos Nгo Matriculados - Carteira de Passe",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/PLetivo.class.php");
	include("../model/Curso.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$pletivo	= new PLetivo($dbOracle);
	$curso		= new Curso($dbOracle);
	
	if($_POST["consultar"] == "" || $_POST["p_PLetivo_Id"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input('Perнodo Letivo','select',array("name"=>'p_PLetivo_Id',"option"=>$pletivo->Calculate("Geral")));			
			
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
			
			$dbDataAux->Get("select PLetivo_Pai_Id,nome from PLetivo where id=".$_POST["p_PLetivo_Id"]);
			$aPLetivo = $dbDataAux->Row();
			
			$aPL = $pletivo->GetIdInfo($aPLetivo["PLETIVO_PAI_ID"]);

			$vDescricao = 'Sem matrнcula em ' . $aPLetivo["NOME"] . ' matriculados em ' . $aPL["NOME"]; 
			
			$dbData->Get("
					select
					 	WPessoa.Id as WPessoa_Id,
						WPessoa.Codigo,
  						WPessoa.Nome,
  						WPessoa.RGRNE
					from
  						wpessoa,
  						matric, 
  						turmaofe, 
  						currofe
					where
 						WPessoa.Id = Matric.WPessoa_Id
					and
  						matric.wpessoa_id not in 
  							( select
						    	matric.wpessoa_id
  							from
    							matric,
				    			turmaofe,
    							currofe
  							where
    							matric.matricti_id = 8300000000001
  							and
    							matric.turmaofe_id = turmaofe.id
  							and
    							turmaofe.currofe_id = currofe.id
  							and
    							matric.state_id = 3000000002002
  							and
    							currofe.pletivo_id = '".$_POST["p_PLetivo_Id"]."' )
					and    
  						matric.matricti_id = 8300000000001
					and
  						matric.turmaofe_id = turmaofe.id
					and
  						turmaofe.currofe_id = currofe.id
					and
  						matric.state_id in (3000000002010,3000000002011,3000000002014,3000000002012)
					and
  						currofe.pletivo_id = '".$aPLetivo["PLETIVO_PAI_ID"]."'
					order by WPessoa.Nome
				");

			//$dbData->ShowQuery();
			//die();
			
			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","P");
							
			$arH[0]['TEXT'] = "Codigo";
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = "Nome";
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = "RG/RNE";
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[3]['TEXT'] = "Curso";
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$viewReport->GridHeader($arH,array(20,70,25,85));
				
			
				
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{
				$aCurso = '';
				$aCurso = $dbDataAux->Row($dbDataAux->Get("
					select
						turmaofe_gnRetCurso(matric.turmaofe_Id) as curso
					from
						matric,
						turmaofe,
						currofe					
					where   
  						matric.matricti_id = 8300000000001
					and
  						matric.turmaofe_id = turmaofe.id
					and
  						turmaofe.currofe_id = currofe.id
					and
  						matric.state_id in (3000000002010,3000000002011,3000000002014,3000000002012)
					and
						matric.wpessoa_Id = '".$rep["WPESSOA_ID"]."'
					and
  						currofe.pletivo_id = '".$aPLetivo["PLETIVO_PAI_ID"]."'
				"));
				
				
				$viewReport->GridContent(array("TEXT"=>$rep["CODIGO"],"TEXT_ALIGN"=>"R","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["NOME"],"TEXT_ALIGN"=>"L","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$rep["RGRNE"],"TEXT_ALIGN"=>"L","TEXT_SIZE"=>"8"));
				$viewReport->GridContent(array("TEXT"=>$curso->Recognize($aCurso["CURSO"]),"TEXT_SIZE"=>"8"));
				
				
				unset($aLotes);
					
			}
				
		}	
		
	}
	
	unset($pletivo);
	unset($curso);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>