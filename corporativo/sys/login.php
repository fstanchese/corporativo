<?php

	session_name ("optimizer");
	session_start ();
	
	include ("../engine/Db.class.php");	
	include ("../engine/ViewPage.class.php");
	include ("../engine/Form.class.php");

	if ($_SESSION[p_WPessoa_Id] == "" )
	{
		$vp = new ViewPage ("Login", "Login");
		$vp->IncludeJS ("login.js");
		$vp->Explain ("Digite seu nome e a sua senha. Clique em \"Login\"");
		$vp->Header ();
	
	
	
		$form = new Form ();
		$form->Input ("", "hidden", array ("name"=>"p_url", "value"=>$_GET[p_url]));
		$form->Input ("", "hidden", array ("name"=>"p_ipaddr", "id"=>"inputIpaddr")); // login.js
		
		$form->Fieldset ();
		$form->Input ("Usuário", "text", array ("name"=>"p_user", "value"=>$_POST[p_user], "required"=>1));
		$form->Input ("Senha", "password", array ("name"=>"p_pass", "required"=>1, "maxlength"=>"20"));
	
		$form->Button ("button", array ("name"=>"p_submit", "value"=>"Login","id"=>"btnLogin"));
		$form->CloseFieldset ();
		
		unset ($form);
	}
	else 
	{
		if ($_GET[p_o_page] != "")
			header("Location: " . $_GET[p_o_page]);
		else if($_GET[p_url] != "")
			header("Location:../".urldecode($_GET[p_url]));
		else 
			header("Location:../sys/busca.php");
	}

	unset ($dbData);
	unset ($dbOracle);
	unset ($vp);
?>