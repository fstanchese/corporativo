<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();
	$app = new App("Cadastro dos Currículos","Cadastro dos Currículos",array('ADM','CPD'),$user);
	
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
	
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle );
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que irá utilizar
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
	
	
	//se o p_O_Option for  == select - então 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($curr->Query("qId",array("p_Curr_Id"=>$_POST[p_Curr_Id])));
		$linhaSelected = $dbData->Row();
	}

	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");

	if($_POST["p_Curso_Id"] != "") $linhaSelected[CURSO_ID] = $_POST[p_Curso_Id];
	if($_POST["p_Curso_Label"] != "") $linhaSelected[NOMECURSO] = $_POST[p_Curso_Label];
	
	//Chama a IUD
	$curr->IUD($_POST);
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	

	//Instanciar formulário
	$form = new Form();
	
		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_Curr_Id',"value"=>$linhaSelected[ID]));
			$form->Input('Grupo de Curso','isel',array("name"=>"p_Curso","href"=>"../box/curso_isel.php","submit"=>"true","value"=>$linhaSelected[CURSO_ID],"label"=>$linhaSelected[NOMECURSO]));			
				
		$form->CloseFieldset ();
		
		$form->Fieldset();

			$form->Input("Código do Currículo",'text',array("class"=>"size10",'name'=>'p_Codigo',"required"=>'1','value'=>$linhaSelected[CODIGO]));
			$form->Input("Complemento Nome Histórico Escolar",'text',array("class"=>"size100",'name'=>'p_CurrCompNome','value'=>$linhaSelected[CURRCOMPNOME]));
			
			$form->Input("Duração",'select',array('name'=>'p_Durac_Id',"id"=>"DuracId","required"=>'1','value'=>$linhaSelected[DURAC_ID],"option"=>$durac->Calculate("Geral")));
			$form->Input("Série Início",'text',array("class"=>"size10",'name'=>'p_SerieInicio','value'=>$linhaSelected[SERIEINICIO]));
			$form->Input("Série Início Estágios",'text',array("class"=>"size10",'name'=>'p_SerieInicioEstagio','value'=>$linhaSelected[SERIEINICIOESTAGIO]));
			$form->Input("Início Letivo",'select',array('name'=>'p_PLetivo_Inicial_Id','value'=>$linhaSelected[PLETIVO_INICIAL_ID],"option"=>$pLetivo->Calculate("Geral")));
			$form->Input("Término",'select',array('name'=>'p_PLetivo_Final_Id','value'=>$linhaSelected[PLETIVO_FINAL_ID],"option"=>$pLetivo->Calculate("Geral")));
			$form->LabelMultipleInput('Modalidade');
			$form->MultipleInput('','select',array('name'=>'p_CurrNivel_Id','value'=>$linhaSelected[CURRNIVEL_ID],"option"=>$currNivel->Calculate("Curric")));
			$form->MultipleInput('Descrição','text',array('name'=>'p_CurrNivelDesc',"class"=>"size40",'value'=>$linhaSelected[CURRNIVELDESC]));
			$form->Input('Currículo Pai','isel',array("name"=>"p_Curr_Pai","href"=>"curr_isel.php","submit"=>"true","value"=>$linhaSelected[CURR_PAI_ID],"label"=>$linhaSelected[CODIGOCURRPAI]));
			$form->Input('Mneumonico','text',array("class"=>"size20",'name'=>'p_Mneumonico','value'=>$linhaSelected[MNEUMONICO]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
		
			// Botões de ação
			$form->IUDButtons();
			
		$form->CloseFieldset ();
	
	//fecha formulário
	unset($form);
	
	//Consultas deverão ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_Curso_Id] != '')
	{
	
		//Chamando o método Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($curr->Query('qFamilia',array("p_Curso_Id"=>$_GET[p_Curso_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Cóigo do Curríulo","Inicio em","Currículo Pai","Editar","Excluir"));
	
			//Obtêm as linhas da execução do arquivo .sql
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