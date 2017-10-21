<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuбrio
	$user 			= new User ();
	
	//Instanciar a Aplicaзгo
	$app = new App("Seleзгo de Logradouro","Seleзгo de Logradouro",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/Lograd.class.php");
 
	
	//Conectar o usuбrio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irб utilizar
	$lograd = new Lograd($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessбrio passar o Titulo da Pбgina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("CEP",'text',array("class"=>"size20",'name'=>'p_Lograd_CEP','value'=>$_POST[p_Lograd_CEP]));
	
	$form->Input("Logradouro",'text',array("class"=>"size50",'name'=>'p_Lograd_Nome','value'=>$_POST[p_Lograd_Nome]));
	
	$ajax->GridRequired($lograd->query["qSelecao"],array("RECOGNIZE"=>"Logradouro","CIDADE"=>"Cidade"),array("p_Lograd_CEP"=>'p_Lograd_CEP',"p_Lograd_Nome"=>"p_Lograd_Nome"));

	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($lograd);
	unset($user);
	unset($app);
	
?>