<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Sele��o de Cheque","Sele��o de Cheque",array('ADM','COBRANCA','CONTABILIDADE'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/Cheque.class.php");
 
	
	//Conectar o usu�rio ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que ir� utilizar
	$cheque = new Cheque($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necess�rio passar o Titulo da P�gina
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("N�mero",'text',array("class"=>"size10",'name'=>'p_Cheque_Numero','value'=>$_POST[p_Cheque_Numero]));
	$form->Input("Data de Emiss�o",'text',array("class"=>"size10",'name'=>'p_Cheque_DtEmissao','value'=>$_POST[p_Cheque_DtEmissao]));
	$form->Input("Emitente",'text',array("class"=>"size50",'name'=>'p_O_Search','value'=>$_POST[p_O_Search]));
	
	
	$ajax->GridRequired($cheque->query["qSelecao"],array("RECOGNIZE"=>"Emitente","NUMERO"=>"Numero","DTEMISSAO"=>"Data de Emissao"),array("p_O_Search"=>"p_O_Search","p_Cheque_DtEmissao"=>"p_Cheque_DtEmissao","p_Cheque_Numero"=>"p_Cheque_Numero"));

	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($cheque);
	unset($user);
	unset($app);
			
?>
						