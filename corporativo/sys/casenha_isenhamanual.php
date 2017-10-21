<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Chamar Senha Manualmente - Controle de Atendimento","Chamar Senha Manualmente - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenha.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAEvento.class.php");
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	$caMesa			= new CAMesa($dbOracle);
	$caEvento		= new CAEvento($dbOracle);
	
	$view->IncludeCSS("casenha.css");
	

	$view->Header($user);
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}

	$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
	
	echo $view->JS("
		
				window.setInterval(function() {
			
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
			
										$.ajax ({
												type: 'POST',
												url: '../ajax/casenha.ajax.php',
									 			data: 'p_Action=getSenhasNovas&CAEvento_Id=".$p_CAEvento_Id."',
												success:function(data)
												{
													$('#divSenhaNova').html(data);
												}
									 	
											});
										
			
			
								}
		 	
							});

						}
 		
					});
			}, 2000);
			
					$('.pickSenha').live('click',function(){
			
						$('#p_CASenha_Id').val($(this).attr('idr'));
						$('input[name=p_Senha]').val($(this).html()).focus();
			
					});
			
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
	
	
	
	
	
	
	if($_POST[p_O_Option] == 'update')
	{
	
		$caSenha  		= new CASenha($dbOracle);


		
		$dadosSenha = $caSenha->GetIdInfo($_POST[p_CASenha_Id]);

		
		$arUpd["p_O_Option"] 	= "update";
		$arUpd["CAMesa_Id"] 	= $_POST[p_Mesa_Id];
		$arUpd["CASenha_Id"] 	= $_POST[p_CASenha_Id];
		$arUpd["Chamada"] 		= $dadosSenha[CHAMADA]+1;
		$arUpd["DtChamada"]  	= date('d/m/Y H:i:s');
		$arUpd["EmEspera"]  	= 0;
		$caSenha->IUD($arUpd);
			
		
	}
		
	
	
		//Instanciar formulário
		$form = new Form();

			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));

				$form->Input("","hidden",array("name"=>"p_CASenha_Id","id"=>"p_CASenha_Id"));
		
				$form->Input("Senha","text",array("name"=>"p_Senha","readonly"=>"true","required"=>1));
			
				$form->Input("","hidden",array("name"=>"p_Mesa_Id"));
				
				$form->Input("Mesa","label",$caMesa->GetListMesaAtiva($p_CAEvento_Id,$_COOKIE["p_CAMesa_Id"]));
				
				$form->Button("submit",array("class"=>"update","value"=>"Chamar Senha"));
			
			$form->CloseFieldset ();

		
		//fecha formulário
		unset ($form);
	
	
	
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaEspera")).$view->CloseDiv();
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaNAtendida")).$view->CloseDiv();
		echo $view->Div(array("style"=>"float:left;width:30%;margin:0 15px","id"=>"divSenhaNova")).$view->CloseDiv();
	

	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>