<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Seleção de Currículo","Seleção de Currículo",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
    include("../engine/Ajax.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	include("../model/Curr.class.php");
	
	//Conectar o usuário ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irá utilizar
	$cursoNivel = new CursoNivel($db);
	$curso = new Curso($db);
	$curr = new Curr($db);
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessïário passar o Titulo da Página
	 */
	
	$vp = new ViewBox($app->title,$app->description);

	$vp->On("change", "#CursoId", "$('#f1').submit();");

	$ajax->InputRequired('CursoNivelId','CursoId','change',$curso->query["qNivel"],array('p_CursoNivel_Id'=>"CursoNivelId"),$_POST[p_Curso_Id]);

	/**
	 * Para montar o Header precisa passar o nome do Usuï¿½rio e os Departamentos dele
	*/
	$vp->Header();
		
	$form = new Form();

	$form->Fieldset();	
   	
	$form->Input('Nivel de Curso','select',array("name"=>'p_CursoNivel_Id',"id"=>"CursoNivelId","required"=>'1', "value"=>$_POST[p_CursoNivel_Id], "option"=>$cursoNivel->Calculate("Geral")));
	$form->Input('Curso','select',array("name"=>'p_Curso_Id','style'=>'width:90%',"id"=>"CursoId","required"=>'1', "value"=>$_POST[p_Curso_Id], "option"=>array("--")));
	
	$ajax->GridRequired($curr->query["qFamilia"],array("CODIGO"=>"Código do Currículo"),array("p_Curso_Id"=>"CursoId"));
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	
	$form->CloseFieldset();
	
	unset($form);
	unset($cursoNivel);
	unset($curso);
	unset($curr);
  	unset($ajax);	

	unset($dbData);
	unset($db);
	unset($vp);

?>