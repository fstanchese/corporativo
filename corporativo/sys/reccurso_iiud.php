<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");	

	$user = new User ();
	$app = new App("Cadastro dos Reconhecimento dos Curso","Cadastro dos Reconhecimento dos Curso",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/RecCurso.class.php");
	include("../model/Curso.class.php");
	include("../model/Campus.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Titulo.class.php");
	include("../model/Modalidade.class.php");

	$dbOracle 	= new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	
	$nav 		= new Navigation($user, $app, $dbData);
	
	$recCurso 	= new RecCurso($dbOracle);	
	$curso 		= new Curso($dbOracle);	
	$campus 	= new Campus($dbOracle);	
	$titulo 	= new Titulo($dbOracle);	
	$cursoNivel = new Curso($dbOracle);
	$modalidade = new Modalidade($dbOracle);
	

	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($recCurso->Query("qId",array("p_RecCurso_Id"=>$_POST[p_RecCurso_Id])));
		$linhaSelected = $dbData->Row();
	}
	

	if($_GET["p_Curso_Id"] != "") $linhaSelected[CURSO_ID] = $_GET["p_Curso_Id"]; 
	if($_GET["p_Curso_Label"] != "" && $_GET["p_Curso_Label"] != "Selecionar") $linhaSelected[NOMECURSO] = $_GET["p_Curso_Label"];


	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	 	
	$recCurso->IUD($_POST);
	
	if($_POST["p_Curso_Id"] != "") $linhaSelected[CURSO_ID] = $_POST[p_Curso_Id];
	if($_POST["p_Curso_Label"] != "") $linhaSelected[NOMECURSO] = $_POST[p_Curso_Label];
	
	$view->Header($user,$nav);	

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_RecCurso_Id',"value"=>$linhaSelected[ID]));
			$form->Input('Grupo de Curso','isel',array("name"=>"p_Curso","href"=>"../box/curso_isel.php","submit"=>"true","value"=>$linhaSelected[CURSO_ID],"label"=>$linhaSelected[NOMECURSO]));
				
				
		$form->CloseFieldset ();
		
		$form->Fieldset("Dados para emissуo do Diploma");

			$form->Input('Unidade','select',array("name"=>'p_Campus_Id',"value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral")));
			$form->Input("Reconhecimento",'text',array("class"=>"size100",'name'=>'p_Reconhecimento',"required"=>'1','value'=>$linhaSelected[RECONHECIMENTO]));
			$form->Input("Nome do Curso Anverso",'text',array("class"=>"size100",'name'=>'p_NomeDiplAnverso',"required"=>'1','value'=>$linhaSelected[NOMEDIPLANVERSO]));
			$form->Input("Nome do Curso Atestado",'text',array('style'=>'width:100%','name'=>'p_NomeAtestado','value'=>$linhaSelected[NOMEATESTADO]));
			$form->Input("Habilitaчуo",'text',array("class"=>"size100",'name'=>'p_Habilitacao','value'=>$linhaSelected[HABILITACAO]));
			$form->Input("Titulo",'select',array("name"=>'p_Titulo_Id',"value"=>$linhaSelected[TITULO_ID], "option"=>$titulo->Calculate("Geral")));
			$form->Input("Modalidade",'select',array("name"=>'p_Modalidade_Id',"value"=>$linhaSelected[MODALIDADE_ID], "option"=>$modalidade->Calculate("Geral")));		
			$form->Input('Reconhecimento Vigente ?','checkbox', array("name"=>'p_Vigente', "checked"=>$linhaSelected[VIGENTE],"value"=>'off'));
			$form->Input("Data da Publicaчуo",'text',array('name'=>'p_DtDOU','value'=>$linhaSelected[DTDOU]));		
			$form->Input("Reconhecimento Anterior",'select',array("class"=>"size100","name"=>'p_RecCurso_Pai_Id',"value"=>$linhaSelected[RECCURSO_PAI_ID], "option"=>$recCurso->Calculate("RecCursoPai",array("p_Curso_Id"=>$_POST[p_Curso_Id]))));				
			$form->Input("Reconhecimento Filho",'select',array("class"=>"size100","name"=>'p_RecCurso_Filho_Id',"value"=>$linhaSelected[RECCURSO_FILHO_ID], "option"=>$recCurso->Calculate("RecCursoPai",array("p_Curso_Id"=>$_POST[p_Curso_Id]))));
				
		$form->CloseFieldset ();

		$form->Fieldset();
		
			$form->IUDButtons();
				
		$form->CloseFieldset ();
		
	
	unset($form);
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$dbData->Get($recCurso->Query('qCurso',array("p_Curso_Id"=>$_GET[p_Curso_Id])));

		if($dbData->Count() > 0)
		{
		
			
			$grid = new DataGrid(array("Reconhecimento do Curso","Editar","Excluir"),null,false);
			
			$v_nomecompleto = '';
							
			while($row = $dbData->Row ())
			{
				if ($v_nomecompleto != $row[NOMEDIPLANVERSO])
				{	
					$v_nomecompleto = $row[NOMEDIPLANVERSO];
					$v_completo = $row[NOMEDIPLANVERSO].' - '.$row[NOMECOMPLETO];
				}	
				else
				{
					$v_tamanho = strlen($v_nomecompleto)+6;
					$v_completo = str_repeat('-',$v_tamanho).' - '.$row[NOMECOMPLETO];
				}				
				$grid->Content($v_completo,array('align'=>'left'));
				$grid->Content($view->Edit($recCurso,$row[ID]));
				$grid->Content($view->Delete($recCurso,$row[ID]));					
			}
		}

		unset($grid);
	
	}	
	
	unset($recCurso);
	unset($curso);
	unset($campus);
	unset($cursoNivel);
	unset($titulo);
	unset($modalidade);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>