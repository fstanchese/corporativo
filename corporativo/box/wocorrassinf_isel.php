<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Seleção de Informação Obrigatória de Assuntos S.A.A.","Seleção de Informação Obrigatória de Assuntos S.A.A.",array('ADM','SAA_ANALISTA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/WOcorrAssInf.class.php");
 
	
	//Conectar o usuário ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irá utilizar
	$wocorrAssInf = new WOcorrAssInf($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessário passar o Titulo da Página
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("Informação Obrigatória",'text',array("class"=>"size50",'name'=>'p_WOcorrAssInf_Informacao','value'=>$_POST[p_WOcorrAssInf_Informacao]));
	
	$ajax->GridRequired($wocorrAssInf->query["qSelecao"],array("RECOGNIZE"=>"Informação"),array("p_WOcorrAssInf_Informacao"=>'p_WOcorrAssInf_Informacao'));
	
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