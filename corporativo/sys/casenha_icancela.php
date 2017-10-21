<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cancelar Senha - Controle de Atendimento","Cancelar Senha - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	$caEvento  	= new CAEvento($dbOracle);
	

	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}
	
	
	$view->Header($user);
	
	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	echo $view->JS("
		
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
	
	
	
	
	
	if($_POST[p_O_Option] == 'update')
	{
	

		$caSenha	= new CASenha($dbOracle);
		
			
		$arUpd["p_O_Option"] 		= "update";
		$arUpd["DtCancelado"]		= date('d/m/Y H:i:s');
		$arUpd["CASenha_Id"] 		= 201200000000000+$_POST[p_CASenha_Id];
			
		$caSenha->IUD($arUpd);
			
		
	}
		
	
	
	


		//Instanciar formulário
		$form = new Form();
	
			$form->Fieldset($caEvento->Recognize($p_CAEvento_Id,"RecReduz"));
	
				$form->Input("Senha","text",array("name"=>"p_CASenha_Id","required"=>1));
				
				$form->Button("submit",array("class"=>"update","value"=>"Prosseguir com Cancelamento"));
				
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