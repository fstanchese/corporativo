<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Inclusão de Informações em Ocorrências Abertas","Inclusão de Informações em Ocorrências Abertas",array('ADM','CPD'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/WOcorr.class.php");
	include("../model/WOcorrAssInf.class.php");
	include("../model/WOcorrInf.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	
	
	$wocorr 		= new WOcorr($dbOracle);
	$wocorrAssInf 	= new WOcorrassInf($dbOracle);
	$wocorrInf		= new WOcorrinf($dbOracle);
		
	
	if($_POST[p_O_Option] == 'insert')
	{
		
		if($_POST[p_Preferencial] == "") $_POST[p_Preferencial] = 0;
	
		$caRegra 	= new CASenhaRegra($dbOracle);
		$caWPes 	= new CAWPesDet($dbOracle);
		$caSenha 	= new CASenha($dbOracle);
	
		$p_CAEvento_Id 	= $_COOKIE["p_CAEvento_Id"];
		
		$arSenhas = $caRegra->GetSenhasEvento($p_CAEvento_Id);
	
		//pegar o tipo de bolsa da pessoa
		$senhaWPes = $caWPes->GetTipoBolsa($_POST[p_WPessoa_Id],$p_CAEvento_Id);
	
		
		//verificar se ja foi chamada
	//	$senhaRetorno = $caSenha->VerificaUsuarioChamado($_POST[p_WPessoa_Id],$senhaWPes);
	
		$arInsert['CASenhaRegra_Id'] 	= $arSenhas[$senhaRetorno][$_POST[p_Preferencial]][$senhaWPes]; 
		$arInsert['WPessoa_Id'] 		= $_POST[p_WPessoa_Id];
		$arInsert['Descricao'] 			= '-';
		
		//Proximo numero da senha
		$arInsert['Numero'] 			= $caSenha->GetNextSenhaNumero($arSenhas[$senhaRetorno][$_POST[p_Preferencial]][$senhaWPes]);
		$arInsert['p_O_Option']			= 'insert';
		
		
		$caSenha->IUD($arInsert);
		$casenha_id = $dbData->GetInsertedId("casenha_id");
		
	}
	
	
	$view 		= new ViewPage($app->title,$app->description);
	
	$view->Header($user);
	
	
	echo $view->JS(	"
				$('#info').change (function() {
					if ($('#info option:selected').val() != '')
					{

						$('#mensagem').load('../ajax/wocorr.ajax.php?vTipo=IncAtributo&id='+$('#info option:selected').val() );
			
					}
				});
			"
		);
	

	$form = new Form();

		$form->Fieldset("Consultar Ocorrência");
			
			$form->Input("Número da Ocorrência",'text',	array("name"=>'p_WOcorr_Codigo', "class"=>"size10", "required"=>'1'));
		
			$form->Button ("submit", array ("value"=>"Consultar"));
		
		$form->CloseFieldset ();
	unset ($form);

	
	
	if($_POST[p_WOcorr_Codigo] != "")
	{

		$aWOcorr = $wocorr->GetIdInfo('340000'.substr($_POST["p_WOcorr_Codigo"],0,7));
		$p_WOcorrAss_Id = $aWOcorr['WOCORRASS_ID'];
		
		$form2 = new Form();
		
		$form2->Fieldset("Informações da Ocorrência");
			$form2->Input("Número da Ocorrência",'label',array($wocorr->GetNumero($aWOcorr[ID])));
			$form2->Input("Data",'label',array($aWOcorr[DATAHORA]));
			$form2->Input("Usuário",'label',array(strtolower($aWOcorr[US])));
			$form2->Input("Aluno",'label',array($aWOcorr[WPESSOA_NOME]));
			$form2->Input("Assunto",'label',array($aWOcorr[WOCORRASS_NOME]));
			$form2->Input('Informação','select',array("name"=>'p_WOcorrAssInf_Id',"value"=>array(),"id"=>"info", "option"=>$wocorrAssInf->Calculate('Assunto',array("p_WOcorrAss_Id"=>$aWOcorr['WOCORRASS_ID']))));
			
			echo $view->Div(array("name"=>"mensagem","id"=>"mensagem"));
			echo $view->CloseDiv();
			
		$form2->CloseFieldset ();
		
		
		unset($form2);
		
		
		$dbData->Get($wocorrInf->Query("qWOcorr",array("p_WOcorr_Id"=>'340000'.substr($_POST["p_WOcorr_Codigo"],0,7))));
		
		while($row = $dbData->Row())
		{
			echo $row["INFORMACAO_RECOGNIZE"] . ': ' . $row["CONTEUDO_RECOGNIZE"] . '<br>';
		}
		
	}

	
	
	
	
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>