<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Pessoa - Informaчѕes Bсsicas","Cadastro de Pessoa - Informaчѕes Bсsicas",array('ADM','CASENHA','CASENHAGER'),$user);
	
	
	include("../engine/Db.class.php");
	//include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoa.class.php");
	
	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	//$nav = new Navigation($user, $app);

	
	$wpessoa = new WPessoa($dbOracle);	
	
	$view = new ViewBox($app->title,$app->description);	

	$aPessoa = $dbData->Row($dbData->Get("select id,nome from wpessoa where cpf='".$_POST[p_CPF]."' or RGRNE='".$_POST[p_RGRNE]."'"));
	$v_WPessoa_Id = $aPessoa[ID]; 
	if (empty($aPessoa[ID]) && $_POST[p_CPF] != '')
	{
		$aCPF = $dbData->Row($dbData->Get("select O_gnCPF($_POST[p_CPF]) as cpfvalido from dual"));
		if ($aCPF["CPFVALIDO"] == 0)
		{
			$view->Dialog('E', 'Cadastro', 'CPF Invсlido');
		}
		else 
		{
			$wpessoa->IUD($_POST);
			$v_WPessoa_Id = $dbData->GetInsertedId("wpessoa_id");
		}
	}
	else 
	{
		if ($aPessoa[ID] != '')
			$view->Dialog('I', 'Cadastro', 'Essa documentaчуo jс estс cadastrada em nome de '. $aPessoa["NOME"]);
	}
	
	
	//Isso aqui serс retirado da pсgina, ou melhorado, pois щ utilizado exclusivamente pelo ProUni
	//Ao cadastrar o candidato щ inserido tambщm nas tabelas CAEvXWPes e CAWPEsDet	
	if ($_POST[p_O_Option] == 'insert' && $v_WPessoa_Id != '')
	{
		require_once("../model/CAEvXWPes.class.php");
		require_once("../model/CAWPesDet.class.php");
		
		$caEvXWPes = new CAEvXWPes($dbOracle);
		$caWPesDet = new CAWPesDet($dbOracle);
								
		$arIns["p_O_Option"] 	= "insert";
		$arIns["WPessoa_Id"] 	= $v_WPessoa_Id;
		$arIns["CAEvento_Id"] 	= $_COOKIE["p_CAEvento_Id"];
		$caEvXWPes->IUD($arIns);

		
		$aSenhaTi = $dbData->Row($dbData->Get("select casenhati.id from casenhati, caassunto where casenhati.caassunto_id = caassunto.id and casenhati.descricao = 'Normal' and caevento_id = '".$_COOKIE["p_CAEvento_Id"]."'"));
		
		$arIns = array();
		$arIns["p_O_Option"] 	= "insert";
		$arIns["Valor"] 		= $aSenhaTi["ID"];
		$arIns["Nome"] 			= "CASENHATI_ID";
		$arIns["CAEvXWPes_Id"]	= $dbData->GetInsertedId("caevxwpes_id");
		$caWPesDet->IUD($arIns);
		
	}
	//Atщ aqui
	
	$view->Header();

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','hidden',array("name"=>'p_WPessoa_Id'));
			
			$form->Input($wpessoa->GetLabel('Nome'),'text',	array("name"=>'p_Nome', "value"=>$_POST["p_Nome"], "class"=>"size50", "required"=>'1','maxlength'=>$wpessoa->GetLength('Nome')));
			$form->Input($wpessoa->GetLabel('RGRNE'),'text',array("name"=>'p_RGRNE', "value"=>$_POST["p_RGRNE"], "class"=>"size20", "required"=>'1','maxlength'=>$wpessoa->GetLength('RGRNE')));
			$form->Input($wpessoa->GetLabel('CPF'),'text',	array("name"=>'p_CPF', "value"=>$_POST["p_CPF"], "class"=>"size20", "required"=>'1','maxlength'=>$wpessoa->GetLength('CPF')));
			$form->Input($wpessoa->GetLabel('FoneRes'),'text',array("name"=>'p_FoneRes', "value"=>$_POST["p_FoneRes"], "class"=>"size20 fone",'maxlength'=>$wpessoa->GetLength('FoneRes')));
			$form->Input($wpessoa->GetLabel('FoneCel'),'text',array("name"=>'p_FoneCel', "value"=>$_POST["p_FoneCel"], "class"=>"size20 fone",'maxlength'=>$wpessoa->GetLength('FoneCel')));
			$form->Input($wpessoa->GetLabel('Email1'),'text',array("name"=>'p_email1', "value"=>$_POST["p_email1"], "class"=>"size50",'maxlength'=>$wpessoa->GetLength('Email1')));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	
	unset ($form);
	unset($view);
	unset($wpessoa);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>