<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Informações Obrigatórias X Assuntos do S.A.A.","Cadastro de Informações Obrigatórias X Assuntos do S.A.A.",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	include("../model/WOAXWOAInf.class.php");
	
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	
	$wOAXWOAInf 	= new WOAXWOAInf ($dbOracle);
		
	
	if($_POST[p_O_Option] == 'select') 
	{
		
		$dbData->Get($wOAXWOAInf->Query("qId",array("p_WOAXWOAInf_Id"=>$_POST[WOAXWOAInf_Id])));
		
		$dadosSelect = $dbData->Row();
		
	}
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Explain('IUD');
	
	$view->Header($user);
	
	
	$wOAXWOAInf->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',	array("name"=>'WOAXWOAInf_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Assunto','isel',		array("name"=>'p_WOcorrAss',"href"=>'../box/wocorrass_isel.php','value'=>$dadosSelect[WOCORRASS_ID],"label"=>$dadosSelect[WOCORRASS_ID_R]));
	$form->Input('Informação','isel',	array("name"=>'p_WOcorrAssInf',"href"=>'../box/wocorrassinf_isel.php','value'=>$dadosSelect[WOCORRASSINF_ID],"label"=>$dadosSelect[WOCORRASSINF_ID_R]));
	$form->Input('Sequencia','text',	array("name"=>"p_Sequencia","class"=>"size10",'value'=>$dadosSelect[SEQUENCIA]));

	

	$form->Input('Informação obrigatória?','checkbox', 	array("name"=>'p_Obrigatoria','checked'=>$dadosSelect[OBRIGATORIA], "value"=>'on'));
	

	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($wOAXWOAInf->Query('qAssunto',array("p_WOcorrAss_Id"=>$_GET[p_WOcorrAss_Id])));

		
		echo "Total de linhas: ".$dbData->Count ();
		
		
		

		$grid = new DataGrid(array("Assunto","Informação","Sequencia","Editar","Excluir"));
		
		while($row = $dbData->RowLimit ($_REQUEST[page])){
				
				
				$grid->Content($row[NOMENET],array('align'=>'left'));
				$grid->Content($row[WOCORRASSINF_RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[SEQUENCIA],array('align'=>'RIGHT'));
				$grid->Content($view->Edit($wOAXWOAInf,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($wOAXWOAInf,$row[ID]),array('width'=>'05%'));
							
		}
		
		unset($grid);
		
		
		$dbData->Pagination ();
		
	}	
	
	unset($wOAXWOAInf);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>