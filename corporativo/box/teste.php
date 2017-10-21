<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Teste - Auto Atendimento - SAA","Teste - Auto Atendimento - SAA",array('ADM'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
		
	include("../model/WPessoa.class.php");

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$wpessoa	= new WPessoa($dbOracle);	
	
	$view 		= new ViewBox('',$app->description);
	$view->Header($user);

	
	
	echo $view->JS(" 
			
				$(document).on('click','.boxItem',function()
				{
					$('input[name=p_SenhaTi_Id]').val($(this).attr('id'));
					$('input[name=p_O_Option]').val('insert');
					$('#f1').submit();
				});
			
			");
	
	
	if ($_POST[Prosseguir] == 'prosseguir')
	{
		$InfPessoa = $wpessoa->teste($_POST[p_Codigo], $_POST[p_Senha]);

		if ($InfPessoa != '')
		{
			echo $InfPessoa;
		}
		else
		{
			$view->Dialog('A', 'Login', 'Login e senha inválidos.');
			echo "<script>window.setTimeout( function () { location.href='teste.php'; },3000);</script>";
		}
	}
	else
	{
		$form = new Form();
			$form->Fieldset('Digite o usuário e senha');
				$form->Input('RA','text',array("name"=>"p_Codigo"));
				$form->Input('Senha','password',array("name"=>"p_Senha"));
				
				$form->Button('submit',array("name"=>"Prosseguir","value"=>"prosseguir"));
			$form->CloseFieldset();
		unset($form);
		
	}

	

/*
	$aTipoSenha = $caSenhaTi->GetSenhaTiByEvento($_COOKIE[p_CAEvento_Id]);
	
	$dbData->Get("SELECT casenhati.descricao, casenhati.id FROM casenhati, caassunto WHERE casenhati.ativo = 'on' and casenhati.caassunto_id = caassunto.id AND caassunto.caevento_id = '".$_COOKIE[p_CAEvento_Id]."' ORDER BY id");

	if ($dbData->Count() > 3)
	{
		$vPerc = "45%";
	}
	else
	{
		$vPerc = "95%"; 
	}
	
	$arCor = array('#084e8a','#0a73cb','#449de9','#0d2539','#00284a','#63b6fc','#005e12','#08c32c','#5edb76','#468e54','#1a4622','#006295');
	$count = 0;
	while ($row = $dbData->Row())
	{
		
		echo $view->Div(array("id"=>$row[ID],"class"=>"boxItem","style"=>"margin:1%;background:".$arCor[$count++].";width:$vPerc;align:center;","title"=>$row[DESCRICAO])).
		$view->Strong($row[DESCRICAO],array("style"=>"color:#fff;font-size:40px;")).
		$view->CloseDiv();
		
		//echo $view->Br().$view->Br().$view->Br();
		
	}
*/
		
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>