<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Alteração de Informações dos Assuntos de Ocorrência - S.A.A.","Alteração de Informações dos Assuntos de Ocorrência - S.A.A.",array('ADM','CPD','SAA_ANALISTA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/WOcorrAss.class.php");
	include("../model/WOAXWOAInf.class.php");
	include("../model/WOAXAnexoTi.class.php");
	include("../model/Empresa.class.php");


	$dbOracle = new Db ($user);
	
	

	$dbData = new DbData ($dbOracle);
	

	$nav = new Navigation($user, $app, $dbData);
	

	$wocorrAss	= new WOcorrAss($dbData);
	$wOAXWOAInf = new WOAXWOAInf($dbData);
	$wOAXAnexoTi = new WOAXAnexoTi($dbData);


	

	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($wocorrAss->Query("qId",array("p_WOcorrAss_Id"=>$_POST[p_WOcorrAss_Id])));
		$linhaSelected = $dbData->Row();
	}
	

    if($_GET["p_WOcorrAss_Id"] != "") 
    { 
    	$linhaSelected[WOCORRASS_ID] = $_GET["p_WOcorrAss_Id"];
       	$linhaSelected[WOCORRASS_ID] = $_GET["p_WOcorrAss_Id_r"];
    }
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	

	$wocorrAss->IUD($_POST);
	
	$view->Header($user,$nav);
	
	
	$form = new Form();
	

		$form->Input('','hidden',array("name"=>'p_WOcorrAss_Id',"value"=>$linhaSelected[ID]));

		$form->Fieldset();
			
			$dbData->Get($wOAXWOAInf->Query('qWOcorrAss',array("p_WOcorrAss_Id"=>$linhaSelected[ID])));
			while($row = $dbData->Row())
			{
				$vInfObrig .= $row[LABEL] . '<br>';
			}			
			if ($vInfObrig == '')
				$vInfObrig = 'Não há';

			$dbData->Get($wOAXAnexoTi->Query('qWOcorrAss',array("p_WOcorrAss_Id"=>$linhaSelected[ID])));
			while($row = $dbData->Row())
			{
				$vDocNecessario .= $row[ANEXOTI_RECOGNIZE] . '<br>';
			}
			if ($vDocNecessario == '')
				$vDocNecessario = 'Não há';
				
			
			
			$form->Input("Assunto",'text',array("class"=>"size60",'name'=>'p_NomeNet','value'=>$linhaSelected[NOMENET]));
			$form->Input("Código",'label',array($linhaSelected[CODIGO]));
			$form->Input("Assunto Ativo",'label',array($view->OnOff($linhaSelected[ATIVO])));
			$form->Input("Disponível Internet",'label',array($view->OnOff($linhaSelected[INTERNET])));
			$form->Input("Descrição","textarea",array("name"=>'p_Descricao', "class"=>"size60", "rows"=>"4", "value"=>$linhaSelected[DESCRICAO]));
			$form->Input("Documentos Necessários",'label',array($vDocNecessario));
			$form->Input("Informações Obrigatórias",'label',array($vInfObrig));
			$form->Input("Documentos Emitidos",'text',array("name"=>"p_DescSaida","class"=>"size60","value"=>$linhaSelected[DESCSAIDA]));
			$form->Input("Prazo",'text',array("name"=>"p_Prazo","class"=>"size10","value"=>$linhaSelected[TEMPORESPOSTA]));
							
			$form->Input("Retirar Data de Urgência",'checkbox',array("name"=>"p_SemUrgencia","class"=>"size10","checked"=>$linhaSelected[SEMURGENCIA],"value"=>$linhaSelected[SEMURGENCIA]));
			$form->Input("Quantidade de Vias do Protocolo",'text',array("name"=>"p_QtdeViasProt","class"=>"size10","value"=>$linhaSelected[QTDEVIASPROT]));
		
			$form->Input("Matrícula Obrigatória",'checkbox',array("name"=>"p_ObrigMatric","class"=>"size10","checked"=>$linhaSelected[OBRIGMATRIC],"value"=>$linhaSelected[OBRIGMATRIC]));
			
			$form->Input("Motivo(Não disponibilizada na Internet)","textarea",array("name"=>'p_Motivo', "class"=>"size60", "rows"=>"4", "value"=>$linhaSelected[MOTIVO]));
			$form->Input("Orientação Acadêmica","textarea",array("name"=>'p_OrAcademica', "class"=>"size60", "rows"=>"4", "value"=>$linhaSelected[ORACADEMICA]));
			$form->Input("Orientação Financeira","textarea",array("name"=>'p_OrFinanceira', "class"=>"size60", "rows"=>"4", "value"=>$linhaSelected[ORFINANCEIRA]));
			
		$form->CloseFieldset ();				
		
		$form->Fieldset();
		
			
			$form->IUDButtons();
					
		$form->CloseFieldset ();
			

	unset($form);
		

	if($_GET["p_O_Option"] == "search" || $_GET[p_WOcorrAss_Id] != '')
	{	
	

		$dbData->Get($wocorrAss->Query('qGeral'));
	

		if($dbData->Count () > 0)
		{
	
			$grid = new DataGrid(array("Assunto","Editar","Excluir"));
	
			while($row = $dbData->RowLimit($_GET[page]))
						{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($wocorrAss,$row[ID]));
				$grid->Content($view->Delete($wocorrAss,$row[ID]));
			}
		}

		//fecha grid
		unset($grid);	
		
		$dbData->Pagination();
		
	}	


	unset($wocorrAss);

	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>