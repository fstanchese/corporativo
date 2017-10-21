<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Gerar Carta de Cobrança","Gerar Carta de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../engine/Ajax.class.php");
	
	include("../model/CCobCrit.class.php");
	include("../model/CCobCartaTi.class.php");
	include("../model/CCobTiXBolTi.class.php");
	include("../model/State.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	include("../model/BoletoTi.class.php");
	include("../model/Boleto.class.php");
	include("../model/StateGru.class.php");
	
	
	$dbOracle = new Db ($user);

	$dbData = new DbData ($dbOracle);
	$nav = new Navigation($user, $app, $dbData);
	
	$ajax = new Ajax();

	$ccobCrit 		= new CCobCrit($dbOracle);
	$ccobCartaTi 	= new CCobCartaTi($dbOracle);
	$ccobTiXBolTi	= new CCobTiXBolTi($dbOracle);
	$state			= new State($dbOracle);
	$cursoNivel		= new CursoNivel($dbOracle);
	$curso			= new Curso($dbOracle);
	$boletoTi		= new BoletoTi($dbOracle);
	$boleto			= new Boleto($dbOracle);
	$stateGru		= new StateGru($dbOracle);
	
	
	$p_Sistema_Id = 131700000000008;
	
	$view = new ViewPage($app->title,$app->description);
	//$view->Explain ("IUD");	
	

	$view->Header($user,$nav);
 
	echo $view->JS("
			
		$(document).on('change','#p_CCobCartaTi_Id',function()
		{
			if ($(this).val() != '')
			{
				$.ajax ({
					type: 'POST',
					url: '../ajax/ccob.ajax.php',
		 			data: 'p_Action=showDetCartaTi&vPar='+$(this).val(),
					success:function(data)
					{
						$('#showDet').html(data);
					}
				});
			}
			else
			{
				$('#showDet').empty();
			}
		});

			
		$('.dtinicio').blur(function(){
			var vStr = $(this).val();
			if(vStr.substr(0,2) > 12)
			{				
				alert('Mês Inválido.');
				document.f1.p_DtInicio.focus();
			}	
		});
			
		$('.dttermino').blur(function(){
			var vStr  = $(this).val();
			var vStrI = $('.dtinicio').val(); 			
			var vInicio = vStrI.substr(3,4) + vStrI.substr(0,2);
			var vTermino = vStr.substr(3,4) + vStr.substr(0,2);
			
			if(vStr.substr(0,2) < 13)
			{				
				if (vInicio > vTermino)
				{
					$.Zebra_Dialog( 'Mês de Término deve ser maior que de Início.',
						{
							'type': 'error',
							'title': 'Informação Incorreta'
						})
					
								
				}
			}	
			else
			{
				$.Zebra_Dialog( 'Mês Inválido',
				{
					'type': 'error',
					'title': 'Informação Incorreta'
				})
				
			
			}
		});

		
		$('.btEnviar').click(function(){

			var \$form    = $(this).closest('form');
			
			if(_CheckRequired(\$form.attr('id')))
			{
				var form = $('#f2').serialize();
			
				$.ajax ({
						type: 'POST',
						url: '../ajax/ccob.ajax.php',
 						data: 'p_Action=setCriterio&'+form,
						beforeSend:function()
						{
			
							$.Zebra_Dialog( 'Buscando Devedores',
							{
								'type': 'information',
								'title': 'Aguarde...',
								'keyboard' : false,
								'overlay_close' : false,
								'show_close_button' : false,
								'buttons':false
							})
			
						},
						success:function(data)
						{
							$('.ZebraDialogOverlay').hide(1);
							$('.ZebraDialog').hide(1);
			
			
							getCriterioSession();	
						}

					});
			}
			
			
		});
			
			
		$(document).on('click','input[type=reset]',function(e)
			{
				e.preventDefault();
				$.ajax ({
					type: 'POST',
					url: '../ajax/ccob.ajax.php',
	 				data: 'p_Action=cancelProc',
					success:function(data)
					{
						location.href='ccobproc_igeracao.php';
					}
	
				});
			}
			);
			
		$(document).on('click','.delCrit',function(e)
			{
				e.preventDefault();
				$.ajax ({
					type: 'POST',
					url: '../ajax/ccob.ajax.php',
	 				data: 'p_Action=delCriterioSession&p_Proc='+$(this).attr('critSession')+'&p_Key='+$(this).attr('key'),
					success:function(data)
					{
						getCriterioSession();
					}
	
				});
			
			
			});
			
		
		$(document).on('click','.viewCrit',function()
		{
			$.colorbox({
				href:'../box/ccobproc_ipreviewcriterio.php?p_Proc='+$(this).attr('critSession')+'&p_Key='+$(this).attr('key')+'&p_DtInicio='+$('#p_DtInicio').val()+'&p_DtTermino='+$('#p_DtTermino').val(),
				width:'80%', 
				height:'75%',
				iframe: true,
				escKey:false				
			});

		
		});	
			
			
			
			
			
			");
	
	
	$view->IncludeJS("ccobproc.js");
	
			
		echo $view->JSFunction("
			function getCriterioSession()
			{
				$.ajax ({
					type: 'POST',
					url: '../ajax/ccob.ajax.php',
	 				data: 'p_Action=getCriterioSession&p_DtInicio='+$('#p_DtInicio').val()+'&p_DtTermino='+$('#p_DtTermino').val(),
					success:function(data)
					{
							$('#boxCriterios').html(data);
					}
	
				});
			}
				
		");

	
	
	
	if($_POST[p_DtInicio] == "")
	{
	
		$form = new Form();
	
			$form->Fieldset("Processo de Cobrança");

				$form->Input('Tipo de Carta','select',	array("name"=>'p_CCobCartaTi_Id',"required"=>'1',"id"=>"p_CCobCartaTi_Id", "value"=>$_POST["p_CCobCartaTi_Id"] , "option"=>$ccobCartaTi->Calculate("Exibir")));

				$form->Button('submit',array("name"=>"btProsseguir","value"=>"Prosseguir"));
				
			$form->CloseFieldset ();
			
		unset ($form);
	}
		

	
	if($_POST[btProsseguir] == "Prosseguir")
	{
	
	

		
		$form = new Form(array("name"=>"f2"));
		
			$form->Fieldset("Critérios do Processo");
			

				$form->Input('','hidden', array("name"=>'p_CCobCartaTi_Id', "value"=>$_POST["p_CCobCartaTi_Id"]));
				
				$form->Input("Início do Período",'text',array("required"=>'1',"name"=>'p_DtInicio', "class"=>"competencia dtinicio" ));
				
				$form->Input("Término do Período",'text',array("required"=>'1',"name"=>'p_DtTermino', "class"=>"competencia dttermino" ));

				
				$form->Input('Tipos de Boletos','label', implode(' / ',$ccobTiXBolTi->GetBoletoTi($_POST["p_CCobCartaTi_Id"],TRUE)) );
				
				if ($_POST["p_CCobCartaTi_Id"] == 207900000000001)
				{
				
					$ajax->InputRequired("p_CursoNivel_Id","p_Curso_Id","change",$curso->query['qNivel'],array("p_CursoNivel_Id"=>"p_CursoNivel_Id"));
				
					$form->Input("Situação Acadêmica",'select',	array("name"=>'p_State_Matric_Id',"required"=>'1', "option"=>$stateGru->Calculate('Sistema',array("p_Sistema_Id"=>$p_Sistema_Id),"nome")));
				
					$form->Input('Nível do Curso','select' , array("name"=>'p_CursoNivel_Id',"option"=>$cursoNivel->Calculate()));
				
					$form->Input('Curso','select' , array("name"=>'p_Curso_Id',"option"=>array(""=>"Selecione o Nível do Curso")));
				
				}

				$form->Input("Mínimo de Boletos em Aberto","text",array("required"=>'1',"name"=>'p_Qtde', "class"=>"size10 onlyNumber", "maxlength"=>"2" ));
				
				$form->Input("Data de Vencimento","date",array("required"=>'1',"name"=>"p_DtVencto" ));
				
				$form->Input("Ignorar Consequência",'onoff' , array("name"=>'p_SCPC', "required"=>"1"));
				
				
				$form->Button('button',array("class"=>"btEnviar","value"=>"Adicionar"));
				$form->Button('reset',array("value"=>"Cancelar"));
							
			$form->CloseFieldset ();	
			
		unset ($form);
		
		
		echo $view->JS("getCriterioSession()");
		
		echo $view->Br();
		
		
		echo $view->Div(array("id"=>"boxCriterios")).$view->CloseDiv();
		
	}
	
	unset($ccobCartaTi);
	unset($ccobCrit);
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>