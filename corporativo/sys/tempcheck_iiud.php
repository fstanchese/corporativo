<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Check-List","Cadastro de Check-List",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Excel.class.php");

	include("../engine/Ajax.class.php");
	
	include("../model/TempCheck.class.php");
	
	include("../model/WPessoa.class.php");
	
	include("../model/CASenha.class.php");

	$dbOracle = new Db ($user);

	$dbData = new DbData ($dbOracle);
	
	$ajax = new Ajax();
	
	$nav = new Navigation($user, $app, $dbData);

	$tempCheck = new TempCheck($dbOracle);
	
	$caSenha = new CASenha($dbOracle);


	$wp = new WPessoa($dbOracle);

	include_once ("../model/Matric.class.php");
	include_once ("../model/TurmaOfe.class.php");
	include_once ("../model/CurrOfe.class.php");
	include_once ("../model/State.class.php");

	include_once ("../model/CCobCarta.class.php");

	
	include_once("../model/Boleto.class.php");	
	$boleto = new Boleto($dbOracle);	
	$ar["p_CCobCartaTi_Id"] = 207900000000002;
	$ar["p_DtInicio"] = '01/2013';
	$ar["p_DtTermino"] = '12/2013';
	$ar["p_Qtde"] = '4';
	$ar["p_State_Matric_Id"] = '3000000002011';
	$ar["p_Curso_Id"] = '';
	$ar["p_CursoNivel_Id"] = '';
	
	//$boleto->GetDevedores($ar);
	//Teste com os boletos em Cobrança Externa
	//$aBol = $boleto->GetBoletoCobExt(1600000051538,'20/05/2014');	
	//print_r($aBol);
	
	include_once("../model/CAMesa.class.php");
	
	$camesa 	= new CAMesa($dbOracle);
	
	echo $camesa->GetMesaSituacao(199700000000019);
	
	
	$ccob = new CCobCarta($dbOracle);

	
	include_once("../model/Parcel.class.php");
	
	$parcel = new Parcel($dbOracle);
	

	//$ccob->GetDevedores($ar);
	
	//include_once '../model/WPesCobRest.class.php';
	
	//$wpes = new WPesCobRest($dbOracle);
	
	//print_r($wpes->GetRestricao(1600000191768));
	
	
