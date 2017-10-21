<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Mensagens de Protocolo X Assuntos do S.A.A.","Cadastro de Mensagens de Protocolo X Assuntos do S.A.A.",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	include("../model/WOAXProtMsg.class.php");
	
	
	
	
	$dbOracle 		= new Db ($user);
	
	
	
	$dbData 		= new DbData ($dbOracle);
	
	
	$wOAXProtMsg 	= new WOAXProtMsg ($dbOracle);
		
	
	if($_POST[p_O_Option] == 'select') 
	{
		
		$dbData->Get($wOAXProtMsg->Query("qId",array("p_WOAXProtMsg_Id"=>$_POST[WOAXWOAInf_Id])));
		
		$dbData = $wOAXProtMsg->Row();
		
	}
	
	
	
	
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Explain('IUD');
	
	$view->Header($user);
	
	
	$wOAXProtMsg->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',					array("name"=>'WOAXProtMsg_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Assunto','isel',						array("name"=>'p_WOcorrAss',"href"=>'../box/wocorrass_isel.php','value'=>$dadosSelect[WOCORRASS_ID],"label"=>$dadosSelect[WOCORRASS_ID_R]));
	$form->Input('Mensagem do Protocolo','isel',		array("name"=>'p_ProtMsg',"href"=>'../box/protmsg_isel.php','value'=>$dadosSelect[PROTMSG_ID],"label"=>$dadosSelect[PROTMSG_ID_R]));
	$form->Input('Sequencia','text',					array("name"=>"p_Sequencia","class"=>"size10",'value'=>$dadosSelect[SEQUENCIA]));

	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($wOAXProtMsg->Query('qWOcorrAss',array("p_WOcorrAss_Id"=>$_GET[p_WOcorrAss_Id])));

		
		echo "Total de linhas: ".$dbData->Count ();
		
		$grid = new DataGrid(array("Assunto","Mensagem","Sequencia","Editar","Excluir"));
		
		while($row = $dbData->Row()){
				
			
				$grid->Content($row[NOMENET],array('align'=>'left'));
				$grid->Content($row[WOCORRASSINF_RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[SEQUENCIA],array('align'=>'RIGHT'));
				$grid->Content($view->Edit($wOAXProtMsg,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($wOAXProtMsg,$row[ID]),array('width'=>'05%'));
							
		}
		
		unset($grid);
		
		
		
	}	
	
	unset($wOAXProtMsg);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>