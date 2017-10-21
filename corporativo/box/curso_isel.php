<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuсrio
	$user 			= new User ();
	
	//Instanciar a Aplicaчуo
	$app = new App("Seleчуo de Curso","Seleчуo de Curso",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Ajax.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$cursoNivel = new CursoNivel($dbOracle);
	$curso = new Curso($dbOracle);
	$ajax = new Ajax();
	
	/**
	 * Quando cria o objeto View  necessясrio passar o Titulo da Pсgina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	
	/**
	 * Para montar o Header precisa passar o nome do Usuя┐╜rio e os Departamentos dele
	*/
	$vp->Header();
		
	$form = new Form();

	$form->Fieldset();
	
	$form->Input('Nivel de Curso','select',array("name"=>'p_CursoNivel_Id',"id"=>"CursoNivelId","required"=>'1', "value"=>$_POST[p_CursoNivel_Id], "option"=>$cursoNivel->Calculate("Geral",$dbData)));
	$form->Input('Nome de Curso','text',array("name"=>'p_Curso_Nome',"id"=>"CursoNome","class"=>"size50", "value"=>$_POST[p_Curso_Nome]));

	$ajax->GridRequired($curso->query["qNivel"],array("NOME"=>"Nome"),array("p_CursoNivel_Id"=>"CursoNivelId","p_Curso_Nome"=>"CursoNome"));
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
		
	unset($form);
	unset($cursoNivel);
	unset($curso);
	

	unset($dbData);
	unset($db);
	unset($vp);

?>