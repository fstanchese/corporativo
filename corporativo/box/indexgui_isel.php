<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Seleção de Páginas do Sistema","Seleção de Páginas do Sistema",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/IndexGUI.class.php");
 
	
	//Conectar o usuário ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irá utilizar
	$indexGUI = new IndexGUI($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessário passar o Titulo da Página
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("Busca",'text',array('class'=>'size60','name'=>'p_O_Search','value'=>$_POST[p_O_Search]));
	
	$ajax->GridRequired($indexGUI->query["qConsulta"],array("GUINAME"=>"Página","GUIDESCRIPTION"=>"Descricao"),array("p_O_Search"=>'p_O_Search'));
	
		
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($indexGUI);
	unset($user);
	unset($app);
			
?>
						
