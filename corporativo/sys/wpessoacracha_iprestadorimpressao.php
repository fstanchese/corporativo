<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	include("../engine/View.class.php");
	
	$user = new User ();
		
	include("../engine/Db.class.php");
	include("../model/CASenha.class.php");

	$dbOracle 	= new Db ($user);
	
	$dbData 	= new DbData($dbOracle);
	
	
	$view = new View();
	
	$view->IncludeJS("jquery.js");
	$view->IncludeJS("jquery-barcode.js");
	
	$view->IncludeCSS("default.css");
	$view->IncludeCSS("azul.css");
	
	echo $view->SetCSS("
			
			
	body {
	  margin : 0px;
	}

	#moldura {
	  width : 5.4cm;
	  height : 8cm;
	  text-align:center;
	  font-family: verdana;
	  font-size:10px;
	  float:left;

	}
			
	#moldura table {
	}

	#moldura table td {
	  font-family: verdana;
	  font-size:8px;
	  font-weight: bold;
	}

	#moldura pre {
	  font: 10px arial;
	  text-align:left;
	  line-height:11px;
	}

	#moldura span {
	  font: 9px arial;
	  text-align:left;
	  line-height:11px;
	}
	");
	
	
	echo $view->JS("
			
			$(document).on('click','.btnPrint',function()
			{
				
				$(this).hide(1);
			});
			
			
			");
	
	$dados = $dbData->Row($dbData->Get("SELECT empresa.fantasia, wpessoacracha.dtinicio, wpessoacracha.codigo FROM wpessoacracha, empresa WHERE empresa.id = wpessoacracha.empresa_id AND wpessoacracha.id = '"._Decrypt($_GET[cracha_id])."'"));
	
	
	echo $view->Table(array("id"=>"moldura","cellpadding"=>0,"cellspacing"=>0)).
			$view->Tr().$view->Td().$view->Img(array("src"=>"http://10.1.1.140/images/logo2_sj_glow.jpg","width"=>165,"style"=>"margin-top:0.6cm")).$view->CloseTd().$view->CloseTr().
			$view->Tr().$view->Td(array("align"=>"center")).
					$view->Table(array("style"=>"height:2.3cm;width:5cm;clear:both;")).
							$view->Tr().$view->Td(array("style"=>"text-align:center;font:bold 14px verdana;vertical-align:middle;"))."Prestador de Serviço".$view->Br().$view->Br().
												$view->Span(array("style"=>"font:bold 9px verdana;"))."Este cartão é destinado ao uso exclusivo para acesso ao refeitório".$view->CloseSpan().
										$view->CloseTd().
							$view->CloseTr().
					$view->CloseTable().
					$view->Div(array("style"=>"font-size:10px;width:5cm;text-align:center;font-weight:bold;")).$dados[FANTASIA].$view->CloseDiv().
					$view->Table(array("style"=>"width:5cm;margin-bottom:15px;")).
							$view->Tr().$view->Td()."CODIGO".$view->CloseTd().$view->Td(array("width"=>"50%","align"=>"right","style"=>"padding-right:15px"))."INÍCIO".$view->CloseTd().$view->CloseTr().
							$view->Tr().$view->Td(array("width"=>"50%")).$dados[CODIGO].$view->CloseTd().$view->Td(array("width"=>"50%","align"=>"right","style"=>"padding-right:15px")).$dados[DTINICIO].$view->CloseTd().$view->CloseTr().
					$view->CloseTable().
					$view->Div(array("style"=>"margin-top:5mm;"))._CodeBar($dados[CODIGO],15,60,10,'false').$view->CloseDiv().
				$view->CloseTd().
			$view->CloseTr().$view->CloseTable();
	
	
	echo $view->Br().$view->Br().$view->BtImprimir();
			
	
	
	
?>