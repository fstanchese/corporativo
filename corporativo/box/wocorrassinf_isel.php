<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Sele��o de Informa��o Obrigat�ria de Assuntos S.A.A.","Sele��o de Informa��o Obrigat�ria de Assuntos S.A.A.",array('ADM','SAA_ANALISTA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/WOcorrAssInf.class.php");
 
	
	//Conectar o usu�rio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que ir� utilizar
	$wocorrAssInf = new WOcorrAssInf($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necess�rio passar o Titulo da P�gina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("Informa��o Obrigat�ria",'text',array("class"=>"size50",'name'=>'p_WOcorrAssInf_Informacao','value'=>$_POST[p_WOcorrAssInf_Informacao]));
	
	$ajax->GridRequired($wocorrAssInf->query["qSelecao"],array("RECOGNIZE"=>"Informa��o"),array("p_WOcorrAssInf_Informacao"=>'p_WOcorrAssInf_Informacao'));
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($wocorrAssInf);
	unset($user);
	unset($app);
	
?>