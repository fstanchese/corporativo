<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Documentos Entregues por Assuntos do S.A.A.","Cadastro de Documentos Entregues por Assuntos do S.A.A.",array("ADM","SAA_ANALISTA"),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	
	include("../model/WOAXAnexoTi.class.php");
	include("../model/AnexoTi.class.php");
	
	
	
	$dbOracle 		= new Db ($user);
	
	
	$dbData 		= new DbData ($dbOracle);
	
	
	$wOAXAnexoTi 	= new WOAXAnexoTi ($dbOracle);
	$anexoTi		= new AnexoTi($dbOracle);
		

	if($_POST[p_O_Option] == 'select') 
	{
		
		
		$dbData->Get($wOAXAnexoTi->Query("qId",array("p_WOAXAnexoTi_Id"=>$_POST[WOAXAnexoTi_Id])));
		
		$dbData = $wOAXAnexoTi->Row();
		
	}
	
	
	
	
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Explain('IUD');
	
	$view->Header($user);
	
	
	
	$p_DocEntrega = 'on';
	
	$wOAXAnexoTi->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	
	$form->Input('',		'hidden',		array("name"=>'WOAXAnexoTi_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Assunto','isel',			array("name"=>'p_WOcorrAss',"href"=>'../box/wocorrass_isel.php','value'=>$dadosSelect[WOCORRASS_ID],"label"=>$dadosSelect[WOCORRASS_ID_R]));
	$form->Input("Tipo de Anexo",'select',	array('name'=>'p_AnexoTi_Id','value'=>$dadosSelect[ANEXOTI_ID],"option"=>$anexoTi->Calculate("AnexoTiList",$dbData)));

	
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		$dbData->Get($wOAXAnexoTi->Query('qWOcorrAss',array("p_WOcorrAss_Id"=>$_GET[p_WOcorrAss_Id])));		
		
		echo "Total de linhas: ".$dbData->Count ();
		
		
		
		$grid = new DataGrid(array("Assunto","Anexo","Editar","Excluir"));
		
		
		while($row = $dbData->Row()){
				
				
				$grid->Content($row[WOCORRASS_RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[ANEXOTI_RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($wOAXAnexoTi,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($wOAXAnexoTi,$row[ID]),array('width'=>'05%'));
							
		}
		
	
		unset($grid);
		
		
		
	}	
	
	unset($wOAXAnexoTi);
	unset($anexoTi);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>