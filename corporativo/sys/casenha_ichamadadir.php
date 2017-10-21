<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Chamar Próxima Senha por Tipo - Controle de Atendimento","Chamar Próxima Senha por Tipo - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenhaRegra.class.php");
	include("../model/CASenha.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaTi.class.php");
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);
	$view 			= new ViewPage($app->title,$app->description);
	
	$caMesa 		= new CAMesa($dbOracle);
	$caEvento 		= new CAEvento($dbOracle); 
	$caSenhaRegra 	= new CASenhaRegra($dbOracle);
	$caSenha		= new CASenha($dbOracle);
	$caSenhaTi		= new CASenhaTi($dbOracle);
	
	
	$view->Header($user,$nav);
	$view->IncludeCSS("casenha.css");
	
	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	echo $view->JS("
				$(document).on('keydown', disableF5);
			
				$('.listMesa li').bind('click',function(){
			
					$('.listMesa li').removeClass('listMesaOn');
					$(this).addClass('listMesaOn');
					$('#p_Mesa_Id').val(\$(this).attr('idr'));
			
				});
			
				if($.cookie('p_CAMesa_Id') != null)			
				{
					$('.listMesa li').trigger('click');			
				}
			
			
			
			");

	
	
	echo $view->JS("
		
				$(document).on('keydown', disableF5);
		
				$('.inputSenha').focus();
		
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
						
							}
	
						});
						}, 3000);
				}
		
			
			");
	
	
	
	
	if ($_COOKIE[p_CAMesa_Id] != '')	
		$vMesa = $_COOKIE[p_CAMesa_Id];
	
	if ($_POST["p_Mesa_Id"] != '')
		$vMesa = $_POST["p_Mesa_Id"]; 
	

	if ($vMesa != '')
	{
		$sql = "select id
		from casenha
		where camesa_id= $vMesa
		AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
		and dtsaida is null
		and dttriagem is not null
		and dtcancelado is null
		order by dtchamada
		";
		
		
		$dbData->Get($sql);
	
		if ($dbData->Count() > 0)
		{

			while ($row = $dbData->Row())
			{
					
				$aProximaSenha = $caSenha->GetIdInfo($row[ID]);
				$vPrint .= $view->Tr().$view->Td() . trim(end(explode("-",$aProximaSenha[CASENHAREGRA_NOME]))).str_pad($aProximaSenha[NUMERO],3,0,STR_PAD_LEFT) . '('.substr($aProximaSenha[ID],-6).')' . $view->CloseTd().$view->CloseTr();

				$senhaNFinalizada = trim(end(explode("-",$aProximaSenha[CASENHAREGRA_NOME]))).str_pad($aProximaSenha[NUMERO],3,0,STR_PAD_LEFT) . '('.substr($aProximaSenha[ID],-6).')';
				
			}
			
			if ($vPrint != '')
			{
				$view->Dialog('E', 'ERRO', 'Finalize a última senha antes de iniciar novo atendimento. <br> Favor finalizar a senha <b>'.$senhaNFinalizada.'</b>');
				$_POST[p_O_Option] = '';
			}
		}
	}	

	
	
	if($_POST[p_O_Option] == 'insert')
	{
	
		$qtdSenha = $caSenha->GetQtdSenha($p_CAEvento_Id);
		
		if($qtdSenha > 0)
		{
			
			
			$proximaSenha = $caSenha->ProximaSenha($p_CAEvento_Id,$_POST["p_CASenhaTi_Id"]);
			
			$aProximaSenha = $caSenha->GetIdInfo($proximaSenha);

			
			
			
			$vProximaSenha = trim(end(explode("-",$aProximaSenha[CASENHAREGRA_NOME]))).str_pad($aProximaSenha[NUMERO],3,0,STR_PAD_LEFT) . '('.substr($aProximaSenha[ID],-6).')';
						
			if($proximaSenha != "")
			{
				
				
				$ultimaSenha = $dbData->Row($dbData->Get("SELECT to_char(dtchamada,'dd/mm/yyyy hh24:mi:ss') as dtchamada FROM casenha WHERE camesa_id = '".$_POST["p_Mesa_Id"]."' ORDER BY id DESC"));

				if($ultimaSenha[DTCHAMADA] != "")
				{
					list($data,$hora) = explode(" ",$ultimaSenha[DTCHAMADA]);
					$data = explode("/",$data);
					$hora = explode(":",$hora);
					
					
					$hrChamada 	= mktime($hora[0],$hora[1],$hora[2],$data[1],$data[0],$data[2]);
					$hrAtual 	= mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
				}
			
				

				if(($hrAtual-$hrChamada) < 30 && $ultimaSenha[DTCHAMADA] != "")
				{
					$view->Dialog('E', 'Mesa', 'Aguarde '.(30-($hrAtual-$hrChamada))." segundos para chamar outra senha.");
				}
				else
				{
					$dadosSenha = $caSenha->GetIdInfo($proximaSenha);
					
					$arUpd["p_O_Option"] 	= "update";
					$arUpd["CAMesa_Id"] 	= $_POST["p_Mesa_Id"];
					$arUpd["CASenha_Id"] 	= $proximaSenha;
					$arUpd["Chamada"] 		= $dadosSenha[CHAMADA]+1;
					$arUpd["DtChamada"]  	= date('d/m/Y H:i:s');
					$arUpd["EmEspera"]  	= 0;
			
			
					$caSenha->IUD($arUpd);
					
					$dbData->Set("UPDATE casenha SET dtespera = null WHERE id = '".$proximaSenha."' ");
					$dbData->Commit();
					
				
					$view->Dialog('I', 'Senha', 'Senha Chamada: '. $vProximaSenha);
				}
				
			}
			else 
			{
				$view->Dialog('I', 'Não há senhas.', 'Não há senhas para serem chamadas nesse momento.');
				
			}
						
		}
		else
		{

			$view->Dialog('I', 'Não há senhas.', 'Não há senhas para serem chamadas nesse momento.');
		
		}
		
		
	
	}
		
	
	if (isset($_COOKIE["p_CAEvento_Id"]))
	{
		
		$acaEvento = $caEvento->GetIdInfo($_COOKIE["p_CAEvento_Id"]);
		
		//Instanciar formulário
		$form = new Form();
	
			$form->Fieldset($caEvento->Recognize($p_CAEvento_Id,"RecReduz"));
				
				$form->Input("","hidden",array("name"=>"p_Mesa_Id","id"=>"p_Mesa_Id"));
							
				$form->Input("Mesa","label",$caMesa->GetListMesaAtiva($p_CAEvento_Id,$_COOKIE["p_CAMesa_Id"]));
				
				$form->Input("Tipo de Atendimento",'select',array("name"=>"p_CASenhaTi_Id","required"=>'1',"option"=>$caSenhaTi->Calculate("Evento",array("p_CAEvento_Id"=>$p_CAEvento_Id)),"value"=>$_POST["p_CAMesa_Id"]));
				
				if ($vPrint != '' && $acaEvento["BLOQCHAM"] == 'on')
				{
					$vMsg = 'Finalize a senha <strong>'.$vPrint. '</strong> antes de iniciar novo atendimento.';
					$form->Input("","label",$vMsg);
				}
				else 
				{
					$form->Button("submit",array("class"=>"insert","value"=>"Chamar"));
				}				
				
			$form->CloseFieldset ();
	
			
		//fecha formulário
		unset ($form);
		
	echo  $view->Table(array("class"=>"dataGrid")).$view->Caption("Atenção, as seguintes senhas não foram finalizadas").
			$view->Th("Senha");
			echo $vPrint;
	echo $view->CloseTable() . $view->CloseDiv();

		
	}
	else
	{
		$view->Dialog('E', 'Evento não Encontrado.', 'O evento precisa ser selecionado nas configurações para essa página funcionar corretamente');
	}	
	
	
	unset($caEvento);
	unset($caMesa);
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>