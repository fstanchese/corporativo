<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Impressão de Crachá para Prestador de Serviços","Impressão de Crachá para Prestador de Serviços",array('ADM','CPD','RH'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	
	
	
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);
	$view 			= new ViewPage($app->title,$app->description);
	
	if($_POST[p_O_Option] == 'insert')
	{

		include("../model/WPessoaCracha.class.php");
		
		$wpessoacracha = new WPessoaCracha($dbOracle);
		
		$dadosCracha = $dbData->Row($dbData->Get("SELECT wpesxemp.dtinicio, wpessoa.codigofunc as codigo FROM wpessoa, wpesxemp WHERE wpessoa.id = wpesxemp.wpessoa_id AND wpessoa_id = '".$_POST[p_WPessoa_Id]."' AND empresa_id = '".$_POST[p_Empresa_Id]."'"));
		
		$arIns[p_O_Option] 		= 'insert';
		$arIns[p_WPessoa_Id] 	= $_POST[p_WPessoa_Id];
		$arIns[p_Codigo]     	= $dadosCracha[CODIGO];
		$arIns[p_Empresa_Id] 	= $_POST[p_Empresa_Id];
		$arIns[p_DtInicio]   	= $dadosCracha[DTINICIO];
		$arIns[p_State_Id]   	= '3000000029001';
		
		$wpessoacracha->IUD($arIns);
		
		$cracha_id = $dbData->GetInsertedId("wpessoacracha_id");
		
		echo $view->Js("$.colorbox({href:'wpessoacracha_iprestadorimpressao.php?cracha_id="._UrlEncrypt($cracha_id)."',width:'500px', height:'480px',iframe: true,escKey:false,onClosed:function(){location.href='wpessoacracha_iprestador.php'}});");
		
	}
	
	
	$view->Header($user,$nav);
	
	
		echo $view->JS("
				
					$(document).on('click','.autoComplete li',function(){
						
						$.post('../ajax/wpessoacracha.ajax.php?p_Action=getEmpresas&prestador_id='+$('#p_WPessoa_Id').val(),function(e){
				
							$('#p_Empresa_Id').empty().append(e);			
				
						});
				
					})
				
				");
		
		
		

		$form = new Form();

		$form->Fieldset("Impressão de Crachá para Prestador de Serviços");
		
			$form->Input('Funcionário','autocomplete',array("execute"=>"WPessoa.AutoCompletePrestador","name"=>'p_WPessoa_Id', "class"=>"size70", "required"=>'1'));
			$form->Input('Empresa','select',array("name"=>'p_Empresa_Id', "required"=>'1',"option"=>array(""=>"Selecione a pessoa")));
			
			
			$form->Button("submit",array("class"=>"insert","value"=>"Imprimir Crachá"));
		//fecha formulário
		unset ($form);
		
	
	unset($caEvento);
	unset($caMesa);
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>