<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();	
	$app = new App("Cadastro dos Grupo de Cursos","Cadastro dos Grupo de Cursos",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Curso.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Facul.class.php");
	include("../model/Depart.class.php");	

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que ir� utilizar
	$curso = new Curso($dbOracle);
	$cursoNivel = new CursoNivel($dbOracle);
	$facul = new Facul($dbOracle);
	$depart = new Depart($dbOracle);
	
	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($curso->Query("qId",array("p_Curso_Id"=>$_POST[p_Curso_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	// verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_CursoNivel_Id"] != "") $linhaSelected[CURSONIVEL_ID] = $_GET["p_CursoNivel_Id"];
	if($_POST["p_CursoNivel_Id"] != "") $linhaSelected[CURSONIVEL_ID] = $_POST["p_CursoNivel_Id"];
    if($_GET["p_WPessoa_Id"] != "") 
    { 
    	$linhaSelected[WPESSOA_ATIVCOMP_ID] = $_GET["p_WPessoa_Id"];
       	$linhaSelected[WPESSOA_ATIVCOMP] = $_GET["p_WPessoa_Label"];
    }
	
	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$view->On("change", "#CursoNivelId", "$('#f1').submit();");
	
	
	//Chama a IUD
	$curso->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formul�rio
	$form = new Form();
	
		$form->Fieldset();
					
			$form->Input('','hidden',array("name"=>'p_Curso_Id',"value"=>$linhaSelected[ID]));
			$form->Input("Curso N�vel",'select',array("name"=>'p_CursoNivel_Id',"id"=>"CursoNivelId","value"=>$linhaSelected[CURSONIVEL_ID], "option"=>$cursoNivel->Calculate("Geral")));
			
		$form->CloseFieldset ();

		$form->Fieldset();
		
			$form->Input("Nome do Curso",'text',array("class"=>"size100",'name'=>'p_Nome',"required"=>'1','value'=>$linhaSelected[NOME]));
			$form->Input("C�digo",'text',array("class"=>"size30",'name'=>'p_Codigo','value'=>$linhaSelected[CODIGO]));
			$form->Input("Faculdade",'select',array("name"=>'p_Facul_Id',"value"=>$linhaSelected[FACUL_ID], "option"=>$facul->Calculate("Geral")));
			$form->Input("Departamento",'select',array("name"=>'p_Depart_Id',"value"=>$linhaSelected[DEPART_ID], "option"=>$depart->Calculate("Geral")));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();	
		
			// Bot�es de a��o
			$form->IUDButtons();
					
		$form->CloseFieldset ();
	
	//fecha formul�rio
	unset($form);
		
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_CursoNivel_Id] != '')
	{	
	
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($curso->Query('qNivel',array("p_CursoNivel_Id"=>$_GET[p_CursoNivel_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Grupo de Curso","Editar","Excluir"));
	
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($curso,$row[ID]));
				$grid->Content($view->Delete($curso,$row[ID]));
			}
		}

		//fecha grid
		unset($grid);	
		
		$dbData->Pagination();
		
	}	


	unset($curso);
	unset($cursoNivel);
	unset($facul);
	unset($depart);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>