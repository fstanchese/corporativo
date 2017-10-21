<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Término do Atendimento - Controle de Atendimento","Término do Atendimento - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaRegra.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	$caEvento 	= new CAEvento($dbOracle);
	$caSenhaRegra 	= new CASenhaRegra($dbOracle);
	
	$view->Header($user);
	$view->IncludeCSS("casenha.css");
	
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}
	
	
	
	echo $view->JS("
			
				$(document).on('keydown', disableF5);
			
				$('.inputSenha').focus();
			
				$('.inputSenha').blur(function(){
					if($(this).val() !='')
						$('#f1').submit();
					
			
				})
			
			
			
			");
	
	
	
	
	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	if($_POST[p_CASenha_Id] != '')
	{
	

		$senhaAtend = $dbData->Row($dbData->Get("SELECT dttriagem FROM casenha WHERE id = '".(201200000000000+$_POST[p_CASenha_Id])."'"));
		
		if($senhaAtend[DTTRIAGEM] == "")
		{
			
			
			$view->Dialog('W', "Senha sem Atendimento", 'O atendimento não pode ser Finalizado pois ainda não foi iniciado o atendimento.');
			
		}
		else
		{		
			$todasSenhas 	= $caSenhaRegra->GetSenhaRegraByEvento($p_CAEvento_Id);
			
			$senhaInvalida = $dbData->Row($dbData->Get("SELECT trunc(dt) as dt, casenharegra_id, dttriagem, dtcancelado, camesa_id, dtsaida FROM casenha WHERE id = '".(201200000000000+$_POST[p_CASenha_Id])."' "));
				
			if(array_search($senhaInvalida[CASENHAREGRA_ID],$todasSenhas[Id]) === FALSE || $senhaInvalida[DT] != date('d/m/Y') || $senhaInvalida[DTCANCELADO] != "" || $senhaInvalida[DTSAIDA] != "")
			{
			
				
				$view->Dialog('W', "Senha <b>".$_POST[p_CASenha_Id]."</b> Inválida", 'A senha que você está tentando finalizar já foi finalizada.');
				
			
			
			}
			else
			{
			
			
				$caSenha	= new CASenha($dbOracle);

				$vConf = true;
				if ($_COOKIE[p_CAMesa_Id] != '')
				{
					$acaSenha = $caSenha->GetIdInfo(201200000000000+$_POST[p_CASenha_Id]);
					If ($acaSenha[CAMESA_ID] != $_COOKIE[p_CAMesa_Id])
					{
						$view->Dialog('W', 'Senha', 'ATENÇÃO, essa senha foi chamada por outra mesa, por favor verifique.', false, false, true, true);
						$vConf = false;
					}
				}
				
				if ($vConf)
				{						
					$arUpd["p_O_Option"] 		= "update";
					$arUpd["DtSaida"] 			= date('d/m/Y H:i:s');
					$arUpd["CASenha_Id"] 		= 201200000000000+$_POST[p_CASenha_Id];
					$arUpd["EmEspera"] 			= 0;
				
					$caSenha->IUD($arUpd);
				}			
			
				unset($caSenha);
			}
		}	
		
		
	}
		

	
		$form = new Form();
	
			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
	
				$form->Input("Senha (Número abaixo do Cod. Barras)","text",array("name"=>"p_CASenha_Id","class"=>"inputSenha","required"=>1,"class"=>"onlyNumber inputSenha"));
				
			$form->CloseFieldset ();
	
			
	
		unset ($form);
	
	
	
	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>