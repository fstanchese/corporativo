<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuбrio
	$user 			= new User ();
	
	//Instanciar a Aplicaзгo
	$app = new App("Seleзгo de Mensagem de Protocolo do S.A.A.","Seleзгo de Mensagem de Protocolo do S.A.A.",array('ADM','SAA_ANALISTA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/ProtMsg.class.php");
 
	
	//Conectar o usuбrio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irб utilizar
	$protMsg = new ProtMsg($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessбrio passar o Titulo da Pбgina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("Mensagem",'text',array("class"=>"size50",'name'=>'p_ProtMsg_Protocolo','value'=>$_POST[p_ProtMsg_Protocolo]));
	
	$ajax->GridRequired($protMsg->query["qSelecao"],array("RECOGNIZE"=>'Mensagem de Protocolo'),array("p_ProtMsg_Protocolo"=>"p_ProtMsg_Protocolo"));
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($protMsg);
	unset($user);
	unset($app);
	
?>