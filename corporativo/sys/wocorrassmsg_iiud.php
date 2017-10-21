<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Mensagens dos Assuntos do S.A.A. aos Atendentes","Cadastro de Mensagens dos Assuntos do S.A.A. aos Atendentes",array("ADM","CPD","SAA_ANALISTA"),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	include("../model/WOcorrAssMsg.class.php");
	
	
	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	
	$wocorrAssMsg 	= new WOcorrassMsg($dbOracle);


	if($_POST[p_O_Option] == 'select') 
	{
		$dbData->Get($wocorrAssMsg->Query("qId",array("p_WOcorrAssMsg_Id"=>$_POST[WOcorrAssMsg_Id])));
		$dadosSelect = $dbData->Row();	
	}
	
	
	
	

	$view = new ViewPage($app->title,$app->description);
	
	$view->Explain('IUD');
	
	$view->Header($user);

	$wocorrAssMsg->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
		$form->Input('',		'hidden',		array("name"=>"WOcorrAssMsg_Id","value"=>$dadosSelect[ID]));
		$form->Input('Assunto','isel',			array("name"=>'p_WOcorrAss',"href"=>'../box/wocorrass_isel.php','value'=>$dadosSelect[WOCORRASS_ID],"label"=>$dadosSelect[WOCORRASS_ID_R]));
		$form->Input('Data de Início','date',	array("name"=>"p_DtInicio","value"=>$dadosSelect[DTINICIO]));
		$form->Input('Data de Término','date',	array("name"=>"p_DtTermino","value"=>$dadosSelect[DTTERMINO]));
		$form->Input('Mensagem','textarea',		array("name"=>"p_Mensagem","class"=>"size40","value"=>$dadosSelect[TEXTO]));
	
			
		$form->Input('Exibir Alerta?','onoff' , array("name"=>'p_AbrirJanela', "value"=>$linhaSelected[ABRIRJANELA]));
		

	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($wocorrAssMsg->Query('qGeral'));
		
		echo "Total de linhas: ".$dbData->Count ();
		
		
		
		$grid = new DataGrid(array("Assunto","Dt.Início","Dt.Término","Mensagem","Exibir Alerta?","Editar","Excluir"));
		
		while($row = $dbData->RowLimit($_REQUEST[page],25)){
				
	    
				$grid->Content($row[WOCORRASS_ID_R],array('align'=>'left'));
				$grid->Content($row[DTINICIO],array('align'=>'left'));
				$grid->Content($row[DTTERMINO],array('align'=>'left'));
				$grid->Content($row[TEXTO],array('align'=>'left'));
				$grid->Content($wocorrAssMsg->OnOff($row[ABRIRJANELA]),array('align'=>'left'));
				$grid->Content($view->Edit($wocorrAssMsg,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($wocorrAssMsg,$row[ID]),array('width'=>'05%'));
							
		}
		
		unset($grid);
		
		
		$dbData->Pagination();
		
	}	
	
	unset($wocorrAssMsg);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>