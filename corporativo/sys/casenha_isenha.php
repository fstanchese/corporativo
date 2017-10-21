<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	include("../engine/View.class.php");
	
	$user = new User ();
	$app = new App("Impressão Senha - Controle de Atendimento","Impressão Senha - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	
	include("../model/CASenha.class.php");

	$dbOracle 	= new Db ($user);
	
	$caSenha 	= new CASenha($dbOracle);
	
	$view = new View();
	
	$view->IncludeJS("jquery.js");
	$view->IncludeJS("jquery-barcode.js");
	$view->IncludeCSS("default.css");
	$view->IncludeCSS("azul.css");
	
	
	echo $view->JS("
			
			$(document).on('click','.btnPrint',function()
			{
				
				$(this).hide(1);
			});
			
			
			");
	
	
	
	echo $caSenha->GetLayoutSenha(_Decrypt($_GET[casenha_id]),$_GET[via2]);
	
	//echo $view->BtImprimir();
	
	echo "<script>window.print();</script>";
	
		
?>