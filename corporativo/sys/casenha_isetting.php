<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Setting - Controle de Atendimento","Setting - Controle de Atendimento",array('ADM','CPD','SUPORTE'),$user);
	
	if($_POST[limpar])
	{
	
		setcookie("p_CAEvento_Id", "", time()-3600, '/');
		setcookie("p_CAMesa_Id", "", time()-3600, '/');
		setcookie("p_MostraNome_Id", "", time()-3600, '/');
		setcookie("p_MostraInfAd_Id", "", time()-3600, '/');
		
		header("Location:casenha_isetting.php");
	
	}
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/CAEvento.class.php");
	include("../model/CAMesa.class.php");
	include("../model/SimNao.class.php");

	$dbOracle 	= new Db ($user);
	$view 	 	= new ViewPage($app->title,$app->description);
	$dbData 	= new DbData ($dbOracle);

	$nav 		= new Navigation($user, $app, $dbData);
	$caEvento 	= new CAEvento($dbOracle);
	$caMesa		= new CAMesa($dbOracle);
	$simNao		= new SimNao($dbOracle);
	

	$view->Header($user,$nav);

	$p_CAEvento_Id = 1;
	if (isset($_POST["p_CAEvento_Id"]))
		$p_CAEvento_Id = $_POST["p_CAEvento_Id"];
	
	$sEvento 	= "Não Existe Evento Selecionado";		
	if (isset($_COOKIE["p_CAEvento_Id"]))
	{
		$sEvento 	= $caEvento->Recognize($_COOKIE["p_CAEvento_Id"]);		
	}
	$sMesa 	= "Não Existe Mesa Selecionada";
	if (isset($_COOKIE["p_CAMesa_Id"]))
	{
		$sMesa 	= $caMesa->Recognize($_COOKIE["p_CAMesa_Id"]);
	}
	$sMostraNomeSenha 	= "";
	if (isset($_COOKIE["p_MostraNome_Id"]))
	{
		$sNomeSenha	= $simNao->Recognize($_COOKIE["p_MostraNome_Id"]);
	}
	$sMostraInf 	= "";
	if (isset($_COOKIE["p_MostraInfAd_Id"]))
	{
		$sMostraInf	= $simNao->Recognize($_COOKIE["p_MostraInfAd_Id"]);
	}
	
	
	//Instanciar formulário
	$form = new Form();

		$form->Fieldset("Limpar Cookies");
			$form->Button("submit",array("name"=>"limpar","value"=>"Limpar todos os Cookies"));
		$form->CloseFieldset ();
			
		$form->Fieldset("Setting");
		
			$form->Input("Evento",'select',array("name"=>"p_CAEvento_Id","option"=>$caEvento->Calculate("Data"),"onChange"=>"setCookie('p_CAEvento_Id',this.value,90000);$('#f1').submit();","value"=>$_POST["p_CAEvento_Id"]));
			$form->Input("Mesa",'select',array("name"=>"p_CAMesa_Id","option"=>$caMesa->Calculate("Geral",array("p_CAEvento_Id"=>$p_CAEvento_Id)),"onChange"=>"setCookie('p_CAMesa_Id',this.value,90000);$('#f1').submit();","value"=>$_POST["p_CAMesa_Id"]));
			
			$form->Input("Mostrar Nome na Senha?",'select',array("name"=>"p_MostraNome_Id","option"=>$simNao->Calculate(),"onChange"=>"setCookie('p_MostraNome_Id',this.value,45);$('#f1').submit();","value"=>$_POST["p_MostraNome_Id"]));
			$form->Input("Mostrar Informações Adicionais?",'select',array("name"=>"p_MostraInfAd_Id","option"=>$simNao->Calculate(),"onChange"=>"setCookie('p_MostraInfAd_Id',this.value,45);$('#f1').submit();","value"=>$_POST["p_MostraInfAd_Id"]));

			$form->Input("Evento Gravado no Cookie",'label',$sEvento);
			$form->Input("Mesa Gravada no Cookie",'label',$sMesa);
			$form->Input("Mostrar Nome na Senha?",'label',$sNomeSenha);
			$form->Input("Mostrar Informações Adicionais?",'label',$sMostraInf);
			
			
	
		$form->CloseFieldset ();

		
	//fecha formulário
	unset ($form);
	
	unset($campus);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>