<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Geraчуo de Lote","Geraчуo de Lote",array('ADM','CPD','CASENHAGER'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/LoteFluxo.class.php");
	include("../model/LoteProc.class.php");
	include("../model/CAEvXWPes.class.php");
	include("../model/Campus.class.php");
	include("../model/Depart.class.php");
	include("../model/Sala.class.php");
	include("../model/CASenha.class.php");
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	
	$loteFluxo	= new LoteFluxo($dbOracle);
	$loteProc	= new LoteProc($dbOracle);
	$caEvXWPes	= new CAEvXWPes($dbOracle);
	$campus		= new Campus($dbOracle);
	$depart		= new Depart($dbOracle);
	$sala		= new Sala($dbOracle);
	$caSenha	= new CASenha($dbOracle);
			
	
	
	
	
	
	$view 		= new ViewPage($app->title,$app->description);
	
	
	if($_POST[p_O_Option] == 'insert')
	{
		if(is_array($_SESSION[LOTESENHA]))
		{
	
			$proxLote = $loteFluxo->GetNextLoteNum();
		
			foreach($_SESSION[LOTESENHA] as $senha)
			{
				$aMatriz = explode("_",$senha);
					
				$arInsert[p_O_Option] 		= "insert";
				$arInsert[DocTi_Id] 		= 206200000000001;
				$arInsert[Numero] 			= $proxLote;
				$arInsert[CAEvXWPes_Id] 	= $aMatriz[0];
				$arInsert[CASenha_Id] 		= $aMatriz[1];
				$arInsert[EnvSecretaria]	= $aMatriz[2];
				
				$arInsert[Sala_Id]			= $_POST[p_Sala_Id];
				$arInsert[Campus_Id]		= $_POST[p_Campus_Id];
				$arInsert[Depart_Id]		= $_POST[p_Depart_Id];
				$arInsert[LoteProc_Id]		= $_POST[p_LoteProc_Id];
					
				$loteFluxo->IUD($arInsert);
					
			}
		
			unset($_SESSION[LOTESENHA]);
			
			
			if($_POST[enviar] == "Gerar Simplificado") echo $view->Js("window.open('../rep/lotefluxo_irsimplificadoprouni.php?numero=".$proxLote."')");
			if($_POST[enviar] == "Gerar Capa") echo $view->Js("window.open('../rep/lotefluxo_ircapaprouni.php?numero=".$proxLote."')");
			
			
		}
			
	}
	
	
	$view->Header($user);

	
	
	echo $view->JS(	"
				$('#p_Senha').blur( function() {
					if  ( $('#p_Senha').val() != '' )
					{
						$.post('../ajax/lote.ajax.php?vTipo=ConsultaSenha&vSenha='+$('input[name=p_Senha]').val()+'&vSecretaria='+$('input[name=p_Secretaria]').val(),function(retorno){
							if(retorno == '0')
							{
								alert('Senha inexistente');
							}
							else
							{
								$('.divItens').html(retorno);
								$('input[name=p_Senha]').focus().val('');
						
							}		
						});
					}
				});

			
				$('.btIncluir').click( function() {
					$.post('../ajax/lote.ajax.php?vTipo=ConsultaSenha&vSenha='+$('input[name=p_Senha]').val(),function(retorno){
						if(retorno == '0')
						{
							alert('Senha inexistente');
						}
						else
						{
							$('.divItens').html(retorno);
							$('input[name=p_Senha]').focus().val('');
								
						}
					});
		
				});
			
			
				$('.btCancelar').click( function() {
					$('.divItens').html('');
				});
			
				$(document).on('click','.delSenha',function(){
			
					$.post('../ajax/lote.ajax.php?vTipo=ExcluiSenha&vSenha='+$(this).attr('idr'),function(retorno){
						$('.btIncluir').trigger('click');
					});
			
				});
			
				$('.btIncluir').trigger('click');
			
			"
		);
	

	$form = new Form();

		$form->Fieldset("Consultar Senha");
			
			$form->Input("Senha",'text',	array("name"=>'p_Senha', "class"=>"size10","id"=>"p_Senha"));
			$form->Input('Enviar Prontuсrio para a Secretaria?','onoff', array("name"=>'p_Secretaria',"value"=>"off"));
		
			$form->Button ("button", array ("value"=>"Selecionar","class"=>"btIncluir"));
		
		$form->CloseFieldset ();
		
		$form->Fieldset("Itens do Lote");
			echo $view->Div(array("class"=>"divItens"));
			
			
			
			echo $view->CloseDiv();
		$form->CloseFieldset ();
		
		$form->Fieldset("Informaчѕes do Lote");
		
			$form->Input("Procedimento",'select',array("name"=>'p_LoteProc_Id',"required"=>1,"option"=>$loteProc->calculate("Geral")));
			$form->Input("Unidade",'select',array("name"=>'p_Campus_Id',"required"=>1, "option"=>$campus->calculate("Geral")));
			$form->Input("Departamento",'select',array("name"=>'p_Depart_Id',"required"=>1, "option"=>$depart->calculate("Geral")));
			$form->Input($sala->GetLabel("Nome"), 'autocomplete', array($sala->GetLength("Nome"), "execute"=>"Sala.AutoComplete","name"=>'p_Sala_Id', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[SALA_ID],"placeholder"=>"Digite a Sala","label"=>$linhaSelected[SALA_RECOGNIZE]));
			//$form->Input("Local",'select',array("name"=>'p_Sala_Id',"required"=>1, "option"=>$sala->calculate("Geral")));
			
			$form->Button ("submit", array ("name"=>"enviar","value"=>"Gerar Capa","class"=>"insert"));
			$form->Button ("submit", array ("name"=>"enviar","value"=>"Gerar Simplificado","class"=>"insert"));
			$form->Button ("button", array ("value"=>"Cancelar","class"=>"btCancelar"));
						
		$form->CloseFieldset ();
		
	unset ($form);

	

	
	
	
	unset($lote);
	unset($loteFluxo);
	unset($loteProc);
	unset($caEvXWPes);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>