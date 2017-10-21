<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();	
	$app = new App("Cadastro de Empresas","Cadastro de Empresas",array('ADM','CPD'),$user);
	
	include("../engine/View.class.php");
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Empresa.class.php");
	
		
	
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	
	$empresa 	= new Empresa ($dbOracle);
	
	
	if($_GET[p_Empresa_Id] != '') 
	{
		
		$dbData->Get($empresa->Query("qId",array("p_Empresa_Id"=>$_GET[p_Empresa_Id])));
		$dadosSelect = $dbData->Row();

	}
	
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Header($user);
	
	$empresa->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',		array("name"=>'Empresa_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Empresa','isel',array("name"=>"p_Empresa","href"=>"../box/empresa_isel.php","submit"=>"true","value"=>$dadosSelect[ID],"label"=>$dadosSelect[FANTASIA]));
	$form->CloseFieldset();
	$form->Fieldset();
	
	$form->Input('CNPJ','text',	array("name"=>'p_CGC','value'=>$dadosSelect[CGC],"class"=>"size20","label"=>$dadosSelect[CGC],"required"=>1));
	$form->Input('Razão Social','text',		array("name"=>'p_Razao',"placeholder"=>"Razão Social","required"=>'1',"value"=>$dadosSelect[RAZAO],"class"=>"size60"));
	$form->Input('Nome Fantasia','text',	array("name"=>'p_Fantasia',"required"=>'1',"value"=>$dadosSelect[FANTASIA],"class"=>"size60"));
	$form->Input('Inscrição Estadual','text',	array("name"=>'p_IE',"value"=>$dadosSelect[IE],"class"=>"size20"));
	$form->Input('CCM','text',	array("name"=>'p_CCM',"value"=>$dadosSelect[CCM],"class"=>"size20"));
	$form->Input('Telefone 1','text',	array("name"=>'p_Fone',"value"=>$dadosSelect[FONE],"class"=>"size20"));
	$form->Input('Telefone 2','text',	array("name"=>'p_Fone2',"value"=>$dadosSelect[FONE2],"class"=>"size20"));
	$form->Input('Fax','text',	array("name"=>'p_FoneFax',"value"=>$dadosSelect[FONEFAX],"class"=>"size20"));
	$form->Input('Contato','text',	array("name"=>'p_Contato',"value"=>$dadosSelect[CONTATO],"class"=>"size60"));
	$form->Input('Endereço','isel',	array("name"=>'p_Lograd',"href"=>"../box/lograd_isel.php","value"=>$dadosSelect[LOGRAD_ID],"label"=>$dadosSelect[LOGRAD_ID_R]));
	$form->Input('Número/Complemento','text',	array("name"=>'p_EnderNum',"value"=>$dadosSelect[ENDERNUM],"class"=>"size20"));
	$form->Input('e-mail','text',	array("name"=>'p_Email',"value"=>$dadosSelect[EMAIL],"class"=>"size80"));
	$form->Input('site','text',	array("name"=>'p_Site',"value"=>$dadosSelect[SITE],"class"=>"size80"));
	$form->Input('Escritório de Cobrança - USJT','checkbox',	array("name"=>'p_CobrancaUSJT',"value"=>$dadosSelect[COBRANCAUSJT]));
	
	

	$form->CloseFieldset();

	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();
	
	unset($form);

	$empresa->Pagination ();
	
	
	unset($empresa);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>