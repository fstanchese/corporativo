<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Gerar Senha - Controle de Atendimento - Matrícula","Gerar Senha - Controle de Atendimento - Matrícula",array('ADM','MATRICULA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenhaRegra.class.php");
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaTi.class.php");

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$caEvento	= new CAEvento($dbOracle);	
	$caSenhaTi 	= new CASenhaTi($dbOracle);
	
	$acaEvento = $caEvento->GetIdInfo($_COOKIE["p_CAEvento_Id"]);
	
	$view 		= new ViewBox($app->title,$app->description);
	$view->Header($user);

	echo "
			<style>
				.boxItem { cursor:pointer;float:left;height:120px!important;position:relative; border-radius:7px;}
				.boxItem:hover { opacity:0.85; -webkit-transition: opacity 1s ease-in-out;
  				-moz-transition: opacity 0.2s ease-in-out;
				-ms-transition: opacity 0.2s ease-in-out;
  				-o-transition: opacity 0.2s ease-in-out;
  				transition: opacity 0.2s ease-in-out;}
		
				.boxItem em { position:absolute;top:10px;font-size:50px;width:100%;text-align:center;z-index:1;color:#444 }
				.boxItem strong { position:absolute;top:15px;width:100%;z-index:2;text-align:center;color:#222}
		
				.titulo { color: #bbb;text-shadow: 0px 2px 3px #666;width:100%;padding:20px 0;background:#474747;text-align:center;margin:1% 0;font-size:37px;text-transform:uppercase}
			</style>
		";
	
	
	if(!isset($_COOKIE["p_CAEvento_Id"]))
	{
		echo $view->Dialog('E', 'Evento Não Encontrado', 'O evento precisa ser selecionado nas configurações para essa página funcionar corretamente', 'false', 'false', 'false', 'false');
		
		die();
	}
	
	
	if ($acaEvento["SENHANOMINAL"] == 'on')
	{
		echo $view->Dialog('E', 'Evento Incorreto', 'Evento selecionado faz uso de senhas nominais, <a href=casenha_igeracao.php>clique aqui</a> para gerar a senha', 'false', 'false', 'false', 'false');
		die();
	}
	
	
	echo $view->JS(" 
			
				$(document).on('click','.boxItem',function()
				{
					$('input[name=p_SenhaRegra_Id]').val($(this).attr('id'));
					$('input[name=p_O_Option]').val('insert');
					$('#f1').submit();
				});
			
				window.setInterval(
			
					function()
					{
						$('#listaSenhas').load('casenha_imonitor.php?p_Action=reload');
			
					},1000);	

			");
	
	if($_POST[p_O_Option] == 'insert')
	{
		
		if($_POST[p_Preferencial] == "") $_POST[p_Preferencial] = 0;
	
		
		$caRegra 	= new CASenhaRegra($dbOracle);
		$caSenha 	= new CASenha($dbOracle);
	
		
		//$arSenhas = $caRegra->GetSenhasEvento($_COOKIE["p_CAEvento_Id"]);

		//print_r($arSenhas);		
		//$dbData->Get("select * from casenharegra where casenhati_id='$_POST[p_SenhaRegra_Id]'");
		
		//
		$aSenhaTi = $dbData->Row();

		$arInsert['CASenhaRegra_Id'] 	= $_POST[p_SenhaRegra_Id]; 
		$arInsert['Descricao'] 			= '-';
		
		//Proximo numero da senha
		$arInsert['Numero'] 			= $caSenha->GetNextSenhaNumero($_POST[p_SenhaRegra_Id]);
		$arInsert['p_O_Option']			= 'insert';
		
		//print_r($arInsert);
		//die();
		
		
		$caSenha->IUD($arInsert, FALSE);
		
		$casenha_id = $dbData->GetInsertedId("casenha_id");
		
				
		echo $view->JS("
					$.colorbox(
						{
							href:'../sys/casenha_isenha.php?casenha_id="._UrlEncrypt($casenha_id)."',
							width:'500px', 
							height:'450px',
							iframe: true,
							overlayClose:false,											 
							onClosed: function() { location.href='casenha_igeracaomatric.php'; }
	
					});

					window.setTimeout(function() {
						$.colorbox.close();
					}, 500);
				
				
				");


		
		
		die();
	}
	
	$form = new Form();
	$form->Input('','hidden',array("name"=>"p_Preferencial"));
	$form->Input('','hidden',array("name"=>"p_SenhaRegra_Id"));
	unset($form);


	//$aTipoSenha = $caSenhaTi->GetSenhaTiByEvento($_COOKIE[p_CAEvento_Id]);
	
	
	$arCor = array('#084e8a','#0a73cb','#449de9','#0d2539','#00284a','#63b6fc','#005e12','#08c32c','#5edb76','#468e54','#1a4622','#006295');


		
	echo $view->Div(array("id"=>"201000000000085","class"=>"boxItem","style"=>"margin:1%;background:#084e8a;width:98%;align:center;","title"=>"Senha Normal")).
	$view->Strong("Senha Normal",array("style"=>"color:#fff;font-size:40px;")).
	$view->CloseDiv();
		

	echo $view->Div(array("id"=>"201000000000086","class"=>"boxItem","style"=>"margin:1%;background:#449de9;width:98%;align:center;","title"=>"Senha Preferencial")).
	$view->Strong("Senha Preferencial",array("style"=>"color:#fff;font-size:40px;")).
	$view->CloseDiv();
	
		//echo $view->Br().$view->Br().$view->Br();
		

	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>