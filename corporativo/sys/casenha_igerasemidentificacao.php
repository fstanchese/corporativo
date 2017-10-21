<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Gerar Senha - Controle de Atendimento","Gerar Senha - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenhaRegra.class.php");
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$caEvento	= new CAEvento($dbOracle);	
	
	$acaEvento = $caEvento->GetIdInfo($_COOKIE["p_CAEvento_Id"]);
	
	$view 		= new ViewPage($app->title,$app->description);
	$view->Header($user);

	
	if(!isset($_COOKIE["p_CAEvento_Id"]))
	{
		echo $view->Dialog('E', 'Evento Não Encontrado', 'O evento precisa ser selecionado nas configurações para essa página funcionar corretamente', 'false', 'false', 'false', 'false');
		
		die();
	}
	
	
	if ($acaEvento["SENHANOMINAL"] == 'on')
	{
		echo $view->Dialog('E', 'Evento Incorreto', 'Evento selecionado faz uso de senhas nominais, <a href=casenha_igeracao.php>clique aqui</a> para gerar a senha', 'false', 'false', 'false', 'false');
		die();
	}
	
	
	echo $view->JS("$(document).on('keydown', disableF5); $(document).on('click','.insert',function(){ $(this).hide(1);});");
	
	if($_POST[p_O_Option] == 'insert')
	{
		
		if($_POST[p_Preferencial] == "") $_POST[p_Preferencial] = 0;
	
		$caRegra 	= new CASenhaRegra($dbOracle);
		$caSenha 	= new CASenha($dbOracle);
	
		
		$arSenhas = $caRegra->GetSenhasEvento($_COOKIE["p_CAEvento_Id"]);

		$dbData->Get("select casenhati.id from casenhati,caassunto where casenhati.caassunto_id=caassunto.id and caassunto.caevento_id='$_COOKIE[p_CAEvento_Id]'");
		
		$aSenhaTi = $dbData->Row();
		$vSenhaTi = $aSenhaTi[ID];
		
	
		$arInsert['CASenhaRegra_Id'] 	= $arSenhas[0][$_POST[p_Preferencial]][$vSenhaTi]; 
		$arInsert['Descricao'] 			= '-';
		
		//Proximo numero da senha
		$arInsert['Numero'] 			= $caSenha->GetNextSenhaNumero($arSenhas[0][$_POST[p_Preferencial]][$vSenhaTi]);
		$arInsert['p_O_Option']			= 'insert';
		
		$caSenha->IUD($arInsert);
		$casenha_id = $dbData->GetInsertedId("casenha_id");
		
		echo $view->JS("
					$('.insert').hide(1);
				
					$.colorbox(
						{
							href:'casenha_isenha.php?casenha_id="._UrlEncrypt($casenha_id)."',
							width:'500px', 
							height:'450px',
							iframe: true,
							overlayClose:false,
							onClosed:function() { location.href='casenha_igerasemidentificacao.php'; }
						});");
		
		die();
	}
	
	
	//Instanciar formulário
	$form = new Form();

		$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
		

			$form->Input("Senha Preferencial?",'checkbox',array("name"=>"p_Preferencial","value"=>"1"));
		
			
			$form->Button("submit",array("class"=>"insert","value"=>"Gerar Senha"));
			
	$form->CloseFieldset ();
	unset ($form);
	
	
	
	
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>