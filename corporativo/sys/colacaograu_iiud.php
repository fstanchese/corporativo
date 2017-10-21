<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");	

	$user = new User ();
	$app = new App("Cadastro da Ata de Colação de Grau II","Cadastro da Ata de Colação de Grau II",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/ColacaoGrau.class.php");
	include("../model/ColacaoGrauTi.class.php");	
	include("../model/Curso.class.php");
	include("../model/Campus.class.php");
	include("../model/PLetivo.class.php");
	include("../model/CurrOfe.class.php");
	include("../model/TurmaOfe.class.php");
	
	
	$dbOracle 	= new Db ($user);
	
	$dbData 	= new DbData ($dbOracle);

	$ajax = new Ajax();
	
	$nav 		= new Navigation($user, $app, $dbData);
		
	$colacaoGrau 	= new ColacaoGrau($dbOracle);
	$colacaoGrauTi	= new ColacaoGrauTi($dbOracle);
	$curso 			= new Curso($dbOracle);
	$campus 		= new Campus($dbOracle);
	$cursoNivel 	= new Curso($dbOracle);
	$pLetivo 		= new PLetivo($dbOracle);
	$currOfe		= new CurrOfe($dbOracle);
	$turmaOfe		= new TurmaOfe($dbOracle);
	
	
		
	if($_POST[p_O_Option] == "select")
	{
		$colacaoInfo = $colacaoGrau->GetIdInfo($_POST[p_ColacaoGrau_Id]);		
	}
	
	
	if($_GET["p_PLetivo_Id"] != "") $colacaoInfo[PLETIVO_ID] = $_GET["p_PLetivo_Id"];
	if($_GET["p_Campus_Id"] != "") $colacaoInfo[CAMPUS_ID] = $_GET["p_Campus_Id"];
	if($_GET["p_ColacaoGrauTi_Id"] != "") $colacaoInfo[COLACAOGRAUTI_ID] = $_GET["p_ColacaoGrauTi_Id"];
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");

	if($_POST["p_PLetivo_Id"] != "") $colacaoInfo[PLETIVO_ID] = $_POST["p_PLetivo_Id"];
	if($_POST["p_Campus_Id"] != "") $colacaoInfo[CAMPUS_ID] = $_POST["p_Campus_Id"];
	if($_POST["p_ColacaoGrauTi_Id"] != "") $colacaoInfo[COLACAOGRAUTI_ID] = $_POST["p_ColacaoGrauTi_Id"];
	if($_POST["p_Localizacao"] != "") $colacaoInfo[LOCALIZACAO] = $_POST["p_Localizacao"];
	if($_POST["p_DtColacao"] != "") $colacaoInfo[DTCOLACAO] = $_POST["p_DtColacao"];
	if($_POST["p_Horario"] != "") $colacaoInfo[HORARIO] = $_POST["p_Horario"];
	if($_POST["p_WPessoa_Pres"] != "") $colacaoInfo[WPESSOA_PRES_ID] = $_POST["p_WPessoa_Pres"];
	if($_POST["p_Colacao"] != "") $colacaoInfo[COLACAO] = $_POST["p_Colacao"];
	if($_POST["p_Diploma"] != "") $colacaoInfo[DIPLOMA] = $_POST["p_Diploma"];
	

	echo $view->On("change","#ColacaoTiId", "$('#CursoTurmaId').hide();if ($(this).val() == 124200000000001) $('#CursoTurmaId').show();");
	
	$ajax->InputRequired('PLetivoId','CursoId','change',$curso->query["qColacao"],array('p_PLetivo_Id'=>"PLetivoId",'p_Campus_Id'=>"CampusId"),$colacaoInfo[CURSO_ID]);
	$ajax->InputRequired('CampusId','CursoId','change',$curso->query["qColacao"],array('p_PLetivo_Id'=>"PLetivoId",'p_Campus_Id'=>"CampusId"),$colacaoInfo[CURSO_ID]);
	$ajax->InputRequired('CursoId','TurmaOfeId','change',$turmaOfe->query["qUltimoAno"],array('p_PLetivo_Id'=>"PLetivoId",'p_Curso_Id'=>"CursoId",'p_Campus_Id'=>"CampusId"));
	
	$colacaoGrau->IUD($_POST);
		
	$view->Header($user,$nav);
	
	$form = new Form();
	
		$form->Fieldset();
			$form->Input('','hidden',array("name"=>'p_ColacaoGrau_Id',"value"=>$colacaoInfo[ID]));		
			$form->Input('Periodo Letivo','select',array('name'=>'p_PLetivo_Id',"id"=>"PLetivoId",'value'=>$colacaoInfo[PLETIVO_ID],"option"=>$currOfe->Calculate("PLetivo",array("p_Ciclo_Id"=>"5400000000001"))));
			$form->Input('Unidade','select',array("name"=>'p_Campus_Id',"id"=>"CampusId","value"=>$colacaoInfo[CAMPUS_ID], "option"=>$campus->Calculate("Geral")));
			$form->Input('Tipo','select',array("name"=>'p_ColacaoGrauTi_Id',"id"=>"ColacaoTiId","value"=>$colacaoInfo[COLACAOGRAUTI_ID], "option"=>$colacaoGrauTi->Calculate("Geral")));
				
		$form->CloseFieldset ();		

		$form->Fieldset();
			$form->Input('Colação de Grau','checkbox',array('name'=>'p_Colacao',"checked"=>$colacaoInfo[COLACAO],"value"=>'on'));
			$form->Input('Diploma','checkbox',array('name'=>'p_Diploma',"checked"=>$colacaoInfo[DIPLOMA],"value"=>'on'));

			$display = "none";
			if ($_POST[p_ColacaoGrauTi_Id] == 124200000000001 || $_GET[p_ColacaoGrauTi_Id] == 124200000000001)						{
				$display = "block";
			}
				
			echo "<div id='CursoTurmaId' style='display:".$display."'>";		
				$form->Input('Curso','select',array("name"=>'p_Curso_Id','style'=>'width:90%',"id"=>"CursoId","required"=>'1', "option"=>array("--")));
				$form->Input('Turma','select',array("name"=>'p_TurmaOfe_Des_Id','style'=>'width:20%',"id"=>"TurmaOfeId","option"=>array("--")));
			echo "</div>";
				
				
			$form->Input("Local",'text',array("class"=>"size50",'name'=>'p_Localizacao',"required"=>'1','value'=>$colacaoInfo[LOCALIZACAO]));
			$form->Input('Data da Colação','date',array("class"=>"size10",'name'=>'p_DtColacao',"required"=>'1','value'=>$colacaoInfo[DTCOLACAO]));
			$form->Input('Horário','text',array("class"=>"size10",'name'=>'p_Horario',"required"=>'1','value'=>$colacaoInfo[HORARIO]));
			$form->Input('Presidente da Solenidade','isel',array("name"=>"p_WPessoa_Pres","href"=>"../box/wpessoa_iselprof.php","value"=>$colacaoInfo[WPESSOA_PRES_ID],"label"=>$colacaoInfo[WPESSOA_PRES_NOME]));
				
				
		$form->CloseFieldset ();
		
		$form->Fieldset();
		
			$form->IUDButtons();
			
		$form->CloseFieldset ();
		
	unset($form);
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$dbData->Get($colacaoGrau->Query('qPLetivo',array("p_PLetivo_Id"=>$_GET[p_PLetivo_Id],"p_Campus_Id"=>$_GET["p_Campus_Id"],"p_ColacaoGrauTi_Id"=>$_GET["p_ColacaoGrauTi_Id"])));
	
		if($dbData->Count() > 0)
		{
	
			$grid = new DataGrid(array("Descrição","Editar","Excluir"),null,false);				
			
			while($row = $dbData->Row ())
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($colacaoGrau,$row[ID]));
				$grid->Content($view->Delete($colacaoGrau,$row[ID]));
			}
		}
	
		unset($grid);
	
	}

	unset($colacaoGrau);
	unset($colacaoGrauTi);	
	unset($curso);
	unset($campus);
	unset($cursoNivel);
	unset($pLetivo);
	unset($currOfe);
	unset($turmaOfe);
	
?>	
	