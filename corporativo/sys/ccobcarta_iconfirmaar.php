<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Carta de Cobrança - Cadastro de Aviso de Recebimento","Carta de Cobrança - Cadastro de Aviso de Recebimento",array('ADM','CPD','CARTACOBRANCA'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");
	
	include("../model/CCobCarta.class.php");
	include("../model/WPessoa.class.php");
		
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);


	$ccobCarta 	= new CCobCarta($dbOracle);
	$wpessoa	= new WPessoa($dbOracle);	
		
	$view 		= new ViewPage($app->title,$app->description);
	
	
	$view->Header($user);
	
	//echo $ccobCarta->GetCartaInfo(208600000017309);
	//die();
	
	echo $view->JS("
		$(document).on('change','#p_CCobCarta_Id',function()
		{
			if ($(this).val() != '')
			{
				$.ajax ({
					type: 'POST',
					url: '../ajax/ccob.ajax.php',
		 			data: 'p_Action=showDetCarta&vPar='+$(this).val(),
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
	
	");
	
	
	if ($_POST["btCadastrar"] == "Cadastrar")
	{
		if ($_POST["p_CCobCarta_Id"] != '' && $_POST["p_DtRecebimento"] != '')
		{
			$aArrUpd = array("p_O_Option"=>"update","p_CCobCarta_Id"=>$_POST["p_CCobCarta_Id"],"p_DtAvisoRec"=>$_POST["p_DtRecebimento"]);
			
			$ccobCarta->IUD($aArrUpd);			
		}
		else
		{
			$view->Dialog('E', 'Cartas de Cobrança', 'Você não preeencheu todas as informações antes de Cadastrar.');
		}
		
	}
	

	$form = new Form();

		$form->Fieldset("Aluno");
			
			$form->Input("Aluno",'autocomplete',array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_WPessoa_Id', "class"=>"size70"));
		
			$form->Button ("submit", array ("value"=>"Selecionar"));
			
		$form->CloseFieldset ();

		if ($_POST["p_WPessoa_Id"] != '')
		{
						
			$aCartas = $dbData->row($dbData->Get($ccobCarta->query("qPessoa",array("p_WPessoa_Id"=>$_POST["p_WPessoa_Id"]))));
			
			if (is_array($aCartas))
			{
				echo $view->div(array("align"=>"center")) . $wpessoa->GetInfoAluno($_POST["p_WPessoa_Id"]) . $view->CloseDiv();

				$form->Fieldset("Cartas");
				$form->Input('Cartas','select', array("name"=>'p_CCobCarta_Id', "id"=>"p_CCobCarta_Id" , "option"=>$ccobCarta->Calculate("Pessoa",array("p_WPessoa_Id"=>$_POST["p_WPessoa_Id"]))));
				
				$form->Input('','label',$view->div(array("id"=>"showDet")) . $view->CloseDiv());				
				
				
				$form->Input("Data de Recebimento","date",array("name"=>"p_DtRecebimento" ));
				
				$form->Button ("submit", array ("name"=>"btCadastrar","value"=>"Cadastrar"));
				$form->CloseFieldset();
				
			}
			else 
			{
				$view->Dialog('I', 'Cartas de Cobrança', 'O aluno(a) '. $wpessoa->Recognize($_POST["p_WPessoa_Id"]) .' não possui carta(s) de cobrança gerada(s)');
			}
			
		}
		
		
	unset($form);
		
	
	unset($ccobCarta);	
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>