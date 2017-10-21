<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Alteraзгo do Tipo de Transaзгo - Recebimentos com Cartгo de Crйdito e Dйbito","Alteraзгo do Tipo de Transaзгo - Recebimentos com Cartгo de Crйdito e Dйbito",array('ADM','CPD','CONTABILIDADE'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/PostoBanc.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	$postoBanc 	= new PostoBanc($dbOracle);
	
	
	$view->Header($user);
	
	
	echo $view->JS("
			
				$(document).on('keydown', disableF5);
			
				$('.inputSenha').focus();
			
				$('.inputSenha').blur(function(){
					if($(this).val() !='')
						$('#f1').submit();
					
			
				})
			
			
			
			");
	
	
	$form = new Form();
	
		$form->Fieldset("Alteraзгo do Tipo de Transaзгo");
	
		$form->Input("Nъmero da Transaзгo","text",array("name"=>"p_PostoBanc_Num","class"=>"size10","required"=>0,"class"=>"onlyNumber"));

	$form->CloseFieldset ();
		
	unset ($form);
		

	if ($_POST[p_PostoBanc_Id] != '' && $_POST[btAlterar] == 'Alterar')
	{ 

		$vOk = 0;
		if (substr($_POST[p_Transacao],15,2) == 'VC')
		{
			$vTransacao = substr(str_replace('VC','VD',$_POST[p_Transacao]),0,-3);
			$vOk = 1; 
		}
		if (substr($_POST["p_Transacao"],15,2) == 'VD')
		{
			$vTransacao = str_replace('VD','VC',$_POST["p_Transacao"]).'_'.$_POST["p_QtdeParcelas"];
			$vOk = 1;
		}
		if ($vOk == '1')
		{
			$arUpd["p_O_Option"] 	= "update";
			$arUpd["Transacao"] 	= $vTransacao;
			$arUpd["PostoBanc_Id"]	= $_POST[p_PostoBanc_Id];
			
			$postoBanc->IUD($arUpd);
		}
		
	}
	
	if($_POST[p_PostoBanc_Num] != '')
	{	
		$p_PostoBanc_Id = $_POST[p_PostoBanc_Num]+86200000000000;
		$aPosto = $postoBanc->GetValores($p_PostoBanc_Id);
		
		if ($aPosto[TIPO] == 'bol')
		{
			$view->Dialog('I','Cartгo Crйdito/Dйbito','Esse nъmero nгo й de uma transaзгo de pagamento, por favor verifique.');
		}
		if ($aPosto[TIPO] == 'pag')
		{
			$form = new Form();
			
			$form->Fieldset("Alteraзгo do Tipo de Transaзгo");
				
			$form->Input("","hidden",array("name"=>"p_PostoBanc_Id","value"=>$p_PostoBanc_Id));
			$form->Input("","hidden",array("name"=>"p_Transacao","value"=>$aPosto["TRANSACAO"]));
			$form->Input("Data","label",array("value"=>$aPosto["DT"]));
			$form->Input("Nъmero","label",array("value"=>$aPosto["NUMTRANSACAO"]));
			$form->Input("Transaзгo","label",array("value"=>$aPosto["TPTRANS"]));
			$form->Input("Cartгo","label",array("value"=>$aPosto["NUMDOC"]));
			$form->Input("Valor","label",array("value"=>_FormatValor(str_replace(',','.',$aPosto["VALOR"])*-1)));
			$form->Input("Qtde de Parcelas","text",array("name"=>"p_QtdeParcelas","class"=>"size10","value"=>_NVL($aPosto["QTDEPARC"],1)));
			
			$form->Button("submit",array("value"=>"Alterar","name"=>"btAlterar"));
			
		}
		
		
		
	}	
	
	
	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>