<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Gerar Arquivo de Bolsistas FIES e PROUNI para SPTrans","Gerar Arquivo de Bolsistas FIES e PROUNI para SPTrans",array('ADM','CPD','SAA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Bolsa.class.php");
		
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	
	$bolsa 	= new Bolsa($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->LabelMultipleInput("Data");
			$form->MultipleInput("","date",array("name"=>"p_Data1"));
			$form->MultipleInput("a","date",array("name"=>"p_Data2"));
		
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em Excel"));
							
		$form->CloseFieldset ();	
			
		unset ($form);
		
		
		unset($view);	
		unset($nav);	
	}	
	else 
	{
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');

		$sql = "SELECT wpessoa_id,BolsaTi_gsRecognize(max(BolsaTi_Id)) as Bolsa
				FROM
					Bolsa				
				WHERE
					Bolsa.BolsaTi_Id in ( 10600000000049, 10600000000048,10600000000156,10600000000152,10600000000153,10600000000160)
				AND
					to_char(Bolsa.DtInicio,'yyyy') = '2015'
				AND
					Bolsa.State_Id in (3000000018001,3000000018003)
				group by wpessoa_id				
				";
		
		//Gerar em Excel
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Código Escola","Nome do Aluno","RG","DV","ESTADO EMISSOR","CPF","TIPO DE PROGRAMA","Data de Matrícula","Unidade"));
			
			$dbData->Get($sql);
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{

				$aMatric = $dbDataAux->Row($dbDataAux->Get("select matric.data as data,wpessoa.nome,wpessoa.rgrne,estado_gsRecognize(Estado_RG_ID) as estado,wpessoa.cpf,Campus_gsRecognize(currofe.campus_id) as unidade from matric,turmaofe,currofe,curr,curso,wpessoa where matric.wpessoa_id = wpessoa.id and matric.turmaofe_id = turmaofe.id and turmaofe.currofe_id = currofe.id and currofe.pletivo_id = 7200000000092 and currofe.curr_id = curr.id and curr.curso_id = curso.id and curso.cursonivel_id = 6200000000001 and matric.data between '$_POST[p_Data1]' and '$_POST[p_Data2]' and wpessoa_id = $rep[WPESSOA_ID]"));
				if (!empty($aMatric[DATA]))
				{
					if ($aMatric["UNIDADE"] == 'Mooca')
					{
						$excel->Content("128325");
					}
					else
					{
						$excel->Content("130745");
					}
					$excel->Content($aMatric["NOME"]);
					$excel->Content($aMatric["RGRNE"]);
					$excel->Content("");
					$excel->Content($aMatric["ESTADO"]);
					$excel->Content($aMatric["CPF"]);
					$excel->Content($rep["BOLSA"]);
					$excel->Content($aMatric["DATA"]);
					$excel->Content($aMatric["UNIDADE"]);
				}
			
			}
			
			$excel->EndTable();

			unset($excel);
			
		}
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>