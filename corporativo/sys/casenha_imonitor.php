<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Monitor de Senhas Chamadas - Controle de Atendimento","Monitor de Senhas Chamadas - Controle de Atendimento",array('ADM','CASENHA','CASENHAGER','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	
	$user = new User ();
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	
	require_once("../engine/View.class.php");
	require_once("../model/CAEvento.class.php");
	
	$view 		= new View();
	$caEvento 	= new CAEvento($dbOracle);
		
	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	$aCAEvento 		= $caEvento->GetIdInfo($p_CAEvento_Id);
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		echo $view->Div(array("class"=>"msgPageError")) . 'Não existe Evento pré-definido nesse computador.' . $view->CloseDiv();
		die();
	}	
	
	if($_REQUEST[p_Action] == 'getMsg')
	{
	
		echo "Por determinação da Diretoria Financeira, Notas Fiscais e outros documentos contábeis com data de emissão do mês de Abril de 2014, só serão aceitos até o dia 05/05/2014. - duh sauhd ashduisahdui hasiudhisa hdhusa hdhashdisauidh sad asduh as";
		
		die();
		
	}
	
	
	if($_REQUEST[p_Action] == 'reload')
	{
		
		
		
		require_once("../model/CASenhaRegra.class.php");
		
		$caSenhaRegra = new CASenhaRegra($dbOracle);
		$arSenhas = $caSenhaRegra->GetSenhaRegraByEvento($p_CAEvento_Id);
		
		
		
		
		//PASSO 1 - Pegar as senhas que foram chamadas a mais de X segundos e colocar em Espera
		$sql = "SELECT casenha.id, to_char(casenha.dtchamada,'hh24:mi:ss') as hora 
				FROM casenha
				WHERE casenharegra_id IN ( ".implode(", ",$arSenhas[Id])." ) 
				AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."' 
				AND dttriagem is null
				AND dtchamada is not null
				AND dtsaida is null
				AND emespera = 0				
				";
		
		
		$dbData->Get($sql);
		
		$dbData2 = new DbData($dbOracle);
		
		while($row = $dbData->Row())
		{

			if(_SubtrairTempo(date('H:i:s'),$row[HORA]) > 180)
				$dbData2->Set("UPDATE casenha SET  emespera = 1, dtespera = sysdate WHERE id = '".$row[ID]."'");
			
		}
		
		unset($dbData2);
			
		
				
		//Passo 2 - Selecionar as ultimas senhas chamadas (pode estar em espera ou nao)
		
		$sql = "
					SELECT casenha.numero, casenharegra.sigla, casenha.id, camesa.numero as mesa, emespera
					FROM casenha, casenharegra, camesa
					WHERE casenha.casenharegra_id = casenharegra.id
					AND casenha.camesa_id = camesa.id
					AND casenharegra_id IN ( ".implode(", ",$arSenhas[Id])." ) 
					AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
					AND dtcancelado is null		
					ORDER BY to_char(dtchamada,'hh24:mi:ss') DESC
				
				";

		$dbData->Get($sql);
		
		
		
		echo $view->Table(array("class"=>"tbMonitor")).
				$view->Th("SENHA");
		
		if($aCAEvento[ESCONDEMESA] != 'on')
			echo $view->Th("MESA");

		$cont = 1;
		while($row = $dbData->Row())
		{
			$classFirst = "";
			if($cont == 1) $classFirst = "firstLine";
			
		
			if($_SESSION[monitorSenha][id] != $row[ID] && $row[ID] != '' && $classFirst == "firstLine"){
				echo "<embed src='../multimedia/notify.swf' hidden=true autostart=true loop=false>";
				$_SESSION[monitorSenha][id] = $row[ID];
			}
			
			echo $view->Tr(array("class"=>$classFirst)).
					$view->Td().$row[SIGLA].str_pad($row[NUMERO],3,0, STR_PAD_LEFT).$view->CloseTd();

					
					if($aCAEvento[ESCONDEMESA] != 'on')
					{
			
						if($row[EMESPERA] == '1')
							echo $view->Td(array("style"=>"font-size:70px"))."EM ESPERA".$view->CloseTd();
						else 
							echo $view->Td().$row[MESA].$view->CloseTd();
					}
					
				echo $view->CloseTr();
			
			
			
			if($cont++ >= $aCAEvento["LINMONITOR"]) break;
			
			
		}
		
		echo $view->CloseTable();
					
		unset($view);
		unset($user);
		unset($db);
		unset($dbOracle);
		
		die();
	}
	
	
	require_once("../engine/View.class.php");
	$view = new View();
	
	$view->IncludeJS("jquery.js");
	$view->IncludeCSS("casenha.css");
	$view->IncludeCSS("font-awesome/css/font-awesome.css");
	
	echo $view->SetCSS("body{overflow:hidden!important}");
	
	echo $view->JS(
			
			"window.setInterval(
			
					function()
					{
						$('#listaSenhas').load('casenha_imonitor.php?p_Action=reload');
			
					},5000);	
			"
			
			);
	
	
	
	echo $view->Div(array("id"=>"listaSenhas")).$view->CloseDiv();
	
	/*
	
	
	echo $view->SetCSS("#listaSenhas { position:absolute;right:0;width:70% } ");
	
	echo $view->SetCSS("#listaImg { position:absolute;left:1%;width:29%;height:400px;background:red }");
	
	echo $view->Div(array("id"=>"listaImg")).$view->CloseDiv();
	
	
	
	
	echo $view->SetCSS("#msgList { left:0;position:absolute;bottom:15px;width:100%;height:auto;z-index:999;font-family:verdana;font-size:60px;overflow:hidden;font-weight:bold;background:#243446;padding:10px 0;color:#fff }");
	
	echo $view->IncludeJS("marquee.js");
	
	
	echo $view->JSFunction(
			"
			
			function showRandomMarquee() {
  
				$.post('casenha_imonitor.php?p_Action=getMsg',function(retorno){
			
					$('#msgList').marquee('destroy').bind('finished', showRandomMarquee).html(retorno).marquee({duration: 15000});
			
				});
			
			  
			}
			
		");
	
	
	
	echo $view->JS("showRandomMarquee();");
	
	echo $view->Div(array("id"=>"msgList")).$view->CloseDiv();
	
	
	if($aCAEvento[ESCONDEMESA] == 'on')
		echo $view->P($view->Italic("",array("class"=>'fa fa-long-arrow-left','style'=>'font-size:550px;color:green;')),array("style"=>"text-align:center"));
	*/
	
	unset($view);
	

?>