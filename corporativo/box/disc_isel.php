<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Sele��o de Disciplinas","Sele��o de Disciplinasr",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");

	include("../model/Disc.class.php");
 
	
	//Conectar o usu�rio ao Banco de Dados
	$db 		= new Db ($user);
	
	$ajax = new Ajax();
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que ir� utilizar
	$disc = new Disc($db);
	
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
	
	$form->Input("C�digo",'text',array('size'=>'10','name'=>'p_Disc_Codigo','value'=>$_POST[p_Disc_Codigo]));
	$form->Input("Descri��o",'text',array('size'=>'50','name'=>'p_Disc_Nome','value'=>$_POST[p_Disc_Nome]));
	
	$ajax->GridRequired($disc->query["qSelecaoDisc"],array("CODIGODISC"=>"C�digo","NOMEDISC"=>"Descri��o"),array("p_O_Search"=>"p_O_Search","p_Disc_Codigo"=>"p_Disc_Codigo","p_Disc_Nome"=>"p_Disc_Nome"));
	
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	
	$form->CloseFieldset();
	
	unset($form);
	
	
	unset($disc);
	unset($dbData);
	unset($db);
	unset($vp);

	
	
?>