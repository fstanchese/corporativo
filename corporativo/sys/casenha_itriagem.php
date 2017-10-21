<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Início do Atendimento - Controle de Atendimento","Início do Atendimento - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaRegra.class.php");
	
	
	$dbOracle 		= new Db ($user);
	$dbData		 	= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);
	$view 			= new ViewPage($app->title,$app->description);
	
	$caEvento 		= new CAEvento($dbOracle);
	$caSenhaRegra 	= new CASenhaRegra($dbOracle);
	
	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	$view->Header($user);
	
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}
	
	$view->IncludeCSS("casenha.css");
	

	
	
	echo $view->JS("
			
				$(document).on('keydown', disableF5);
			
				window.setInterval(function()
				{
					$('.inputSenha').focus();	
				},500);
			
			
				
			
				$('.inputSenha').blur(function(){
					if($(this).val() !='')
						$('#f1').submit();
					
			
				});
				
				if($.cookie('p_CAEvento_Id') != undefined)
				{
			
					window.setInterval(function(){
					$.ajax ({
							type: 'POST',
							url: '../ajax/casenha.ajax.php',
	 						data: 'p_Action=getSenhasAtendimento&CAEvento_Id=".$p_CAEvento_Id."',
							success:function(data)
							{
								$('#divSenhaAtend').html(data);
									
				
								$.ajax ({
									type: 'POST',
									url: '../ajax/casenha.ajax.php',
			 						data: 'p_Action=getSenhasEmEspera&CAEvento_Id=".$p_CAEvento_Id."',
									success:function(data)
									{
										$('#divSenhaEspera').html(data);
				
				
										$.ajax ({
											type: 'POST',
											url: '../ajax/casenha.ajax.php',
					 						data: 'p_Action=getSenhasSemInicioAtend&CAEvento_Id=".$p_CAEvento_Id."',
											success:function(data)
											{
												$('#divSenhaNAtendida').html(data);
											}
					 						
										});
				
									}
			 						
								});
				
				
							}
	 						
						});
						}, 3000);
				}
			
			
						
			
			");
	
	
	
	
	
	
	if($_POST[p_CASenha_Id] != '')
	{
	

		
		
		$senhaEmEspera = $dbData->Row($dbData->Get("SELECT emespera FROM casenha WHERE id = '".(201200000000000+$_POST[p_CASenha_Id])."'"));
		
		

		
		if($senhaEmEspera[EMESPERA] == 1)
		{
			
			$view->Dialog('W', "Senha em Espera", 'O atendimento não pode ser iniciado pois essa senha está em espera.');
			
		}
		else
		{
			$todasSenhas 	= $caSenhaRegra->GetSenhaRegraByEvento($p_CAEvento_Id);
			
			$senhaInvalida = $dbData->Row($dbData->Get("SELECT trunc(dt) as dt, casenharegra_id, dttriagem, dtcancelado, camesa_id FROM casenha WHERE id = '".(201200000000000+$_POST[p_CASenha_Id])."' "));
			
			if(array_search($senhaInvalida[CASENHAREGRA_ID],$todasSenhas[Id]) === FALSE || $senhaInvalida[DT] != date('d/m/Y') || $senhaInvalida[DTCANCELADO] != "" || $senhaInvalida[DTTRIAGEM] != "")
			{
				
				$view->Dialog('W', "Senha <b>".$_POST[p_CASenha_Id]."</b> Inválida", 'Essa senha já está com o atendimento iniciado ou o número está incorreto.');
				
			}
			else
			{
			
				$caSenha	= new CASenha($dbOracle);
				$acaSenha = $caSenha->GetIdInfo(201200000000000+$_POST[p_CASenha_Id]);
				
				$vConf = true;
				if ($_COOKIE[p_CAMesa_Id] != '')
				{
					
					If ($acaSenha[CAMESA_ID] != $_COOKIE[p_CAMesa_Id])
					{
						$view->Dialog('E', 'Senha', 'ATENÇÃO, essa senha foi chamada por outra mesa, por favor verifique.', false, false, true, true);
						$vConf = false;
					}
				}
				
				if ($vConf)
				{
					if ($acaSenha[CAMESA_ID] != '')
					{	
						$arUpd["p_O_Option"] 		= "update";
						$arUpd["DtTriagem"] 		= date('d/m/Y H:i:s');
						$arUpd["CASenha_Id"] 		= 201200000000000+$_POST[p_CASenha_Id];
						
						$caSenha->IUD($arUpd);
						
						$dadosSenha = $caSenha->GetIdInfo(201200000000000+$_POST[p_CASenha_Id]);
						
						$aEvento = $caEvento->GetIdInfo($p_CAEvento_Id);
						
						if ($aEvento[ESCONDEMESA] == 'on' )
							$view->Dialog('W', "Dirigir-se à MESA", '<span style="font-size:35px">'.end(explode("-",$dadosSenha[CAMESA_NOME])).'</span>');
						
						
						
					}
					else
					{
						$view->Dialog('E', 'Senha', 'A senha não foi chamada, você só pode iniciar atendimento de senhas chamadas.');						
					}						
				}
				
			}
			
		}
		
	}
		
	
	
	
	

		//Instanciar formulário
		$form = new Form();

			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
	
				$form->Input("Senha (Número abaixo do Cod. Barras)","text",array("name"=>"p_CASenha_Id","class"=>"inputSenha","required"=>1,"class"=>"onlyNumber inputSenha"));
			
			$form->CloseFieldset ();

		
		//fecha formulário
		unset ($form);
	
	
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaAtend")).$view->CloseDiv();
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaEspera")).$view->CloseDiv();
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaNAtendida")).$view->CloseDiv();
	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>