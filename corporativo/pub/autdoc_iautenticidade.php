<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ('aluno','jdfoj8303m3o9');
	//$user = new User ();
	
	//$app = new App("Consulta de Autenticidade de Documentos","Consulta de Autenticidade de Documentos",array('ADM','COORDPOS','CARTORIOEXP','PROUNI','TELEATENDIMENTO','DIRETORIAFINANCEIRA','CENTROPESQUISA','COBRANCA','CPA','DIRETORES','SECRETARIASDIRETORES','SAA','SECCOORDENADORIA','SECRETARIAGERAL','COORDENADORES','HORARIOPROVA','CPD','SALAPROFESSORES','REGISTRODIPLOMAS','MATRICULA','SECRETARIAESTAGIOS','COORDESTAGIO','POSGRADUACAO','COORDPOS','BOLSA','ARQHISTORICO','CAAM','PROFESSORES'),$user);

	include ("../engine/Db.class.php");	
	include ("../engine/ViewPage.class.php");
	include ("../engine/Form.class.php");
	include ("../model/AutDoc.class.php");

	
	$dbOracle = new Db($user);
	$autDoc = new AutDoc($dbOracle);
	
	$vp = new ViewPage ('Consulta de Autenticidade de Documentos','Consulta de Autenticidade de Documentos');
	$vp->Explain ("Digite a chave com 32 caracteres para confirmar a autenticidade do documento");
	$vp->Header ();

	$form = new Form ();
	
	$form->Fieldset ();
	
	$form->Input("Código", "text", array ("name"=>"p_Hash", "size"=>"40"));
	$form->Button("button",array("name"=>"btProsseguir","value"=>"Prosseguir","class"=>"btAutentica"));
	
	//print $vp->Link('<img src=../images/accept.png>',array("align"=>"center", "class"=>"openColorBox","href"=>"../pub/atestado.php?p_Hash=".$_GET[p_Hash]));
	
	
	$sDocumento = $autDoc->GetDocumento(str_replace("-","",strtoupper($_POST['p_Hash'])));
	
	$form->CloseFieldset ();
		
	unset ($form);

	unset ($dbData);
	unset ($dbOracle);
	unset ($vp);
?>