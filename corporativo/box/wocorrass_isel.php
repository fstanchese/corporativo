<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Sele��o de Assuntos S.A.A.","Sele��o de Assuntos S.A.A.",array('ADM','SAA_ANALISTA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/WOcorrAss.class.php");
 
	
	//Conectar o usu�rio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que ir� utilizar
	$wocorrAss = new WOcorrAss($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necess�rio passar o Titulo da P�gina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("Descri��o",'text',array("class"=>"size50",'name'=>'p_WOcorrAss_Nomenet','value'=>$_POST[p_WOcorrAss_Nomenet]));
	
	$ajax->GridRequired($wocorrAss->query["qSelecao"],array("RECOGNIZE"=>"Informa��o","ATIVO"=>"Ativo","DISPONIBILIZADA"=>"Disponibilizada"),array("p_WOcorrAss_Nomenet"=>'p_WOcorrAss_Nomenet'));
	
		
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($wocorrAss);
	unset($user);
	unset($app);
	
?>