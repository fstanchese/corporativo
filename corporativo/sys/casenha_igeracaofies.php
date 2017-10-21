<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Gerar Senha FIES - Controle de Atendimento","Gerar Senha FIES - Controle de Atendimento",array('ADM','CASENHA','MATRICULA','MATRICULAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/DataGrid.class.php");
		
	include("../model/WPessoa.class.php");
	
	
	include("../model/CASenhaRegra.class.php");
	include("../model/CAWPesDet.class.php");
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	include("../model/CASenhaTi.class.php");



	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	
	$caEvento 	= new CAEvento($dbOracle);	
	$wpessoa 	= new WPessoa($dbOracle);
	
	$caRegra 	= new CASenhaRegra($dbOracle);
	$caSenhaTi	= new CASenhaTi($dbOracle);	
	
	$acaEvento = $caEvento->GetIdInfo($_COOKIE["p_CAEvento_Id"]);
	
	$view 		= new ViewPage($app->title,$app->description);
	
	$view->Header($user);
	
	

	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
		
		die();
	}
	
		
	if ($acaEvento["SENHANOMINAL"] != 'on')
	{
		$view->Dialog("E", "Evento Incorreto", "Evento selecionado não contempla o uso de Senhas Nominais, <a href=casenha_igerasemidentificacao.php>clique aqui</a> para gerar a senha.", 'false', 'false', 'false', 'false');
		
		die();
	}
	
	
	
	echo $view->JS("
			
			$('.openColorBoxSenha').colorbox({
				iframe:true, 
				width:'500px', 
				height:'450px',
			 	escKey:false,
    			onClosed:function(){
					location.href='casenha_igeracaofies.php'
				}
			});
			
			");
	
	if($_POST[p_O_Option] == 'insert')
	{
		
		if($_POST[p_Preferencial] == "") $_POST[p_Preferencial] = 0;
	
		
		$caWPes 	= new CAWPesDet($dbOracle);
		$caSenha 	= new CASenha($dbOracle);
	
		
		$arSenhas = $caRegra->GetSenhasEvento($_COOKIE["p_CAEvento_Id"],$_POST[p_CASenhaTi_Id]);

		//pegar o tipo de bolsa da pessoa
		//$senhaWPes = $caWPes->GetTipoBolsa($_POST[p_WPessoa_Id],$_COOKIE["p_CAEvento_Id"]);

				
		//verificar se ja foi chamada
		$senhaRetorno = $caSenha->VerificaUsuarioChamado($_POST[p_WPessoa_Id],$_COOKIE["p_CAEvento_Id"]);
		
		
		$arInsert['CASenhaRegra_Id'] 	= $arSenhas[0][$_POST[p_Preferencial]][$_POST[p_CASenhaTi_Id]];  
		$arInsert['WPessoa_Id'] 		= $_POST[p_WPessoa_Id];
		$arInsert['Descricao'] 			= '-';
		
		
		//Proximo numero da senha
		$arInsert['Numero'] 			= $caSenha->GetNextSenhaNumero($arSenhas[$senhaRetorno][$_POST[p_Preferencial]][$_POST[p_CASenhaTi_Id]]);
		

		$arInsert['p_O_Option']			= 'insert';
		
		
		
		$caSenha->IUD($arInsert);
		$casenha_id = $dbData->GetInsertedId("casenha_id");
		
		echo $view->Js("$.colorbox({href:'casenha_isenha.php?casenha_id="._UrlEncrypt($casenha_id)."',width:'500px', height:'450px',iframe: true,escKey:false,onClosed:function(){location.href='casenha_igeracaofies.php'}});");
	
		
	}

	
	
		//Instanciar formulário
		$form = new Form();

			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
			
				$form->Input("Nome",'autocomplete',	array("execute"=>"WPessoa.AutoCompleteTodos","name"=>'p_WPessoa_Id', "class"=>"size70", "required"=>'1',"label"=>""));
				
				$form->Input("","label", $view->Link("Incluir candidato",array("href"=>"../box/wpessoa_iiudbasico.php","class"=>"openColorBox")) );				
				
				$form->Button ("submit", array ("value"=>"Consultar"));
			
			$form->CloseFieldset ();
		unset ($form);

	
	
		if($_POST[p_WPessoa_Id] != "")
		{
			$form = new Form(array("name"=>"f2"));
			
				$form->Input("","hidden",array("name"=>"p_WPessoa_Id","value"=>$_POST[p_WPessoa_Id]));
				$form->Fieldset("Informações");
				$aPessoa = $dbData->Row($dbData->Get("SELECT nome, cpf FROM wpessoa WHERE id = '".$_POST[p_WPessoa_Id]."'"));
			
				$form->Input("CPF",'label',array($aPessoa[CPF]));
				$form->Input("Nome",'label',array($aPessoa[NOME]));
				
				$form->Input("Preferencial",'checkbox',array("name"=>"p_Preferencial","value"=>"1"));

				$form->Input("Tipo de Atendimento",'select',array("required"=>"1","name"=>"p_CASenhaTi_Id","option"=>$caSenhaTi->Calculate("Evento",array("p_CAEvento_Id"=>$_COOKIE["p_CAEvento_Id"])),"value"=>$_POST["p_CAMesa_Id"]));
				
				$form->Button("submit",array("class"=>"insert","value"=>"Gerar Senha"));
				
				$form->CloseFieldset ();
			unset ($form);
			
			
			
			$todasSenhas 	= $caRegra->GetSenhaRegraByEvento($_COOKIE["p_CAEvento_Id"]);
			
	
			//Verifica se candidato ProUni já possui processo em lote
			$aLote = $dbData->Row($dbData->Get("select lotefluxo.* from lotefluxo,caevxwpes where lotefluxo.caevxwpes_id = caevxwpes.id and wpessoa_id='".$_POST[p_WPessoa_Id]."' and caevento_id in (select id from caevento where senhanominal='on' and sysdate between dtinicio and dttermino)"));
						
			if ($aLote[ID] != '')
			{
				$view->Dialog("I", "Atenção", "Candidato (a) já entregou processo para análise, portanto, deverá aguardar o contato da equipe de conferência para efetivar sua matrícula e/ou entregar documentos pendentes.");
			}
			
			$dbData->Get("SELECT casenha.id, sigla, casenha.numero, trunc(casenha.dt) as dt FROM casenha, casenharegra WHERE casenha.casenharegra_id = casenharegra.id AND casenharegra_id in (".implode(',',$todasSenhas[Id]).") AND casenha.wpessoa_id = '".$_POST[p_WPessoa_Id]."' ");
			
			if($dbData->Count () > 0)
			{
			
				$grid = new DataGrid(array("Senha","Data"," "));
			
				while($row = $dbData->Row ())
				{
			
					$grid->Content($row[SIGLA].$row[NUMERO]);
					$grid->Content($row[DT]);
					$grid->Content($view->Link("2ª via",array("href"=>"casenha_isenha.php?via2=1&casenha_id="._UrlEncrypt($row[ID]),"class"=>"openColorBoxSenha")));
				}
			}
			
			unset($grid);
			
		}
	
	
	
	
	
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>