/*
	$dbData->Get("select CCobCarta.Id as carta,WPessoa_gsRecognize(WPessoa_Id) as nome from ccobcarta where id in (select ccobcarta_id from ccobdebito)");
	
	while ($row = $dbData->Row())		
	{
		if ($row["NOME"] <> $ccob->GetResponsavel($row["CARTA"]))
			print 'Carta: ' . $row["CARTA"] . ' Devedor: ' . $row["NOME"] . ' Contratante: ' . $ccob->GetResponsavel($row["CARTA"]) . '<br>';
	}
*/
		
	$matric = new Matric($dbOracle);
	$turmaofe = new TurmaOfe($dbOracle);
	$currofe = new CurrOfe($dbOracle);
	$state 	= new State($dbOracle);
	
	
	$amat = $matric->GetCursoNivel(8400000835947);
	
	print_r($amat);
	die();
	//$arCurr			= $curr->GetIdInfo($arCurrOfe[CURR_ID]);
	
	
	 //echo _ShortName('MIS-IT - Master Integration Solutions of Information Technology - Especialista em Integração de Soluções na Tecnologia da Informação', 80);
	
	
	$arMatric = $matric->GetIdInfo(8400000810859);
	$arTurmaOfe = $turmaofe->GetIdInfo($arMatric[TURMAOFE_ID]);
	$arCurrOfe 		= $currofe->GetIdInfo($arTurmaOfe[CURROFE_ID]);
	
	
	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($tempCheck->Query("qId",array("p_TempCheck_Id"=>$_POST[p_TempCheck_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	
	
	if($_GET["p_TempCheckEv_Id"] != "") $linhaSelected[TEMPCHECKEV_ID] = $_GET["p_TempCheckEv_Id"]; 
	
	
	print $caSenha->ProximaSenha(199700000000011) ; 

	$view = new ViewPage($app->title,$app->description);
	$view->IncludeJS('jqfancytransitions.js');
	
	$view->IncludeCSS("casenha.css");
	
	
	$code .= "$('#placeHolderID').jqFancyTransitions({effect: 'wave',position: 'left', direction: 'top', delay: 2000});";
	echo $view->JS($code);
	
	$view->Explain ("IUD");	
	
	
	
	if(($_POST["p_O_Option"] == "insert" || $_POST["p_O_Option"] == "update" ) && $_POST["p_Confirmado"] == "")
		$_POST["p_Confirmado"] = "off";
	
		
 	
	$tempCheck->IUD($_POST);

	$view->Header($user,$nav);
	
	$form = new Form();

		$form->Fieldset("Título 1");
		
			$form->Input('',		'hidden',			array("name"=>'p_TempCheck_Id',"value"=>$linhaSelected[ID]));
		
			$form->Input('Evento','select',	array("name"=>'p_TempCheckEv_Id',"required"=>'1',  "value"=>$linhaSelected[TEMPCHECKEV_ID], "option"=>$tempCheck->Calculate("Evento",$dbData)));
			
			$form->Input('Teste','select',	array("name"=>'p_TempCheckEv_Id',"required"=>'1',  "value"=>$linhaSelected[TEMPCHECKEV_ID], "option"=>$state->Calculate("StateTiNome",array("p_StateTi_Nome"=>"boleto"))));			
			
			$form->Input('Data','date',	array("name"=>'aaa'));
			$form->Input('Data e Hora','datetime',	array("name"=>'bbb'));
			$form->Input('Hora','time',	array("name"=>'ccc'));
			

		$form->CloseFieldset ();	

		$form->Fieldset("ewqewq eqwe wqe wq");
		
			
			$form->Input($tempCheck->GetLabel("Nome"),'autocomplete',array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>'1600000001234',"label"=>"Vinicius Oliveira"));
			
		
			$form->Input("","label",$wp->GetInfoAluno('1600000158374'));
			//$form->Input("","label",$wp->GetInfoDocente('1610000001938'));
			//$form->Input("","label",$wp->GetInfoFuncionario('1600000158374'));
			
						
			$form->Input('Relacionado com Módulo',
					'select',
					array("name"=>'p_TempCheck_Pai_Id', "value"=>$linhaSelected[TEMPCHECK_PAI_ID], "option"=>array(""=>"Selecione o Evento")));
			
			
			$ajax->InputRequired("p_TempCheckEv_Id","p_TempCheck_Pai_Id","change",$tempCheck->query["qLista"],array("p_TempCheckEv_Id"=>"p_TempCheckEv_Id"));
			
			
			$form->Input('Descrição',
					'textarea',
					array("name"=>'p_Descricao', "class"=>"size70 heightSmall", "value"=>$linhaSelected[DESCRICAO]));
			
			$form->Input('Descrição',
					'editor',
					array("name"=>'p_Descricao2', "class"=>"size70 heightSmall", "style"=>"height:150px",  "value"=>$linhaSelected[DESCRICAO]));
				
			
			$form->Input('Prioridade',
					'select',
					array("name"=>'p_Prioridade_Id',"required"=>'1', "value"=>$linhaSelected[PRIORIDADE_ID], "option"=>$tempCheck->Calculate("Prioridade")));
			
			
			$form->Input('Prioridade',
					'multiselect',
					array("name"=>'p_Prioridade_Id',"required"=>'1', "value"=>array(), "option"=>$tempCheck->Calculate("Prioridade")));
			
			
			
			$form->Input('Periodicidade',
					'select',
					array("name"=>'p_Ciclo_Id',"required"=>'1', "value"=>$linhaSelected[CICLO_ID], "option"=>$tempCheck->Calculate("Periodicidade")));
			
			$form->Input('Responsável',
					'select',
					array("name"=>'p_WPessoa_Resp_Id', "value"=>$linhaSelected[WPESSOA_RESP_ID], "option"=>$tempCheck->Calculate("Usuario")));
			
			
			$form->Input('Departamento',
					'select',
					array("name"=>'p_Depart_Id', "value"=>$linhaSelected[DEPART_ID], "option"=>$tempCheck->Calculate("Departamento")));
			
			if($linhaSelected[CONFIRMADO] == 'on')
				$checked = true;
			else
				$checked = false;
			
			$form->Input('Confirmado?',	'onoff' , array("name"=>'p_Confirmado', "value"=>$linhaSelected[CONFIRMADO]));

			$form->Input('teste?',	'range' , array("name"=>'p_Confirmado', "value"=>10));
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	

	if($_GET["p_O_Option"] == "search")
	{
	
	

		$dbData->Get($tempCheck->Query('qLista',array("p_TempCheckEv_Id"=>$_GET[p_TempCheckEv_Id])));
	
		if($dbData->Count () > 0)
		{
			
			$grid = new DataGrid(array("Módulo","Ciclo","Depart.","Prioridade","Responsável","Confirmado", "Usuário", "Editar","Del"));
			
			while($row = $dbData->Row ())
			{
				
				$grid->Detail(array("Descrição"=>$row[DESCRICAO]));
				
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				
				$dbData2 = new DbData ($dbOracle);
				$dbData2->Get("SELECT nome AS ciclo FROM ciclo WHERE id = '".$row["CICLO_ID"]."'");
				$linha = $dbData2->Row();
				
				$grid->Content($linha[CICLO],array('align'=>'center'));
				
				unset($linha);
				unset($dbData2);
				

				$dbData2 = new DbData ($dbOracle);
				$dbData2->Get("SELECT nomereduz AS depart FROM depart WHERE id = '".$row["DEPART_ID"]."'");
				$linha = $dbData2->Row();
				
				$grid->Content($linha[DEPART],array('align'=>'center'));
				
				unset($linha);
				unset($dbData2);
				
				
				$dbData2 = new DbData ($dbOracle);
				$dbData2->Get("SELECT nome AS prioridade FROM prioridade WHERE id = '".$row["PRIORIDADE_ID"]."'");
				$linha = $dbData2->Row();
				
				$grid->Content($linha[PRIORIDADE],array('align'=>'center'));
				
				unset($linha);
				unset($dbData2);
				

				
				$dbData2 = new DbData ($dbOracle);
				$dbData2->Get("SELECT usuario  FROM wpessoa WHERE id = '".$row["WPESSOA_RESP_ID"]."'");
				$linha = $dbData2->Row();
				
				$grid->Content($linha[USUARIO],array('align'=>'center'));
				
				unset($linha);
				unset($dbData2);
				
				
				
				$grid->Content($view->OnOff($row[CONFIRMADO]),array('align'=>'center'));
				$grid->Content($row[US],array('align'=>'center'));
				$grid->Content($view->Edit($tempCheck,$row[ID]));
				$grid->Content($view->Delete($tempCheck,$row[ID]));
			}
		}
		
		

		

		unset($grid);
		
		//$dbData->Pagination();
	}

	
	echo '<div id=placeHolderID>
	<img src=../images/sem_foto_ele.gif alt=img1 />
	<img src=../images/foto_nao_disponivel.jpg alt=img2 />
	<img src=../images/sem_foto_ela.gif alt=img3 />
	</div>';
	
	
	echo $wp->teste('201101615','35715');
	
	
	unset($tempCheck);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>