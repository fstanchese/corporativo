<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();
	$app = new App("Cadastro dos Curr�culos","Cadastro dos Curr�culos",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Curso.class.php");
	include("../model/Curr.class.php");
	include("../model/Durac.class.php");
	include("../model/PLetivo.class.php");
	include("../model/CurrNivel.class.php");
	
	
	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle );
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que ir� utilizar
	$curso = new Curso($dbOracle);
	$curr = new Curr($dbOracle);
	$durac = new Durac($dbOracle);
	$pLetivo = new PLetivo($dbOracle);
	$currNivel = new CurrNivel($dbOracle);
	
	//verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_Curso_Id"] != "") $linhaSelected[CURSO_ID] = $_GET["p_Curso_Id"];
	if($_GET["p_Curso_Label"] != "") $linhaSelected[NOMECURSO] = $_GET["p_Curso_Label"];

	if($_GET["p_Curr_Pai_Id"] != "") $linhaSelected[CURR_PAI_ID] = $_GET["p_Curr_Pai_Id"];
	if($_GET["p_Curr_Pai_Label"] != "") $linhaSelected[CODIGOCURRPAI] = $_GET["p_Curr_Pai_Label"];
	
	
	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($curr->Query("qId",array("p_Curr_Id"=>$_POST[p_Curr_Id])));
		$linhaSelected = $dbData->Row();
	}

	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");

	if($_POST["p_Curso_Id"] != "") $linhaSelected[CURSO_ID] = $_POST[p_Curso_Id];
	if($_POST["p_Curso_Label"] != "") $linhaSelected[NOMECURSO] = $_POST[p_Curso_Label];
	
	//Chama a IUD
	$curr->IUD($_POST);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	

	//Instanciar formul�rio
	$form = new Form();
	
		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_Curr_Id',"value"=>$linhaSelected[ID]));
			$form->Input('Grupo de Curso','isel',array("name"=>"p_Curso","href"=>"../box/curso_isel.php","submit"=>"true","value"=>$linhaSelected[CURSO_ID],"label"=>$linhaSelected[NOMECURSO]));			
				
		$form->CloseFieldset ();
		
		$form->Fieldset();

			$form->Input("C�digo do Curr�culo",'text',array("class"=>"size10",'name'=>'p_Codigo',"required"=>'1','value'=>$linhaSelected[CODIGO]));
			$form->Input("Complemento Nome Hist�rico Escolar",'text',array("class"=>"size100",'name'=>'p_CurrCompNome','value'=>$linhaSelected[CURRCOMPNOME]));
			
			$form->Input("Dura��o",'select',array('name'=>'p_Durac_Id',"id"=>"DuracId","required"=>'1','value'=>$linhaSelected[DURAC_ID],"option"=>$durac->Calculate("Geral")));
			$form->Input("S�rie In�cio",'text',array("class"=>"size10",'name'=>'p_SerieInicio','value'=>$linhaSelected[SERIEINICIO]));
			$form->Input("S�rie In�cio Est�gios",'text',array("class"=>"size10",'name'=>'p_SerieInicioEstagio','value'=>$linhaSelected[SERIEINICIOESTAGIO]));
			$form->Input("In�cio Letivo",'select',array('name'=>'p_PLetivo_Inicial_Id','value'=>$linhaSelected[PLETIVO_INICIAL_ID],"option"=>$pLetivo->Calculate("Geral")));
			$form->Input("T�rmino",'select',array('name'=>'p_PLetivo_Final_Id','value'=>$linhaSelected[PLETIVO_FINAL_ID],"option"=>$pLetivo->Calculate("Geral")));
			$form->LabelMultipleInput('Modalidade');
			$form->MultipleInput('','select',array('name'=>'p_CurrNivel_Id','value'=>$linhaSelected[CURRNIVEL_ID],"option"=>$currNivel->Calculate("Curric")));
			$form->MultipleInput('Descri��o','text',array('name'=>'p_CurrNivelDesc',"class"=>"size40",'value'=>$linhaSelected[CURRNIVELDESC]));
			$form->Input('Curr�culo Pai','isel',array("name"=>"p_Curr_Pai","href"=>"curr_isel.php","submit"=>"true","value"=>$linhaSelected[CURR_PAI_ID],"label"=>$linhaSelected[CODIGOCURRPAI]));
			$form->Input('Mneumonico','text',array("class"=>"size20",'name'=>'p_Mneumonico','value'=>$linhaSelected[MNEUMONICO]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
		
			// Bot�es de a��o
			$form->IUDButtons();
			
		$form->CloseFieldset ();
	
	//fecha formul�rio
	unset($form);
	
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_Curso_Id] != '')
	{
	
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($curr->Query('qFamilia',array("p_Curso_Id"=>$_GET[p_Curso_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("C�igo do Curr�ulo","Inicio em","Curr�culo Pai","Editar","Excluir"));
	
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[CODIGO],array('align'=>'center','width'=>'10%'));
				$grid->Content($row[CURRINICIO],array('align'=>'center','width'=>'10%'));
				$grid->Content($row[PAI],array('align'=>'left','width'=>'10%'));
				$grid->Content($view->Edit($curr,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($curr,$row[ID]),array('width'=>'05%'));
			}
		}
	
		//fecha grid
		unset($grid);
	
		$dbData->Pagination();
	
	}
	
	
	unset($curso);
	unset($curr);
	unset($durac);
	unset($pLetivo);
	unset($currNivel);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>	