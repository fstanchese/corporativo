<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Alteraчуo das Informaчѕes de Carta de Cobranчa","Alteraчуo das Informaчѕes de Carta de Cobranчa",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	
	include("../engine/Db.class.php");
	//include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/CCobCarta.class.php");
	include("../model/State.class.php");
	
	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	//$nav = new Navigation($user, $app);

	if ($_GET[p_CCobCarta_Id] != '')
	{
		$p_CCobCarta_Id = _Decrypt($_REQUEST[p_CCobCarta_Id]);
	}
	
	$ccobCarta 		= new CCobCarta($dbOracle);
	$state			= new State($dbOracle);
	
	
	$view = new ViewBox($app->title,$app->description);	

	$view->Header();

	if ($_POST["btUpd"] == "Alterar" && $_REQUEST[p_CCobCarta_Id] != '')
	{
		$ccobCarta->IUD($_POST);
	}
	
	$aCarta = $ccobCarta->GetIdInfo(_NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id]));
	
	
	$form = new Form();

		$form->Fieldset();
		
			$form->Input('','label',$ccobCarta->GetCartaInfo(_NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id])));
			$form->Input('','hidden',array("name"=>'p_CCobCarta_Id', "value"=>_NVL($p_CCobCarta_Id,$_POST[p_CCobCarta_Id])));
			
			$form->Input($ccobCarta->GetLabel('DtVencto'),'date',	array("name"=>'p_DtVencto', "value"=>$aCarta["DTVENCTO"]));
			$form->Input($ccobCarta->GetLabel('State_Id'),'select',	array("name"=>'p_State_Id', "value"=>$aCarta["STATE_ID"],"option"=>$state->Calculate("StateTiNome",array("p_StateTi_Nome"=>"CartaCobranca"))));
				
			$form->Button("submit",array("value"=>"Alterar","name"=>"btUpd","class"=>"update"));
						
		$form->CloseFieldset ();	
		
	
	unset ($form);
	

	unset($view);
	unset($ccobCarta);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>