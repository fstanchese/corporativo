<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Sele��o de Empresa","Sele��o de Empresa",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	include("../model/Empresa.class.php");


	
	//Conectar o usu�rio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	$ajax			= new Ajax();
	
	$empresa = new Empresa ($db);
	

	/**
	 * Quando cria o objeto View  necess��rio passar o Titulo da P�gina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	

	/**
	 * Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	*/
	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("CNPJ",'text',array('size'=>'20','name'=>'p_Empresa_CGC','value'=>$_POST[p_Empresa_CGC]));
	$form->Input("Raz�o",'text',array('size'=>'60','name'=>'p_Empresa_Razao','value'=>$_POST[p_Empresa_Razao]));
	$form->Input("Nome Fantasia",'text',array('size'=>'20','name'=>'p_Empresa_Fantasia','value'=>$_POST[p_Empresa_Fantasia]));

	$ajax->GridRequired($empresa->query["qSelecao"], array("RAZAO"=>"Raz�o Social","FANTASIA"=>"Nome Fantasia"), array("p_Empresa_CGC"=>"p_Empresa_CGC","p_Empresa_Razao"=>"p_Empresa_Razao","p_Empresa_Fantasia"=>"p_Empresa_Fantasia")); 
	
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);
	
	unset($ajax);
	unset($empresa);
	unset($dbData);
	unset($db);
	unset($vp);

?>