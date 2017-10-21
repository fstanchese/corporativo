<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Regra de Senha - Ajuste de Prioridade - Controle de Atendimento","Regra de Senha - Ajuste de Prioridade - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CASenhaRegra.class.php");
	include("../model/CASenhaTi.class.php");	

	

	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	

	$nav = new Navigation($user, $app, $dbData);
	
	$caSenhaRegra = new CASenhaRegra($dbOracle);
		
			
	$view = new ViewPage($app->title,$app->description);
	
	
	if (!isset($_COOKIE["p_CAEvento_Id"]))
	{
		$view->Dialog("E", "Evento não Encontrado", "O evento precisa ser selecionado nas configurações para essa página funcionar corretamente", 'false', 'false', 'false', 'false');
	
		die();
	}
	
	
	if($_POST[enviar] == 'Alterar')
	{
		
		$arUpd["p_O_Option"] = "update";
		
		foreach($_POST[p_Sequencia] as $key => $value)
		{
			$arUpd["CASenhaRegra_Id"] 	= $key;
			$arUpd["Sequencia"]		 	= strtr($value,'.',',');
			
			$caSenhaRegra->IUD($arUpd);
			
			
		}
		
	}
	
	
	
	
	
	
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Regra de Senha - Ajuste de Prioridade");
		
			$dbData->Get("SELECT sequencia, sigla, id FROM casenharegra WHERE casenhati_id IN ( SELECT id FROM casenhati WHERE caassunto_id IN ( SELECT id FROM caassunto WHERE caevento_id = '".$_COOKIE["p_CAEvento_Id"]."' ) ) ORDER BY id");
			
			
			
			while($row = $dbData->Row())
			{
				$form->Input($row[SIGLA],	'range' , array("id"=>'p_Sequencia'.$row[ID], "name"=>'p_Sequencia['.$row[ID].']', "value"=>strtr($row[SEQUENCIA],',','.'),"max"=>10,"min"=>1,"step"=>"0.1"));				
			}
		
			


			$form->Button("submit",array("name"=>"enviar","value"=>"Alterar"));
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
		
	unset($caSenhaRegra);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>