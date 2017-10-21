<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	//Instanciar o Usuсrio
	$user 			= new User ();
	
	//Instanciar a Aplicaчуo
	$app = new App("Seleчуo de Aluno e Ex-Aluno","Seleчуo de Aluno e Ex-Aluno",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoa.class.php");
	
	include("../engine/Ajax.class.php");
	
	//Conectar o usuсrio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	
	$ajax = new Ajax();
	//Instanciar a classe que irс utilizar
	$wpessoa = new WPessoa($db);
	
	/**
	 * Quando cria o objeto View  necessясrio passar o Titulo da Pсgina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	

	/**
	 * Para montar o Header precisa passar o nome do Usuario e os Departamentos dele
	*/
	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("RG/RNE ou CODIGO",'text',array('class'=>'size10','name'=>'p_WPessoa_RGRNE','value'=>$_POST[p_WPessoa_RGRNE]));
	$form->Input("Nome",'text',array('class'=>'size60','name'=>'p_WPessoa_Nome','value'=>$_POST[p_WPessoa_Nome]));

	$ajax->GridRequired($wpessoa->query["qSelecaoAlunoEx"],array("NOME"=>"Nome","CODIGOFUNC"=>"Cod Func","RGRNE"=>"RG/RNE","CPF"=>"CPF"),array("p_WPessoa_RGRNE"=>'p_WPessoa_RGRNE',"p_WPessoa_Nome"=>'p_WPessoa_Nome'));
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);
	

	unset($dbData);
	unset($db);
	unset($vp);

	unset($wpessoa);
	
?>